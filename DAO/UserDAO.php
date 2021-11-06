<?php
    namespace DAO;
  
    use \Exception as Exception;
    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;
    use DAO\StudentDAO as StudentDAO;
    use DAO\AdminDAO as AdminDAO;
    use DAO\CareerDAO as CareerDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Throwable;	

    class UserDAO implements IUserDAO
    {
        private $studentDAO;
        private $adminDAO;
        private $careerDAO;
        private $jobPositionDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->adminDAO = new AdminDAO();
            $this->careerDAO = new CareerDAO();
            $this->jobPositionDAO = new JobPositionDAO();
        }

        private $connection;
        private $tableName = "users";

        public function add(user $user)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, role) VALUES (:email, :password, :role);";
                
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["role"] = $user->getRole();

                $this->connection = Connection::GetInstance();

                if($this->dbChecker($user)){
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    echo "<script> if(confirm('El Usuario fue registrado con exito.'));";
                    echo "window.location = '../Home';
                   </script>";
                }
                elseif($this->apiChecker($user)){
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    $studentFromApi= $this->studentDAO->getStudentsFromAPI($user);
                    $this->studentDAO->add($studentFromApi);
                    echo "<script> if(confirm('El Usuario fue registrado con exito.'));";
                    echo "window.location = '../Home';
                    </script>";
		            
                }
                else{
                    
                    throw new Exception("El usuario que intenta registrar no se encuentra en la API");
                }

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function dbChecker(user $user){
            $studentList = $this->studentDAO->getAll();
            if(!empty($studentList)){
                foreach($studentList as $student){
                    if($student->getEmail() == $user->getEmail()){
                        return true;
                    }
                }
            }
            else{
                return false;
            }
        }

        public function apiChecker(user $user){
            $studentFromApi= $this->studentDAO->getStudentsFromAPI($user);
            if(!empty($studentFromApi)){
                return true;
            }
            else{
                return false;
            }
        }

        public function getAll()
        {
            try {
                $userList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {
                    $user = new User();
                    $user->setRole($row["role"]);
                    $user->setPassword($row["password"]);
                    $user->setUserId($row["userId"]);
                    $user->setEmail($row["email"]);

                    array_push($userList, $user);
                }

                return $userList;
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function getByEmail($email, $password)
        {
            $studentList = $this->studentDAO->getAll();
            $adminList = $this->adminDAO->getAll();
            $careerList = $this->careerDAO->getAll();
            //$jobPositionList = $this->jobPositionDAO->getAll();

            if(empty($careerList))
            {
                $this->careerDAO->getCareersFromAPI();
            }

            /*if(empty($jobPositionList))
            {
                $this->jobPositionDAO->getJobPositionsFromAPI();
            }*/
            if(!empty($studentList)){
                foreach($studentList as $student){
                    if($student->getEmail() == $email){
                        if($student->getPassword() == $password){
                            return $student;
                        }
                    }
                }
            }
            
            if(!empty($adminList)){
                foreach($adminList as $admin){
                    if($admin->getEmail() == $email){
                        if($admin->getPassword() == $password){
                            return $admin;
                        }
                    }
                }
            }
            return NULL;
        }
    }
?>