<?php
    session_start();
    class Configuracion{
        private $servidor;
        private $user;
        private $password;
        private $status=0;

        function conectarDB(){
            $servidor = "localhost";
            $user = "root";
            $password = "";
            $database = "HOTEL2";
            $con= new mysqli($servidor, $user, $password, $database);
            if($con->connect_error){
                $_SESSION["ErrorDB"]="No ha sido posible la conexion con la base de datos ".$con->error;
                header('Location: ../user/registro.php');
            }else{
                $status=1;  
            }
            return $con;
        }
    
        function crearServicio(){
            $con=$this->conectarDB();
            $directorio = "../imgHabitaciones/";
            $archivo = $directorio . basename($_FILES["imagen"]["name"]);
            $estado = 1;
            $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            //Verificar si es o no una imagen por medio de getimagesize
            if(isset($_POST["submit"])) {
                $verificar = getimagesize($_FILES["imagen"]["tmp_name"]);
                if($verificar !== false) {
                    echo "El archivo es una imagen <br>";
                }else {
                    echo "El archivo no es una imagen <br>";
                    $estado=0;
                }
            }
            //Verificar el tipo de la imagen
            if ($tipoArchivo != "png" && $tipoArchivo != "jpg" && $tipoArchivo != "jpeg") {
                echo "Tipo de archivo no permitido";
                $estado=0;
            }else {
                echo "El archivo es de tipo:$tipoArchivo";
            }

            //Verificar el tamaño de la imagen
            if($_FILES["imagen"]["size"]>1000000){
                echo "<br>El peso del archivo excede el tamaño permitido";
                $estado=0;
            }

            //Verificar si el archivo es apto para subir
            if($estado == 0){
                echo "Lo sentimos, su archivo no ha podido subirse";
            }else{
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo)){
                    echo "<br>El archivo ".basename($_FILES["archivoSubir"]["name"]." ha sido subido exitosamente!");
                }else{
                    echo "Ha ocurrido un error.";
                }
            }
            $sql="INSERT INTO SERVICIO (id_categoria_servicio, nombre_servicio, descripcion_servicio, tarifa_servicio, imagen_servicio)
            VALUES('".$_POST["categoria"]."','".$_POST["nombre"]."','".$_POST["descripcion"]."','".$_POST["tarifa"]."','".$archivo."');";
        
            if($con->query($sql)===TRUE){                
                header('Location: ../adminServicios/registrar.php?mensaje=correcto');
            }else{
                $con->error;
                header('Location: ../adminServicios/registrar.php?mensaje=error');
            }
            $con->close();
        }
    }
    
    $con = new Configuracion();
    $con->crearServicio();
?>