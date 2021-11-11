<?php
    namespace Controllers;

    use DAO\CareerDAO as CareerDAO;
    use Models\Career as Career;

    class CareerController
    {
        private $careerDAO;

        public function __construct()
        {
            $this->careerDAO = new CareerDAO();
        }

        public function showAddView()
        {
            require_once(VIEWS_PATH."career-add.php");
        }

        public function showListView()
        {
            $careerList = $this->careerDAO->getAll();
            require_once(VIEWS_PATH."career-list.php");
        }

        public function add($careerId, $description, $active)
        {
            $newCareer = new Career();
            $newCareer->setCareerId($careerId);
            $newCareer->setDescription($description);
            $newCareer->setActive($active);

            $this->careerDAO->add($newCareer);

            $this->showAddView();
        }
    }
?>