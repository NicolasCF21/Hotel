<?php
include '../controller/conexion.php';
$conexion = new Conexion();
$con = $conexion->conectarDB();

$id = $_POST['id'];
$estado = $_POST['estado'];

$sql = "UPDATE opiniones SET estado = '$estado' WHERE id_opinion = '$id'";
$con->query($sql);
?>