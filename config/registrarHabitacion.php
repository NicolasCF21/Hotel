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
    
        function crearHabitacion(){
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
                $_SESSION["Errori"]="La habitación no se ha podido registrar";
                header('Location: ../adminHabitaciones/registrar.php');
                return $con->error;
                $estado=0;
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
                date_default_timezone_set('America/Bogota');
                $fecha_actual = date('Y-m-d');                            
                $sentencia = "SELECT id_temporada FROM temporada where fecha_inicio <= '$fecha_actual' AND fecha_fin >= '$fecha_actual'";
                $resultset = $con->query($sentencia);
                if($resultset->num_rows>0){{
                    while ($fila = $resultset->fetch_assoc()) {
                        
                        $id_temporada = $fila["id_temporada"];                        
                    }
                }                            

                $sql="INSERT INTO habitacion (id_tipo_habitacion, id_temporada, nombre_habitacion, descripcion_habitacion, cantidad_personas, id_estado, precio_Tb, imagen_habitacion)
                VALUES('".$_POST["categoria"]."', $id_temporada,'".$_POST["nombre"]."','".$_POST["descripcion"]."','".$_POST["cantidad"]."','".$_POST["estado"]."','".$_POST["preciob"]."','".$archivo."');";
            
                if($con->query($sql)===TRUE){ 
                    
                    $_SESSION["Registrado"]="La habitación ha sido registrada";
                    header('Location: ../adminHabitaciones/registrar.php');
                }else{   
                    
                   $_SESSION["Error"]="La habitación no se ha podido registrar";
                   header('Location: ../adminHabitaciones/registrar.php');
                }
                $con->close();
            }                    
        }
    }

    
    $con = new Configuracion();
    $con->crearHabitacion();
?>