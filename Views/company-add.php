<?php
session_start();
require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar nueva empresa</h2>
            <?php
            if($alert) { ?>
                <div class="alert alert-<?php echo $alert->getType()?> text-center fwbold" role="alert"><?php echo $alert->getMessage()?></div>
            <?php } ?>
                <form action="<?php echo FRONT_ROOT ?>Company/Add" method="POST" class="bg-light-alpha p-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Nombre de la empresa</label>
                                <input type="text" name="name" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">CUIT</label>
                                <input type="text" name="cuit" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Ubicacion</label>
                                <input type="text" name="location" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Codigo postal</label>
                                <input type="text" name="zipCode" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Numero telefonico</label>
                                <input type="text" name="phoneNumber" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Codigo Postal</label>
                            <input type="text" name="zipCode" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>