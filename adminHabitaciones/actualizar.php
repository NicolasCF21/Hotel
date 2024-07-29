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
    $sql = "SELECT * FROM habitacion WHERE id_habitacion=$id";

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
        <link rel="stylesheet" href="../css/styl.css">
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
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> La habitación fue actualizada correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';    
                    }                
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {                
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> La habitación no ha sido actualizado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';            
                    }
                ?>
                    <h3 class="text-center">Actualización de Habitaciones</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);                        
                        while($fila = $resulset->fetch_assoc()){; 
                        ?>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id_habitacion" id="id_habitacion" value="'<?php echo $fila['id_habitacion']; ?>'">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Habitacion" value="<?php echo $fila['nombre_habitacion']; ?>  "required>
                                    <label for="nombre">Nombre Habitacion:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el tipo de habitación--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_tipo_habitacion, tipo_habitacion FROM  TIPO_HABITACION";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_tipo_habitacion"] == $fila["id_tipo_habitacion"])
                                                    echo "<option value='".$datos["id_tipo_habitacion"] ."' selected='selected'>" . $datos["tipo_habitacion"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_tipo_habitacion"] ."'>" . $datos["tipo_habitacion"]. "</option>";
                                            }
                                            $con->close();
                                    ?>
                                    </select>
                                    <label for="categoria">Tipo de Habitación:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad Personas" value="<?php echo $fila['cantidad_personas'] ;?>" required min="1" max="10">
                                    <label for="cantidad">Cantidad Personas:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="preciob" name="preciob" class="form-control" placeholder="Precio Temporada Baja" value="<?php echo $fila['precio_Tb']; ?>" required min="1" max="100000">
                                    <label for="preciob">Precio:</label>
                                </div>
                            </div>
                                                                            
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="estado" name="estado" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el esstado de la habitación--</option>
                                        <?php                                            
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_estado, estado_habitacion FROM  estado_habitacion";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_estado"] == $fila["id_estado"])
                                                    echo "<option value='".$datos["id_estado"] ."' selected='selected'>" . $datos["estado_habitacion"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_estado"] ."'>" . $datos["estado_habitacion"]. "</option>";
                                            }
                                            $con->close();
                                        ?>
                                    </select>
                                    <label for="estado">Estado Habitación:</label>
                                </div>
                            </div>  
                            <div class="col-lg-6 col-sm-6">                                                            
                                <div class="form-floating my-3">
                                    <input cols="30" rows="10" type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" value="<?php echo $fila['descripcion_habitacion'];?> " required>
                                    <label for="descripcion">Descripción:</label>
                                </div>
                            </div>                          
                            <div class="col-lg-6 col-sm-12">
                                <label for="imagen" class="form-label">Imagen Habitacion</label><br>
                                <?php 
                                echo '<img src="'.$fila["imagen_habitacion"].'" class="img-fluid" style="max-width:250px">';
                                ?>
                                <input class="form-control mt-3" name="imagen" type="file" id="imagen">
                                <?php }
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