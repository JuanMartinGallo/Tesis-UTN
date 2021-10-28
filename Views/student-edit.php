<?php
    session_start();
    require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Editar estudiante</h2>
            <form action="<?php echo FRONT_ROOT ?>Student/Edit" method="POST" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="firstName" value="<?php echo $student->getFirstName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="lastName" value="<?php echo $student->getLastName() ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">DNI</label>
                            <input type="text" name="dni" value="<?php echo $student->getDni() ?>" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Legajo</label>
                            <input type="text" name="fileNumber" value="<?php echo $student->getFileNumber() ?>" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Genero</label>
                            <input type="text" name="gender" value="<?php echo $student->getGender() ?>" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Fecha de nacimiento</label>
                            <input type="text" name="birthDate" value="<?php echo $student->getBirthDate() ?>" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="<?php echo $student->getEmail() ?>" class="form-control" required></input>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Numero de Telefono</label>
                            <input type="text" name="phoneNumber" value="<?php echo $student->getPhoneNumber() ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="studentId" value="<?php echo $student->getStudentId() ?>" class="btn btn-dark ml-auto d-block">Editar</button>
            </form>
        </div>
    </section>
</main>