<?php
    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    use \Exception as Exception;
    use Models\Alert as Alert;
    use Models\Admin as Admin;
    use FPDF\FPDF as FPDF;

class AdminController
    {
        private $adminDAO;

        public function __construct()
        {
            $this->adminDAO = new AdminDAO();
        }

        public function showAddView($alert = NULL)
        {
            require_once(VIEWS_PATH."admin-add.php");
        }

        public function showListView()
        {
            $adminList = $this->adminDAO->getAll();
            require_once(VIEWS_PATH."admin-list.php");
        }

        public function ShowEditView($adminId)
        {
            $admin = $this->adminDAO->search($adminId);
            require_once (VIEWS_PATH."admin-edit.php");
        }

        public function edit ($firstName, $lastName, $dni, $email, $adminId)
        {
            $this->adminDAO->update($firstName, $lastName, $dni, $email, $adminId);
            $this->showListView();
        }

        public function add($firstName, $lastName, $dni, $email, $password)
        {
            try
            {
                $alert = new Alert();

                $admin = new Admin();
                $admin->setFirstName($firstName);
                $admin->setLastName($lastName);
                $admin->setDni($dni);
                $admin->setEmail($email);
                $admin->setPassword($password);

                $this->adminDAO->add($admin);

                $alert->setType("success");
                $alert->setMessage("El administrador ha sido ingresado correctamente.");
            }
            catch (Exception $e)
            {
                if(str_contains($e->getMessage(), 1062))
                {
                    $alert->setType("warning");
                    $alert->setMessage("El administrador no puede ser agregado debido a una entrada duplicada de email o dni.");

                }
                else
                {
                    $alert->setType("danger");
                    $alert->setMessage("Error al ingresar el administrador.");
                }
            }
            finally
            {
                $this->showAddView($alert);
            }
        }
        
        public function generatePDF()
        {
            $pdf = new FPDF('P','mm','A4');
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial','',16);
            $adminList = $this->adminDAO->getAll();

            $pdf->Cell(0,20,('Listado de Administradores'),0,0,'C',0);
            $pdf->Ln(30);
            $pdf->Cell(40,10,utf8_decode('Nombre'),1,0,'C',0);
            $pdf->Cell(40,10,utf8_decode('Apellido'),1,0,'C',0);
            $pdf->Cell(90,10,utf8_decode('EMail'),1,1,'C',0);

            foreach ($adminList as $admin)
            {
                $pdf->Cell(40,10,$admin->getFirstName(),1,0,'C',0);
                $pdf->Cell(40,10,$admin->getLastName(),1,0,'C',0);
                $pdf->Cell(90,10,$admin->getEmail(),1,1,'C',0);
            }

            
            $pdf->Output();

        }
    }
?>