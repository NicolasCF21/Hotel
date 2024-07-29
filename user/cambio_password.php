<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $user = $_SESSION["Usuario"];

    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>    
    </head>
    <body>
        <?php
            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_user.php';
                ?>
                <div class="col-lg-10 col-sm-8 col-md-9 py-3">
                    <div class="container">
                        <?php
                         
                        if(isset($_SESSION["error"])){
                            echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle-fill"></i><strong>Error!</strong> La contraseña no ha sido actualizada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION["error"]);
                        }
                        if(isset($_SESSION["exito"])){
                            echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong>¡Exito!</strong> La contraseña ha sido actualizada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION["exito"]);
                        }
                        if(isset($_SESSION["errorCont"])){
                            echo '<div class="alert alert-warning m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> La contraseña actual es incorrecta.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION["errorCont"]);
                        }
                        ?>
                        <div class="my-3">
                            <h4>Cambio contraseña</h4>
                            <hr>
                        </div> 
                        <form action="validar_pass.php" method="POST">
                            <div class="row g-3">                            
                                <div class="col-lg-12">
                                    <h5>Contraseña Actual</h5>      
                                    <div class="form-floating">                                                                                                                 
                                        <input type="password" id="passworda" name="passworda" class="form-control" placeholder="Conraseña Usuario" required>
                                        <label for="passworda">Ingrese su contraseña </label>                                                                        
                                    </div>      
                                    <hr class="mt-4 mb-1">                           
                                </div>  
                                 
                                <div class="col-lg-12">
                                    <h5>Nueva contraseña</h5>   
                                </div>                     
                                <div class="col-lg-6">                    
                                    <div class="form-floating">                                                                            
                                        <input type="password" id="passwordn" name="passwordn" class="form-control" placeholder="Conraseña Usuario" required>
                                        <label for="passwordn">Ingrese su contraseña nueva </label>                                                                        
                                    </div>                                
                                </div>                         
                                <div class="col-lg-6">
                                    <div class="form-floating">                                                                            
                                        <input type="password" id="passwordc" name="passwordc" class="form-control" placeholder="Conraseña Usuario" required>
                                        <label for="passwordc">Confirme su contraseña </label>                                                                        
                                    </div>                                
                                </div>  
                                <?php
                                    if(isset($_SESSION["errorConf"])){
                                        echo '<div class="toast-container position-static">
                                            <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body text-danger fw-bold">
                                                        ¡Las contraseñas no coinciden!.
                                                    </div>
                                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>';
                                        unset($_SESSION["errorConf"]);
                                    }
                                    ?>                          
                                <div class="container mt-4">
                                    <div class="text-center">
                                        <input class="btn btn-info" type="submit" name="submit"></input>
                                    </div>                            
                                </div>  
                            </div>  
                        </form>
                    </div>
                </div>            
            </div>
        </div>
        <script>
            //Hacer visible el toast de alerta
            var toast = document.querySelector('.toast');
            var bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();
        </script>
    </body>
</html>