<?php

require_once('nav.php');
require_once('header.php');

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de empresas</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/ShowListView" method="post" class="bg-light-alpha p-5">
                    <div class="row">
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Nombre de la empresa" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="cuit" value="<?php echo $cuit; ?>" placeholder="CUIT" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="location" value="<?php echo $location; ?>" placeholder="Locacion" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="form-group">
                                   <input type="text" name="phoneNumber" value="<?php echo $phoneNumber; ?>" placeholder="Numero de Telefono" class="form-control">
                              </div>
                         </div>
                    </div>
               </form>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>CUIT</th>
                         <th>Locacion</th>
                         <th>Numero de Telefono</th>
                    </thead>
                    <tbody>
                         <form action="<?php echo FRONT_ROOT ?>Company/Action" method="post" class="bg-light-alpha p-5">
                              <?php
                              foreach ($companyList as $company) {
                              ?>
                                   <tr>
                                        <td><?php echo $company->getName() ?></td>
                                        <td><?php echo $company->getCuit() ?></td>
                                        <td><?php echo $company->getLocation() ?></td>
                                        <td><?php echo $company->getPhoneNumber() ?></td>
                                        <?php
                                        if ($_SESSION["loggedUser"]->getRole() == "Admin") {
                                        ?>
                                             <td>
                                                  <button type="submit" name="Remove" class="btn btn-danger" value="<?php echo $company->getIdCompany() ?>"><i class="fas fa-trash-alt"></i></button>
                                                  <button type="submit" name="Edit" class="btn btn-dark" value="<?php echo $company->getIdCompany() ?>"><i class="fas fa-pencil-alt"></i></button>
                                                  <button type="submit" name="getData" class="btn btn-dark" value="<?php echo $company->getIdCompany() ?>">Ver datos</i></button>
                                             </td>
                                        <?php
                                        }
                                        ?>
                                   </tr>
                              <?php
                              }
                              ?>
                              </tr>
                      
                    </tbody>
               </table>
          </div>
     </section>
</main>