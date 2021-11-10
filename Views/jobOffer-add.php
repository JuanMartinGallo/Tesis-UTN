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

$today = date("Y-m-d");

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar nueva postulacion laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="jobPosition" class="form-control"required>
                                <option value="">Seleccione una posicion laboral</option>
                                <?php foreach ($jobPositionList as $jobPosition) { ?>
                                    <option value="<?php echo $jobPosition->getJobPositionId(); ?>"><?php echo $jobPosition->getDescription(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="careerId" class="form-control"required>
                                <option value="">Seleccione una carrera</option>
                                <?php foreach ($careerList as $career) { ?>
                                    <option value="<?php echo $career->getCareerId(); ?>"><?php echo $career->getDescription(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php if ($_SESSION['userLogged']->getRole() == "company") { ?>
                                <input type="hidden" name="companyId" class="form-control" value="<?php echo $_SESSION['userLogged']->getCompanyId() ?>">
                            <?php } else { ?>
                                <select name="companyId" class="form-control">
                                    <option value="">Seleccione una compañia</option>
                                    <?php foreach ($companyList as $company) { ?>
                                        <option value="<?php echo $company->getCompanyId(); ?>"><?php echo $company->getName(); ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
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
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="isRemote" class="form-control"required>
                                <option value="">Acepta Trabajo Remoto</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Remuneracion aproximada</label>
                            <input type="number" name="salary" value="" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha inicial</label>
                            <input type="date" name="startingDate" value="<?php echo $today ?>" class="form-control" min=<?php echo $today ?> required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha de caducidad</label>
                            <input type="date" name="endingDate" value="" class="form-control" min=<?php echo $today ?> required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="active" class="form-control" required>
                                <option value="">Activa</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                                </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>