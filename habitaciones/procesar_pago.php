<?php 
session_start();
error_reporting (E_ALL ^ E_NOTICE);
include '../controller/conexion.php';
if(!isset($_SESSION["Usuario"])){
    header('Location: http://localhost/hotel/user/login.php');
}
$user=$_SESSION["Usuario"];
$conexion = new Conexion();
$conn = $conexion->conectarDB();
$sen = "SELECT * FROM usuarios WHERE id_usuario='$user'";
$rs=$conn->query($sen);
while ($fila = $rs->fetch_assoc()) {
    $user=$fila["email"];                
}

USE PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;


$numero=$_POST["numeroTarjeta"];
$mes=$_POST["mes"];
$anio=$_POST["anio"];
$num=$_POST["cvv"];
$nombre=$_POST["nombre"];
$tarjeta=$_POST["tarjeta"];
$pago=$_POST["pago"];


function validarTarjetaCredito($numero) {
    $numero = str_replace(' ', '', $numero); // Elimina espacios en blanco
    $longitud = strlen($numero);
    $suma = 0;

    // Recorre los dígitos de la tarjeta de crédito de derecha a izquierda
    for ($i = $longitud - 1; $i >= 0; $i--) {
        $digito = (int) $numero[$i];
        // Si el dígito está en una posición par, se duplica
        if (($longitud - $i) % 2 == 0) {
            $digito *= 2;
            // Si el resultado de la duplicación es mayor o igual a 10, se suma los dígitos
            if ($digito >= 10) {
                $digito = ($digito % 10) + 1;
            }
        }
        $suma += $digito;
    }

    // Si la suma de los dígitos es un múltiplo de 10, la tarjeta es válida
    return ($suma % 10 == 0);
}
if (validarTarjetaCredito($numero)) {
    //echo 'La tarjeta es válida'."<br>";
} else {
    //echo 'La tarjeta es inválida'."<br>";
    
    header("Location: ./pago.php?mensaje=tarjeta");
}

function validarFechaCaducidad($mes, $anio) {
    $mes = intval($mes);
    $anio = intval($anio);
    if ($mes < 1 || $mes > 12) {
        return false;
    }
    if ($anio < date('Y')) {
        return false;
    }
    return checkdate($mes, 1, $anio);
}
if (validarFechaCaducidad($mes, $anio)) {
    //echo 'La fecha tarjeta es válida'."<br>";
} else {
    //echo 'La fecha tarjeta es inválida'."<br>";
    header("Location: ./pago.php?mensaje=fecha");
}
$num;
function validarCVV($num) {
    return preg_match('/^\d{3,4}$/',$num) === 1;
}
if (validarCVV($num)) {
    //echo 'El codigo de seguridad es valido'."<br>";
} else {
    //echo 'El codigo de seguridad es invalido'."<br>";
    header("Location: ./pago.php?mensaje=codigo");
}

function validarNombre($nombre) {
    return preg_match('/^[a-zA-Z ]+$/', $nombre) === 1 && strlen($nombre) > 0;
}
if (validarNombre($nombre)) {
    //echo 'El nombre es valido'."<br>";
} else {
    //echo 'El nombre es invalido'."<br>";
    header("Location: ./pago.php?mensaje=nombre");
}

$tarjetaValida = validarTarjetaCredito($numero);
$fechaValida = validarFechaCaducidad($mes, $anio);
$cvvValido = validarCVV($num);
$nombreValido = validarNombre($nombre);

if ($tarjetaValida && $fechaValida && $cvvValido && $nombreValido) {
    // Todas las validaciones son verdaderas, se puede hacer la consulta SQL segura
    $conexion=new Conexion();
    $con=$conexion->conectarDB();
    $sql="UPDATE reservacion SET forma_pago='Tarjeta de credito' ORDER BY id_reservacion DESC LIMIT 1";
    if ($con->query($sql)===TRUE) {
        header ("Location: ./confirmacion.php");


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
                    $mail->addAddress($user); 
                    
                        
                    $mail->isHTML(true);
                    $mail->Subject = utf8_decode('Registro reservación');
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
                                <h1 class="text-center">Reservación</h1>
                                <p>Su reservación ha sido registrada con exito</p>
                                <p>Gracias por preferirnos</p>
                                <p class="text">!Esperamos que disfrute su estancia en nuestro hotel¡</p>            
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
    }
} else {
    // Al menos una validación es falsa, se muestra un mensaje de error
    echo "Error: los datos de la tarjeta de crédito no son válidos";
}

?>