<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();   
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $documento=$_POST["documento"];
    $telefono=$_POST["telefono"];
    $email=$_POST["email"];
    $sueldo=$_POST["sueldo"];
    $cargo=$_POST["cargo"];
    $horario=$_POST["horario"];
    $contrato=$_POST["contrato"];
    $validar = "SELECT * FROM EMPLEADO WHERE correo='$email'|| documento='$documento'";
    $validando=$con->query($validar);
    if($validando->num_rows>0){
        $_SESSION["ERegistrado"]="Empleado ya se encuentra registrado";
            header("Location: ../admin_empleados/registrar_empleado.php");
    }else{
        if (!preg_match("/^[a-zA-Zá-úÁ-Úñ-Ñ]*$/",$nombre)) {                    
            #echo"error";
            $_SESSION["nombre"]="¡Por favor igrese solo letras!";
            header("Location: ../admin_empleados/registrar_empleado.php");
        }
        elseif (!preg_match("/^[a-zA-Zá-úÁ-Úñ-Ñ]*$/",$apellido)) {                
            $_SESSION["apellido"]="Por favor ingrese solo letras";
            header("Location: ../admin_empleados/registrar_empleado.php");
        }
        elseif (!is_numeric($telefono)) {                
            $_SESSION["telefono"]="Por favor ingrese solo numeros";
            header("Location: ../admin_empleados/registrar_empleado.php");
        }
        elseif (!is_numeric($documento)) {                
            $_SESSION["documento"]="Por favor ingrese solo numeros";
            header("Location: ../admin_empleados/registrar_empleado.php");
        }
        elseif (!is_numeric($sueldo)) {                
            $_SESSION["sueldo"]="Por favor ingrese solo numeros";
            header("Location: ../admin_empleados/registrar_empleado.php");
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["correo"]="Ingrese un correo valido";
            header("Location: ../admin_empleados/registrar_empleado.php");
        }else{
            $sql="INSERT INTO empleado (id_cargo_empleado, id_tipo_contrato, id_turno_empleados, nombre_empleado, apellido_empleado, documento, telefono, correo, sueldo,estado)
            VALUES('$cargo', '$contrato', '$horario', '$nombre', '$apellido', '$documento','$telefono', '$email', '$sueldo', 'Activo');";            
            if($con->query($sql)===TRUE){
                $_SESSION["Registrado"]="Empleado registrado";
                header('Location: ../admin_empleados/registrar_empleado.php');
            }else{
                $_SESSION["Error"]="Empleado no se registro";
                header('Location: ../admin_empleados/registrar_empleado.php');
            }
        }
                
    }
    
    $con->close();
?>