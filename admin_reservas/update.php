<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id"];
    $estado = $_POST['estado'];

    $sql = "UPDATE reservacion SET estado_reservacion='$estado' WHERE id_reservacion=$id";

    
    if($con->query($sql)===TRUE) {
        header ("Location: listar_reservacion.php"); 
        
    }else{
        echo "No se ha actualizado";
    }
?>