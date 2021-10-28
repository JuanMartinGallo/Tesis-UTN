<?php
    namespace DAO;

    use DAO\IAdminDAO as IAdminDAO;
    use Models\Admin as Admin;

    class AdminDAO implements IAdminDAO
    {
        private $adminList = array();

        public function add(Admin $admin)
        {
            $this->retrieveData();
            array_push($this->adminList, $admin);
            $this->saveData();
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->adminList;
        }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->adminList as $admin)
            {
                $valuesArray["firstName"] = $admin->getFirstName();
                $valuesArray["lastName"] = $admin->getLastName();
                $valuesArray["dni"] = $admin->getDni();
                $valuesArray["email"] = $admin->getEmail();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/Admins.json', $jsonContent);
        }

        private function retrieveData()
        {
            $this->adminList = array();

            if(file_exists('Data/Admins.json'))
            {
                $jsonContent = file_get_contents('Data/Admins.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $admin = new admin();
                    $admin->setFirstName($valuesArray["firstName"]);
                    $admin->setLastName($valuesArray["lastName"]);
                    $admin->setDni($valuesArray["dni"]);
                    $admin->setEmail($valuesArray["email"]);

                    array_push($this->adminList, $admin);
                }
            }
        }  
    }
?>