<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
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
        <script src="../js/jquery-3.6.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php

            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                <?php
                    if(isset($_SESSION["Registrado"])){
                        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El tipo de habitación fue registrado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Registrado"]);
                    }
                    if(isset($_SESSION["Error"])){
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El tipo de habitación no ha sido registrado
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Error"]);
                    }
                    
                ?>  
                    <div class="alert" role="alert" style="display:none;"></div>               
                    <h3 class="text-center">Registro Tipo Habitaciones</h3>
                    <hr>
                    <form action="../config/registrarTipoh.php" method="POST" id="formulario">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="tipo" name="tipo" class="form-control" placeholder="Tipo Habitacion" required>
                                    <label for="tipo">Tipo Habitacion:</label>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="text-center my-3">
                            <button class="btn btn-info" type="submit">Registar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            //Hacer visible el toast de alerta
            var toast = document.querySelector('.toast');
            var bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();
        </script>
        <script>
            $(document).ready(function() {
                $('#formulario').submit(function(event) {
                    event.preventDefault();

                    // Obtener el nombre del producto
                    var tipo = $('#tipo').val();

                    // Enviar la solicitud AJAX
                    $.ajax({
                    url: 'verificar_tipo.php',
                    data: {
                        tipo: tipo
                    },
                    type: 'GET',
                    success: function(respuesta) {
                        if (respuesta === 'registrado') {
                        // El producto ya está registrado, mostrar una alerta con el mensaje correspondiente
                        $('.alert').removeClass('alert-success').addClass('alert-warning m-0 alert-dismissible fade show').html('<i class="bi bi-question-diamond-fill"></i> El tipo de habitación ya se encuentra registrado.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                        } else {
                        // El producto no está registrado, enviar el formulario
                        $('#formulario').unbind('submit').submit();
                        }
                        // Mostrar el alert
                        $('.alert').fadeIn();
                    },
                    error: function() {
                        // Hubo un error en la solicitud AJAX, mostrar un mensaje de error
                        alert('Hubo un error al verificar el producto.');
                    }
                    });
                });
            });
        </script>    
    </body>
    
</html>