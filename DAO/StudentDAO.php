<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
    use DAO\Connection as Connection;
    use DAO\IUserDAO as IUserDAO;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class StudentDAO implements IStudentDAO
    {

        private $connection;
        private $tableName = "students";

        public function add(Student $student)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName. " (studentId, userId, careerId, firstName, lastName, role, dni, fileNumber, gender, birthDate, email, password, phoneNumber, active) VALUES (:studentId, :userId, :careerId, :firstName, :lastName, :role, :dni, :fileNumber, :gender, :birthDate, :email, :password, :phoneNumber, :active);";

                $parameters["studentId"] = $student->getStudentId();
                $parameters["userId"] = $this->getNextId();
                $parameters["careerId"] = $student->getCareerId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["role"] = 'student';
                $parameters["dni"] = $student->getDni();
                $parameters["fileNumber"] = $student->getFileNumber();
                $parameters["gender"] = $student->getGender();
                $parameters["birthDate"] = $student->getBirthDate();
                $parameters["email"] = $student->getEmail();
                $parameters["password"] = $student->getPassword();
                $parameters["phoneNumber"] = $student->getPhoneNumber();
                $parameters["active"] = $student->getActive();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function getNextId()
        {
            $id = 0;
            $userDAO = new UserDAO();
            $userList = $userDAO->getAll();

            foreach($userList as $user)
            {
                $id = ($user->getUserId() > $id) ? $user->getUserId() : $id;
            }

            return $id;
        }

        public function getAll()
        {
            try
            {
                $studentList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setStudentId($row["studentId"]);
                    $student->setUserId($row["userId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPassword($row["password"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["active"]);

                    array_push($studentList, $student);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function update($firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $studentId)
        {
            $update = "UPDATE  $this->tableName 
            SET firstName='$firstName', lastName='$lastName', dni='$dni', fileNumber='$fileNumber', gender='$gender', 
            birthDate='$birthDate', email='$email', phoneNumber='$phoneNumber'
            WHERE studentId = '$studentId'";

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($update);
        }

        public function searchStudentById($studentId)
        {
            try
            {
                $search = "SELECT * FROM $this->tableName WHERE studentId = '$studentId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($search);
            
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setStudentId($row["studentId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                }

                return $student;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function remove($studentId)
        {
            try
            {
                $remove = "DELETE FROM $this->tableName WHERE studentId = '$studentId'"; 
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($remove);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getStudentsFromAPI($user)
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
                if($valuesArray["email"] == $user->getEmail())
                {
                    $newStudent = new Student();
                    $newStudent->setStudentId($valuesArray["studentId"]);
                    $newStudent->setUserId($user->getUserId());
                    $newStudent->setCareerId($valuesArray["careerId"]);
                    $newStudent->setFirstName($valuesArray["firstName"]);
                    $newStudent->setLastName($valuesArray["lastName"]);
                    $newStudent->setDni($valuesArray["dni"]);
                    $newStudent->setFileNumber($valuesArray["fileNumber"]);
                    $newStudent->setGender($valuesArray["gender"]);
                    $newStudent->setBirthDate($valuesArray["birthDate"]);
                    $newStudent->setEmail($valuesArray["email"]);
                    $newStudent->setPassword($user->getPassword());
                    $newStudent->setPhoneNumber($valuesArray["phoneNumber"]);
                    $newStudent->setActive($valuesArray["active"]);
                    
                    return $newStudent;
                }           
            }
            return null;
        }
    }
?>