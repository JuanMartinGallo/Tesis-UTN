<?php 
    namespace DAO;

    use Models\JobPosition as JobPosition;

    class JobPositionDAO
    {
        private $jobPositionList = array();

        public function add(JobPosition $jobPosition)
        {
            $this->retrieveData();
            array_push($this->jobPositionList, $jobPosition);
            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->jobPositionList;
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

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->jobPositionList as $jobPosition)
            {
                $valuesArray["jobPositionId"] = $jobPosition->getJobPositionId();
                $valuesArray["careerId"] = $jobPosition->getCareerId();
                $valuesArray["description"] = $jobPosition->getDescription();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/JobPositions.json', $jsonContent);
        }

        public function retrieveData()
        {
            $this->studentList = array();

            if(file_exists('Data/JobPositions.json'))
            {
                $jsonContent = file_get_contents('Data/JobPositions.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
                    $jobPosition->setCareerId($valuesArray["careerId"]);
                    $jobPosition->setDescription($valuesArray["description"]);

                    array_push($this->jobPositionList, $jobPosition);
                }
            }
        }

        public function getJobPositionList()
        { 
            $this->retrieveData();
            return $this->jobPositionList; 
        }
    }
?>