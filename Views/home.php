<?php

require_once('nav.php');
require_once('header.php');

if(isset($_SESSION['userLogged']))
     {
          $userLogged = $_SESSION['userLogged'];
     }

?>

<?php 

     if($userLogged->getRole() == "Student")
     { ?>
     <main class="py-5">
          <section id="listado" class="mb-5">
               <div class="container">
                    <h2 class="mb-4">Inicio para estudiante</h2>
               </div>
          </section>
     </main>
    <?php } else  { ?>
     <main class="py-5">
          <section id="listado" class="mb-5">
               <div class="container">
                    <h2 class="mb-4">Inicio para administrador</h2>
               </div>
          </section>
     </main>
    <?php } 
?>
    


