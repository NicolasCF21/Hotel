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
            
            #pass{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
    <?php
        include '../modules/menu.php';       
    ?>    
        <section class="vh-xxl-100">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'true') {        
                echo '<div class="alert alert-warning alert-dismissible fade show m-0" role="alert"><i class="bi bi-exclamation-diamond-fill me-2"></i>';
                echo 'Su cuenta ha sido eliminada exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';                
            }
             if(isset ($_SESSION["errorCon"])){
                echo '<div class="alert alert-danger alert-dismissible fade show m-0" role="alert"><i class="bi bi-exclamation-circle-fill me-2"></i>';
                echo '<strong>Errror '.$_SESSION["errorCon"].'</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
                unset($_SESSION['errorCon']);
                
            }
            ?>
            <div class="container h-100 d-flex px-0 px-sm-4 my-3">
                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-12">
                        <div class="shadow-lg rounded-3 overflow-hidden">                            
                            <div class="row g-0">                                
                                <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1 bg-light bg-opacity-75">
                                    <div class="p-3 p-lg-5">
                                        <img src="../img/Authentication.svg" alt="imagen login" style="max-width:400px">                                        
                                    </div>
                                    <div class="vr opacity-1 d-none d-block"></div>
                                </div>
                                
                                <div class="col-lg-6 order-1 ">
                                    <div class="p-4 p-sm-5">
                                        <a href="http://localhost/hotel/index.php">
                                            <img src="../img/Logo1.png" alt="Logo" class="mb-4" style="max-width:180px">
                                        </a>
                                        
                                        <h1 class="mb-2 h3 fw-bold">Bienvenido de nuevo</h1>
                                        <p class="mb-0">¿Eres un nuevo usuario? <a href="http://localhost/hotel/user/registro.php" style="text-decoration:none;">Crea una cuenta</a></p>
                                        <form action="../controller/login_user.php" method="POST" class="mt-4 text-stat">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Ingrese su correo electronico</label>
                                                <input type="email" name="email" id="email" class="form-control">
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <label for="password" class="form-label">Ingrese su contraseña</label>
                                                <input type="password" id="password" name="password" class="form-control">
                                                <span class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3 me-2 bi bi-eye-slash-fill" id="pass" action="hide"></span>
                                            </div>                                            
                                            <div>
                                            <?php
                                                if(isset ($_SESSION["Error"])){
                                                    echo '<div class="alert alert-danger alert-dismissible fade show m-0" role="alert"><i class="bi bi-exclamation-circle-fill me-2"></i>';
                                                    echo '<strong>'.$_SESSION["Error"].'</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                                    echo '</div>';
                                                    unset($_SESSION['Error']);
                                                    
                                                }
                                            ?>
                                            </div>                                            
                                            <div class="mb-3 d-sm-flex justify-content-end">
                                                <a href="http://localhost/hotel/user/olvido.php" style="text-decoration:none;">¿Olvidaste tu contraseña?</a>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary w-100 mb-0 rounded-pill">Ingresar</button>
                                            </div>
                                        </form>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </section>        
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