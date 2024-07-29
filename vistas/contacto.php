<?php
    USE PHPMailer\PHPMailer\PHPMailer;
    USE PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Pagina Hotel</title>
    <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.min.js"></script>
    <style>
            .hover-in {
                overflow: hidden; /* [1.2] Hide the overflowing of child elements */
            }

                /* [2] Transition property for smooth transformation of images */
            .hover-in img {
                transition: transform .6s ease;
            }

                /* [3] Finally, transforming the image when container gets hovered */
            .hover-in:hover img {
                transform: scale(1.1);
            }
            .mt-n4{
                margin-top: -13.5rem;
            }
    </style>
</head>
<body>
    <?php
        include '../modules/menu.php';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_REQUEST['correo'];
            $nombre = $_REQUEST['nombre'];
            $telefono = $_REQUEST['numero'];                      
            $mensaje = $_REQUEST['mensaje'];
            $mesagge='<!DOCTYPE html>
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
                        text-align: start;
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
                    <div class="">                                
                        <h4><b>De: </b>'.$nombre.'</h4>                    
                        <h4><b>Correo: </b>'.$email.'</h4>                    
                        <h4><b>Telefono: </b>'.$telefono.'</h4>   
                        <h4><b>Mensaje: </b>'.$mensaje.'</h4>            
                    </div>
                </div>
                
            </body>
            </html>';

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
                $mail->addAddress('hresplendor@gmail.com'); 
                
                    
                $mail->isHTML(true);
                $mail->Subject = 'Mensaje formulario contacto';
                $mail->Body    = $mesagge;
                if($mail->send()){
                    $msg = "¡Se ha enviado el mensjae!";
                } 
            } catch (Exception $e) {
                $msg = "¡No sa ha podido enviar el mensaje!";
            }

        }

    ?>
    <div class="container-fluid text-center">
        <div class="hover-in position-relative">
        <img src="../img/contac.jpg" alt="Habitaciones" class="img-fluid w-100">
            <div class="position-absolute p-5 ms-5 mt-n4 bg-white translate-middle-y shadow">
                <h2 class="display-1">Contactanos</h2>
                <h5 class="text-muted my-3">!Dejanos saber tus dudas y conoce </br> nuestra ubicación¡</h5>                
            </div>
        </div>    
    </div>
    <div class="container-fluid my-4">
        <div class="bg-light">
            <div class="row">
                <div class="col-lg-7 col-sm-12 p-5">
                    <div>
                        <h1 class="fw-semibold fs-2">Envíanos un mensaje</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo electronico</label>
                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número telefonico</label>
                                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="mensaje">Mensaje</label>
                                    <textarea class="form-control" placeholder="Mensaje" id="mensaje" name="mensaje" style="height: 100px" required></textarea>                            
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="submit" value="Enviar" class="btn btn-primary">
                            </div>
                            <p class="error"><?php if(!empty($msg)){
                                        echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert">';
                                        echo '<strong>'.$msg.'</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                        echo '</div>';
                                    }
                                ?>
                            </p>
                        </div>
                    </form>                    
                </div>
                <div class="col-lg-5 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15898.387794186989!2d-73.48172231485638!3d5.0064067954999745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4002ac3dcd0023%3A0x9408de06cc563fc6!2sGuateque%2C%20Boyac%C3%A1!5e0!3m2!1ses!2sco!4v1681487830699!5m2!1ses!2sco" width="100%" height="510" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>                
    </div>
    <hr class="mx-3">
    <div class="container my-4">
        <div class="">
            <div class="row gy-3">
                <div class="col-lg-4">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center">
                            <img src="../img/location.png" class="img-fluid w-25 my-3" alt="">
                            <div class="d-grid gap-3 d-sm-block">
                                <button class="btn btn-sm btn-light"><i class="bi bi-geo-alt-fill me-2"></i>Guateque - Boyaca</button>                                
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center">
                            <img src="../img/telephone.png" class="img-fluid w-25 my-3" alt="">
                            <div class="d-grid gap-3 d-sm-block">
                                <button class="btn btn-sm btn-primary"><i class="bi bi-phone me-2"></i>+57 3143256917</button>
                                <button class="btn btn-sm btn-light"><i class="bi bi-telephone me-2"></i>+(222)4567 586</button>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center">
                            <img src="../img/mail.png" class="img-fluid w-25 my-3" alt="">
                            <div class="d-grid gap-3 d-sm-block">
                                <button class="btn btn-sm btn-light"><i class="bi bi-envelope-fill me-2"></i>hresplendor@gmail.com</button>                                
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include '../modules/footer.php';
    ?>
    
</body>
</html>