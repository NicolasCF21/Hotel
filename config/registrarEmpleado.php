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
            $sql="INSERT INTO empleado (id_cargo_empleado, id_turno_empleados, nombre_empleado, apellido_empleado, documento, telefono, correo, sueldo)
            VALUES('".$_POST["cargo"]."', '".$_POST["horario"]."', '".$_POST["nombre"]."', '".$_POST["apellido"]."', '".$_POST["documento"]."', '".$_POST["telefono"]."', '".$_POST["email"]."', '".$_POST["sueldo"]."');";
            
            if($con->query($sql)===TRUE){
                header('Location: ../admin_empleados/registrar_empleado.php?mensaje=correcto');
            }else{
                $con->error;
                header('Location: ../admin_empleados/registrar_empleado.php?mensaje=error');
            }
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearTipoS();
?>