<?php 
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;
    
    class CareerDAO implements ICareerDAO
    {
        private $careerList = array();

        public function add(Career $career)
        {
            $this->retrieveData();
            array_push($this->careerList, $career);
            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->careerList;
        }

        public function update(Career $newCareer)
        {
            $this->retrieveData();
            $flag = 0;

            foreach($this->careerList as $key => $career)
            {
                if($career->getCareerId() == $newCareer->getCareerId())
                {
                    $this->careerList[$key] = $newCareer;
                    $flag = 1;
                }
            }

            $this->saveData();
            return $flag;
        }

        public function remove($careerId)
        {
            $this->retrieveData();

            foreach($this->careerList as $key => $career)
            {
                if($career->getCareerId() == $careerId)
                {
                    unset($this->careerList[$key]);
                }
            }

            $this->saveData();
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

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->careerList as $career)
            {
                $valuesArray["careerID"] = $career->getCareerId();
                $valuesArray["description"] = $career->getDescription();
                $valuesArray["active"] = $career->getActive();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Careers.json', $jsonContent);
        }

        private function retrieveData()
        {
            $this->careerList = array();

            if(file_exists('Data/Careers.json'))
            {
                $jsonContent = file_get_contents('Data/Careers.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $career = new Career();
                    $career->setCareerId($valuesArray["careerID"]);
                    $career->setDescription($valuesArray["description"]);
                    $career->setActive($valuesArray["active"]);
            
                    array_push($this->careerList, $career);
                }
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

            $this->retrieveData();

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