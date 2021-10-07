<?php 
    namespace Repositories;

    use Repositories\ICareerRepository as ICareerRepository;
    use Models\Career as Career;
    

class CareerRepository implements ICareerRepository
    {
        private $careerList = array();
        private $fileName;

        function __construct()
        {
            $this->fileName = dirname(__DIR__)."";
        }

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

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->careerList as $career)
            {
                $valuesArray["careerId"] = $career->getCareerId();
                $valuesArray["description"] = $career->getDescription();
                $valuesArray["active"] = $career->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function retrieveData()
        {
            $this->careerList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $career = new Career();
                    $career->setCareerId($valuesArray["careerId"]);
                    $career->setDescription($valuesArray["description"]);
                    $career->setActive($valuesArray["active"]);

                    array_push($this->careerList, $career);
                }
            }
        }
    }

?>