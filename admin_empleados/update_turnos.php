<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id_turno"];
    $jornada = $_POST["turno"];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];
    if (!preg_match("/^[a-zA-Zñ-Ñ -]*$/",$jornada)) {                    
        $_SESSION["jornada"]="¡Por favor igrese solo letras!";
        header("Location: ../admin_empleados/actualizar_turno.php?id=".$id."&mensaje=jornada");
    }else{
        $sql = "UPDATE turnos_empleados SET jornada='$jornada', entrada='$entrada', salida='$salida'  WHERE id_turno_empleados=$id";

    
        if($con->query($sql)===TRUE) {
            header ("Location: actualizar_turno.php?id=". $id ."&mensaje=actualizado"); 
        }else{
            header ("Location: actualizar_turno.php?id=". $id ."&mensaje=error"); 
        }
    }
    
    
    
?>