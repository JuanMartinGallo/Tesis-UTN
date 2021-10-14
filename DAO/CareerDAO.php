<?php 
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;
    

    class CareerDAO implements ICareerDAO
    {
        private $careerList = array();

        // Funcion para agregar estudiantes

        public function Add(Career $career)
        {
            $this->RetrieveData();
            array_push($this->careerList, $career);
            $this->SaveData();
        }

        // Funcion para listar estudiantes

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->careerList;
        }

        // Funcion para actualizar un registro de estudiante

        public function Update(Career $newCareer)
        {
            $this->RetrieveData();
            $flag = 0;

            foreach($this->careerList as $key => $career)
            {
                if($career->getCareerId() == $newCareer->getCareerId())
                {
                    $this->careerList[$key] = $newCareer;
                    $flag = 1;
                }
            }

            $this->SaveData();
            return $flag;

        }

        public function Remove($careerId)
        {
            $this->RetrieveData();

            foreach($this->careerList as $key => $career)
            {
                if($career->getCareerId() == $careerId)
                {
                    unset($this->careerList[$key]);
                }
            }

            $this->SaveData();
        }

        public function GetCareerFromAPI()
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
                $newCareer->setCareerId($valuesArray["careerID"]);
                $newCareer->setDescription($valuesArray["description"]);
                $newCareer->setActive($valuesArray["active"]);
                
                $this->Add($newCareer);
            }            
        }

        private function SaveData()
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
            
            file_put_contents('Data/Career.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->careerList = array();

            if(file_exists('Data/Career.json'))
            {
                $jsonContent = file_get_contents('Data/Carrer.json');

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

        public function GetById($careerID)
        {
            $this->GetCareerFromAPI();

            foreach ($this->careerList as $career) {
                if ($career->getCareerId() == $careerID) {
                    return $career;
                }
            }
            return NULL;
        }

    }
?>