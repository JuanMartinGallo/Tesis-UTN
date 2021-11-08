<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function add(User $user, $value);
        function getAll();
    }
