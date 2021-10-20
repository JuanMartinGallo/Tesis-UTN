<?php
     require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos del alumno</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Apellido</th>
                         <th>DNI</th>
                         <th>Legajo</th>
                         <th>Genero</th>
                         <th>Carrera</th>
                         <th>Fecha de nacimiento</th>
                         <th>Email</th>
                         <th>Telefono</th>
                    </thead>
                    <tbody>
                    <?php foreach($studentList as $student) { ?>
                         <tr>
                              <td><?php echo $student->getFirstName() ?></td>
                              <td><?php echo $student->getLastName() ?></td>
                              <td><?php echo $student->getDni() ?></td>
                              <td><?php echo $student->getFileNumber() ?></td>
                              <td><?php echo $student->getGender() ?></td>
                              <td><?php echo $student->getCareerId() ?></td>
                              <td><?php echo $student->getBirthDate() ?></td>
                              <td><?php echo $student->getEmail() ?></td>
                              <td><?php echo $student->getPhoneNumber() ?></td>
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>