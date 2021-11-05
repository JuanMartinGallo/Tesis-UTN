<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use DAO\Connection as Connection;

    class CompanyDAO implements ICompanyDAO
    {

        private $connection;
        private $tableName = "companies";

        public function add(Company $company)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name, cuit, location, phoneNumber,zipCode) VALUES (:name, :cuit, :location, :phoneNumber, :zipCode);";
                
                $parameters["name"] = $company->getName();
                $parameters["cuit"] = $company->getCuit();
                $parameters["location"] = $company->getLocation();
                $parameters["phoneNumber"] = $company->getPhoneNumber();
                $parameters["zipCode"] = $company->getZipCode();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            try
            {
                $companyList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setName($row["name"]);
                    $company->setCuit($row["cuit"]);
                    $company->setLocation($row["location"]);
                    $company->setPhoneNumber($row["phoneNumber"]);
                    $company->setCompanyId($row["companyId"]);
                    $company->setZipCode($row["zipCode"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function remove($companyId)
        {
            try
            {
                $remove = "DELETE FROM $this->tableName WHERE companyId = '$companyId'"; 
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($remove);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function search($companyId)
        {
            try
            {

                $search = "SELECT * FROM $this->tableName WHERE companyId = '$companyId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($search);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setName($row["name"]);
                    $company->setCuit($row["cuit"]);
                    $company->setLocation($row["location"]);
                    $company->setPhoneNumber($row["phoneNumber"]);
                    $company->setcompanyId($row["companyId"]);
                    $company->setZipCode($row["zipCode"]);
                }

                return $company;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function update($name, $cuit, $location, $phoneNumber, $companyId, $zipCode)
        {
            try
            {
                $query = "UPDATE $this->tableName SET name = '$name', cuit = '$cuit', location = '$location', phoneNumber = '$phoneNumber', zipCode = '$zipCode' WHERE companyId = '$companyId'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>