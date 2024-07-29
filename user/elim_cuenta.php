<?php
include '../controller/conexion.php';
//function eliminarCorreo(){
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET["id"];
    $sql = "DELETE FROM usuarios WHERE id_usuario ='$id'";
   
    if ($con->query($sql) == true) {
        header("Location: ./login.php?action=true");
    }
?>