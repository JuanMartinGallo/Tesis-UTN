<?php 
    namespace DAO;

    use \Exception as Exception;
    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;
    use DAO\Connection as Connection;
    
    class CareerDAO implements ICareerDAO
    {
        private $connection;
        private $tableName = "careers";

        public function add(Career $career)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (careerId, description, active) VALUES (:careerId, :description, :active);";
                
                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["lastName"] = $career->getActive();

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
                $careerList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $career = new Career();
                    $career->setDescription($row["description"]);
                    $career->setActive($row["active"]);

                    array_push($careerList, $career);
                }

                return $careerList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getCareersFromAPI()
        {
            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Career';

            $header = array('x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            $arrayToDecode = ($response) ? json_decode($response, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $newCareer = new Career();
                $newCareer->setCareerId($valuesArray["careerId"]);
                $newCareer->setDescription($valuesArray["description"]);
                $newCareer->setActive($valuesArray["active"]);
                
                $this->add($newCareer);
            }            
        }

        private function getNextId()
        {
            $id = 0;

            foreach($this->studentList as $student)
            {
                $id = ($student->getStudentId() > $id) ? $student->getStudentId() : $id;
            }

            return $id + 1;
        }

        public function getById()
        {
            $careerID = $this->getNextId();

            $careerList = $this->getAll();

            //$this->getCareersFromAPI();

            foreach ($careerList as $career)
            {
                if ($career->getCareerId() == $careerID)
                {
                    return $career;
                }
            }
            return NULL;
        }
    }
?>