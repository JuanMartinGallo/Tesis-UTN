<?php 

    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use \Exception as Exception;
    use Models\Alert;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO;
        }

        public function showAddView($alert = NULL)
        {
            require_once (VIEWS_PATH."company-add.php");
        }

        public function showEditView($companyId)
        {
            $company = $this->companyDAO->search($companyId);
            require_once (VIEWS_PATH."company-edit.php");
        }

        public function showDataView($companyId)
        {
            $company = $this->companyDAO->search($companyId);
            require_once (VIEWS_PATH."company-data.php");
        }

        public function showListView($name = null, $cuit = null, $location = null)
        {
            $companyList = $this->companyDAO->getAll();

            if($name || $cuit || $location)
            {
                $companyList = $this->filterList($companyList, $name, $cuit, $location);
            }

            require_once (VIEWS_PATH."company-list.php");
        }

        public function add($zipCode, $name, $cuit, $location, $phoneNumber)
        {
            try
            {
                $alert = new Alert();

                $company = new Company();
                $company->setZipCode($zipCode);
                $company->setName($name);
                $company->setCuit($cuit);
                $company->setLocation($location);
                $company->setPhoneNumber($phoneNumber);

                $this->companyDAO->add($company);

                $alert->setType("success");
                $alert->setMessage("La empresa ha sido ingresada correctamente.");
            }
            catch(Exception $e)
            {
                if(str_contains($e->getMessage(), 1062))
                {
                    $alert->setType("warning");
                    $alert->setMessage("La empresa que intenta agregar contiene un CUIT ya existente en la base de datos.");
                }
                else
                {
                    $alert->setType("danger");
                    $alert->setMessage("Error al ingresar la empresa.");
                }
            }
            finally
            {
                $this->showAddView($alert);
            }
        }

        public function edit ($zipCode, $name, $cuit, $location, $phoneNumber, $companyId)
        {
            $this->companyDAO->update($zipCode, $name, $cuit, $location, $phoneNumber, $companyId);
            $this->showListView();
        }

        public function filterList($companyList, $name, $cuit, $location)
        { 
            if($name)
            {
                $filteredList = array();
                foreach($companyList as $company)
                {
                    if(str_contains(strtolower($company->getName()), strtolower($name)))
                    {
                        array_push($filteredList, $company);
                    }
                }
                $companyList = $filteredList;
            }
            if($cuit)
            {
                $filteredList = array();
                foreach($companyList as $company)
                {
                    if(str_contains(strtolower($company->getCuit()), strtolower($cuit)))
                    {
                        array_push($filteredList, $company);
                    }
                }
                $companyList = $filteredList;
            }
            if($location)
            {
                $filteredList = array();
                foreach($companyList as $company)
                {
                    if(str_contains($company->getLocation(), $location))
                    {
                        array_push($filteredList, $company);
                    }
                }
                $companyList = $filteredList;
            }
            return $companyList;
        }

        public function delete($companyId)
        {
            $this->companyDAO->remove($companyId);
            $this->showListView();
        }

        public function filter($name)
        {
            $newList = $this->companyDAO->getAll();

            foreach($newList as $company)
            {
                if(strncasecmp ($company->getName(), $name,10))
                {
                    $this->showListView($name);
                }
            }       
        }
    }
?>