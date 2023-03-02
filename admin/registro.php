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
</head>
<body>
    <?php
        if(isset($_SESSION["ErrorDB"])){
            echo '<div class="alert alert-danger m-0">
            <strong>ERROR</strong>';
            echo $_SESSION ["ErrorDB"];
            echo '</div>';
            session_unset();
            session_destroy();
        }
        if(isset($_SESSION["Status"])){
            echo '<div class="alert alert-success m-0">
            <strong>Exito</strong> La operación ha sido realizada.
            </div>';
            session_unset();
            session_destroy();
        }
        include '../modules/menu.php';
    ?>
    <div class="max-w-screen-lg mx-auto ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <form action="../config/inicio.php" method="POST" class="was-validated">
                            <div class="card p-4" style="height: 530px; width: 500px">
                                <div class="card-body ">
                                    <div class="text-center mb-4">
                                        <img src="../img/Logo1.png" style="max-width:200px">
                                    </div>
                                    <h3 class="card-title text-center">Crear Cuenta</h3>
                                    <div class="form-floating mb-3 mt-4">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electonico" required>
                                        <div class="invalid-feedback">Por favor llene este campo</div>
                                        <div class="valid-feedback">El correo electronico es adecuado</div>
                                        <label for="email">Correo Electronico</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                        <label for="password">Contraseña</label>
                                        <h6 class="card-subtitle mb-2 mt-2">¿Ya tienes cuenta? <a href="http://localhost/hotel/user/login.php" style="text-decoration:none;">Iniciar Sesion</a></h6>
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
</body>