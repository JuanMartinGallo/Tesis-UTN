<?php 
    namespace DAO;

    use \Exception as Exception;
    use DAO\ICitiesDAO as ICitiesDAO;
    use Models\Cities as Cities;
    use DAO\Connection as Connection;

    class CitiesDAO implements ICitiesDAO
    {
        private $connection;
        private $tableName = "cities";

        public function getAll(){
            try
            {
                $citiesList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($query);

                foreach ($resultSet as $row) {
                    $cities = new Cities();
                    $cities->setName($row["name"]);
                    $cities->setZipCode($row["zipCode"]);

                array_push($citiesList, $cities);
                }

            }catch(Exception $ex){
                throw $ex;
            }
        }
    }
