<?php
     require_once('header.php');
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>UTN LinkedIn</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Career/getCareersFromAPI">Listar Carreras</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowDataView">Listar Empresas</a>
          </li>  
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowLoggedStudentView">Ver tus datos </a>
          </li>       
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/logout">Cerrar sesion</a>
          </li>          
     </ul>
</nav>