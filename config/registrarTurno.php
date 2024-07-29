<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $sql="INSERT INTO turnos_empleados (jornada,entrada,salida)
    VALUES('".$_POST["turno"]."', '".$_POST["entrada"]."', '".$_POST["salida"]."');";

    if($con->query($sql)===TRUE){
        header('Location: ../admin_empleados/registrar_turnos.php?mensaje=registrado');
    }else{
        $con->error;
        header('Location: ../admin_empleados/registrar_turnos.php?mensaje=error');
    }
    $con->close();
?>