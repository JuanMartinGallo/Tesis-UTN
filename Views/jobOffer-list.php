<?php
session_start();
require_once('nav.php');

date_default_timezone_set("America/Argentina/Buenos_Aires");
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


$today = date("Y-m-d");

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">

               <form action="<?php echo FRONT_ROOT ?>JobOffer/filterSelect" method="POST">
                    <div class="col-lg-4">
                         <div class="form-group">
                              <select name="jobPositionId" class="form-control">
                                   <option value="">Buscar por posicion laboral</option>
                                   <?php foreach ($jobPositionList as $jobPosition) { ?>
                                        <option value="<?php echo $jobPosition->getJobPositionId(); ?>"><?php echo $jobPosition->getDescription(); ?></option>
                                   <?php } ?>
                              </select>
                              <button type="submit" name='careerId' value="" class="btn btn-dark ml-auto d-block">Buscar </button>
                         </div>
                    </div>
                    <div class="col-lg-4">
                         <div class="form-group">
                              <select name="careerId" class="form-control">
                                   <option value="">Buscar por Carrera</option>
                                   <?php foreach ($careerList as $career) { ?>
                                        <option value="<?php echo $career->getCareerId(); ?>"><?php echo $career->getDescription(); ?></option>
                                   <?php } ?>
                              </select>
                              <button type="submit" name='jobPositionId' value="" class="btn btn-dark ml-auto d-block">Buscar</button>
                         </div>
                    </div>
               </form>

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
                         <?php foreach ($jobOfferList as $jobOffer) {
                              if ($_SESSION['userLogged']->getRole() == "admin" || $jobOffer->getActive()) { ?>
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
                                             if ($company->getCompanyId() == $jobOffer->getCompany()) { ?>
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
                                        <td>

                                             <?php
                                             if ($jobOffer->getEndingDate() == $today) {
                                                  $jobOfferDAO->disableJobOffer($jobOffer->getJobOfferId(), false);
                                                  require_once('sendMail.php');
                                             }
                                             ?>


                                             <?php if ($_SESSION['userLogged']->getRole() == "admin") { ?>

                                        <td>
                                             <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowEditView" method="POST">
                                                  <button type="submit" name='jobOfferId' value=<?php echo $jobOffer->getJobOfferId() ?> class="btn btn-dark ml-auto d-block">Editar</button>
                                             </form>
                                        </td>
                                        <td>
                                             <form action="<?php echo FRONT_ROOT ?>JobOffer/delete" method="POST">
                                                  <button type="submit" name='jobOfferId' value=<?php echo $jobOffer->getJobOfferId() ?> class="btn btn-dark ml-auto d-block">Eliminar</button>
                                             </form>
                                        </td>
                                   <?php } else { ?>
                                        <td>
                                             <form action="<?php echo FRONT_ROOT ?>JobOffer/AddPostulant" method="POST">
                                                  <input type="hidden" name="jobOfferId" value=<?php echo $jobOffer->getJobOfferId() ?>>
                                                  <button type="submit" name='studentId' value=<?php echo $_SESSION['userLogged']->getStudentId() ?> class="btn btn-dark ml-auto d-block">Postularse</button>
                                             </form>
                                        </td>
                                   </tr>
                              <?php } ?>
                              </tr>
                         <?php } ?>
                    <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>