<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pagina Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body>
    <?php
        if(isset($_SESSION["ErrorDB"])){
            echo '<div class="alert alert-danger m-0">
            <i class="bi bi-circle-fill"></i><strong>ERROR</strong>';
            echo $_SESSION ["ErrorDB"];
            echo '</div>';
            session_unset();
            session_destroy();
        }
        if(isset($_SESSION["Status"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i><strong>¡Exito!</strong> El usuario ha sido registrado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            session_unset();
            session_destroy();
        }
        if(isset($_SESSION["Resgistrado"])){
            echo '<div class="alert alert-warning m-0 alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> Se encuentra un usuario registrado con el mismo correo o docuemnto de identificación
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            session_unset();
            session_destroy();
        }
        
        include '../modules/menu.php';
    ?>
    <div class="max-w-screen-lg mx-auto ">
    <?php
        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Por favor completar el captcha
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
        ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-sm-12 mt-3">
                        <form action="registrar_usuario.php" method="POST" id="form">
                            <div class="card py-4 mb-4" style="max-height: 750px; max-width: 700px">                            
                                <div class="card-body ">
                                    <div class="text-center mb-4">
                                        <img src="../img/Logo1.png" style="max-width:200px">
                                    </div>
                                    <h3 class="card-title text-center">Crear Cuenta</h3>
                                    <div class="row">   
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3 mt-4">
                                                <input type="text" class="form-control" id="nombre" name="nombre" id placeholder="Nombre" required>
                                                <label for="nombre">Nombre</label>
                                                <!--<p id="verificarN"></p>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3 mt-4">
                                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                                                <label for="apellido">Apellido</label>
                                            </div>
                                        </div>                                    
                                        <div class="col-lg-6">
                                            <div class="form-floating  mb-3 mt-4">
                                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Numero telefonico" maxlength="10" required>
                                                <label for="telefono">Número Telefonico</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3 mt-4">
                                                <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento Identidad" maxlength="10" required>
                                                <label for="documento">Doc. Identidad</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-group mb-3 mt-4">
                                                <span class="input-group-text">@</span>
                                                <div class="form-floating ">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electonico" required>
                                                    <label for="email">Correo Electronico</label>
                                                </div>                                
                                            </div>                                            
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3 mt-4">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                                <label for="password">Contraseña</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3 mt-4">
                                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmar contraseña" required>
                                                <label for="password2">Confirma contraseña</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="card-subtitle my-3">¿Ya tienes cuenta? <a href="http://localhost/hotel/user/login.php" style="text-decoration:none;">Iniciar Sesion</a></h6>
                                    </div>
                                    <div class="checkbox mt-2">
                                        <label for="">
                                            <input type="checkbox">Recordar inicio de sesión
                                        </label>
                                    </div>
                                    <div class="text-center mt-4 d-grid">
                                        <button class="btn btn-primary rounded-pill" type="submit">Continuar</button>
                                    </div>  
                                </div>                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="validar.js"></script>
</body>