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
                $query = "INSERT INTO ".$this->tableName." (jobOfferId, jobPosition, company, city, salary, isRemote, description) VALUES (:jobOfferId, :jobPosition, :company, :city, :salary, :isRemote, :description);";
                
                $parameters["jobOfferId"] = $jobOffer->getJobOfferId();
                $parameters["jobPosition"] = $jobOffer->getJobPosition();
                $parameters["company"] = $jobOffer->getCompany();
                $parameters["city"] = $jobOffer->getCity();
                $parameters["salary"] = $jobOffer->getSalary();
                $parameters["isRemote"] = $jobOffer->getIsRemote();
                $parameters["description"] = $jobOffer->getDescription();

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
                    $jobOffer->setCompany($row["company"]);
                    $jobOffer->setCity($row["city"]);
                    $jobOffer->setSalary($row["salary"]);
                    $jobOffer->setIsRemote($row["isRemote"]);
                    $jobOffer->setDescription($row["description"]);

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