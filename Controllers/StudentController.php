<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function showAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function showListView()
        {
            $studentList = $this->studentDAO->getAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function showLoggedStudentView()
        {
            $studentList = $this->studentDAO->getAll();

            require_once(VIEWS_PATH."student-logged.php");
        }

        public function add($studentId, $firstName, $lastName, $dni, $gender, $birthDate, $email, $phoneNumber, $active)
        {
            $student = new Student();
            $student->setStudentId($studentId);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);
            $student->setDni($dni);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setEmail($email);
            $student->setPhoneNumber($phoneNumber);
            $student->setActive($active);

            $this->studentDAO->add($student);

            $this->showListView();
        }
    }
?>