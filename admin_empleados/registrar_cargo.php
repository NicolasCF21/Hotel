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
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El cargo fue registrado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Registrado"]);
                    }
                    if(isset($_SESSION["Error"])){
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El cargo no ha sido registrado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Error"]);
                    }                    
                ?>
                    <div class="alert" role="alert" style="display:none;"></div>
                    <h3 class="text-center">Registro cargos de empleados</h3>
                    <hr>
                    <form action="../config/registrar_cargo.php" method="POST" id="formulario">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="cargo" name="cargo" class="form-control" placeholder="Cargo empleado" required>
                                    <label for="cargo">Cargo:</label>
                                </div>
                                <?php 
                                        if(isset($_SESSION["ErrorC"])){
                                            echo '<div class="toast-container position-static">
                                            <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body text-danger fw-bold">
                                                        ¡Solo se permiten letras!.
                                                    </div>
                                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>';
                                        unset($_SESSION["ErrorC"]);
                                        }
                                    ?>
                            </div>
                            
                        </div>
                        <div class="text-center my-3">
                            <button class="btn btn-info" type="submit">Registar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="../js/modal.js"></script>
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
                    var cargo = $('#cargo').val();                

                    // Enviar la solicitud AJAX
                    $.ajax({
                    url: 'verificar_cargo.php',
                    data: {
                        cargo: cargo            
                    },
                    type: 'GET',
                    success: function(respuesta) {
                        if (respuesta === 'registrado') {
                        // El producto ya está registrado, mostrar una alerta con el mensaje correspondiente
                        $('.alert').removeClass('alert-success').addClass('alert-warning').html('<b>¡Error!</b> El cargo ya se encuentra registrado.');
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