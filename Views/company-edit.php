<?php
    session_start();
    require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Editar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Edit" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre de la empresa</label>
                            <input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">CUIT</label>
                            <input type="text" name="cuit" value="<?php echo $company->getCuit() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ubicacion</label>
                            <input type="text" name="location" value="<?php echo $company->getLocation() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Numero telefonico</label>
                            <input type="text" name="phoneNumber" value="<?php echo $company->getPhoneNumber() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Codigo Postal</label>
                            <input type="text" name="zipCode" value="<?php echo $company->getZipCode() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="companyId" value="<?php echo $company->getCompanyId() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
            </form>
        </div>
    </section>
</main>