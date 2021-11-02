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
                    //TODO: deberia saltar un cartel de que el registro fue un exito
                }
                elseif($this->apiChecker($user)){
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    //TODO: deberia saltar un cartel de que el registro fue un exito
                }
                else{
                    echo "Error: El usuario ya existe";
                    //throw new Exception("El usuario que intenta registrar no se encuentra en la API"); preguntar como usar bien el throw
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
            $studentFromApi= $this->studentDAO->getStudentsFromAPI($user->getEmail());
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

        public function getByEmail($email)
        {
            $studentList = $this->studentDAO->getAll();
            $adminList = $this->adminDAO->getAll();
            $careerList = $this->careerDAO->getAll();
            //$jobPositionList = $this->jobPositionDAO->getAll();

            if(empty($studentList))
            {
                $this->studentDAO->getStudentsFromAPI(); //TODO: ver como arreglar desde aca
            }

            if(empty($careerList))
            {
                $this->careerDAO->getCareersFromAPI();
            }

            /*if(empty($jobPositionList))
            {
                $this->jobPositionDAO->getJobPositionsFromAPI();
            }*/
        
            foreach($studentList as $student)
            {
                if($student->getEmail() == $email)
                {
                $student->setRole("Student");
                    return $student;
                }
            }
            
            foreach($adminList as $admin)
            {
                if($admin->getEmail() == $email)
                {
                    $admin->setRole("Admin");
                    return $admin;
                }
            }
            
            return NULL;
        }
    }
?>