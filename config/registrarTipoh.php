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
            $sql="INSERT INTO TIPO_HABITACION (tipo_habitacion)
            VALUES('".$_POST["tipo"]."');";
            
            if($con->query($sql)===TRUE){
                $_SESSION["Status"]="Se ha creado el tipo de habitacion correctamente";
                header('Location: ../adminHabitaciones/registrar_tipo.php?mensaje=registrado');
            }else{
                $_SESSION["ErrorDB"]="Error creando el tipo de habitacion ".$con->error;
                header('Location: ../adminHabitaciones/registrar_tipo.php?mensaje=error');
            }
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearTipoH();
?>