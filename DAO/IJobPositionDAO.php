<?php 
    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface IJobPositionDAO
    {
        function add(JobPosition $jobPosition);
        function getAll();
    }
?>