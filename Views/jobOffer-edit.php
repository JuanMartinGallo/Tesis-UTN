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
            <h2 class="mb-4">Editar postulacion laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/edit" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="jobPosition" id="jobPosition" class="form-control">
                                <?php foreach ($jobPositionList as $jobPosition) {
                                    if ($jobPosition->getJobPositionId() == $jobOffer->getJobPosition()) {
                                ?>
                                        <option value="<?php echo $jobOffer->getJobPosition(); ?>"><?php echo $jobPosition->getDescription(); ?></option>
                                <?php }
                                } ?>
                                <?php foreach ($jobPositionList as $jobPosition) {
                                    if ($jobPosition->getJobPositionId() != $jobOffer->getJobPosition()) {            ?>
                                        <option name="jobPosition" value="<?php echo $jobPosition->getJobPositionId(); ?>"><?php echo $jobPosition->getDescription(); ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="careerId" id="careerId" class="form-control">
                                <?php foreach ($careerList as $career) {
                                    if ($career->getCareerId() == $jobOffer->getCareerId()) { ?>

                                        <option value="<?php echo $jobOffer->getCareerId(); ?>"><?php echo $career->getDescription(); ?></option>
                                <?php }
                                } ?>
                                <?php foreach ($careerList as $career) {
                                    if ($career->getCareerId() != $jobOffer->getCareerId()) { ?>?>
                                <option value="<?php echo $career->getCareerId(); ?>"><?php echo $career->getDescription(); ?></option>
                        <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="companyId" id="company" class="form-control">
                            <?php foreach ($companyList as $company) {
                                    if ($company->getCompanyId() == $jobOffer->getCompanyId()) { ?>

                                        <option value="<?php echo $jobOffer->getCompanyId(); ?>"><?php echo $company->getName(); ?></option>
                                <?php }
                                } ?>
                                <?php foreach ($companyList as $company) {
                                    if ($jobOffer->getCompanyId() != $company->getCompanyId()) { ?>
                                        <option value="<?php echo $company->getName(); ?>"><?php echo $company->getName(); ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Descripcion del trabajo</label>
                            <input type="text" name="description" value="<?php echo $jobOffer->getDescription(); ?>" class="form-control" placeholder="<?php echo $jobOffer->getDescription(); ?>" ></textarea>
                        </div>
                    </div>
  
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Habilidades necesarias</label>
                            <input type="text" name="skills" value="<?php echo $jobOffer->getSkills(); ?>" class="form-control" placeholder="<?php echo $jobOffer->getSkills(); ?>" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="">Acepta trabajo Remoto?</label>
                            <select name="isRemote" id="isRemote" class="form-control"required>
                                <option value="">-</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Remuneracion aproximada</label>
                            <input type="number" name="salary" value="<?php echo $jobOffer->getSalary(); ?>" class="form-control" min="0" required>
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
                            <input type="date" name="endingDate" value="<?php echo $jobOffer->getEndingDate(); ?>" class="form-control" min=<?php echo $today ?> required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="active" id="isRemote" class="form-control"required>
                                <option value="">Activa</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                                </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name="jobOfferId" value="<?php echo $jobOffer->getJobOfferId() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
            </form>
        </div>
    </section>
</main>