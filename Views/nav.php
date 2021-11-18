<?php
require_once('header.php');
require_once('verify-session.php');
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/home"><strong>UTN LinkedIn</strong></a>
     </span>
     <ul class=" navbar-nav ml-auto">
          <?php if ($_SESSION['userLogged']->getRole() == "student" || $_SESSION['userLogged']->getRole() == "admin") { ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Career/ShowListView">Listar carreras</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowProfileView">Ver tus datos</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Listar empresas</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowListView">Listar postulacion</a>
               </li>
          <?php } ?>
          <?php if ($_SESSION['userLogged']->getRole() == "admin") { ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Listar alumnos</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/showRegisterView">Agregar usuario</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Admin/ShowAddView">Agregar administrador</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Admin/ShowListView">Listar administradores</a>
               </li>
          <?php } ?>
          <?php if ($_SESSION['userLogged']->getRole() == "student" || $_SESSION['userLogged']->getRole() == "company") { ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowPostulateView">Mis Postulaciones</a>
               </li>
          <?php } ?>
          <?php if ($_SESSION['userLogged']->getRole() == "company"  || $_SESSION['userLogged']->getRole() == "admin") { ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/ShowAddView">Agregar postulacion laboral</a>
               </li>
          <?php } ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Cerrar sesion</a>
          </li>
     </ul>
</nav>