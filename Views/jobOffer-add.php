<?php
session_start();
require_once('nav.php');

use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\CompanyDAO as CompanyDAO;

$careerDAO = new CareerDAO();
$jobPositionDAO = new JobPositionDAO();
$companyDAO = new CompanyDAO();
$careerList = $careerDAO->getAll();
$jobPositionList = $jobPositionDAO->getAll();
$companyList = $companyDAO->getAll();

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar nueva postulacion laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="jobPosition" id="jobPosition" class="form-control">
                                <option value="">Seleccione una posicion laboral</option>
                                <?php foreach ($jobPositionList as $jobPosition) { ?>                                    
                                    <option value="<?php echo $jobPosition->getDescription(); ?>"><?php echo $jobPosition->getDescription(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <select name="careerId" id="careerId" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                <?php foreach ($careerList as $career) { ?>
                                    <option value="<?php echo $career->getDescription(); ?>"><?php echo $career->getDescription(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <select name="company" id="company" class="form-control">
                                <option value="">Seleccione una compañia</option>
                                <?php foreach ($companyList as $company) { ?>
                                    <option value="<?php echo $company->getName(); ?>"><?php echo $company->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Remuneracion aproximada</label>
                            <input type="number" name="salary" value="" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Acepta trabajo remoto?</label>
                            <input type="checkbox" name="isRemote" value="1" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <textarea type="text" name="description" value="" class="form-control" placeholder="Descripcion del trabajo" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <textarea type="text" name="skills" value="" class="form-control" placeholder="Habilidades necesarias" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha inicial</label>
                            <input type="date" name="startingDate" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha de caducidad</label>
                            <input type="date" name="endingDate" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Activa</label>
                            <input type="checkbox" name="active" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>