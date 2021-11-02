<?php
    namespace Models;

    class User
    {
        private $role;
        private $password;
        private $userId;
        private $email;

        function __construct($role = NULL, $password = NULL, $userId = NULL, $email = NULL)
        {
            $this->role = $role;
            $this->password = $password;
            $this->userId = $userId;
            $this->email = $email;
        }

        public function getRole(){ return $this->role; }
        public function setRole($role): self { $this->role = $role; return $this; }

        public function getPassword(){ return $this->password; }
        public function setPassword($password): self { $this->password = $password; return $this; }

        public function getUserId(){ return $this->userId; }
        public function setUserId($userId): self { $this->userId = $userId; return $this; }

        public function getEmail(){ return $this->email; }
        public function setEmail($email): self { $this->email = $email; return $this; }
    }
?>