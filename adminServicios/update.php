<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id=$_POST["id_servicio"];
    $nombre=$_POST['nombre'];
    $categoria=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $tarifa=$_POST["tarifa"];   
    $estado=0;

    if($_FILES["imagen"]["error"] == 0){ //Verificar si el archivo se envio (0) sino lo omite
        $fileName = basename($_FILES["imagen"]["name"]); 
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){
            if($_FILES["imagen"]["size"] > 1000000){
                $estado=1;
                $error = "El peso del archivo excede el tamaño permitido";
                header ("Location: actualizar.php?id=".$id."&error=" . $error . ""); 
            } else {
                $directorio = "../imgServicios/";
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
        }
        $sql = "UPDATE SERVICIO SET nombre_servicio='$nombre', id_categoria_servicio='$categoria', descripcion_servicio='$descripcion',
        tarifa_servicio='$tarifa', imagen_servicio='$archivo' WHERE id_servicio=$id";
    }else{
        $sql = "UPDATE SERVICIO SET nombre_servicio='$nombre', id_categoria_servicio='$categoria', descripcion_servicio='$descripcion',
        tarifa_servicio='$tarifa' WHERE id_servicio=$id";
    }

    if($estado === 0 && $con->query($sql) === TRUE) {
        header ("Location: actualizar.php?id=". $id . "&mensaje=correcto"); 
    }else{
        header ("Location: actualizar.php?id=" . $id . "&mensaje=error"); 
    }

?>