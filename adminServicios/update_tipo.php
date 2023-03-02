<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id_categoria_servicio"];
    $tipo = $_POST['tipo'];
    
    $sql = "UPDATE CATEGORIA_SERVICIO SET categoria_servicio='$tipo' WHERE id_categoria_servicio=$id";

    
    if($con->query($sql)===TRUE) {
        header ("Location: actualizar_tipo.php?id=". $id ."&mensaje=correcto"); 
    }else{
        header ("Location: actualizar_tipo.php?id=". $id ."&mensaje=error"); 
    }
?>