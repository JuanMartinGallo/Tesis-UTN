<?php
require_once('nav.php');

use DAO\CompanyDAO as CompanyDAO;

$companyDAO = new CompanyDAO();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <form action="<?php echo FRONT_ROOT ?>Company/Filter" method="post">
                    <div class="col-lg-3">
                         <div class="form-group">
                              <label for="">Buscar:</label>
                              <input  type="text" name="name" value="" class="form-control">
                         </div>
                    </div>
               </form>

               <h2 class="mb-4">Lista de compañias</h2>

               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                    </thead>
                    <tbody>

                         <?php foreach ($companyList as $company) { ?>
                              <tr>
                                   <td><?php echo $company->getName() ?></td>
                                   <td>
                                        <form action="<?php echo FRONT_ROOT ?>Company/ShowDataView" method="post">
                                             <button type="submit" name='idCompany' value=<?php echo $company->getIdCompany() ?> class="btn btn-dark ml-auto d-block">Ver Perfil</button>
                                        </form>
                                   </td>
                                   <td>
                                        <form action="<?php echo FRONT_ROOT ?>Company/ShowEditView" method="post">
                                             <button type="submit" name='idCompany' value=<?php echo $company->getIdCompany() ?> class="btn btn-dark ml-auto d-block">Editar</button>
                                        </form>
                                   </td>
                                   <td>
                                        <form action="<?php echo FRONT_ROOT ?>Company/Delete" method="post">
                                             <button type="submit" class="btn btn-dark ml-auto d-block">Eliminar</button>
                                        </form>
                                   </td>
                              </tr>
                         <?php } ?>

                    </tbody>
               </table>
          </div>
     </section>
</main>