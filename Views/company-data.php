<?php 
     session_start();
     require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de <?php echo $company->getName()?></h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>CUIT</th>
                         <th>Ubicacion</th>
                         <th>Numero telefonico</th>
                    </thead>
                    <tbody>
                         <tr>
                         <td><?php echo $company->getName() ?></td>
                         <td><?php echo $company->getCuit() ?></td>
                         <td><?php echo $company->getLocation() ?></td>
                         <td><?php echo $company->getPhoneNumber() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>