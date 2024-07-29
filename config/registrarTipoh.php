<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    
    $tipo=$_POST["tipo"];
            
    if (!preg_match("/^[a-zA-Zá-úÁ-Ú ]*$/",$tipo)) {
        $_SESSION["ErrorH"]="¡Solo se permiten letras!";
        header("Location: ../adminHabitaciones/registrar_tipo.php");
    }else{
        $sql="INSERT INTO TIPO_HABITACION (tipo_habitacion)
        VALUES('".$tipo."');";
                
        if($con->query($sql)===TRUE){
            $_SESSION["Registrado"]="Se ha creado el tipo de habitacion correctamente";
            header('Location: ../adminHabitaciones/registrar_tipo.php');
        }else{
            $_SESSION["Error"]="Error creando el tipo de habitacion ";
            header('Location: ../adminHabitaciones/registrar_tipo.php');
        }
    }                
    $con->close();

?>