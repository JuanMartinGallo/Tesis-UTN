<?php 
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\JobOffer as JobOffer;
    use Models\Alert;
    use Exception;
    use FPDF\FPDF as FPDF;
    use DAO\UserDAO as UserDAO;
    use DAO\CareerDAO as CareerDAO; 


    class JobOfferController
    {
        private $jobOfferDAO;
        private $userDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->userDAO = new UserDAO();
        }

        public function ShowAddView($alert = NULL)
        {
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function showListView($jobOfferList = NULL, $alert = NULL)
        {
            if ($jobOfferList == NULL)
            {
                $jobOfferList = $this->jobOfferDAO->GetAll();
            }
            require_once(VIEWS_PATH."jobOffer-list.php");
        }
    
        public function showEditView($jobOfferId)
        {
            $jobOffer = $this->jobOfferDAO->searchByJobOfferId($jobOfferId);
            require_once (VIEWS_PATH."jobOffer-edit.php");
        }

        public function showDataView($jobOfferId)
        {
            $jobOffer = $this->jobOfferDAO->searchByJobOfferId($jobOfferId);
            require_once (VIEWS_PATH."jobOffer-data.php");
        }

        public function ShowPostulatedStudentsView()
        {
            $careerDAO = new CareerDAO();
            $careerList = $careerDAO->getAll();
            $studentList= $this->jobOfferDAO->GetPostulatedStudents();
            require_once(VIEWS_PATH."student-list.php");
        }

        public function addPostulant($studentId, $jobOfferId)
        {
            try{
                $alert = new Alert();
                $this->jobOfferDAO->addPostulant($studentId, $jobOfferId);

                $alert->setType("success");
                $alert->setMessage("Postulante agregado exitosamente");
            }
            catch(Exception $e)
            {
                if(str_contains($e->getMessage(), 1062))
                {
                    $alert->setType("warning");
                    $alert->setMessage("Ya te postulaste a esta oferta.");

                }
            }
            finally
            {
                $this->showListView(NULL, $alert);
            }
        }

        public function ShowPostulateView()
        {
            
            require_once (VIEWS_PATH."jobOffer-postulate.php");
        }

        public function add($jobPosition, $careerId, $companyId, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active)
        {
            try
            {

            $alert= new Alert();  
             
            $jobOffer = new JobOffer();
            $jobOffer->setJobPosition($jobPosition);
            $jobOffer->setCareerId($careerId);
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setSalary($salary);
            $jobOffer->setIsRemote($isRemote);
            $jobOffer->setDescription($description);
            $jobOffer->setSkills($skills);
            $jobOffer->setStartingDate($startingDate);
            $jobOffer->setEndingDate($endingDate);
            $jobOffer->setActive($active);

            $this->jobOfferDAO->add($jobOffer);
            
            $alert->setType("success");
            $alert->setMessage("La propuesta laboral a sido cargada exitosamente.");

            if($active == 0)
            {
                $alert->setType("warning");
                $alert->setMessage("La propuesta laboral a sido cargada exitosamente. La propuesta laboral se encuentra inactiva.");
            }

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally 
            {
                 $this->ShowAddView($alert);
            }
        }

        public function edit ($jobPosition, $careerId, $companyId, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active, $jobOfferId)
        {
            $this->jobOfferDAO->update($jobPosition, $careerId, $companyId, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active, $jobOfferId);
            $this->showListView();
        }

        public function delete($jobOfferId)
        {
            $this->jobOfferDAO->remove($jobOfferId);
            $this->showListView();
        }


        public function filterSelect($jobPositionId, $careerId)
        {
            try
            {
                $alert= new Alert();
                
                $filterList = array();
                
                $newList = $this->jobOfferDAO->getAll();
            
                foreach ($newList as $jobOffer) {
                        if ($jobOffer->getJobPosition() == $jobPositionId) {
                            array_push($filterList, $jobOffer);
                        }
                        elseif($jobOffer->getCareerId() == $careerId)
                        {
                            array_push($filterList, $jobOffer);
                        }
                    }

                    $alert->setType("success");
                    $alert->setMessage("Busqueda exitosa.");


                    if($filterList == NULL)
                    {
                        $alert->setType("warning");
                        $alert->setMessage("No se encontraron postulaciones con esa informacion.");
                    }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            finally 
            {
                $this->showListView($filterList, $alert);
            }
        }


        public function disableJobOffer($jobOfferId,$active)
        {
            $this->jobOfferDAO->disableJobOffer($jobOfferId,$active);
            $this->showListView();
        }

        public function generatePDF()
        {
            $pdf = new FPDF('P','mm','A4');
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial','',16);
            $userList=$this->userDAO->GetAll();

            $pdf->Cell(0,20,('Listado de Postulantes'),0,0,'C',0);
            $pdf->Ln(30);
            $pdf->Cell(90,10,utf8_decode('Email'),1,1,'C',0);


            foreach ($userList as $user)
            {
                if($user->getRole() == 'user')
                {
                $pdf->Cell(90,10,$user->getEmail(),1,1,'C',0);
                }
            }  
            $pdf->Output();

        }
    }
