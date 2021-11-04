<?php
session_start();
require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar nueva postulacion laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="jobPositionId" id="jobPositionId" class="form-control">
                                <option value="">Seleccione una posicion laboral</option>
                                <?php foreach ($jobPositionList as $jobPosition) { ?>
                                    <option value="<?php echo $jobPosition->getJobPositionId(); ?>"><?php echo $jobPosition->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <select name="careerId" id="careerId" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                <?php foreach ($careerList as $career) { ?>
                                    <option value="<?php echo $career->getCareerId(); ?>"><?php echo $jobPosition->getDescription(); ?></option>
                                <?php } ?>
                            </select>
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
                            <label for="">Numero telefonico</label>
                            <input type="text" name="phoneNumber" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>