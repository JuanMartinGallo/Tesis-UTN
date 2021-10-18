<?php
    namespace DAO;

    use DAO\IAdminDAO as IAdminDAO;
    use Models\Admin as Admin;

    class AdminDAO implements IAdminDAO
    {
        private $adminList = array();

        // Funcion para agregar admins

        public function add(Admin $admin)
        {
            $this->retrieveData();
            array_push($this->adminList, $admin);
            $this->saveData();
        }

        // Funcion para listar admins

        public function getAll()
        {
            $this->retrieveData();
            return $this->adminList;
        }

        /*public function getadminsFromAPI()
        {
            $ch = curl_init();

            $url = 'https://utn-admins-api.herokuapp.com/api/admin';

            $header = array('x-api-key: 4f3bceed-50ba-4461-a910-518598664c08');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            $arrayToDecode = ($response) ? json_decode($response, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $newadmin = new admin();
                $newadmin->setadminId($valuesArray["adminId"]);
                $newadmin->setCareerId($valuesArray["careerId"]);
                $newadmin->setFirstName($valuesArray["firstName"]);
                $newadmin->setLastName($valuesArray["lastName"]);
                $newadmin->setDni($valuesArray["dni"]);
                $newadmin->setFileNumber($valuesArray["fileNumber"]);
                $newadmin->setGender($valuesArray["gender"]);
                $newadmin->setBirthDate($valuesArray["birthDate"]);
                $newadmin->setEmail($valuesArray["email"]);
                $newadmin->setPhoneNumber($valuesArray["phoneNumber"]);
                $newadmin->setActive($valuesArray["active"]);

                $this->add($newadmin);
            }            
        }*/

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

        public function getAdminList()
        {
            $this->retrieveData();
            return $this->adminList;
        }
    }
?>