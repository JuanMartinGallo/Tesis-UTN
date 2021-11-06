<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IAdminDAO as IAdminDAO;
    use Models\Admin as Admin;
    use DAO\Connection as Connection;

    class AdminDAO implements IAdminDAO
    {
        private $connection;
        private $tableName = "admins";

        public function add(Admin $admin)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (firstName, lastName, dni, email, adminId) VALUES (:firstName, :lastName, :dni, :email, :adminId);";
                
                $parameters["firstName"] = $admin->getFirstName();
                $parameters["lastName"] = $admin->getLastName();
                $parameters["dni"] = $admin->getDni();
                $parameters["email"] = $admin->getEmail();
                $parameters["adminId"] = $admin->getAdminId();

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
                $adminList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $admin = new Admin();
                    $admin->setFirstName($row["firstName"]);
                    $admin->setLastName($row["lastName"]);
                    $admin->setDni($row["dni"]);
                    $admin->setEmail($row["email"]);
                    $admin->setAdminId($row["adminId"]);

                    array_push($adminList, $admin);
                }

                return $adminList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function remove($adminId)
        {
            try
            {
                $remove = "DELETE FROM $this->tableName WHERE adminId = '$adminId'"; 
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($remove);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function search($adminId)
        {
            try
            {
                $search = "SELECT * FROM $this->tableName WHERE adminId = '$adminId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($search);
                
                foreach ($resultSet as $row)
                {                
                    $admin = new Admin();
                    $admin->setFirstName($row["firstName"]);
                    $admin->setLastName($row["lastName"]);
                    $admin->setDni($row["dni"]);
                    $admin->setEmail($row["email"]);
                    $admin->setAdminId($row["adminId"]);
                }

                return $admin;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function update($firstName, $lastName, $dni, $eMail, $adminId)
        {
            $update = "UPDATE  $this->tableName 
            SET firstName='$firstName', lastName='$lastName', dni='$dni', email='$eMail'
            WHERE adminId = '$adminId'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->ExecuteNonQuery($update);
        }
    }
?>