<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $user = $_SESSION["Usuario"];
    include '../controller/conexion.php';
    include '../config/seguridad.php';
    $conexion=new Conexion();
    $con=$conexion->conectarDB();
    $limpieza = new Seguridad();
    if (isset($_POST['submit'])) {        
        $passworda=$limpieza->encriptarP($_POST["passworda"]);
        $passwordn=$limpieza->encriptarP($_POST["passwordn"]);
        $passwordc=$limpieza->encriptarP($_POST["passwordc"]);
        $sql="SELECT * FROM usuarios WHERE id_usuario='$user' AND password='$passworda'";
        $result=$con->query($sql);
        if ($result->num_rows>0) {
            if ($passwordn != $passwordc) {
                $_SESSION["errorConf"]="Las contraseñas no coinciden";
                header("Location: cambio_password.php");
            }else{
                $sentencia="UPDATE usuarios SET password = '$passwordn' WHERE id_usuario= '$user'";
                if($con->query($sentencia)===TRUE) {
                    $_SESSION["exito"]="La contraseña fue modificada";
                    header("Location: cambio_password.php");
                }else{
                    $_SESSION["error"]="La contraseña no fue modificada";
                    header("Location: cambio_password.php");
                }
            }
        }else{
            $_SESSION["errorCont"]="La contraseña no es correcta";
            header("Location: cambio_password.php");
        }
        
    }
?>