<?php
    namespace Controllers;

    use \Exception as Exception;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;
    use Models\Alert as Alert;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function showRegisterView($alert = NULL)
        {
            $value = 0;
            require_once(VIEWS_PATH . "register.php");
        }

        public function showRegisterViewAdmin($alert = NULL)
        {
            $value = 2;
            require_once(VIEWS_PATH . "register.php");
        }

        public function showRegisterViewCompany($alert = NULL)
        {
            $value = 1;
            require_once(VIEWS_PATH . "register.php");
        }

        public function add($email, $password, $value){
            try
            {
                $alert = new Alert();

                $user = new User;
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setRole('user');
                $this->userDAO->add($user, $value);

                $alert->setType("success");
                $alert->setMessage("El usuario ha sido ingresado correctamente.");
            }
            catch(Exception $ex)
            {
                if(str_contains($ex->getMessage(), 1062))
                {
                    $alert->setType("warning");
                    $alert->setMessage("El usuario que intenta registrar ya se encuentra registrado");

                }
                else
                {
                    $alert->setType("danger");
                    $alert->setMessage("El usuario que intenta agregar no existe en la base de datos/API o se encuentra inactivo.");
                }
            }
            finally
            {
                if($value == 0)
                {
                    $this->showRegisterView($alert);
                }
            }

        }

        public function showLoginView($alert = NULL)
        {
            require_once(VIEWS_PATH . "login.php");
        }

        public function login($email, $password)
        {    
            try
            {
                $alert= new Alert();

                $user = $this->userDAO->GetByEmail($email, $password);

                if ($user != null) {
                    session_start();
                    
                    $_SESSION["userLogged"] = $user;

                    require_once(VIEWS_PATH . "home.php");
                    die();
                }
            }
            catch(Exception $ex)
            {
                $alert->setType("danger");
                $alert->setMessage("El usuario no existe, debe registrarse para poder iniciar sesion.");
            }
            finally
            {
                $this->showLoginView($alert);
            }
        }
    }
?>