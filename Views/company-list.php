<?php require_once('header.php');

use DAO\CompanyDAO as CompanyDAO;

$companyDAO = new CompanyDAO();
$companyList = $companyDAO->getAll();

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de las compañias</h2>
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
                         <td><form action="<?php echo FRONT_ROOT ?>Company/ShowEditView" method="post" >
                              <button type="submit" name=<?php echo $company->getIdCompany() ?> value = <?php echo $company->getIdCompany() ?> class="btn btn-dark ml-auto d-block">Editar</button>
                              </form>
                         </td>
                         <td><form action="<?php echo FRONT_ROOT ?>Company/Delete" method="post" >
                              <button type="submit" name=<?php echo $company->getIdCompany() ?> value = <?php echo $company->getIdCompany() ?> class="btn btn-dark ml-auto d-block">Eliminar</button>
                              </form>
                         </td>
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>


