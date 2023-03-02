<?php
session_start();
if(!isset($_SESSION["Usuario"])){
    header('Location: http://localhost/hotel/user/login.php');
}
$user=$_SESSION["Usuario"];

$habitacion = $_POST['habitacion'];
$ingreso = $_POST['ingreso'];
$salida = $_POST['salida'];
$cantidad = $_POST['cantidad'];
date_default_timezone_set("America/Bogota");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php include '../modules/menu.php'; ?>
    <div class="container my-3">
        <div class="row">
            <form action="registro_reservacion.php" method="POST">
                <div class="col-lg-6">
                    <div class="row g-3">
                            <div >
                                <h2>Informacion Basica</h2>
                            </div>
                                        
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT * FROM usuarios WHERE id_usuario='".$user."'";
                        $resultset = $con->query($sql);
                        while ($fila = $resultset->fetch_assoc()){
                    ?>
                        <div class="col-lg-6">
                            <input type="hidden" name="usuario" id="usuario" value="<?php echo $fila["id_usuario"]?>">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $fila["nombre_usuario"]?>" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $fila["apellido_usuario"]?>" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="documento" class="form-label">Doc. Identidad</label>
                            <input type="text" id="documento" name="documento" class="form-control" value="<?php echo $fila["documento"]?>" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="email" class="form-label">Correo Electronico</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $fila["email"]?>" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $fila["telefono"]?>" required>
                        </div>
                    <?php } 
                    $con->close();?>                                            
                    </div>    
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <h2>Informacion Reservación</h2>
                            </div>        
                        </div>    
                                     
                        <?php
                        $fechaActual = date("Y-m-d");
                        ?>
                        <div class="col-lg-6">
                            <label for="ingreso" class="form-label">Fecha ingreso</label>
                            <input type="date" id="ingreso" name="ingreso" class="form-control" value="<?php echo $ingreso;?>" required min="<?= $fechaActual ?>">
                        </div>
                        <div class="col-lg-6">
                            <label for="salida" class="form-label">Fecha Salida</label>
                            <input type="date" id="salida" name="salida" class="form-control" value="<?php echo $salida;?>" required min="<?= $ingreso ?>">
                        </div>            
                        <?php
                            $con = $conexion->conectarDB();
                            $sql = "SELECT nombre_habitacion FROM habitacion WHERE id_habitacion=$habitacion";
                            $resultset = $con->query($sql);
                            while ($fila = $resultset->fetch_assoc()) {                            
                        ?>
                        <div class="col-lg-6">
                            <label for="habitacion" class="form-label">Habitacion seleccionada</label>
                            <input type="hidden" id="habitacion" name="habitacion" value="<?php echo $habitacion;?>">
                            <input type="text" id="hb" name="hb " class="form-control" value="<?php echo $fila['nombre_habitacion'];?>" required>
                        </div>
                        <?php
                            };
                            $con->close();
                        ?>
                        <div class="col-lg-6">
                        <label for="cantidad" class="form-label">Cantidad Personas</label>
                            <input type="text" id="cantidad" name="cantidad" class="form-control" value="<?php echo $cantidad;?>" required>
                        </div>
                        <div class="col-lg-6">
                            <?php                                               
                                $con = $conexion->conectarDB();
                                $sql = "SELECT precio_habitacion FROM HABITACION WHERE id_habitacion=$habitacion";
                                $resultset = $con->query($sql);
                                while($fila = $resultset->fetch_assoc()){
                                    $precio = $fila['precio_habitacion'];      
                                    $fecha1 = date_create($ingreso);
                                    $fecha2 = date_create($salida);
                                    $diferencia = $fecha1->diff($fecha2);          
                                    $pago = $diferencia->d * $precio;
                            ?>
                            <label for="precio" class="form-label">Precio Habitacion:</label>
                            <input type="text" id="precio" name="precio" class="form-control" value="<?php echo $precio;?>" required>
                            
                        </div>
                        <div class="col-lg-6">  
                            <label for="pago" class="form-label">Pago Total</label>
                            <input type="text" id="pago" name="pago" class="form-control" value="<?php echo $pago;?>" required>
                            <?php 
                                    } 
                                    $con->close();
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <label for="servicio">Servicios adicionales:</label><i class="bi bi-exclamation-circle ms-2 me-1"></i><label for="servicio">Opcional</label>                                   
                                <select class="form-select mt-2" id="servicio" name="servicio" aria-label="Default select example">
                                        <option option selected hidden value="">--Elija el tipo servicio--</option>
                                        <?php                                           
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_servicio, nombre_servicio FROM  SERVICIO";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_servicio"]?>"><?php echo $datos["nombre_servicio"]?></option>
                                        <?php
                                            }
                                            $con->close();
                                        ?>
                                </select>                         
                        </div>
                    </div>                                                         
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="float-start me-2">
                                <i class="bi bi-3-circle" style="font-size:25px;"></i>
                            </div>
                            <div class="float-start">
                                <h2>Metodo de Pago</h2>
                            </div>
                        </div>     
                        <hr class="mx-3">                   
                    </div>
                    <div class="row g-3 mb-5">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" value="Pago en linea Tarjta">Tarjeta de credito </button>
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" value="Pago en linea pse">PSE</button>
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile2" type="button" role="tab" aria-controls="v-pills-profile2" aria-selected="false" value="Pago en linea">Transferencia bancaria</button>
                                </div>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                                        <div class="text-center">
                                            <i class="bi bi-credit-card" style="font-size:25px;"></i>
                                        </div> 
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="tarjeta" class="form-label">Nombre y apellido como figura en la tarjeta</label>
                                                <input type="text" class="form-control" id="tarjeta" name="tarjeta">   
                                                <label class="form-label">Fecha Vencimiento</label>                                     
                                            </div>
                                            <div class="col-lg-6 col-sm-6">                                
                                                <input type="number" class="form-control" id="tarjeta" name="tarjeta">                                        
                                            </div>
                                            <div class="col-lg-6 col-sm-6">                                
                                                <input type="number" class="form-control" id="tarjeta" name="tarjeta">                                        
                                            </div>
                                            <div class="col-l6">
                                                <label for="codigo" class="form-label">Codigo de seguridad</label>
                                                <input type="text" id="codigo" name="codigo" class="form-control">
                                            </div>
                                            <div class="col-l6">
                                                <label for="cedula" class="form-label">Cedula del pagador</label>
                                                <input type="text" id="cedula" name="cedula" class="form-control">
                                            </div>
                                        </div>                                                                                           
                                    </div>  
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                        <i class="bi bi-">PSE</i>
                                        <p></p>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                        <i class="bi bi-phone-flip">Transferencia bancaria</i>
                                        <p></p>
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark" id="reservar">Reservar</button>
                    </div>     
                    <div class="float-end">
                        <button class="btn btn-info" type="button" id="imprimir"><i class="bi bi-printer me-2"></i>Imprimir Factura</button>
                    </div>                                                    
                </div>
                
            </form>
        </div>
    </div>
    
</body>
<?php
 include '../modules/footer.php';
?>

</html>
