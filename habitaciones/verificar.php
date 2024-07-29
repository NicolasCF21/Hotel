<?php
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con=$conexion->conectarDB();
    $producto =  $_GET['producto'];
    $id=$_GET["id"];

    // Buscar si el producto ya está registrado en la base de datos
    $validar = "SELECT * FROM inventario WHERE id_producto='$producto' and id_habitacion='$id'";
    $stmt=$con->query($validar);
    if ($stmt->num_rows> 0) {
    echo 'registrado';
    }

    // Cerrar la conexión a la base de datos
    $con->close();
?>