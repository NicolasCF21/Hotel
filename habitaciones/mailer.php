<?php
    USE PHPMailer\PHPMailer\PHPMailer;
    USE PHPMailer\PHPMailer\Exception;
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';

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
                                <img src="http://localhost/hotel/img/Logo1.png" alt="Logo hotel" style="max-width:170px">
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
?>