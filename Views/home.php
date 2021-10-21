<?php
     require_once('nav.php');
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Usted esta logueado como <?php echo $_SESSION['userLogged']->getFirstName() ." ". $_SESSION['userLogged']->getLastName() ?>
               </h2>
          </div>
     </section>
</main>
