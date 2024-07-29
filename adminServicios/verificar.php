<?php
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con=$conexion->conectarDB();
    $nombre =  $_GET['nombre'];

    // Buscar si el producto ya está registrado en la base de datos
    $validar = "SELECT * FROM servicio WHERE nombre_servicio='$nombre'";
    $stmt=$con->query($validar);
    if ($stmt->num_rows> 0) {
    // El producto ya está registrado
    echo 'registrado';
    }

    // Cerrar la conexión a la base de datos
    $con->close();
?>