<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();

        public function Add(Student $student)
        {
            array_push($this->studentList, $student);
            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();
            return $this->studentList;
        }

        public function RetrieveData()
        {
            $ch = curl_init();

            $url = 'https://utn-students-api.herokuapp.com/api/Student';

            $header = array('x-api-key: API_KEY');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            $studentListAPI = ($response) ? json_decode($response, true) : array();

            foreach($studentListAPI as $student)
            {
                $newStudent = new Student();
                $newStudent->setStudentId($student["studentId"]);
                $newStudent->setCareerId($student["careerId"]);
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
                $valuesArray["careerId"] = $student->getCareerId();
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

        public function getByEmail($email){
            $this->RetrieveData();

            foreach($this->studentList as $arrayList){
                if($arrayList->getEmail() == $email)
                    return $arrayList;   
            }
            return NULL;
        }
    }
?>