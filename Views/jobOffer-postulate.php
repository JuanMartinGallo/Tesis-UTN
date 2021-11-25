<?php
session_start();
require_once('nav.php');

use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobOfferDAO as JobOfferDAO;

$jobPositionDAO = new JobPositionDAO();
$careerDAO = new CareerDAO();
$companyDAO = new CompanyDAO();
$jobOfferDAO = new JobOfferDAO();

$jobPositionList = $jobPositionDAO->getAll();
$careerList = $careerDAO->getAll();
$companyList = $companyDAO->getAll();
if($_SESSION['userLogged']->getRole() == 'student'){
     $jobOfferList = $jobOfferDAO->postulatedJob($_SESSION['userLogged']->getStudentId());   
}
else{
    $jobOfferList = $jobOfferDAO->companyOffers($_SESSION['userLogged']->getCompanyId());
}


?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">

               <h2 class="mb-4">Datos de postulacion</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Puesto laboral</th>
                         <th>Carrera</th>
                         <th>Compañia</th>
                         <th>Salario aproximado</th>
                         <th>Puesto remoto?</th>
                         <th>Descripcion</th>
                         <th>Habilidades</th>
                         <th>Fecha de publicacion</th>
                         <th>Fecha de expiracion</th>
                    </thead>
                    <tbody>
                         <?php foreach ($jobOfferList as $jobOffer) {?>
                                   <tr>
                                        <?php foreach ($jobPositionList as $jobPosition) {
                                             if ($jobPosition->getJobPositionId() == $jobOffer->getJobPosition()) { ?>
                                                  <td><?php echo $jobPosition->getDescription(); ?></td>
                                                  
                                             <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($careerList as $career) {
                                             if ($career->getCareerId() == $jobOffer->getCareerId()) { ?>
                                                  <td><?php echo $career->getDescription(); ?></td>
                                             <?php } ?>
                                        <?php } ?>


                                        <?php foreach ($companyList as $company) {
                                             if ($company->getCompanyId() == $jobOffer->getCompanyId()) { ?>
                                                  <td><?php echo $company->getName(); ?></td>
                                             <?php } ?>
                                        <?php } ?>
                                        <td><?php echo "$" . $jobOffer->getSalary() ?></td>
                                        <td><?php if ($jobOffer->getIsRemote() == 1) {
                                                  echo "Si";
                                             } else {
                                                  echo "No";
                                             } ?></td>
                                        <td><?php echo $jobOffer->getDescription() ?></td>
                                        <td><?php echo $jobOffer->getSkills() ?></td>
                                        <td><?php echo $jobOffer->getStartingDate() ?></td>
                                        <td><?php echo $jobOffer->getEndingDate() ?></td>                                 
                                   </tr>
                              <?php } ?>
                              </tr>
                    </tbody>