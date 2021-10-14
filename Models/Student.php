<?php
    namespace Models;

    use Models\User as User;

    class Student extends User
    {
        private $studentId;
        private $careerId;
        private $active;
        
        function __construct($firstName = NULL, $lastName = NULL, $dni = NULL, $gender = NULL, $birthDate = NULL, $email = NULL, $phoneNumber = NULL, $studentId = NULL, $careerId = NULL, $active = NULL)
        {
            parent::__construct($firstName, $lastName, $dni, $gender, $birthDate, $email, $phoneNumber);
            $this->studentId = $studentId;
            $this->careerId = $careerId;
            $this->active = $active;
        }

        public function getStudentId(){ return $this->studentId; }
        public function setStudentId($studentId): self { $this->studentId = $studentId; return $this; }

        public function getCareerId(){ return $this->careerId; }
        public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }

        public function getActive(){ return $this->active; }
        public function setActive($active): self { $this->active = $active; return $this; }
    }
?>

