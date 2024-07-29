<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
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
                    if(isset($_SESSION["Registrado"])){
                        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> La promoción fue registrada correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Registrado"]);
                    }
                    if(isset($_SESSION["Error"])){
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> La promoción no ha sido registrada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Error"]);
                    }                                                    
                ?>  
                    <div class="alert" role="alert" style="display:none;"></div>   
                    <h3 class="">Registro de Promociones</h3>
                    <hr>
                    <form action="../config/registrar_prom.php" method="POST" enctype="multipart/form-data" id="formulario">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Promoción" required >
                                    <label for="nombre">Nombre Promoción:</label>                                
                                </div>
                            </div>                            
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="habitacion" name="habitacion" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione la habitación--</option>
                                        <?php
                                            include '../controller/conexion.php';
                                            $conexion = new Conexion();
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_habitacion, nombre_habitacion FROM  habitacion";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_habitacion"]?>"><?php echo $datos["nombre_habitacion"]?></option>
                                        <?php
                                            }
                                            $con->close();
                                        ?>
                                    </select>
                                    <label for="habitacion">Habitación:</label>
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="date" id="inicio" name="inicio" class="form-control" placeholder="Fecha inicio" required>
                                    <label for="inicio">Fecha inicio:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="date" id="fin" name="fin" class="form-control" placeholder="Fecha fin" required min="1" max="100000">
                                    <label for="fin">Fecha fin:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" required></textarea>
                                    <label for="descripcion">Descripción Promoción:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="descuento" name="descuento" class="form-control" placeholder="Descuento" required min="1" max="100">
                                    <label for="descuento">Descuento:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                                                          
                                    <input class="form-control" name="imagen" type="file" id="imagen" required>                                    
                                    <label for="imagen" class="form-label ">Imagen promocion:</label>
                                    <?php
                                    if(isset($_SESSION["Errori"])){
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
                                    unset($_SESSION["Errori"]);
                                    }
                                    ?>
                                </div>                                            
                            </div>
                            
                              
                        </div>
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Registrar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>      
    </body>
</html>