<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function Add(Student $student)
        {
            $this->RetrieveData();
            array_push($this->studentList, $student);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->studentList;
        }

        private function DestroyJSON()
        {
            file_put_contents('Data/Students.json', $jsonContent = array());
        }

        public function GetStudentsFromAPI()
        {
            $this->DestroyJSON();

            $studentListJSON = file_get_contents('https://utn-students-api.herokuapp.com/api/Student');

            $studentListAPI = ($studentListJSON) ? json_decode($studentListJSON, true) : array();

            foreach($studentListAPI as $student)
            {
                $newStudent = new Student();
                $newStudent->setStudentId($student["studentId"]);
                $newStudent->setFirstName($student["firstName"]);
                $newStudent->setLastName($student["lastName"]);
                $newStudent->setDni($student["dni"]);
                $newStudent->setGender($student["gender"]);
                $newStudent->setBirthDate($student["birthDate"]);
                $newStudent->setEmail($student["email"]);
                $newStudent->setPhoneNumber($student["phoneNumber"]);
                $newStudent->setActive($student["active"]);

                $this->Add($newStudent);
            }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
                $valuesArray["studentId"] = $student->getStudentId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();
                $valuesArray["dni"] = $student->getDni();
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

        private function RetrieveData()
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
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setDni($valuesArray["dni"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthDate($valuesArray["birthDate"]);
                    $student->setEmail($valuesArray["email"]);
                    $student->setPhoneNumber($valuesArray["phoneNumber"]);
                    $student->setActive($valuesArray["active"]);

                    array_push($this->studentList, $student);
                }
            }
        }
    }
?>