<?php
    namespace DAO;

   
    use DAO\StudentDAO as StudentDAO;
    use DAO\AdminDAO as AdminDAO;

    class userDAO 
    {
        private $studentDAO;
        private $adminDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->adminDAO = new AdminDAO();
        }
        
         public function getByEmail($email)
        {
            $studentList = $this->studentDAO->getStudentList();
            $adminList = $this->adminDAO->getAdminList();
            //$this->studentDAO->getStudentsFromAPI(); 

            foreach ($studentList as $student) {
                if ($student->getEmail() == $email) {
                    $student->setRole("Student");
                    return $student;
                }
            }

            foreach ($adminList as $admin) {
                if ($admin->getEmail() == $email) {
                    $admin->setRole("Admin");
                    return $admin;
                }
            }

            return NULL;
        }
    }
?>