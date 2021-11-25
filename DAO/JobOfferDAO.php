<?php 
    namespace DAO;

    use DAO\IJobOfferDAO as IJobOfferDAO;
    use \Exception as Exception;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $connection;
        private $tableName = "jobOffers";

        public function add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPosition, careerId, companyId, salary, isRemote, description, skills, startingDate, endingDate, active) VALUES 
                (:jobPosition, :careerId, :companyId, :salary, :isRemote, :description, :skills, :startingDate, :endingDate, :active);";

                $parameters["jobPosition"] = $jobOffer->getJobPosition();
                $parameters["careerId"] = $jobOffer->getCareerId();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                $parameters["salary"] = $jobOffer->getSalary();
                $parameters["isRemote"] = $jobOffer->getIsRemote();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["skills"] = $jobOffer->getSkills();
                $parameters["startingDate"] = $jobOffer->getStartingDate();
                $parameters["endingDate"] = $jobOffer->getEndingDate();
                $parameters["active"] = $jobOffer->getActive();
          
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function addPostulant($studentId, $jobOfferId)
        {
            try
            {
                $query = "INSERT INTO students_x_jobOffers (studentId, jobOfferId) VALUES (:studentId, :jobOfferId);";
                
                $parameters["studentId"] = $studentId;
                $parameters["jobOfferId"] = $jobOfferId;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getAll()
        {
            try
            {
                $jobOffersList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setJobPosition($row["jobPosition"]);
                    $jobOffer->setCareerId($row["careerId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setIsRemote($row["isRemote"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setStartingDate($row["startingDate"]);
                    $jobOffer->setEndingDate($row["endingDate"]);
                    $jobOffer->setActive($row["active"]);

                    array_push($jobOffersList, $jobOffer);
                }

                return $jobOffersList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function remove($jobOfferId)
        {
            try
            {
                $remove = "DELETE FROM $this->tableName WHERE jobOfferId = '$jobOfferId'"; 
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($remove);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function searchByJobOfferId($jobOfferId)
        {
            try
            {

                $search = "SELECT * FROM $this->tableName WHERE jobOfferId = '$jobOfferId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($search);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setJobPosition($row["jobPosition"]);
                    $jobOffer->setCareerId($row["careerId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setIsRemote($row["isRemote"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setStartingDate($row["startingDate"]);
                    $jobOffer->setEndingDate($row["endingDate"]);
                    $jobOffer->setActive($row["active"]);
                }

                return $jobOffer;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function update($jobPosition, $careerId, $companyId, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active, $jobOfferId)
        {
            try
            {
                $update = "UPDATE $this->tableName SET jobPosition = '$jobPosition', careerId = '$careerId', companyId = '$companyId', salary = '$salary', 
                isRemote = '$isRemote', description = '$description', skills = '$skills', startingDate = '$startingDate', 
                endingDate = '$endingDate', active = '$active' WHERE jobOfferId = '$jobOfferId'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($update);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function disableJobOffer($jobOfferId,$active)
        {
            try
            {
                $disable =  "UPDATE $this->tableName SET active = '$active'  WHERE jobOfferId = '$jobOfferId'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($disable);
            }
            
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function postulatedJob($studentId)
        {
            try
            {
                $listId = array();
                $jobOffersList = array();
                $search = "SELECT * FROM students_x_jobOffers jobOfferId  WHERE studentId = '$studentId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($search);


                foreach($resultSet as $row)
                {
                    $jobOfferId = $row["jobOfferId"];
                    array_push($listId, $jobOfferId);
                }
                foreach($listId as $id)
                {
                    $jobOffer = new JobOffer();
                    $jobOffer = $this->searchByJobOfferId($id);
                    array_push($jobOffersList, $jobOffer);
                }          
                return $jobOffersList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function companyOffers($companyId){
            try{
                $listId = array();
                $jobOffersList = array();
                $search = "SELECT * FROM $this->tableName WHERE companyId = '$companyId'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($search);

                foreach ($resultSet as $row) {
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setJobPosition($row["jobPosition"]);
                    $jobOffer->setCareerId($row["careerId"]);
                    $jobOffer->setCompanyId($row["companyId"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setIsRemote($row["isRemote"]);
                    $jobOffer->setDescription($row["description"]);
                    $jobOffer->setSkills($row["skills"]);
                    $jobOffer->setStartingDate($row["startingDate"]);
                    $jobOffer->setEndingDate($row["endingDate"]);
                    $jobOffer->setActive($row["active"]);

                    array_push($jobOffersList, $jobOffer);
                }
                return $jobOffersList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>