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

        public function Login($email)
        {
            $user = $this->userDAO->GetByEmail($email);

            if (($user != null)) {
                session_start();

                $_SESSION["userLogged"] = $user;

                require_once(VIEWS_PATH . "home.php");
            }

            else{
            require_once(VIEWS_PATH . "login.php");//deberia saltarle un mensaje al usuario erroneo sobre su cuenta que no esta registrada
            }
        }
    }
