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
                $query = "INSERT INTO ".$this->tableName." (jobPosition, careerId, company, salary, isRemote, description, skills, startingDate, endingDate, active) VALUES 
                (:jobPosition, :careerId, :company, :salary, :isRemote, :description, :skills, :startingDate, :endingDate, :active);";
                
                $parameters["jobPosition"] = $jobOffer->getJobPosition();
                $parameters["careerId"] = $jobOffer->getCareerId();
                $parameters["company"] = $jobOffer->getCompany();
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
                    $jobOffer->setCompany($row["company"]);
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
                    $jobOffer->setCompany($row["company"]);
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

        public function update($jobPositionId, $jobPosition, $careerId, $company, $salary, $isRemote, $description, $skills, $startingDate, $endingDate, $active)
        {
            try
            {
                $update = "UPDATE $this->tableName SET jobPosition = '$jobPosition', careerId = '$careerId', company = '$company', salary = '$salary', 
                isRemote = '$isRemote', description = '$description', skills = '$skills', startingDate = '$startingDate', 
                endingDate = '$endingDate', active = '$active' WHERE jobOfferId = '$jobPositionId'";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($update);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>