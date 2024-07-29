<?php
include '../controller/conexion.php';
include '../config/seguridad.php';
$conexion = new Conexion();
$con = $conexion->conectarDB();
$limpieza = new Seguridad();
$id = $_POST['id'];
$token = $_POST['token'];
$psw1=$limpieza->encriptarP($_POST["psw1"]);
$psw2=$limpieza->encriptarP($_POST["psw2"]); 


    if($psw1==$psw2){
        $sql="UPDATE usuarios set password='$psw1' where id_usuario='$id' and token='$token';";                
        if($con->query($sql)===TRUE){            
            $_SESSION["Success"]="Contraseña restaurada correctamente";
            header("Location: http://localhost/hotel/user/login.php");
        }
    }

?>
