<?php 

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;

class CompanyController
{
    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
    }

    public function ShowAddView()
    {
        require_once (VIEWS_PATH."company-add.php");
    }

    public function ShowEditView($Edit)
    {
        $company = $this->companyDAO->Edit($Edit);
        require_once (VIEWS_PATH."company-edit.php");
    }

    public function ShowDataView($idCompany)
    {
        $company = $this->companyDAO->searchId($idCompany);

        require_once (VIEWS_PATH."company-data.php");
    }

    public function ShowListView($name = null, $cuit = null, $location = null)
    {
        session_start();
        $companyList = $this->companyDAO->getAll();

        if($name || $cuit || $location)
        {
            $companyList = $this->filterList($companyList, $name, $cuit, $location);
        }

        require_once (VIEWS_PATH."company-list.php");
    }

    public function ShowAdminView($name = null, $cuit = null, $location = null)
    {
        $companyList = $this->companyDAO->getAll();

        require_once (VIEWS_PATH."admin-home.php");
    }

    public function Add($name, $cuit, $location, $phoneNumber)
    {
        $company = new Company();
        $company->setIdCompany(count($this->companyDAO->getAll())+1);
        $company->setName($name);
        $company->setCuit($cuit);
        $company->setLocation($location);
        $company->setPhoneNumber($phoneNumber);

        $this->companyDAO->add($company);

        $this->ShowAddView();
    }

    public function Edit ($idCompany, $name, $cuit, $location, $phoneNumber)
    {
        $newList = $this->companyDAO->GetAll();

        foreach($newList as $company) {
            if($company->getIdCompany() == $idCompany){
                $company->setName($name);
                $company->setCuit($cuit);
                $company->setLocation($location);
                $company->setPhoneNumber($phoneNumber);

            }
        }

        $this->companyDAO->saveAll($newList);
        $this->ShowListView();
    }

    public function Action($Remove = "", $Edit = "", $getData = "")
    {
        if ($Edit != "")
        {
            $this->ShowEditView($Edit);
        } else if($Remove != "")
        {
            $this->companyDAO->remove($Remove);
            $this->ShowListView();
        } else if($getData!="")
        {
            $this->ShowDataView($getData);
        }
    }

    private function filterList($companyList, $name, $cuit, $location)
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
}
