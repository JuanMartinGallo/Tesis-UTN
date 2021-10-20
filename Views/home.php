<?php
     require_once('nav.php');

     if (isset($_SESSION["userLogged"]))
     {
          $userLogged = $_SESSION["userLogged"];
     }

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Pagina Principal</h2>
          </div>
     </section>
</main>
