<?php 
    namespace Models;

    class Cities 
    {
        private $name;
        private $zipCode;

        public function __construct($name = NULL, $zipCode = NULL)
        {
            $this->name = $name;
            $this->zipCode = $zipCode;
        }

        public function getName(){ return $this->name; }
        public function setName($name): self { $this->name = $name; return $this; }

        public function getZipCode(){ return $this->zipCode; }
        public function setZipCode($zipCode): self { $this->zipCode = $zipCode; return $this; }
    }
?>
