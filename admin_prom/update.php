<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id=$_POST["id"];
    $promocion=$_POST['promocion'];
    $id_habitacion=$_POST["id_habitacion"];
    $descripcion=$_POST['descripcion'];
    $inicio=$_POST["inicio"];
    $fin=$_POST["fin"];   
    $descuento=$_POST["descuento"];
    $estado=0;

    if($_FILES["imagen"]["error"] == 0){ //Verificar si el archivo se envio (0) sino lo omite
        $fileName = basename($_FILES["imagen"]["name"]); 
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){
            if($_FILES["imagen"]["size"] > 1000000){
                $estado=1;
                $errorimg = "El peso del archivo excede el tamaño permitido";
                header ("Location: actualizar.php?id=".$id."&error=" . $errorimg . ""); 
            }else{
                $directorio = "../img/";
                $archivo = $directorio . basename($_FILES["imagen"]["name"]);
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo)){
                    echo "<br>El archivo ".basename($_FILES["archivoSubir"]["name"]." ha sido subido exitosamente!");
                }else{
                    echo "Ha ocurrido un error.";
                }
            }      
        } else{
            $estado=1;
            $error = "Tipo de archivo no es el adecuado";
            header ("Location: actualizar.php?id=".$id."&error=" . $error . ""); 
            return $con->error;
        }
        $sql = "UPDATE promociones SET nombre_prom='$promocion', descripcion='$descripcion', fecha_inicio='$inicio', fecha_fin='$fin',
        descuento='$descuento', imagen='$archivo'  WHERE id_promocion=$id";
    }else{
        $sql = "UPDATE promociones SET nombre_prom='$promocion', descripcion='$descripcion', fecha_inicio='$inicio', fecha_fin='$fin',
        descuento='$descuento' WHERE id_promocion=$id";
    }

    if($estado === 0 && $con->query($sql) === TRUE) {
        $fecha_actual=date('Y-m-d');
        if ($fin>$fecha_actual) {
            $estado='Activa';
        }else{
            $estado='Finalizada';
        }
        $sentencia="UPDATE promociones SET estado='$estado' WHERE id_promocion=$id;";
        if ($con->query($sentencia)===TRUE) {
            $_SESSION["Actualizado"]="La habitacion se actualizo";
            header ("Location: actualizar.php?id=". $id . "&mensaje=correcto");             
        }else{
            $_SESSION["Error"]="La habitacion no se actualizo";
            header ("Location: actualizar.php?id=" . $id . "&mensaje=error");         
        }
        
    }
?>