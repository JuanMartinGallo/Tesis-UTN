<?php
require_once('header.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Registrarse</h2>
            <form action="<?php echo FRONT_ROOT ?>Student/Add" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="text" name="password" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark ml-auto d-block">Continuar</button>
            </form>
        </div>
    </section>
</main>