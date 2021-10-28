<?php
     require_once('header.php');
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>UTN LinkedIn</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Career/ShowListView">Listar carreras</a>
          </li>
          <?php if($_SESSION['userLogged']->getRole() == "Admin")
               { ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowListView">Listar alumnos</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar empresa</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Admin/ShowAddView">Agregar administrador</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Admin/ShowListView">Listar administradores</a>
          </li>
          <?php }
               else 
               { ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Student/ShowProfileView">Ver tus datos</a>
          </li>
          <?php } ?>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Company/ShowListView">Listar empresas</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Logout">Cerrar sesion</a>
          </li>
     </ul>
</nav>