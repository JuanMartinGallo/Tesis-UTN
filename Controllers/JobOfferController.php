<?php 
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\JobOffer as JobOffer;

    class JobOfferController
    {
        private $jobOfferDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function showListView($jobOfferList = NULL)
        {
            if($jobOfferList == NULL)
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

        public function addPostulant($studentId, $jobOfferId)
        {
            $this->jobOfferDAO->addPostulant($studentId, $jobOfferId);
            require_once (VIEWS_PATH."jobOffer-postulate.php");
        }

        public function ShowPostulateView()
        {
            
            require_once (VIEWS_PATH."jobOffer-postulate.php");
        }

        public function add($jobPosition, $careerId, $companyId, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active)
        {
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
            $this->showListView();
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
            $this->showListView($filterList);
        }

        public function disableJobOffer($jobOfferId,$active)
        {
            $this->jobOfferDAO->disableJobOffer($jobOfferId,$active);
            $this->showListView();
        }
    }?>

     
    