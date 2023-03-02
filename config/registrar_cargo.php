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
        function crearTipoH(){
            $con=$this->conectarDB();
            $sql="INSERT INTO cargo_empleado (cargo_empleado)
            VALUES('".$_POST["cargo"]."');";
            
            if($con->query($sql)===TRUE){
                $_SESSION["Status"]="Se ha creado el cargo correctamente";
                header('Location: ../admin_empleados/registrar_cargo.php?mensaje=registrado');
            }else{
                $_SESSION["ErrorDB"]="Error creando el cargo  ".$con->error;
                header('Location: ../admin_empleados/registrar_cargo.php?mensaje=error');
            }
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearTipoH();
?>