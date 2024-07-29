<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $tipo=$_POST["tipo"];

    if(!preg_match("/^[a-zA-Z ]*$/",$tipo)){
        $_SESSION["ErrorS"]="¡Solo se permiten letras!";
        header("Location: ../adminServicios/registrar_tipo.php");
    }else{
        $sql="INSERT INTO categoria_servicio (categoria_servicio)
        VALUES('".$tipo."');";

        if($con->query($sql)===TRUE){
            $_SESSION["Registrado"]="Se ha creado el tipo de servicio correctamente";
            header('Location: ../adminServicios/registrar_tipo.php');
        }else{                    
            $_SESSION["Error"]="Error creando el tipo de servicio ";
            header('Location: ../adminServicios/registrar_tipo.php');
        }
    }
    $con->close();
?>