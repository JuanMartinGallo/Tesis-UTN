<?php
    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    use Models\Admin as Admin;

    class AdminController
    {
        private $adminDAO;

        public function __construct()
        {
            $this->adminDAO = new AdminDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."admin-add.php");
        }

        public function ShowListView()
        {
            $adminList = $this->adminDAO->getAll();

            require_once(VIEWS_PATH."admin-list.php");
        }

        public function add($firstName, $lastName, $dni, $email)
        {
            $admin = new Admin();
            $admin->setfirstName($firstName);
            $admin->setLastName($lastName);
            $admin->setDni($dni);
            $admin->setEmail($email);

            $this->adminDAO->add($admin);

            $this->showListView();
        }
    }
?>