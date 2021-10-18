<?php
    namespace DAO;

    use Models\Admin as Admin;

    interface IAdminDAO
    {
        function add(Admin $admin);
        function getAll();
    }
?>