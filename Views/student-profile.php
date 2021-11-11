<?php
     session_start();
     require_once('nav.php');

     use DAO\CareerDAO as CareerDAO;
     $careerDAO = new CareerDAO();
     $careerList = $careerDAO->getAll();
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
                         <tr>
                              <td><?php echo $_SESSION['userLogged']->getFirstName() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getLastName() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getDni() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getFileNumber() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getGender() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getCareerId() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getBirthDate() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getEmail() ?></td>
                              <td><?php echo $_SESSION['userLogged']->getPhoneNumber() ?></td>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>