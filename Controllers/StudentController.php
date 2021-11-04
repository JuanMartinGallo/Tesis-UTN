<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;
    use DAO\CareerDAO as CareerDAO;

    class StudentController
    {
        private $studentDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function showListView()
        {
            $careerList = $this->careerDAO->getAll();
            $studentList = $this->studentDAO->getAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function showEditView($studentId)
        {
            $student = $this->studentDAO->searchStudentById($studentId);
            require_once (VIEWS_PATH."student-edit.php");
        }

        public function showProfileView()
        {
            if (isset($_SESSION['userLogged']))
            {
                $userLogged = $_SESSION['userLogged'];
            }
            require_once(VIEWS_PATH."student-profile.php");
        }

        public function add($firstName, $lastName, $dni, $fileNumber, $gender, $careerId, $birthDate, $email, $phoneNumber, $active = true)
        {
            $student = new Student();
            $student->setStudentId(count($this->studentDAO->getAll())+1);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);
            $student->setDni($dni);
            $student->setFileNumber($fileNumber);
            $student->setGender($gender);
            $student->setCareerId($careerId);
            $student->setBirthDate($birthDate);
            $student->setEmail($email);
            $student->setPhoneNumber($phoneNumber);
            $student->setActive($active);

            $this->studentDAO->add($student);

            $this->showListView();
        }

        public function edit ($firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $studentId)
        {
            $this->studentDAO->update($firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $studentId);
            $this->showListView();
        }

        public function delete($studentId)
        {
            $this->studentDAO->remove($studentId);
            $this->showListView();
        }

    }
