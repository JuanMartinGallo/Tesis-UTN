<?php 
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use Models\JobOffer as JobOffer;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;



    class JobOfferController
    {
        private $jobOfferDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."jobOffer-add.php");
        }

        public function showListView($filterList = NULL)
        {
            if($filterList == NULL)
            {
                $jobOfferList = $this->jobOfferDAO->GetAll();
            }
            else
            {
                $jobOfferList=$filterList;
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

        public function add($jobPosition, $careerId, $company, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active)
        {
            $jobOffer = new JobOffer();
            $jobOffer->setJobPosition($jobPosition);
            $jobOffer->setCareerId($careerId);
            $jobOffer->setCompany($company);
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

        public function edit ($jobPosition, $careerId, $company, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active, $jobOfferId)
        {
            $this->jobOfferDAO->update($jobPosition, $careerId, $company, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active,$jobOfferId);
            $this->showListView();
        }

        public function delete($jobOfferId)
        {
            $this->jobOfferDAO->remove($jobOfferId);
            $this->showListView();
        }
        
        

        public function filter($search)
        {


            $filterList = array();
            $jobPositionList = $this->jobPositionDAO->getAll();
            $careerList = $this->careerDAO->getAll();

            $newList = $this->jobOfferDAO->getAll();


            foreach ($newList as $jobOffer) {
            
            foreach ($jobPositionList as $jobPosition) {
                
                similar_text(strtolower($jobPosition->getDescription()), strtolower($search), $similar);
                    
                if ($similar > 5 && $jobOffer->getJobPosition() == $jobPosition->getJobPositionId()) {
                    array_push($filterList, $jobOffer);
                }
            }
            }

            foreach ($careerList as $career) {
                
                similar_text(strtolower($career->getDescription()), strtolower($search), $similar);

                if ($similar > 5 && $jobOffer->getCareerId() == $career->getCareerId()) {
                    array_push($filterList, $jobOffer);
                }
            }
        

            if($search == NULL)
            {
                $filterList = $this->jobOfferDAO->getAll();
            }

            $this->showListView($filterList);
        }
    }?>

     
    