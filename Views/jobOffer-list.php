<?php 
     session_start();
     require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de postulacion</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Puesto laboral</th>
                         <th>Compañia</th>
                         <th>Ciudad</th>
                         <th>Salario</th>
                         <th>Puesto remoto</th>
                         <th>Descripcion</th>
                    </thead>
                    <tbody>
                         <tr>
                         <td><?php echo $jobOffer->getJobPosition() ?></td>
                         <td><?php echo $jobOffer->getCompany() ?></td>
                         <td><?php echo $jobOffer->getCity() ?></td>
                         <td><?php echo $jobOffer->getSalary() ?></td>
                         <td><?php echo $jobOffer->getRemote() ?></td>
                         <td><?php echo $jobOffer->getDescription() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>