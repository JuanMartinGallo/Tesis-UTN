<?php
require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <?php if ($_SESSION['userLogged']->getRole() == 'student' || $_SESSION['userLogged']->getRole() == 'admin'){ ?>
               <h2 class="mb-4">Usted esta logueado como <?php echo $_SESSION['userLogged']->getFirstName() . " " . $_SESSION['userLogged']->getLastName() ?>
               </h2>
               <?php } else{?>
               <h2 class="mb-4">Bienvenido <?php echo $_SESSION['userLogged']->getName() ?></h2>
               <?php } ?>
          </div>
     </section>
</main>