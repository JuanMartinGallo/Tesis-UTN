<?php

use Models\Student;

session_start();
     require_once('nav.php');

     use DAO\CareerDAO as CareerDAO;
     $careerDAO = new CareerDAO();
     $careerList = $careerDAO->getAll();

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de alumnos</h2>
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
                    <?php foreach($studentList as $student){ ?>
                         <tr>
                              <td><?php echo $student->getFirstName() ?></td>
                              <td><?php echo $student->getLastName() ?></td>
                              <td><?php echo $student->getDni() ?></td>
                              <td><?php echo $student->getFileNumber() ?></td>
                              <td><?php echo $student->getGender() ?></td>
                              <td><?php foreach($careerList as $career){
                                   if($career->getCareerId() == $student->getCareerId()){
                                        echo $career->getDescription();
                                   }
                              }?></td>
                              </td>
                              <td><?php echo $student->getBirthDate() ?></td>
                              <td><?php echo $student->getEmail() ?></td>
                              <td><?php echo $student->getPhoneNumber() ?></td>
                              <td>
                                   <form action="<?php echo FRONT_ROOT ?>Student/ShowEditView" method="POST">
                                        <button type="submit" name='studentId' value=<?php echo $student->getStudentId() ?> class="btn btn-dark ml-auto d-block">Editar</button>
                                   </form>
                              </td>
                              <td>
                                   <form action="<?php echo FRONT_ROOT ?>Student/Delete" method="POST">
                                        <button type="submit" name='studentId' value=<?php echo $student->getStudentId() ?>  class="btn btn-dark ml-auto d-block">Eliminar</button>
                                   </form>
                              </td>
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>