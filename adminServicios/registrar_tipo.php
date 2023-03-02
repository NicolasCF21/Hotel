    <?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
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
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'correcto') {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Correcto!</strong> Tipo servicio registrado correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Tipo servicio no se ha podido registrar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                    <h3 class="text-center">Registro Tipo Servicios</h3>
                    <hr>
                    <form action="../config/registrarTipos.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="tipo" name="tipo" class="form-control" placeholder="Tipo Habitacion" required>
                                    <label for="tipo">Tipo servicios:</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="text-center my-3">
                            <input class="btn btn-success" type="submit" value="Registrar" name="submit"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
   
</html>