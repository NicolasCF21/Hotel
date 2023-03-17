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
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $documento=$_POST["documento"];
            $telefono=$_POST["telefono"];
            $correo=$_POST["correo"];
            $sueldo=$_POST["sueldo"];
            $nombre=$_POST["cargo"];
            $horario=$_POST["horario"];
            $validar = "SELECT * FROM EMPLEADO WHERE correo='$correo'|| documento='$documento'";
            $validando=$con->query($validar);
            if($validando->num_rows>0){
                header("Location: ../admin_empleados/registrar_empleado.php?mensaje=registrado");
            }else{
                $sql="INSERT INTO empleado (id_cargo_empleado, id_turno_empleados, nombre_empleado, apellido_empleado, documento, telefono, correo, sueldo)
                VALUES('$cargo', '$horario', '$nombre', '$apellido', '$documento','$telefono', '$email', '$sueldo');";
            
                if($con->query($sql)===TRUE){
                    header('Location: ../admin_empleados/registrar_empleado.php?mensaje=correcto');
                }else{
                    $con->error;
                    header('Location: ../admin_empleados/registrar_empleado.php?mensaje=error');
                }
            }

            
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearTipoS();
?>