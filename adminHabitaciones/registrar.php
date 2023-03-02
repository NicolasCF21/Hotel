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
                    <strong>¡Correcto!</strong> Habitación registrada correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Habitación no se pudo registrar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                    <h3 class="text-center">Registro de Habitaciones</h3>
                    <hr>
                    <form action="../config/registrarHabitacion.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Habitacion" required>
                                    <label for="nombre">Nombre Habitacion:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                                        <option option selected hidden>--Elija el tipo de habitación--</option>
                                        <?php
                                            include '../controller/conexion.php';
                                            $conexion = new Conexion();
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_tipo_habitacion, tipo_habitacion FROM  TIPO_HABITACION";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_tipo_habitacion"]?>"><?php echo $datos["tipo_habitacion"]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="categoria">Tipo de Habitación:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad Personas" required>
                                    <label for="cantidad">Cantidad Personas:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado Habitacion" required>
                                    <label for="estado">Estado Habitación:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="precio" name="precio" class="form-control" placeholder="Precio Habitacion" required>
                                    <label for="precio">Precio Habitación:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                                                          
                                    <input class="form-control" name="imagen" type="file" id="imagen">                                    
                                    <label for="imagen" class="form-label ">Imagen Habitacion:</label>
                                </div>                                            
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating my-3">
                                    <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" required></textarea>
                                    <label for="descripcion">Descripción:</label>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                        <div class="text-center my-3">
                            <input class="btn btn-success" type="submit" value="Registrar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>