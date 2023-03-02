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
                    <strong>¡Correcto!</strong> Servicio registrado correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Servicio no se ha podido registrar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                    <h3 class="text-center">Registro de Servicios</h3>
                    <hr>
                    <form action="../config/registrarServicio.php" method="POST" enctype="multipart/form">
                        <div class="form-floating">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="nombre" required>
                            <label for="nombre">Nombre Servicio</label>
                        </div>
                        <div class="form-floating my-3">
                        <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                            <option option selected hidden>--Elija el tipo de servicio--</option>
                        <?php
                            include '../controller/conexion.php';
                            $conexion = new Conexion();
                            $con = $conexion->conectarDB();
                            $sql = "SELECT id_categoria_servicio, categoria_servicio FROM  CATEGORIA_SERVICIO";
                            $resulset = $con->query($sql);
                            while($datos = mysqli_fetch_array($resulset)){
                                ?>                                                    
                            <option value="<?php echo $datos["id_categoria_servicio"]?>"><?php echo $datos["categoria_servicio"]?></option>
                                <?php
                                    }
                                    ?>
                        </select>
                        <label for="categoria">Categoria Servicio:</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" required></textarea>
                            <label for="descripcion">Descripción:</label>
                        </div>  
                        <div class="form-floating my-3">
                            <input type="text" id="tarifa" name="tarifa" class="form-control" placeholder="Tarifa" required>
                            <label for="tarifa">Tarifa Servicio:</label>
                        </div>                
                        <div class="my-3">
                            <label for="imagen" class="form-label">Imagen Servicio:</label>
                            <input class="form-control" name="imagen" type="file" id="imagen">
                        </div>
                        <div class="text-center">
                            <input class="btn btn-success" type="submit" value="Registrar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>