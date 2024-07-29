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
            $directorio = "../imgServicios/";
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
                $_SESSION["Errori"]="Error tipo de imagen";
                header('Location: ../adminServicios/registrar.php');
                $estado=0;
                return $con->error;
            }else {
                echo "El archivo es de tipo:$tipoArchivo";
            }

            //Verificar si el archivo es apto para subir
            if($estado == 0){
                echo "Lo sentimos, su archivo no ha podido subirse";
            }else{
                if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $archivo)){
                    echo "<br>El archivo ".basename($_FILES["imagen"]["name"]." ha sido subido exitosamente!");
                }else{
                    echo "Ha ocurrido un error.";
                }
            }
            $nombre=$_POST["nombre"];
            
            $sql="INSERT INTO SERVICIO (id_categoria_servicio, nombre_servicio, descripcion_servicio, tarifa_servicio, imagen_servicio)
            VALUES('".$_POST["categoria"]."','".$nombre."','".$_POST["descripcion"]."','".$_POST["tarifa"]."','".$archivo."');";
            
            if($con->query($sql)===TRUE){             
                $_SESSION["Registrado"]="El servicio ha sido registrado";   
                header('Location: ../adminServicios/registrar.php');
            }else{
                $_SESSION["Error"]="El servicio no se ha podido registrar";
                header('Location: ../adminServicios/registrar.php');
            }
            
            
            $con->close();
        }
    }
    
    $con = new Configuracion();
    $con->crearServicio();
?>