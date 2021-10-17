<?php
    namespace Models;

    class User
    {
        private $role;

        function __construct($role = NULL)
        {
            $this->role = $role;
        }

        public function getRole(){ return $this->role; }
        public function setRole($role): self { $this->role = $role; return $this; }
    }
?>