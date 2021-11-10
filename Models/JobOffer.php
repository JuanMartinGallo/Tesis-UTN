<?php 
    namespace Models;

    class JobOffer
    {
        private $jobOfferId;
        private $jobPosition;
        private $careerId;
        private $companyId;
        private $city;
        private $salary;
        private $isRemote;
        private $description;
        private $skills;
        private $startingDate;
        private $endingDate;
        private $active;

        public function __construct($jobOfferId = NULL, $jobPosition = NULL, $careerId = NULL, $companyId = NULL, $city = NULL, $salary = NULL, $isRemote = true, $description = NULL, $skills = NULL, $startingDate = NULL, $endingDate = NULL, $active = true)
        {
            $this->jobOfferId = $jobOfferId;
            $this->jobPosition = $jobPosition;
            $this->careerId = $careerId;
            $this->companyId = $companyId;
            $this->city = $city;
            $this->salary = $salary;
            $this->isRemote = $isRemote;
            $this->description = $description;
            $this->skills = $skills;
            $this->startingDate = $startingDate;
            $this->endingDate = $endingDate;
            $this->active = $active;
        }

        public function getJobOfferId(){ return $this->jobOfferId; }
        public function setJobOfferId($jobOfferId): self { $this->jobOfferId = $jobOfferId; return $this; }

        public function getJobPosition(){ return $this->jobPosition; }
        public function setJobPosition($jobPosition): self { $this->jobPosition = $jobPosition; return $this; }

        public function getCareerId(){ return $this->careerId; }
        public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }

        public function getCity(){ return $this->city; }
        public function setCity($city): self { $this->city = $city; return $this; }

        public function getSalary(){ return $this->salary; }
        public function setSalary($salary): self { $this->salary = $salary; return $this; }

        public function getIsRemote(){ return $this->isRemote; }
        public function setIsRemote($isRemote): self { $this->isRemote = $isRemote; return $this; }

        public function getDescription(){ return $this->description; }
        public function setDescription($description): self { $this->description = $description; return $this; }

        public function getSkills(){ return $this->skills; }
        public function setSkills($skills): self { $this->skills = $skills; return $this; }

        public function getStartingDate(){ return $this->startingDate; }
        public function setStartingDate($startingDate): self { $this->startingDate = $startingDate; return $this; }

        public function getEndingDate(){ return $this->endingDate; }
        public function setEndingDate($endingDate): self { $this->endingDate = $endingDate; return $this; }

        public function getActive(){ return $this->active; }
        public function setActive($active): self { $this->active = $active; return $this; }

        public function getCompanyId(){ return $this->companyId; }
        public function setCompanyId($companyId): self { $this->companyId = $companyId; return $this; }
    }
?>