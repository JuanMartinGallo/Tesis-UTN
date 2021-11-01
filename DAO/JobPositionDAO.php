<?php 
    namespace DAO;

    use DAO\IJobPositionDAO as IJobPositionDAO;
    use \Exception as Exception;
    use Models\JobPosition as JobPosition;
    use DAO\Connection as Connection;

    class JobPositionDAO implements IJobPositionDAO
    {
        private $connection;
        private $tableName = "jobPositions";

        public function add(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, careerId, description) VALUES (:jobPositionId, :careerId, :description);";
                
                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

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
                $jobPositionList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($row["jobPositionId"]);
                    $jobPosition->setCareerId($row["careerId"]);
                    $jobPosition->setDescription($row["description"]);

                    array_push($jobPositionList, $jobPosition);
                }

                return $jobPositionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getJobPositionsFromAPI()
        {
            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/JobPosition';

            $header = array('x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            $arrayToDecode = ($response) ? json_decode($response, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $newJobPosition = new JobPosition();
                $newJobPosition->setJobPositionId($valuesArray["jobPositionId"]);
                $newJobPosition->setCareerId($valuesArray["careerId"]);
                $newJobPosition->setDescription($valuesArray["description"]);

                $this->add($newJobPosition);
            }            
        }
    }
?>