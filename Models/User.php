<?php
    namespace Models;

    class User
    {
        private $username;
        private $password;
        private $role;

        function __construct($username = NULL, $password = NULL, $role = NULL)
        {
            $this->username = $username;
            $this->password = $password;
            $this->role = $role;
        }

        public function getUsername(){ return $this->username; }
        public function setUsername($username): self { $this->username = $username; return $this; }

        public function getPassword(){ return $this->password; }
        public function setPassword($password): self { $this->password = $password; return $this; }

        public function getRole(){ return $this->role; }
        public function setRole($role): self { $this->role = $role; return $this; }
    }
?>