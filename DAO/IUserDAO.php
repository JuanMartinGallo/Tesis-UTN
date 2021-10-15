<?php
    namespace DAO;

    use Models\Student as Student;

    interface IUserDAO
    {
        function add(Student $student);
        //function getAll();
    }
?>