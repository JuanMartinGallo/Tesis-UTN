<?php
require_once('nav.php');
require_once('header.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de la empresa</h2>
               <table class="table bg-light-alpha">
                    <tbody>
                         <tr>
                              <th>ID</th>
                              <td><?php echo $company->getIdCompany() ?></td>
                         </tr>
                         <tr>
                              <th>Nombre</th>
                              <td><?php echo $company->getName() ?></td>
                         </tr>
                         <tr>
                              <th>CUIT</th>
                              <td><?php echo $company->getCuit() ?></td>
                         </tr>
                         <tr>
                              <th>Locacion</th>
                              <td><?php echo $company->getLocation() ?></td>
                         </tr>
                         <tr>
                              <th>Numero de Telefono</th>
                              <td><?php echo $company->getPhoneNumber() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>