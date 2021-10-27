<?php 
    namespace Models;

    class JobPosition
    {
        private $jobPositionId;
        private $careerId;
        private $description;

        public function __construct($jobPositionId = NULL, $careerId = NULL, $description = NULL)
        {
            $this->jobPositionId = $jobPositionId;
            $this->careerId = $careerId;
            $this->description = $description;
        }

        public function getJobPositionId(){ return $this->jobPositionId; }
        public function setJobPositionId($jobPositionId): self { $this->jobPositionId = $jobPositionId; return $this; }

        public function getCareerId(){ return $this->careerId; }
        public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }

        public function getDescription(){ return $this->description; }
        public function setDescription($description): self { $this->description = $description; return $this; }
    }
?>