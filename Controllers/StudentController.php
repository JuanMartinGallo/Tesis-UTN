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

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowProfileView()
        {
            require_once(VIEWS_PATH . "student-profile.php");
        }   

        public function ShowListView()
        {
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function Add($studentId, $firstName, $lastName, $dni, $gender, $birthDate, $email, $phoneNumber, $active)
        {
            $student = new Student();
            $student->setStudentId($studentId);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $student->setDni($dni);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setEmail($email);
            $student->setPhoneNumber($phoneNumber);
            $student->setActive($active);

            $this->studentDAO->Add($student);

            $this->ShowAddView();
        }

        public function logIn($email){
            $user = $this->studentDAO->getByEmail($email);

            if($user != null){
            session_start();

            $loggedUser = $user;
            //$loggedUser->setRole("depende"); aqui deberia implementar un metodo para diferenciar tipos de usuario
            $_SESSION["loggedUser"] = $loggedUser;

            $this->ShowProfileView();
            }
            else{
            echo "<script> if(confirm('Verifique que el email sea de un alumno registrado'));";
            echo "window.location = '../login.php';
		    </script>";
            }
        }
    }
?>