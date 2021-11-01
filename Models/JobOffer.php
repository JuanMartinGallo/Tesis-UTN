<?php 
    namespace Models;

    class JobOffer
    {
        private $jobOfferId;
        private $jobPosition;
        private $company;
        private $city;
        private $salary;
        private $isRemote;
        private $description;
        private $active;

        public function __construct($jobOfferId = NULL, $jobPosition = NULL, $company = NULL, $city = NULL, $salary = NULL, $isRemote = true, $description = NULL, $active = true)
        {
            $this->jobOfferId = $jobOfferId;
            $this->jobPosition = $jobPosition;
            $this->company = $company;
            $this->city = $city;
            $this->salary = $salary;
            $this->isRemote = $isRemote;
            $this->description = $description;
            $this->active = $active;
        }

        public function getJobOfferId(){ return $this->jobOfferId; }
        public function setJobOfferId($jobOfferId): self { $this->jobOfferId = $jobOfferId; return $this; }

        public function getJobPosition(){ return $this->jobPosition; }
        public function setJobPosition($jobPosition): self { $this->jobPosition = $jobPosition; return $this; }

        public function getCompany(){ return $this->company; }
        public function setCompany($company): self { $this->company = $company; return $this; }

        public function getCity(){ return $this->city; }
        public function setCity($city): self { $this->city = $city; return $this; }

        public function getSalary(){ return $this->salary; }
        public function setSalary($salary): self { $this->salary = $salary; return $this; }

        public function getIsRemote(){ return $this->isRemote; }
        public function setIsRemote($isRemote): self { $this->isRemote = $isRemote; return $this; }

        public function getDescription(){ return $this->description; }
        public function setDescription($description): self { $this->description = $description; return $this; }

        public function getActive(){ return $this->active; }
        public function setActive($active): self { $this->active = $active; return $this; }
    }
?>