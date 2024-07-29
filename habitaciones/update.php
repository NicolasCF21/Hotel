<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id"];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    if(!preg_match("/^[a-zA-Z ]*$/",$producto)){
        $_SESSION["Error"]="Solo se permiten letras";
        header("Location: actualizar_producto.php?id=".$id."&mensaje=cn");
    }else{
        $sql = "UPDATE productos SET nombre_producto='$producto', cantidad_producto='$cantidad' WHERE id_producto=$id AND cantidad_producto>=0";

    
        if($con->query($sql)===TRUE) {
            header ("Location: actualizar_producto.php?id=$id&mensaje=actualizado"); 
        }else{
            header ("Location: actualizar_producto.php?id=$id&mensaje=error"); 
        }
    }
    
    
    
?>