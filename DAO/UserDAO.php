<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use DAO\StudentDAO as StudentDAO;
    use Models\User as User;
    use Models\Student as Student;

    class userDAO extends StudentDAO implements IUserDAO 
    {
        private $studentList = array();
        

        // Funcion para agregar estudiantes

        public function add(Student $student)
        {
            $this->retrieveData();
            array_push($this->studentList, $student);
            $this->saveData();
        }

    /*// Funcion para listar estudiantes

        public function getAll()
        {
            $this->retrieveData();
            return $this->userList;
        }

        // Funcion para actualizar un registro de estudiante

        public function update(user $newuser)
        {
            $this->retrieveData();
            $flag = 0;

            foreach($this->userList as $key => $student)
            {
                if($student->getUserId() == $newuser->getUserId())
                {
                    $this->userList[$key] = $newuser;
                    $flag = 1;
                }
            }

            $this->saveData();
            return $flag;

        }

        public function remove($studentId)
        {
            $this->retrieveData();

            foreach($this->userList as $key => $student)
            {
                if($student->getuserId() == $studentId)
                {
                    unset($this->userList[$key]);
                }
            }

            $this->saveData();
        }*/

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

        foreach ($arrayToDecode as $valuesArray) {
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
                $valuesArray["userId"] = $student->getStudentId();
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

        private function retrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/Students.json'))
            {
                $jsonContent = file_get_contents('Data/Students.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $student = new student();
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

        public function getByEmail($email)
        {
            $this->getStudentsFromAPI();

            foreach ($this->studentList as $student) {
                if ($student->getEmail() == $email) {
                    $student->setRole = "Student";
                    return $student;
                }
            }

            foreach ($this->studentList as $student) {
                if ($student->getEmail() == $email) {
                    $student->setRole = "Student";
                    return $student;
                }
            }
            
        }
    }
?>