<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id=$_POST["id"];
    $producto=$_POST["producto"];
    $cantidad=$_POST["cantidad"];
    //Consulta si existen el tipo de habitacion
    $validar="SELECT * FROM inventario WHERE id_producto='$producto' and id_habitacion='$id'";
    $validando=$con->query($validar);    
    if($validando->num_rows>0){                
        $_SESSION["PRegistrado"]="El producto ya esta registrado en la habitación";
        header("Location: ../habitaciones/registrar.php?id='$id'&mensaje=registrado");
    }else{            
        $sql="INSERT INTO inventario (id_habitacion, id_producto, cantidad)
        VALUES('".$id."','".$producto."','".$cantidad."');";
                
        if($con->query($sql)===TRUE){
            $sentencia="UPDATE productos set cantidad_producto=cantidad_producto-$cantidad where id_producto=$producto;";
            if ($con->query($sentencia)===TRUE) {
                $_SESSION["Registrado"]="Se ha creado el producto correctamente";
                header("Location: ../habitaciones/registrar.php?id='$id'&mensaje=correcto");
            }                    
            }else{
                $_SESSION["Error"]="Error creando el producto";
                header("Location: ../habitaciones/registrar.php?id='$id'&mensaje=error");
            }
                
    }        
    
    $con->close();
?>