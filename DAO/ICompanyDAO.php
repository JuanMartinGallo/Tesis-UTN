<?php 
    namespace DAO;

    use Models\Company as Company;
    use DAO\Connection as Connection;

    interface ICompanyDAO
    {
        function add(Company $company);
        function getAll();
    }
?>