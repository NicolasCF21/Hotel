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
        function crearUsuario(){
            error_reporting (E_ALL ^ E_NOTICE);
            include '../controller/conexion.php';
            include '../config/seguridad.php';
            $conexion = new Conexion();
            $con = $conexion->conectarDB();
            $limpieza = new Seguridad();
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];  
            
            $email=$_POST["email"];  
            $telefono=$_POST["telefono"];
            $documento=$_POST["documento"];
            //Consulta si existen el usuario en la base de datos
            $validar="SELECT * FROM USUARIOS WHERE email='$email' OR documento='$documento'";
            $validando=$con->query($validar);    
            if($validando->num_rows>0){
                $_SESSION["Resgistrado"]="Esta registrado";
                header("Location: ../user/registro.php");
            }else{
                $password=$limpieza->encriptarP($_POST["password"]);
                $sql="INSERT INTO USUARIOS (nombre_usuario, apellido_usuario, email, telefono, documento, password)
                VALUES('$nombre', '$apellido', '$email', '$telefono','$documento', '$password');";
                
                if($con->query($sql)===TRUE){
                    $_SESSION["Status"]="Se ha creado el usuario exitosamente";
                    header('Location: ../user/registro.php');
                }else{
                    $_SESSION["ErrorDB"]="Error creando el usuario en la base de datos ".$con->error;
                    header('Location: ../user/registro.php');
                }
            }
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearUsuario();
?>