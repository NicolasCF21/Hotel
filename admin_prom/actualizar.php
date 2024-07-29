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
    $sql = "SELECT id_promocion, id_habitacion, nombre_prom, fecha_inicio, fecha_fin, descuento, descripcion, imagen FROM promociones WHERE id_promocion=$id";

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> La promoción fue actualizada correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> La promoción no ha sido actualizado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';            
                    }
                ?>
                    <h3 class="">Actualización de Promociones</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);                        
                        while($fila = $resulset->fetch_assoc()){; 
                        ?>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6    ">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id" id="id" value="'<?php echo $fila['id_promocion']; ?>'">
                                    <input type="hidden" name="id_habitacion" id="id_habitacion" value="'<?php echo $fila['id_habitacion']; ?>'">
                                    <input type="text" id="promocion" name="promocion" class="form-control" placeholder="Nombre Empleado" value="<?php echo $fila['nombre_prom']; ?>" required>
                                    <label for="promocion">Promocion:</label>
                                    <?php
                                    if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'nombre'){
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
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Apellido Empleado" value="<?php echo $fila['descripcion']; ?>  "required>
                                    <label for="descripcion">Descripción:</label>
                                    <?php
                                    if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'apellido'){
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
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="date" id="inicio" name="inicio" class="form-control" placeholder="Fecha inicio" value="<?php echo $fila["fecha_inicio"]?>" required>
                                    <label for="inicio">Fecha inicio:</label>
                                    <?php
                                    if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'email'){
                                        echo '<div class="toast-container position-static">
                                        <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body text-danger fw-bold">
                                                    ¡Por favor ingrese un correo valido!.
                                                </div>
                                                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">       
                                    <input type="date" id="fin" name="fin" class="form-control" placeholder="Fecha fin" value="<?php echo $fila["fecha_fin"]?>" required>                                                                 
                                    <label for="fin">Fecha fin:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="number" id="descuento" name="descuento" class="form-control" placeholder="Descuento" value="<?php echo $fila['descuento']; ?>" min="1" max="100" required>
                                    <label for="descuento">Descuento:</label>
                                    <?php
                                    if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'telefono'){
                                        echo '<div class="toast-container position-static">
                                        <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body text-danger fw-bold">
                                                    ¡Solo se permiten numeros!.
                                                </div>
                                                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="imagen" class="form-label">Imagen Promocion</label><br>
                                <img src=".<?php echo $fila["imagen"]?>" alt="Img promocion" style="max-width:200px;">
                                <input class="form-control" name="imagen" type="file" id="imagen">
                                <?php                             
                            }
                                
                                ?>

                            </div>                            
                                                        
                            <?php ?>
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Actualizar"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="../js/modal.js"></script>
        <script>
            //Hacer visible el toast de alerta
            var toast = document.querySelector('.toast');
            var bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();
        </script>
    </body>
</html>