<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id_cargo_empleado"];
    $cargo = $_POST['cargo'];
    
    $sql = "UPDATE CARGO_EMPLEADO SET cargo_empleado='$cargo' WHERE id_cargo_empleado=$id";

    
    if($con->query($sql)===TRUE) {
        header ("Location: actualizar_cargo.php?id=". $id ."&mensaje=actualizado"); 
    }else{
        header ("Location: actualizar_cargo.php?id=". $id ."&mensaje=error"); 
    }
    
?>