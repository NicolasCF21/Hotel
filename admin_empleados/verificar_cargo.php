<?php
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con=$conexion->conectarDB();
    $cargo =  $_GET['cargo'];

    // Buscar si el producto ya está registrado en la base de datos
    $validar = "SELECT * FROM cargo_empleado WHERE cargo_empleado='$cargo'";
    $stmt=$con->query($validar);
    if ($stmt->num_rows> 0) {
    echo 'registrado';
    }

    // Cerrar la conexión a la base de datos
    $con->close();
?>