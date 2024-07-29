<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id"];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    #$documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $sueldo = $_POST['sueldo'];
    $turno = $_POST['turno'];
    $contrato = $_POST['contrato'];

    if (!preg_match("/^[a-zA-Zá-úÁ-Ú ñ-Ñ]*$/",$nombre)) {                    
        #echo"error";
        $_SESSION["nombre"]="¡Por favor igrese solo letras!";
        header("Location: ../admin_empleados/actualizar_empleado.php?id=".$id."&mensaje=nombre");
    }
    elseif (!preg_match("/^[a-zA-Zá-úÁ-Ú ñ-Ñ]*$/",$apellido)) {                
        $_SESSION["apellido"]="Por favor ingrese solo letras";
        header("Location: ../admin_empleados/actualizar_empleado.php?id=".$id."&mensaje=apellido");
    }
    elseif (!is_numeric($telefono)) {                
        $_SESSION["telefono"]="Por favor ingrese solo numeros";
        header("Location: ../admin_empleados/actualizar_empleado.php?id=".$id."&mensaje=telefono");
    }
    elseif (!is_numeric($sueldo)) {                
        $_SESSION["sueldo"]="Por favor ingrese solo numeros";
        header("Location: ../admin_empleados/actualizar_empleado.php?id=".$id."&mensaje=telefono");
    }
    elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["correo"]="Ingrese un correo valido";
        header("Location: ../admin_empleados/actualizar_empleado.php?id=".$id."&mensaje=email");
    }
    else{
        $sql = " UPDATE empleado SET id_cargo_empleado='$cargo', id_tipo_contrato='$contrato', id_turno_empleados='$turno', nombre_empleado='$nombre', apellido_empleado='$apellido', 
        telefono='$telefono', correo='$correo', sueldo='$sueldo' WHERE id_empleado=$id";

        if($con->query($sql)===TRUE) {
            $_SESSION["Actualizar"]="Actualizado";
            header ("Location: actualizar_empleado.php?id=". $id ."&mensaje=actualizado"); 
        }else{
            header ("Location: actualizar_empleado.php?id=". $id ."&mensaje=error");
        }
    }
?>