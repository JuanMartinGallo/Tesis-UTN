<?php
    namespace Controllers;

    use DAO\companyDAO as CompanyDAO;
    use Models\Company as Company;

    class companyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowListView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function Add($name, $cuit, $location, $phoneNumber, $idCompany)
        {
            $company = new company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setLocation($location);
            $company->setPhoneNumber($phoneNumber);
            $company->setIdCompany($idCompany);

            $this->companyDAO->Add($company);

            $this->ShowAddView();
        }
    }
?>