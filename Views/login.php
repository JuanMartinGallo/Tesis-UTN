<?php require_once('header.php') ?>

<main class="d-flex align-items-center justify-content-center height-50">
     <div class="content">
          <header class="text-center text-white">
               <h2>Bienvenido al sistema!</h2>
          </header>
          <form action="<?php echo FRONT_ROOT ?>Student/logIn" method="POST" class="login-form bg-light-alpha p-5 text-dark font-weight-bold">
               <div class="form-group">
               <?php if(isset($message)){ ?>
                    <label for=""> <strong> <?php echo $message ?></strong> </label>
               <?php } ?>
               </br>
                    <label for="">EMAIL</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingrese su correo electronico">
               </div>

               <button class="btn btn-primary btn-block btn-lg mt-4" type="submit">Iniciar sesión</button>
          </form>
     </div>
</main>