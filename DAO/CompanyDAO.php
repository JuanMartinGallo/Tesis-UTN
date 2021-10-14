<?php

namespace DAO;

use DAO\ICompanyDAO as ICompanyDAO;
use Models\Company as Company;

class CompanyDAO implements ICompanyDAO
{

    private $companyList = array();

    public function add(Company $company)
    {

        $this->retriveData();

        array_push($this->companyList, $company);

        $this->saveData();
    }

    public function getAll()
    {

        $this->retriveData();

        return $this->companyList;
    }

    public function remove($idCompany)
    {
        $this->retriveData();

        foreach ($this->companyList as $key => $value) {
            if ($value->getIdCompany() == $idCompany) {
                $this->companyList[$key]->setState(false);
            }
        }
        $this->saveData();
    }

    public function edit($idCompany)
    {
        $editedCompany = $this->searchId($idCompany);
        return $editedCompany;
    }

    public function saveAll($newList)
    {
        $this->companyList = $newList;
        $this->saveData();
    }

    public function searchId($idCompany)
    {
        $this->retriveData();

        $foundCompany = new Company();

        foreach ($this->companyList as $company) {
            if ($company->getIdCompany() == $idCompany) {
                $foundCompany = $company;
            }
        }
        return $foundCompany;
    }

    private function saveData()
    {
        $arrayToEncode = array();
        foreach ($this->companyList as $company) {
            $valuesArray["name"] = $company->getName();
            $valuesArray["cuit"] = $company->getCuit();
            $valuesArray["location"] = $company->getLocation();
            $valuesArray["phoneNumber"] = $company->getPhoneNumber();
            $valuesArray["idCompany"] = $company->getIdCompany();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/companies.json', $jsonContent);
    }

    private function retriveData()
    {
        $this->companyList = array();
        if (file_exists('Data/companies.json')) {
            $jsonContent = file_get_contents('Data/companies.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                if ($valuesArray["state"]) {
                    $company = new Company();
                    $company->setName(($valuesArray["name"]));
                    $company->setCuit($valuesArray["cuit"]);
                    $company->setLocation($valuesArray["location"]);
                    $company->setPhoneNumber($valuesArray["phoneNumber"]);
                    $company->setIdCompany($valuesArray["idCompany"]);

                    array_push($this->companyList, $company);
                }
            }
        }
    }
}