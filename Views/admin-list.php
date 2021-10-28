<?php 
     session_start();
     require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de administradores del sistema</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>DNI</th>
                         <th>Email</th>
                    </thead>
                    <tbody>
                    <?php foreach($adminList as $admin) { ?>
                         <tr>
                              <td><?php echo $admin->getFirstName() ?></td>
                              <td><?php echo $admin->getLastName() ?></td>
                              <td><?php echo $admin->getDni() ?></td>
                              <td><?php echo $admin->getEmail() ?></td>
                              <td>
                                        <form action="<?php echo FRONT_ROOT ?>Admin/ShowEditView" method="POST">
                                             <button type="submit" name='adminId' value=<?php echo $admin->getAdminId() ?> class="btn btn-dark ml-auto d-block">Editar</button>
                                        </form>
                                   </td>
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>