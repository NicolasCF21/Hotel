<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $idinventario=$_POST["idi"];
    $idproducto = $_POST["idp"];
    $idhabitacion = $_POST["idh"];    
    $cantidad = $_POST['cantidad'];
    $conex=$conexion->conectarDB();
    $sent="SELECT cantidad FROM inventario where id_habitacion=$idhabitacion AND id_producto=$idproducto";
    $rs=$conex->query($sent);
    while ($row=$rs->fetch_assoc()) {
        $cantActual=$row["cantidad"];
    }
   
    $sql = "UPDATE inventario SET cantidad=$cantidad WHERE id_habitacion=$idhabitacion and id_producto=$idproducto";    
    if($con->query($sql)===TRUE) {
        $conn=$conexion->conectarDB();
        $sentencia="SELECT * FROM productos;";
        $result = $conn->query($sentencia);
        while($fila = $result->fetch_assoc()){
            $cant=$fila["cantidad_producto"];
        };                
        $conec=$conexion->conectarDB();
        $sql2="UPDATE productos SET cantidad_producto=cantidad_producto-($cantidad-$cantActual) WHERE id_producto=$idproducto AND cantidad_producto>=0";
        if($conec->query($sql2)===TRUE) {
            header ("Location: actualizar.php?id=$idinventario&mensaje=actualizado");
        }else{
           header ("Location: actualizar.php?id=$idinventario&mensaje=error"); 
        }                 
    }    
?>