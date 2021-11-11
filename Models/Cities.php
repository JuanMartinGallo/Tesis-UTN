<?php 
    namespace Models;

    class Cities 
    {
        private $zipCode;
        private $cityName;
        private $location;

        public function __construct($zipCode = null, $cityName = null, $location = null)
        {
            $this->zipCode = $zipCode;
            $this->cityName = $cityName;
            $this->location = $location;
        }

        public function getZipCode(){ return $this->zipCode; }
        public function setZipCode($zipCode): self { $this->zipCode = $zipCode; return $this; }

        public function getCityName(){ return $this->cityName; }
        public function setCityName($cityName): self { $this->cityName = $cityName; return $this; }

        public function getLocation(){ return $this->location; }
        public function setLocation($location): self { $this->location = $location; return $this; }
    }
?>
