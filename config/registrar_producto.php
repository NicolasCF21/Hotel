<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    
    $producto=$_POST["producto"];
    $cantidad=$_POST["cantidad"];
            
    if (!preg_match("/^[a-zA-Zá-úÁ-Ú ]*$/",$producto)) {
        $_SESSION["ErrorP"]="¡Solo se permiten letras!";
        header("Location: ../habitaciones/registrar_producto.php");
    }else{
        $sql="INSERT INTO productos (nombre_producto, cantidad_producto)
        VALUES('".$producto."','".$cantidad."');";
                
        if($con->query($sql)===TRUE){
            $_SESSION["Registrado"]="Se ha creado el producto correctamente";
            header('Location: ../habitaciones/registrar_producto.php');
        }else{
            $_SESSION["Error"]="Error creando el producto";
            header('Location: ../habitaciones/registrar_producto.php');
        }
    }
            
    $con->close();
    
?>