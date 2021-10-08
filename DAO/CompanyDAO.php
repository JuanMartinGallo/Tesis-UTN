<?php 
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    

class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();
        private $fileName;

        function __construct()
        {
            $this->fileName = dirname(__DIR__)."";
        }

        public function add(Company $company)
        {
            $this->retrieveData();
            array_push($this->companyList, $company);
            $this->saveData();
        }

        public function delete($name){
            $this->retrieveData();
            $newList = array();
            foreach ($this->companyList as $company) {
                if($company->getName() != $name){
                    array_push($newList, $company);
                }
            }
    
            $this->companyList = $newList;
            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->companyList;
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["name"] = $company->getName();
                $valuesArray["cuit"] = $company->getCuit();
                $valuesArray["location"] = $company->getLocation();
                $valuesArray["phoneNumber"] = $company->getPhoneNumber();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function retrieveData()
        {
            $this->companyList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $company = new Company();
                    $company->setName($valuesArray["name"]);
                    $company->setCuit($valuesArray["cuit"]);
                    $company->setLocation($valuesArray["location"]);
                    $company->setPhoneNumber($valuesArray["phoneNumber"]);

                    array_push($this->companyList, $company);
                }
            }
        }
    }

?>