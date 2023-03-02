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
        function crearTipoS(){
            $con=$this->conectarDB();
            $sql="INSERT INTO CATEGORIA_SERVICIO (categoria_servicio)
            VALUES('".$_POST["tipo"]."');";
            
            if($con->query($sql)===TRUE){
                header('Location: ../adminServicios/registrar_tipo.php?mensaje=correcto');
            }else{
                $con->error;
                header('Location: ../adminServicios/registrar_tipo.php?mensaje=error');
            }
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearTipoS();
?>