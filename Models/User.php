<?php
    namespace Models;

    class User
    {
        private $role;
        private $password;
        private $id;

        function __construct($role = NULL, $password = NULL, $id = NULL)
        {
            $this->role = $role;
            $this->password = $password;
            $this->id = $id;
        }

        public function getRole(){ return $this->role; }
        public function setRole($role): self { $this->role = $role; return $this; }

        public function getPassword(){ return $this->password; }
        public function setPassword($password): self { $this->password = $password; return $this; }

        public function getId(){ return $this->id; }
        public function setId($id): self { $this->id = $id; return $this; }
    }
?>