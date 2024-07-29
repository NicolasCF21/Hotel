<?php
    session_start();
    USE PHPMailer\PHPMailer\PHPMailer;
    USE PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
    <?php
        include '../modules/menu.php';
        include '../controller/config.php';
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_REQUEST['email'];        
            $consulta           = ("SELECT * FROM usuarios WHERE email ='".$email."'");
            $queryconsulta      = mysqli_query($con, $consulta);
            $cantidadConsulta   = mysqli_num_rows($queryconsulta);
            $dataConsulta       = mysqli_fetch_array($queryconsulta);
            if($cantidadConsulta ==0){ 
                $msg = "¡No hemos encontrado a un usuario con el correo ingresado!";
            }else{
                
                function generandoTokenClave($length = 20) {
                    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklymopkz', ceil($length/strlen($x)) )),1,$length);
                }
                $miTokenClave     = generandoTokenClave();
                //Agregando Token en la tabla BD
                $updateClave    = ("UPDATE usuarios SET token='$miTokenClave' WHERE email='".$email."' ");
                $queryResult    = mysqli_query($con,$updateClave); 

                $linkRecuperar      = "http://localhost/hotel/user/nuevaClave.php?id=".$dataConsulta['id_usuario']."&tokenUser=".$miTokenClave;
                $message = '<!DOCTYPE html>
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
                        h2{
                            color: #10454F;
                            font-family: "Roboto", sans-serif;    
                        }
                        p{
                            color: #10403B;
                            font-family: "Roboto", sans-serif;
                        }
                        .p1{
                            margin-bottom: 30px;
                        }
                        .p2{
                            margin-top: 30px;
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
                            <h2 class="text-center">¡Estimado '.$dataConsulta["nombre_usuario"].'!</h2>
                            <p class="p1">Hemos recibido una petición de restauración de contraseña por parte de este correo</p>            
                            <a href="'.$linkRecuperar.'" target="_blank" class="btnlink">Restablecer contraseña</a>
                            <p class="p2">Si usted no solicitó una restauración de contraseña, por favor omita el correo.</p>             
                        </div>
                    </div>
                    
                </body>
                </html>';

                require '../PHPMailer/Exception.php';
                require '../PHPMailer/PHPMailer.php';
                require '../PHPMailer/SMTP.php';
                $mail = new PHPMailer(true);
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
                $mail->Subject = 'Hotel Resplendor';
                $mail->Body    = $message;
                if($mail->send()){
                    $msg = "¡Hemos enviado un enlace a tu correo electronico para restaurar tu contraseña!";
                }else{
                    $msg = "¡No hemos encontrado a un usuario con el correo ingresado!";
                }                                                

            }
        }
    ?>
    
        <div class="max-w-screen-lg mx-auto">
            <div class="container h-100 d-flex px-0  px-sm-4 my-3">
                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-lg-12">
                        <div class="shadow-lg rounded-3 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1 bg-light bg-opacity-25">
                                    <div class="p-3 p-lg-5">
                                        <img src="../img/forgot.svg" alt="imagen" class="img-fluid" style="width:500px;">                                        
                                    </div>
                                    <div class="vr opacity-4 d-none d-block"></div>
                                </div>
                                <div class="col-lg-6 order-1">
                                    <div class="p-4 p-sm-5">
                                        <a href="http://localhost/hotel/index.php">
                                            <img src="../img/Logo1.png" alt="Logo" class="mb-4" style="max-width:180px">
                                        </a>
                                        <h1 class="mb-2 h3 fw-bold">Recuperar Contraseña</h1>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                                            <div class="mb-3">                                                                                                                                            
                                                <div class="form-floating mb-3 mt-4">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electonico" required>
                                                    <label for="email">Dirección de correo electronico:</label>
                                                </div>                                                                    
                                                    <div class="text-center mt-4 d-grid">
                                                        <input type="submit" id="login" name="login" value="Enviar" class="btn btn-primary rounded-pill" />
                                                    </div>  
                                                    <p class="error"><?php if(!empty($msg)){
                                                        echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert">';
                                                        echo '<strong>'.$msg.'</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                                        echo '</div>';
                                                    }
                                                        ?>
                                                    </p>
                                                    <div class="text-end">
                                                        <a href="http://localhost/hotel/user/login.php" class="btn btn-light"><i class="bi bi-arrow-left"></i> Volver</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
        
    </body>
</html>