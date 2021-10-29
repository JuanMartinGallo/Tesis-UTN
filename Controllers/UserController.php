<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;

    class UserController
    {
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function showRegisterView()
        {
            require_once(VIEWS_PATH . "register.php");
        }

        public function login($email)
        {
            $user = $this->userDAO->GetByEmail($email);

            if (($user != null)) {
                session_start();

                $_SESSION["userLogged"] = $user;

                require_once(VIEWS_PATH . "home.php");
            }
            else
            {
                echo '<script language="javascript">alert("Email no Registrado");</script>';
                require_once(VIEWS_PATH . "login.php");

            }
        }
    }
?>