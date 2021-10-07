<?php 
    namespace Repositories;

    use Models\Career as Career;

interface ICareerRepository
    {
        function add(Career $career);
        function getAll();
    }
?>