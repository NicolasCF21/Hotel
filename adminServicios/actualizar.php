<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    if(!isset($_SESSION["Admin"])){ 
        header('Location: ../admin/login.php');
    }
       
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET['id'];
    $sql = "SELECT * FROM SERVICIO WHERE id_servicio=$id";

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
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El servicio fue actualizada correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }

                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El servicio no ha sido actualizado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>'; 
                    }

                ?>
                    <h3 class="text-center">Actualización de Servicios</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);
                        while($fila = $resulset->fetch_assoc()){; ?>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id_servicio" id="id_servicio" value="'<?php echo $fila['id_servicio']; ?>'">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Habitacion" value="<?php echo $fila['nombre_servicio']; ?>  "required>
                                    <label for="nombre">Nombre Servicio:</label>
                                </div>                                                                
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                                    <option option selected hidden>--Elija el tipo de servicio--</option>
                                    <?php     
                                            $con2 = $conexion->conectarDB();
                                            $sql = "SELECT id_categoria_servicio, categoria_servicio FROM  CATEGORIA_SERVICIO WHERE categoria_servicio!='Sin servicio'";
                                            $resulset = $con2->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_categoria_servicio"] == $fila["id_categoria_servicio"])
                                                    echo "<option value='".$datos["id_categoria_servicio"] ."' selected='selected'>" . $datos["categoria_servicio"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_categoria_servicio"] ."'>" . $datos["categoria_servicio"]. "</option>";
                                            }
                                    ?>
                                    </select>
                                    <label for="categoria">Tipo de Servicio:</label>
                                </div>   
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-2">
                                    <input cols="30" rows="10" type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" value="<?php echo $fila['descripcion_servicio'];?> " required>
                                    <label for="descripcion">Descripción:</label>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-floating mb-2">
                                    <input type="number" id="tarifa" name="tarifa" class="form-control" placeholder="Cantidad Personas" value="<?php echo $fila['tarifa_servicio'] ;?>" required min="0" max="50000">
                                    <label for="tarifa">Tarifa Servicio:</label>
                                </div>
                            </div>                             
                            <div class="col-lg-6 m-0 align-self-end">
                                <label for="imagen" class="form-label m-0">Imagen Servicio</label><br>
                                <?php 
                                echo '<img src="'.$fila["imagen_servicio"].'" class="img-fluid" style="max-width:350px">';
                                ?>
                                <input class="form-control mt-3" name="imagen" type="file" id="imagen">
                                <?php } ?>
                            </div>
                            <div class="col-lg-6">
                            <?php 
                                if(isset($_GET['error'])){
                                    echo '<div class="toast-container position-static">
                                            <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body text-danger fw-bold">
                                                        ¡Por favor ingrese un formato de imagen valido!.
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