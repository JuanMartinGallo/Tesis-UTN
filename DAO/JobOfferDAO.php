<?php 
    namespace DAO;

    use DAO\IJobOfferDAO as IJobOfferDAO;
    use \Exception as Exception;
    use Models\JobOffer as JobOffer;
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO
    {
        private $connection;
        private $tableName = "jobPositions";

        public function add(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, careerId, description) VALUES (:jobPositionId, :careerId, :description);";
                
                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>
