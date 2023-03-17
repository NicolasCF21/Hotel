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
        
        include '../modules/menu.php'
    ?>
        <div class="max-w-screen-lg mx-auto">
            <div class="container">            
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <form action="../controller/login_admin.php" method="POST">
                            <div class="card p-4" style="height: 500px; width: 550px">
                                <div class="card-body ">
                                    <div class="text-center mb-4">
                                        <img src="../img/Logo1.png" style="max-width:200px">
                                    </div>
                                    <h3 class="card-title text-center">Inicio de sesión Admin</h3>
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
                                    <div class="form-floating mb-3 mt-4">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electonico" required>
                                            <div class="valid-feedback">El correo electronico es adecuado</div>
                                            <label for="email">Dirección de correo electronico</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                        <label for="password">Contraseña</label>

                                    </div>
                                    <div class="checkbox mt-2">
                                        <label for="">
                                            <input type="checkbox">Recordar inicio de sesión
                                        </label>
                                    </div>
                                    <div class="text-center mt-4 d-grid">
                                        <button class="btn btn-primary rounded-pill" type="submit">Ingresar</button>
                                        
                                    </div>  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>     
        </div>
    </body>
</html>