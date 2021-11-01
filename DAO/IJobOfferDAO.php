<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;

    interface IJobOfferDAO
    {
        function add(JobOffer $jobOffer);
        function getAll();
    }
?>