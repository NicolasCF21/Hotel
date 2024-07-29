<?php
    USE PHPMailer\PHPMailer\PHPMailer;
    USE PHPMailer\PHPMailer\Exception;
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
            $fecha=$_POST["fecha"];

            //Verificar si el usuario que se quiere registrar es mayor de edad
            $fecha_nacimiento = strtotime($fecha);
            $hoy = new DateTime();
            $fecha_nacimiento = new DateTime(date('Y-m-d', $fecha_nacimiento));
            $edad = date_diff($hoy, $fecha_nacimiento)->y;


            //Consulta si existe el usuario en la base de datos
            $validar="SELECT * FROM USUARIOS WHERE email='$email' || documento='$documento'";
            $validando=$con->query($validar);    
            if($validando->num_rows>0){
                $_SESSION["Resgistrado"]="Esta registrado";
                header("Location: registro.php");
            }else{
                $password2=$limpieza->encriptarP($_POST["password2"]);
                $password=$limpieza->encriptarP($_POST["password"]);
                if($password!=$password2){
                    $_SESSION["Password"]="¡Las contraseñas no coinciden!";
                    header("Location: ../user/registro.php");
                }
                elseif (!preg_match("/^[a-zA-Zá-úÁ-Ú ñ-Ñ ]*$/",$nombre)) {                    
                    #echo"error";
                    $_SESSION["nombre"]="¡Por favor igrese solo letras!";
                    header("Location: ../user/registro.php");
                }
                elseif (!preg_match("/^[a-zA-Zá-úÁ-Ú ñ-Ñ ]*$/",$apellido)) {                
                    $_SESSION["apellido"]="Por favor ingrese solo letras";
                    header("Location: ../user/registro.php");
                }
                elseif (!is_numeric($telefono)) {                
                    $_SESSION["telefono"]="Por favor ingrese solo numeros";
                    header("Location: ../user/registro.php");
                }
                elseif (!is_numeric($documento)) {                
                    $_SESSION["documento"]="Por favor ingrese solo numeros";
                    header("Location: ../user/registro.php");
                }
                elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["correo"]="Ingrese un correo valido";
                    header("Location: ../user/registro.php");
                }
                elseif ($edad<18) {            
                    $_SESSION["edad"]="El usuario es menor de edad";
                    header("Location: ../user/registro.php");
                }else{
                    $sql="INSERT INTO usuarios (nombre_usuario, apellido_usuario, email, telefono, documento, fecha_nacimiento, password)
                    VALUES('$nombre', '$apellido', '$email', '$telefono','$documento','$fecha', '$password');";
                    
                        require '../PHPMailer/Exception.php';
                        require '../PHPMailer/PHPMailer.php';
                        require '../PHPMailer/SMTP.php';
                        $mail = new PHPMailer(true);
                        try {
                            $mail->SMTPDebug = 0;                  
                            $mail->isSMTP();                       
                            $mail->Host       = 'smtp.gmail.com';
                            $mail->SMTPAuth   = true;
                            $mail->Username   = 'hresplendor@gmail.com';
                            $mail->Password   = 'rvwysxchdxnfmpqn';
                            $mail->SMTPSecure = 'tls';
                            $mail->Port       = 587;
                            
                            $mail->setFrom('hresplendor@gmail.com', 'Hotel');
                            $mail->addAddress($email); 
                            
                                
                            $mail->isHTML(true);
                            $mail->Subject = 'Registro confirmado';
                            $mail->Body    = '<!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                <style type="text/css">  
                                    * {
                                        box-sizing: border-box;
                                    }  
                                    .container{
                                        margin: 0 auto;
                                        width:50%;
                                        background-color: #F0F0F2;
                                        padding: 30px 100px;
                                        text-align: center;
                                    }        
                                    h1{
                                        color: #10454F;
                                        font-family: "Roboto", sans-serif;    
                                    }
                                    p{
                                        color: #10403B;
                                        font-family: "Roboto", sans-serif;
                                    }
                                    img{
                                        width:100%;
                                        margin-left: auto;
                                        margin-right: auto;
                                        display: block;
                                        padding:0px;
                                    }
                                    .text{
                                        font-weight: bold;
                                        margin-bottom: 40px;
                                    }
                                    .btnlink{
                                        padding:15px 30px;
                                        font-family: "Roboto", sans-serif;
                                        text-align:center;
                                        background-color:#cecece;
                                        color: #10403B;
                                        font-weight: 600;
                                        text-decoration: blue;            
                                    }
                                    .btnlink:hover{
                                        color: #fff !important;
                                    }
                                    @media screen and (max-width: 768px) {    
                                    .container {
                                        width: 80%;
                                        padding: 20px;
                                    }
                                    }
                            
                                    @media screen and (max-width: 480px) {    
                                    .container {
                                        width: 90%;
                                        padding: 10px;
                                    }
                                    img {
                                        max-width: 120px;
                                    }
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="container">
                                    <div class="text-center">                                        
                                        <h1 class="text-center">¡Bienvenido a Hotel Resplendor!</h1>
                                        <p>Te damos la bienvenida, hotel resplendor te ayudará a facilitar tus procesos de reservas, seleccionar los servicios indicados para ti y los mejores precios.</p>            
                                        <p class="text">¡Gracias por unirte a nosotros, estaremos encantados en ayudarte a tener una gran experinecia!</p>  
                                        <a href="http://localhost/hotel/user/login.php" target="_blank" rel="noopener noreferrer" class="btnlink">Inicia Sesion</a>          
                                    </div>
                                </div>
                                
                            </body>
                            </html>';
                            if($mail->send()){
                                $msg = "¡Se ha enviado el mensjae!";
                            } 
                        } catch (Exception $e) {
                            $msg = "¡No sa ha podido enviar el mensaje!";
                        }
                        

                    
                    if($con->query($sql)===TRUE){
                        $_SESSION["Status"]="Se ha creado el usuario exitosamente";
                        header('Location: registro.php');
                    }else{
                        $_SESSION["Error"]="El usuario no se ha podido registrar ";
                        header('Location: registro.php');
                    }
                }
                
            }
            $con->close();
        }
        
    }
    
    $con = new Configuracion();
    $con->crearUsuario();
?>