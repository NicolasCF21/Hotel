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
    
        function crearPromocion(){
            $con=$this->conectarDB();
            $directorio = "./img/";
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
                header('Location: ../admin_prom/registrar_prom.php');
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
                                            

                $sql="INSERT INTO promociones (id_habitacion, nombre_prom, descripcion, fecha_inicio, fecha_fin, descuento, estado, imagen)
                VALUES('".$_POST["habitacion"]."','".$_POST["nombre"]."','".$_POST["descripcion"]."','".$_POST["inicio"]."','".$_POST["fin"]."','".$_POST["descuento"]."','Activa','".$archivo."');";
            
                if($con->query($sql)===TRUE){ 
                    
                    $_SESSION["Registrado"]="La promocion ha sido registrada";
                    header('Location: ../admin_prom/registrar_prom.php');
                }else{   
                    echo $con->error;
                   $_SESSION["Error"]="La promocion no se ha podido registrar";
                   //header('Location: ../admin_prom/registrar_prom.php');
                }
                $con->close();
            }                    
        }

    
    $con = new Configuracion();
    $con->crearPromocion();
?>