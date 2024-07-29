<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    if(!isset($_SESSION["Admin"])){ 
        header('Location: ../admin/login.php');
    }

    

    if(isset($_GET['error'])){
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
        <strong>ERROR</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo $_GET['error'];
        echo '</div>';
        
    }

    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET['id'];
    $sql = "SELECT * FROM categoria_servicio WHERE id_categoria_servicio=$id";

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
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'correcto') {
                        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El tipo de servicio fue actualizado correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El tipo de servicio no ha sido actualizado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';           
                    }
                ?>
                    <h3 class="text-center">Actualización de tipo de servicio</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);
                        while($fila = $resulset->fetch_assoc()){; ?>
                    <form action="update_tipo.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id_categoria_servicio" id="id_categoria_servicio" value="'<?php echo $fila['id_categoria_servicio']; ?>'">
                                    <input type="text" id="tipo" name="tipo" class="form-control" placeholder="Nombre Habitacion" value="<?php echo $fila['categoria_servicio']; ?>  "required>
                                    <label for="tipo">Tipo Servicio:</label>
                                    <?php 
                                    }
                                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'cn') {
                                    
                                    echo '<div class="toast-container position-static">
                                            <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body text-danger fw-bold">
                                                        ¡Solo se permiten letras!.
                                                    </div>
                                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>';
                                    
                                    }
                                    ?>

                                </div>                                
                            </div>                        
                        
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Actualizar"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            //Hacer visible el toast de alerta
            var toast = document.querySelector('.toast');
            var bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();
        </script>        
    </body>
</html>