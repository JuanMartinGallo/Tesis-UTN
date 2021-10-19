<?php
require_once('header.php');

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Editar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Edit" method="post" class="bg-light-alpha p-5">
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
                            <input type="text" name="location" value="" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Numero de Telefono</label>
                            <input type="text" name="phoneNumber" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="idCompany" " value=" value=<?php echo $company->getIdCompany() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
            </form>
        </div>
    </section>
</main>