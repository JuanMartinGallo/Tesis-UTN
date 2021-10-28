<?php

namespace Controllers;

session_start();
class HomeController
{
    public function index($message = "")
    {
        require_once(VIEWS_PATH . "login.php");
    }

    public function home($message = "")
    {
        require_once(VIEWS_PATH . "home.php");
    }

    public function logout($message = "")
    {
        if (!empty($_SESSION["userLogged"]))
        {
            unset($_SESSION["userLogged"]);
        }

        session_destroy();

        header("location:../index.php");
    }
}
