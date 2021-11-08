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
    use DAo\CompanyDAO as CompanyDAO;

class UserDAO implements IUserDAO
    {
        private $studentDAO;
        private $adminDAO;
        private $careerDAO;
        private $companyDAO;
        private $jobPositionDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->adminDAO = new AdminDAO();
            $this->careerDAO = new CareerDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
        }

        private $connection;
        private $tableName = "users";

        public function add(user $user, $value)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (email, password, role) VALUES (:email, :password, :role);";
                
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();
                $parameters["role"] = $user->getRole();

                $this->connection = Connection::GetInstance();

                if($value == 0){
                    if($this->dbChecker($user)){
                        $this->connection->ExecuteNonQuery($query, $parameters);
                    }
                     elseif($this->apiChecker($user)){
                        $this->connection->ExecuteNonQuery($query, $parameters);
                        $studentFromApi= $this->studentDAO->getStudentsFromAPI($user);
                        $this->studentDAO->add($studentFromApi);
                    }
                }
                else{
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    $alert= null;
                    require_once (VIEWS_PATH."company-add.php");
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

        public function loadingLists(){
                $careerList = $this->careerDAO->getAll();
                $jobPositionList = $this->jobPositionDAO->getAll();

                if(empty($careerList))
                {
                    $this->careerDAO->getCareersFromAPI();
                }

                if(empty($jobPositionList))
                {
                    $this->jobPositionDAO->getJobPositionsFromAPI();
                }
        }

        public function getByEmail($email, $password)
        {
            try{
                $userList = $this->getAll();
                $adminList = $this->adminDAO->getAll();
                $studentList = $this->studentDAO->getAll();
                $companyList = $this->companyDAO->getAll();
                $this->loadingLists();

                if(!empty($studentList)){
                    foreach($userList as $user){
                        if($user->getEmail() == $email && $user->getPassword() == $password){
                            foreach($studentList as $student){
                                if($student->getEmail() == $email){
                                    return $student;
                                }
                            }
                        }
                    }
                }

                if(!empty($companyList)){
                    foreach($userList as $user){
                        if($user->getEmail() == $email && $user->getPassword() == $password){
                            foreach($companyList as $company){
                                if($company->getEmail() == $email){
                                    return $company;
                                }
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
                            else{
                                throw new Exception("Password incorrect");
                                require_once (VIEWS_PATH."login.php");
                            }
                        }
                    }
                }

                return null; //TODO: ver como hacer para que tire un error cuando intento logearme con una cuenta no registrada o usa una contraseña incorrecta
            }

            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>