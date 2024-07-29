<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
    date_default_timezone_set("America/Bogota");
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/jquery-3.6.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php

            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registrado') {
                        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El turno fue registrado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El turno no ha sido registrado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                ?>
                    <h3 class="text-center">Registro turnos de empleados</h3>
                    <hr>
                    <form action="../config/registrarTurno.php" method="POST">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="turno" name="turno" class="form-control" placeholder="Jornada turno" required>
                                    <label for="turno">Turno:</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="time" id="entrada" name="entrada" class="form-control" placeholder="Entrada empleado" required>
                                    <label for="entrada">Entrada:</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="time" id="salida" name="salida" class="form-control" placeholder="Salida empleado" required>
                                    <label for="salida">Salida:</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-3">
                            <button class="btn btn-info" type="submit">Registar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </body>    
</html>