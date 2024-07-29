<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
if(!isset($_SESSION["Usuario"])){
    header('Location: http://localhost/hotel/user/login.php');
}
$user=$_SESSION["Usuario"];
$promocion=$_POST["promocion"];
$habitacion = $_POST['habitacion'];
$ingreso = $_POST['ingreso'];
$salida = $_POST['salida'];
$cantidad = $_POST['cantidad'];
$servicio =$_POST['servicio'];
date_default_timezone_set("America/Bogota");
?>
<!DOCTYPE html>
<head>
    <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <title>Reservación</title>
</head>
<body>
    <?php include '../modules/menu.php'; ?>
    <div class="container-fluid my-3">
        <form action="registro_reservacion.php" method="POST">
        <div class="row g-5">      
            <div class="col-md-6 order-md-last order-sm-first">  
                <div class="text-bg-light p-4 border-0 rounded-4 me-4 shadow">
                <div class="row g-3">
                    <div class="col-lg-12">                    
                        <div>
                            <h3><i class="bi bi-journal-bookmark-fill"></i> Resumen Reservación</h3>                            
                        </div>
                        <hr>
                    </div>                    
                                 
                    <?php
                    $fechaActual = date("Y-m-d");
                    ?>
                    <div class="col-lg-6 col-sm-6">
                        <input type="hidden" name="usuario" id="usuario" value="<? echo $user ?>">
                        <label for="ingreso" class="form-label fw-semibold">Fecha ingreso:</label><br>
                        <input type="date" id="ingreso" name="ingreso" class="form-control" value="<?php echo $ingreso;?>" required min="<?= $fechaActual ?>">
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <label for="salida" class="form-label fw-semibold">Fecha Salida:</label><br>
                        <input type="date" id="salida" name="salida" class="form-control" value="<?php echo $salida;?>" required min="<?= $ingreso ?>">
                    </div>                      
		            <input type="hidden" id="dias" name="dias" readonly>          
                    
                    <?php                        
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        if(!empty($servicio)){
                            $con = $conexion->conectarDB();
                            $sql = "SELECT nombre_servicio, imagen_servicio FROM servicio WHERE id_servicio=$servicio";
                            $resultset = $con->query($sql);
                            while ($fila = $resultset->fetch_assoc()) {                                
                                             
                    ?>
                    <div class="col-lg-6 col-sm-6">
                        <label for="sr" class="form-label fw-semibold">Servicio seleccionado:</label>
                        <input type="hidden" id="servicio" name="servicio" value="<?php echo $servicio;?>">
                        <label type="text" id="sr" name="sr" class="form-control " value="<?php echo $fila['nombre_servicio'];?>" ><?php echo $fila['nombre_servicio'];?></label>
                        <img src="<?php echo $fila['imagen_servicio']?>" alt="Imagen servicio hotel" class="img-fluid  mt-2"  style="max-width: 200px; max-height: 200px;">
                    </div>
                    <?php
                            }   
                            $con->close();
                        };
                    ?>
                    <?php            
                    $con = $conexion->conectarDB();
                    $sql = "SELECT nombre_habitacion, imagen_habitacion FROM habitacion WHERE id_habitacion=$habitacion";
                    $resultset = $con->query($sql);
                    while ($fila = $resultset->fetch_assoc()) {                                
                            
                    ?>
                    <div class="col-lg-6 col-sm-6">
                        <label for="hb" class="form-label fw-semibold">Habitacion seleccionada:</label><br>
                        <input type="hidden" id="habitacion" name="habitacion" value="<?php echo $habitacion;?>">
                        <label type="text" id="hb" name="hb" class="form-control " value="<?php echo $fila['nombre_habitacion'];?>" ><?php echo $fila['nombre_habitacion'];?></label>
                        <img src="<?php echo $fila['imagen_habitacion']?>" alt="Imagen habitacion hotel" class="img-fluid mt-2 float-center"  style="max-width: 200px; max-height: 200px;">
                    </div>
                    <?php
                    };
                    $con->close(); ?>
                    <?php 
                        if(!empty($servicio)){
                            $con = $conexion->conectarDB();
                            $sql = "SELECT tarifa_servicio FROM servicio WHERE id_servicio=$servicio";
                            $resultset = $con->query($sql);
                            while ($fila = $resultset->fetch_assoc()) {
                                $tarifa_s = $fila['tarifa_servicio'];      
                                $fecha1 = date_create($ingreso);
                                $fecha2 = date_create($salida);
                                $dia_mas = 1;
                                $fecha2n = date_format(date_modify($fecha2, "+$dia_mas day"), 'Y-m-d');
                                $diferencia = $fecha1->diff($fecha2);                             
                                $total = $diferencia->d * $tarifa_s;

                    ?>
                    <div class="col-lg-6 col-sm-6">
                        <label for="cantidad" class="form-label fw-semibold">Tarifa Servicio</label><br>
                        <input type="hidden" name="tarifa" id="tarifa" value="<?php $servicio?>">
                        <input type="hidden" name="tarifas" id="tarifas" value="<?php $completo=$total*$cantidad?>">
                        <input type="text" id="cantidad" name="cantidad" class="form-control" value="<?php echo $tarifa_s?>" required>
                    </div>
                    <?php
                            }
                            
                        };                    
                    ?>
                    
                        <?php                                               
                            $con = $conexion->conectarDB();
                            $sql = "SELECT precio_Tb FROM HABITACION WHERE id_habitacion=$habitacion";
                            $resulset = $con->query($sql);
                            $descuento=0;
                            if(!empty($promocion)){
                                $sentencia="SELECT descuento FROM promociones WHERE id_habitacion=$habitacion AND id_promocion=$promocion";
                                $validar=$con->query($sentencia);
                                if ($validar->num_rows>0) {
                                    while ($row = $validar->fetch_assoc()) {
                                        $descuento=$row["descuento"];
                                    }
                                }
                            }
                            while($fila = $resulset->fetch_assoc()){
                                $precio = $fila['precio_Tb'];      
                                $fecha1 = date_create($ingreso);
                                $fecha2 = date_create($salida);
                                $dia_mas = 1;
                                $fecha2n = date_format(date_modify($fecha2, "+$dia_mas day"), 'Y-m-d');
                                $diferencia = $fecha1->diff($fecha2);                                          
                                $pr=0;
                                if ($descuento>0) {
                                    $pr=($precio*$descuento)/100;
                                    $p_des=$precio-$pr;
                                    $pago = ($diferencia->d * $p_des);
                                    echo'<div class="col-lg-6 col-sm-6">
                                        <label for="precio" class="form-label fw-semibold">Precio Habitacion: -'.$descuento.'%</label>
                                        <input type="text" id="precio" name="precio" class="form-control" value="'.$p_des.'" required>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="personas" class="form-label fw-semibold">Número Personas</label><br>
                                        <input type="number" id="personas" name="personas" class="form-control" value="'.$cantidad.'" required min="1" max="10">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">  
                                        <label for="pago" class="form-label fw-semibold">Pago Total</label>
                                        <input type="text" id="pago" name="pago" class="form-control" value="'.$pago_total=$pago+$completo.'" required>
                                    </div> ';
                                }else{
                                    $pago = ($diferencia->d * $precio);
                                    echo'<div class="col-lg-6 col-sm-6">
                                        <label for="precio" class="form-label fw-semibold">Precio Habitacion:</label>
                                        <input type="text" id="precio" name="precio" class="form-control" value="'.$precio.'" required>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="personas" class="form-label fw-semibold">Número Personas</label><br>
                                        <input type="number" id="personas" name="personas" class="form-control" value="'.$cantidad.'" required min="1" max="10">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">  
                                        <label for="pago" class="form-label fw-semibold">Pago Total</label>
                                        <input type="text" id="pago" name="pago" class="form-control" value="'.$pago_total=$pago+$completo.'" required>
                                    </div>';
                                }                                                                
                            } 
                            $con->close();
                        ?>
                                                   
                    <div class="col-lg-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark" id="reservar">Ir a pago</button>
                        </div>     
                    </div>

                </div>                                                         
                </div>              
            </div>

            <div class="col-md-6 mb-5">
                <div class="p-4 rounded-4 shadow-lg">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <h3><i class="bi bi-people-fill"></i> Detalles Usuario</h3>                            
                            </div>
                            <hr>   
                        </div>                                                                     
                        <?php                        
                            $con = $conexion->conectarDB();
                            $sql = "SELECT * FROM usuarios WHERE id_usuario='".$user."'";
                            $resultset = $con->query($sql);
                            while ($fila = $resultset->fetch_assoc()){
                        ?>
                        <div class="col-lg-6 col-sm-6">
                            <input type="hidden" name="usuario" id="usuario" value="<?php echo $fila["id_usuario"]?>">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $fila["nombre_usuario"]?>" required>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $fila["apellido_usuario"]?>" required>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label for="documento" class="form-label">Doc. Identidad</label>
                            <input type="text" id="documento" name="documento" class="form-control" value="<?php echo $fila["documento"]?>" required>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label for="email" class="form-label">Correo Electronico</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $fila["email"]?>" required>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo $fila["telefono"]?>" required>
                        </div>
                        <div class="col-lg-6 col-sm-6">                        
                            <input type="hidden" id="telefono" name="telefono" class="form-control">
                        </div>
                        <?php } 
                        $con->close();?>                                                                      
                    </div>                
                </div>                
            </div>                    
        </div>
        </form>      
    </div>
    <?php
        include '../modules/footer.php';
    ?>
</body>
<script>
  const fecha1 = document.getElementById('ingreso');
  const fecha2 = document.getElementById('salida');
  const dias = document.getElementById('dias');
  const precioH = document.getElementById('precio');
  const precioS = document.getElementById('cantidad');
  const total = document.getElementById('pago');
  const personas = document.getElementById('personas');
if (precioS === null) {
    function sumar() {
        const diff = Math.abs(new Date(fecha2.value) - new Date(fecha1.value));
        const diasTotales = Math.ceil(diff / (1000 * 60 * 60 * 24));
        const diasT = dias.value = diasTotales+1;    
        total.value = diasT*precioH.value;       
    }
}else{
    function sumar() {
        const diff = Math.abs(new Date(fecha2.value) - new Date(fecha1.value));
        const diasTotales = Math.ceil(diff / (1000 * 60 * 60 * 24));
        const diasT = dias.value = diasTotales+1;
        const totalH = diasT*precioH.value;
        const totalS = diasT*precioS.value;    
        total.value = totalH + totalS * personas.value;
    }
}
  fecha1.addEventListener('input', sumar);
  fecha2.addEventListener('input', sumar); 
  personas.addEventListener('input', sumar);  
  precio.addEventListener('keyup', sumar);
</script>
</html>
