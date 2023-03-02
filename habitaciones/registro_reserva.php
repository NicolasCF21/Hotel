<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $sql="INSERT INTO RESERVAS (id_habitacion ,id_servicio, nombres, apellidos, documento, telefono, correo, fecha_ingreso, fecha_salida, cant_personas, estado_reservacion)
    VALUES('".$_POST["habitacion"]."','".$_POST["servicio"]."','".$_POST["nombres"]."','".$_POST["apellidos"]."','".$_POST["documento"]."','".$_POST["telefono"]."','".$_POST["correo"]."','".$_POST["ingreso"]."','".$_POST["salida"]."','".$_POST["personas"]."','registrada');";
    
    if($con->query($sql)===TRUE){
        echo "Reservacion registrada ";
        
    }else{
        echo "Error registrando la reservacion ".$con->error;
    
    }

?>