<?php require_once('header.php');
require_once('nav.php');

use DAO\CompanyDAO as CompanyDAO;

$companyDAO = new CompanyDAO();
$companyList = $companyDAO->getAll();

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de la compañia</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>CUIT</th>
                         <th>Ubicacion</th>
                         <th>Numero telefonico</th>
                    </thead>
                    <tbody>
                    <?php foreach($companyList as $company) { ?>
                         <tr>
                         <td><?php echo $company->getName() ?></td>
                         <td><?php echo $company->getCuit() ?></td>
                         <td><?php echo $company->getLocation() ?></td>
                         <td><?php echo $company->getPhoneNumber() ?></td>
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>


