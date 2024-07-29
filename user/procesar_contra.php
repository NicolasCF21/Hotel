<?php
    session_start();
    include '../controller/conexion.php';
    include '../config/seguridad.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $limpieza = new Seguridad();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_REQUEST['email'];
        $psw1=$limpieza->encriptarP($_REQUEST["psw1"]);
        $psw2=$limpieza->encriptarP($_REQUEST["psw2"]);  
        if($psw1==$psw2){
            $sql="UPDATE usuarios set password='$psw1' where email='$email'";                
            if($con->query($sql)===TRUE){
                $msg['exito'] = "Su contraseña ha sido actualizada correctamente";
            }else{
                $msg['error'] = "No se pudo actualizar su contraseña";
            }
        }else{
            $msg['errorc'] = "Las contraseñas no coinciden. Intentelo de nuevo";
        }
      
    }
?>