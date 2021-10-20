<?php
     require_once('nav.php');

     use DAO\CareerDAO as CareerDAO;

     $careerDAO = new CareerDAO();
     $careerList = $careerDAO->getAll();

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Datos de las carreras</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre carrera</th>
                    </thead>
                    <tbody>
                    <?php foreach($careerList as $career) { ?>
                         <tr>
                              <td><?php echo $career->getDescription() ?></td>
                         </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </section>
</main>