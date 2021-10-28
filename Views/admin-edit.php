<?php
    session_start();
    require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Editar administrador</h2>
            <form action="<?php echo FRONT_ROOT ?>Admin/edit" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="firstName" value="<?php echo $admin->getFirstName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="lastName" value="<?php echo $admin->getLastName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">DNI</label>
                            <input type="text" name="dni" value="<?php echo $admin->getDni() ?>" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="<?php echo $admin->getEmail() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="adminId" value="<?php echo $admin->getAdminId() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
            </form>
        </div>
    </section>
</main>