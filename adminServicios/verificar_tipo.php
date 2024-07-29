<?php
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con=$conexion->conectarDB();
    $tipo =  $_GET['tipo'];

    // Buscar si el producto ya está registrado en la base de datos
    $validar = "SELECT * FROM categoria_servicio WHERE categoria_servicio='$tipo'";
    $stmt=$con->query($validar);
    if ($stmt->num_rows> 0) {
    // El producto ya está registrado
    echo 'registrado';
    }

    // Cerrar la conexión a la base de datos
    $con->close();
?>