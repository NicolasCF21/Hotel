<?php
    session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    if (!isset($_SESSION["Usuario"])) {
        $_SESSION["registrarse"]="debe registrase";
        header("Location: ../vistas/reseñas.php");
    }
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $user=$_SESSION["Usuario"];
    $opinion=$_POST["opinion"];
    $valoracion=$_POST["calificacion"];
    if(!is_numeric($valoracion)){
      $_SESSION["texto"]="Ingrese un numero";
      header("Location: ../vistas/reseñas.php");
    }
    $sql="INSERT INTO OPINIONES (id_usuario, opinion, calificacion, estado)
    VALUES('$user', '$opinion', '$valoracion', 'No aprobada');";

    
    // Mostrar los comentarios existentes
    if ($con->query($sql)===TRUE) {
      #echo "registrado";
      $_SESSION["exito"]="comentario registrado";
      header("Location: ../vistas/reseñas.php");
    }
?>