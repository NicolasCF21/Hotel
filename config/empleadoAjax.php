<?php
    require_once '../controller/conect.php';
    require_once 'funcionesE.php';

    $datos=[];

    if (isset($_POST["action"])) {
        $action=$_POST["action"];
        $con = new Conexion();
        $conexion = $con->conectarDB();

        if ($action == 'emailExiste') {
            $datos['ok'] = emailExiste($_POST["email"], $conexion);
        }elseif($action == 'documentoExiste'){
            $datos['ok'] = documentoExiste($_POST["documento"], $conexion);
        }elseif($action == 'campoNombre'){
            $datos['ok'] = campoNombre($_POST["nombre"]);
        }elseif($action == 'campoApellido'){
            $datos['ok'] = campoApellido($_POST["apellido"]);
        }elseif($action == 'campoTelefono'){
            $datos['ok'] = campoTelefono($_POST["telefono"]);
        }elseif($action == 'campoDocumento'){
            $datos['ok'] = campoDocumento($_POST["documento"]);
        }elseif($action == 'esEmail'){
            $datos['ok'] = esEmail($_POST["email"]);
        }elseif($action == 'campoSueldo'){
            $datos['ok'] = campoSueldo($_POST["sueldo"]);
        }
    }
    echo json_encode($datos);