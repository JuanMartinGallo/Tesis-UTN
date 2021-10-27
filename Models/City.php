<?php 
    namespace Models;

    class City
    {
        private $name;
        private $postalCode;

        public function __construct($name = NULL, $postalCode = NULL)
        {
            $this->name = $name;
            $this->postalCode = $postalCode;
        }

        public function getName(){ return $this->name; }
        public function setName($name): self { $this->name = $name; return $this; }

        public function getPostalCode(){ return $this->postalCode; }
        public function setPostalCode($postalCode): self { $this->postalCode = $postalCode; return $this; }
    }
?>