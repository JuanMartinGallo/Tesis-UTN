<?php 

     require_once('nav.php');

     use DAO\AdminDAO as AdminDAO;

     $adminDAO = new AdminDAO();
     $adminList = $adminDAO->getAll();

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
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>