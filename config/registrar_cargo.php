<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $cargo=$_POST["cargo"];
    
        if (!preg_match("/^[a-zA-Z ]*$/",$cargo)){
            $_SESSION["ErrorC"]="Solo se permiten letras";
            header("Location: ../admin_empleados/registrar_cargo.php");
        }else{
            $sql="INSERT INTO cargo_empleado (cargo_empleado)
                VALUES('".$cargo."');";
                    
            if($con->query($sql)===TRUE){
                $_SESSION["Registrado"]="Se ha creado el cargo correctamente";
                header('Location: ../admin_empleados/registrar_cargo.php');
            }else{
                $_SESSION["Error"]="Error creando el cargo  ".$con->error;
                header('Location: ../admin_empleados/registrar_cargo.php');
            }
        }
    
            
    $con->close();
?>