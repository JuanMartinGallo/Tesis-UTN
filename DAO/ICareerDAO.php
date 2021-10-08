<?php 
    namespace DAO;

    use Models\Career as Career;

interface ICareerDAO
    {
        function add(Career $career);
        function getAll();
    }
?>