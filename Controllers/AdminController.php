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

        public function showAddView()
        {
            require_once(VIEWS_PATH."admin-add.php");
        }

        public function showListView()
        {
            $adminList = $this->adminDAO->getAll();

            require_once(VIEWS_PATH."admin-list.php");
        }

        public function ShowEditView($adminId)
        {
            $admin = $this->adminDAO->search($adminId);
            require_once (VIEWS_PATH."admin-edit.php");
        }

        public function edit ($firstName, $lastName, $dni, $email, $adminId)
    {
        $this->adminDAO->update($firstName, $lastName, $dni, $email, $adminId);
        $this->showListView();
    }

        public function add($firstName, $lastName, $dni, $email)
        {
            $admin = new Admin();
            $admin->setfirstName($firstName);
            $admin->setLastName($lastName);
            $admin->setDni($dni);
            $admin->setEmail($email);
            $admin->setAdminId(count($this->adminDAO->getAll())+1);;

            $this->adminDAO->add($admin);

            $this->showListView();
        }
    }
?>