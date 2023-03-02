<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $ingreso = $_POST['ingreso'];
    $salida = $_POST['salida'];
    $usuario = $_POST['usuario'];
    $servicio = $_POST['servicio'];
    $habitacion = $_POST['habitacion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $pago = $_POST['pago'];
    $pagos = $_POST['pagos'];
   
    $sql="INSERT INTO reservacion (id_usuario, id_habitacion ,id_servicio, fecha_ingreso, fecha_salida, cantidad_personas, forma_pago, estado_reservacion, total_pago)
    VALUES('".$usuario."','".$habitacion."','".$servicio."','".$ingreso."','".$salida."','".$cantidad."','".$pagos."','Confirmada','".$pago."');";
    
    if($con->query($sql)===TRUE){        
        header("Location: ./confirmacion.php");
    }else{
        echo $con->error;
    }
?>