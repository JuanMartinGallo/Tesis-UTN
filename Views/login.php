<?php
require_once('header.php');
?>

<main class="d-flex align-items-center justify-content-center height-50">
     <div class="content">
          <header class="text-center text-white">
               <h2>Bienvenido al sistema!</h2>
          </header>
          <form action="<?php echo FRONT_ROOT ?>User/Login" method="POST" class="login-form bg-light-alpha p-5 text-dark font-weight-bold">
               <div class="form-group">
                    <label for="">EMAIL</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingrese su correo electronico">
               </div>
               <div class="form-group">
                    <label for="">CONTRASEÑA</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingrese su contraseña">
               </div>
               <button class="btn btn-primary btn-block btn-lg mt-4" type="submit">Iniciar sesión</button>
          </form>
          <a class="btn btn-primary btn-block btn-lg mt-4" style="text-decoration:none; color:white; background-color:gray;" href="<?php echo FRONT_ROOT ?>User/showRegisterView">
               Registrarse
          </a>
     </div>
</main>