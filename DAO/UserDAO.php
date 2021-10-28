<?php
    namespace DAO;
  
    use DAO\StudentDAO as StudentDAO;
    use DAO\AdminDAO as AdminDAO;
    use DAO\CareerDAO as CareerDAO;
    use DAO\JobPositionDAO as JobPositionDAO;

    class UserDAO 
    {
        private $studentDAO;
        private $adminDAO;
        private $careerDAO;
        private $jobPositionDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->adminDAO = new AdminDAO();
            $this->careerDAO = new CareerDAO();
            $this->jobPositionDAO = new JobPositionDAO();
        }
        
        public function getByEmail($email)
        {
            $studentList = $this->studentDAO->getAll();
            $adminList = $this->adminDAO->getAll();
            $careerList = $this->careerDAO->getAll();
            $jobPositionList = $this->jobPositionDAO->getAll();

            if(empty($studentList))
            {
                $this->studentDAO->getStudentsFromAPI();
            }

            if(empty($careerList))
            {
                $this->careerDAO->getCareersFromAPI();
            }

            /*if(empty($jobPositionList))
            //{
                $this->jobPositionDAO->getJobPositionsFromAPI();
            }*/
        
            foreach($studentList as $student)
            {
                if($student->getEmail() == $email)
                {
                    $student->setRole("Student");
                    return $student;
                }
            }
            
            foreach($adminList as $admin)
            {
                if($admin->getEmail() == $email)
                {
                    $admin->setRole("Admin");
                    return $admin;
                }
            }
            
            return NULL;
        }
    }
?>