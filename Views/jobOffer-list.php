<?php 
     session_start();
     require_once('nav.php');

     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
     use DAO\CareerDAO as CareerDAO;

     $jobOfferDAO = new JobOfferDAO();
     $jobPositionDAO = new JobPositionDAO();
     $careerDAO = new CareerDAO();
     $jobOfferList = $jobOfferDAO->getAll();
     $jobPositionList = $jobPositionDAO->getAll();
     $careerList = $careerDAO->getAll();
     
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
                         <?php foreach($jobOfferList as $jobOffer) { ?>
                              <tr>
                                   <?php foreach($jobPositionList as $jobPosition) {
                                        if($jobPosition->getJobPositionId() == $jobOffer->getJobPosition()) { ?>
                                             <td><?php echo $jobPosition->getDescription(); ?></td>
                                        <?php } ?>
                                   <?php } ?>
                                   <?php foreach($careerList as $career) {
                                        if($career->getCareerId() == $jobOffer->getCareerId()) { ?>
                                             <td><?php echo $career->getDescription(); ?></td>
                                        <?php } ?>
                                   <?php } ?>
                                   <td><?php echo $jobOffer->getCompany() ?></td>
                                   <td><?php echo $jobOffer->getSalary() ?></td>
                                   <td><?php if ($jobOffer->getIsRemote() == 1){
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
                    </tbody>
               </table>
          </div>
     </section>
</main>