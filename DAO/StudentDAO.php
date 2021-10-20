<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function add(Student $student)
        {
            $this->retrieveData();
            array_push($this->studentList, $student);
            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->studentList;
        }

        public function update(Student $newStudent)
        {
            $this->retrieveData();
            $flag = 0;

            foreach($this->studentList as $key => $student)
            {
                if($student->getStudentId() == $newStudent->getStudentId())
                {
                    $this->studentList[$key] = $newStudent;
                    $flag = 1;
                }
            }

            $this->saveData();
            return $flag;

        }

        public function remove($studentId)
        {
            $this->retrieveData();

            foreach($this->studentList as $key => $student)
            {
                if($student->getStudentId() == $studentId)
                {
                    unset($this->studentList[$key]);
                }
            }

            $this->saveData();
        }

        public function getStudentsFromAPI()
        {
            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Student';

            $header = array('x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            $arrayToDecode = ($response) ? json_decode($response, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $newStudent = new Student();
                $newStudent->setStudentId($valuesArray["studentId"]);
                $newStudent->setCareerId($valuesArray["careerId"]);
                $newStudent->setFirstName($valuesArray["firstName"]);
                $newStudent->setLastName($valuesArray["lastName"]);
                $newStudent->setDni($valuesArray["dni"]);
                $newStudent->setFileNumber($valuesArray["fileNumber"]);
                $newStudent->setGender($valuesArray["gender"]);
                $newStudent->setBirthDate($valuesArray["birthDate"]);
                $newStudent->setEmail($valuesArray["email"]);
                $newStudent->setPhoneNumber($valuesArray["phoneNumber"]);
                $newStudent->setActive($valuesArray["active"]);

                $this->add($newStudent);
            }            
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
                $valuesArray["studentId"] = $student->getStudentId();
                $valuesArray["careerId"] = $student->getCareerId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();
                $valuesArray["dni"] = $student->getDni();
                $valuesArray["fileNumber"] = $student->getFileNumber();
                $valuesArray["gender"] = $student->getGender();
                $valuesArray["birthDate"] = $student->getBirthDate();
                $valuesArray["email"] = $student->getEmail();
                $valuesArray["phoneNumber"] = $student->getPhoneNumber();
                $valuesArray["active"] = $student->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Students.json', $jsonContent);
        }

        public function retrieveData()
        {
            $this->studentList = array();

            if(file_exists('Data/Students.json'))
            {
                $jsonContent = file_get_contents('Data/Students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $student = new Student();
                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setCareerId($valuesArray["careerId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setDni($valuesArray["dni"]);
                    $student->setFileNumber($valuesArray["fileNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthDate($valuesArray["birthDate"]);
                    $student->setEmail($valuesArray["email"]);
                    $student->setPhoneNumber($valuesArray["phoneNumber"]);
                    $student->setActive($valuesArray["active"]);

                    array_push($this->studentList, $student);
                }
            }
        }

        public function getStudentList(){ 
            $this->retrieveData();
            return $this->studentList; 
        }
    }
?>