<?php
    session_start();
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
        <script src="../js/jquery-3.6.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <style>
            span{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
    <?php
        
        include '../modules/menu.php'
    ?>
        <div class="max-w-screen-lg mx-auto">
            <div class="container h-100 d-flex px-0  px-sm-4 my-3">            
                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-lg-12">
                        <div class="shadow-lg rounded-3 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1 bg-light bg-opacity-75">
                                    <div class="p-3 p-lg-5">
                                        <img src="../img/Analysis.svg" alt="imagen" class="img-fluid" style="width:500px;">                                        
                                    </div>
                                    <div class="vr opacity-4 d-none d-block"></div>
                                </div>
                                <div class="col-lg-6 order-1">
                                    <div class="p-4 p-sm-5">
                                        <a href="http://localhost/hotel/index.php">
                                            <img src="../img/Logo1.png" alt="Logo" class="mb-4" style="max-width:180px">
                                        </a>
                                        <h1 class="mb-2 h3 fw-bold">Iniciar Sesión</h1>
                                        <p class="mb-0">Bienvenido de nuevo Admin</p>
                                        <form action="../controller/login_admin.php" method="POST">
                                            <div class="mb-3">                                                                                                                                                    
                                                <div class="mb-3 mt-4">
                                                    <label for="email">Dirección de correo electronico</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electonico" required>                                                        
                                                    <div class="valid-feedback">El correo electronico es adecuado</div>                                                            
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label for="password">Contraseña</label>
                                                    <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Contraseña" required>                                                        
                                                    <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-3 mt-3 bi bi-eye-slash-fill" id="pass" action="hide"></span>
                                                </div>                      
                                                <div>
                                                <?php
                                                    if(isset ($_SESSION["Error"])){
                                                        echo '<div class="alert alert-danger alert-dismissible fade show m-0" role="alert"><i class="bi bi-exclamation-circle-fill me-2"></i>';
                                                        echo '<strong>'.$_SESSION["Error"].'</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                                        echo '</div>';
                                                        session_unset();
                                                        session_destroy();
                                                    }
                                                ?>
                                                </div>              
                                                <div class="text-center mt-4 d-grid">
                                                    <button class="btn btn-primary rounded-pill" type="submit">Ingresar</button>                                                        
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
        <script>
            $(document).ready(function(){
                $('#pass').click(function(){
                    if ($('#password').attr('type') == 'password') {
                        $('#password').attr('type', 'text');                        
                        $('#pass').addClass('bi-eye-fill').removeClass('bi-eye-slash-fill');
                    } else {
                        $('#password').attr('type', 'password');
                        $('#pass').addClass('bi-eye-slash-fill').removeClass('bi-eye-fill');
                    }
                });
            });
        </script>
    </body>
</html>