<?php
    error_reporting (E_ALL ^ E_NOTICE);
    //TIMESTAMP sirve para definir la hora actual del registro 
    session_start();
    class Configuracion{
        private $servidor;
        private $user;
        private $password;
        private $status=0;

        public function conexion(){
            $servidor = "localhost";
            $user = "root";
            $password = "";
            $con= new mysqli($servidor, $user, $password);
            if($con->connect_error){
                $_SESSION["ErrorDB"]="No ha sido posible la conexion con el sistema";
                header('Location: ../user/registro.php');
            }else{
                $_SESSION["Status"]="Se ha conectado con la base de datos exitosamente";
                header('Location: ../user/registro.php');
            }
            return $con;
        }

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

        function crearDB(){
            $con=$this->conexion();
            $sql = "CREATE DATABASE HOTEL ;";
            if($con->query($sql)===TRUE){
                $_SESSION["Status"]="Se ha conectado con la base de datos exitosamente";
                header('Location: ../user/registro.php');
            }else{
                $_SESSION["ErrorDB"]="Error creando la base de datos ".$con->error;
                header('Location: ../user/registro.php');
            }
            $con->close();
        }

        function crearTB(){
            $con=$this->conectarDB();
            $sql = "CREATE TABLE EMPLEADOS(
                id_empleado INT(6) AUTO_INCREMENT PRIMARY KEY,
                id_cargo_empleado INT(6) NOT NULL,
                nombre VARCHAR(25) NOT NULL,
                apellido VARCHAR(25) NOT NULL,
                documento VARCHAR(25) NOT NULL,
                telefono VARCHAR(25) NOT NULL,
                correo VARCHAR(25) NOT NULL,
                password VARCHAR(25) NOT NULL
                /*fecha_reg TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON
                UPDATE CURRENT_TIMESTAMP*/
                );";
                if($con->query($sql)===TRUE){
                    $status = 1;
                }else{
                    $_SESSION["ErrorDB"]="Error creando la tabla en la base de datos ".$con->error;
                    header('Location: ../user/registro.php');
                }
                $con->close();
        }

        function crearUsuario(){
            $con=$this->conectarDB();
            include 'seguridad.php';
            $limpieza = new Seguridad();
            $password=$limpieza->encriptarP($_POST["password"]);
            $sql="INSERT INTO USUARIOS (nombre_usuario, apellido_usuario, email, telefono, documento, password)
            VALUES('".$_POST["nombre"]."', '".$_POST["apellido"]."', '".$_POST["email"]."', '".$_POST["telefono"]."','".$_POST["documento"]."', '".$password."');";
            
            if($con->query($sql)===TRUE){
                $_SESSION["Status"]="Se ha creado el usuario exitosamente";
                header('Location: ../user/registro.php');
            }else{
                $_SESSION["ErrorDB"]="Error creando el usuario en la base de datos ".$con->error;
                header('Location: ../user/registro.php');
            }
            $con->close();
        }
        function crearAdministrador(){
            $con=$this->conectarDB();
            include 'seguridad.php';
            $limpieza = new Seguridad();
            $password=$limpieza->encriptarP($_POST["password"]);
            $sql="INSERT INTO ADMINISTRADOR (email, password)
            VALUES('".$_POST["email"]."','".$password."');";
            
            if($con->query($sql)===TRUE){
                $_SESSION["Status"]="Se ha creado el usuario exitosamente";
                header('Location: ../admin/registro.php');
            }else{
                $_SESSION["ErrorDB"]="Error creando el usuario en la base de datos ".$con->error;
                header('Location: ../admin/registro.php');
            }
            $con->close();
        }
        
        
        

        function subirImagen(){
            $con=$this->conectarDB();
            $directorio = "../imgHabitaciones/";
            $archivo = $directorio . basename($_FILES["imagen"]["name"]);

            echo $archivo;

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
            //Verificar si el archivo existe
            if(file_exists("$archivo")){
                echo "El archivo ya existe en la ruta destino <br>";
            }else {
                echo "El archivo no existe en el directorio y se puede subir <br>";
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
            return $archivo;
        }    
    }
    $conex = new Configuracion();
    //$conex->conexion();
    //$conex->conectarDB();
    //$conex->crearDB();
    //$conex->crearTB();
    $conex->crearUsuario();
    //$conex->crearAdministrador();
    
?>