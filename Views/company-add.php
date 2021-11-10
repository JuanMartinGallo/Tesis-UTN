<?php
session_start();
require_once('nav.php');

use DAO\CitiesDAO as CitiesDAO;

$citiesDAO = new CitiesDAO();
$citiesList = $citiesDAO->getAll();
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar nueva empresa</h2>
            <?php
            if ($alert) { ?>
                <div class="alert alert-<?php echo $alert->getType() ?> text-center fwbold" role="alert"><?php echo $alert->getMessage() ?></div>
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
                            <select name="location" class="form-control" required>
                                <option value="">Seleccione una ciudad</option>
                                <?php foreach ($citiesList as $cities) { ?>
                                    <option value="<?php echo $cities->getName(); ?>"><?php echo $cities->getName(); ?></option>
                                <?php } ?>
                                <input type="hidden" name="zipcode" class="form-control" value="<?php echo $cities->getZipCode(); ?>">
                            </select>
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
                <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar</button>
        </div>
        </form>
        </div>
    </section>
</main>