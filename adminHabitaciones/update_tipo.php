<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id_tipo_habitacion"];
    $tipo = $_POST['tipo'];
    
    $sql = "UPDATE TIPO_HABITACION SET tipo_habitacion='$tipo' WHERE id_tipo_habitacion=$id";

    
    if($con->query($sql)===TRUE) {
        header ("Location: actualizar_tipo.php?id=". $id ."&mensaje=actualizado"); 
    }else{
        header ("Location: actualizar_tipo.php?id=". $id ."&mensaje=error"); 
    }
    
?>