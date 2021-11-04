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

        public function showListView()
        {
            $jobOfferList = $this->jobOfferDAO->getAll();

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

        public function add($jobPosition, $careerId, $company, $city, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active)
        {
            $jobOffer = new JobOffer();
            $jobOffer->setJobPosition($jobPosition);
            $jobOffer->setCareerId($careerId);
            $jobOffer->setCompany($company);
            $jobOffer->setCity($city);
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

        public function edit ($jobPositionId, $jobPosition, $careerId, $company, $city, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active)
        {
            $this->jobOfferDAO->update($jobPositionId, $jobPosition, $careerId, $company, $city, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active);
            $this->showListView();
        }

        public function delete($jobOfferId)
        {
            $this->jobOfferDAO->remove($jobOfferId);
            $this->showListView();
        }
    }
?>
