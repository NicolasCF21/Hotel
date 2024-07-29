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
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El servicio fue registrado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Registrado"]);
                    }
                    if(isset($_SESSION["Error"])){
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El servicio no ha sido registrado.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Error"]);
                    }                    
                ?>
                    <div class="alert" role="alert" style="display:none;"></div> 
                    <h3 class="text-center">Registro de Servicios</h3>
                    <hr>
                    <form action="../config/registrarServicio.php" method="POST" enctype="multipart/form-data" id="formulario">
                        <div class="form-floating">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="nombre" required>
                            <label for="nombre">Nombre Servicio</label>
                        </div>
                        <div class="form-floating my-3">
                        <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                            <option option selected hidden>--Elija el tipo de servicio--</option>
                        <?php
                            include '../controller/conexion.php';
                            $conexion = new Conexion();
                            $con = $conexion->conectarDB();
                            $sql = "SELECT id_categoria_servicio, categoria_servicio FROM  CATEGORIA_SERVICIO WHERE categoria_servicio!='Sin servicio'";
                            $resulset = $con->query($sql);
                            while($datos = mysqli_fetch_array($resulset)){
                                ?>                                                    
                            <option value="<?php echo $datos["id_categoria_servicio"]?>"><?php echo $datos["categoria_servicio"]?></option>
                                <?php
                                    }
                                    ?>
                        </select>
                        <label for="categoria">Categoria Servicio:</label>
                        </div>
                        <div class="form-floating my-3">
                            <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" required></textarea>
                            <label for="descripcion">Descripción:</label>
                        </div>  
                        <div class="form-floating my-3">
                            <input type="number" id="tarifa" name="tarifa" class="form-control" placeholder="Tarifa" required min="0" max="50000">
                            <label for="tarifa">Tarifa Servicio:</label>
                        </div>                
                        <div class="my-3">
                            <label for="imagen" class="form-label">Imagen Servicio:</label>
                            <input class="form-control" name="imagen" type="file" id="imagen" required>
                            <?php
                                if(isset($_SESSION["Errori"])){
                                echo '<div class="toast-container position-static">
                                        <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body text-danger fw-bold">
                                                    ¡Por favor ingrese un formato de imagen valido!.
                                                </div>
                                                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>';
                                unset($_SESSION["Errori"]);
                                }
                            ?>
                        </div>
                        <div class="text-center">
                            <input class="btn btn-info" type="submit" value="Registrar" name="submit">
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
                    var nombre = $('#nombre').val();

                    // Enviar la solicitud AJAX
                    $.ajax({
                    url: 'verificar.php',
                    data: {
                        nombre: nombre
                    },
                    type: 'GET',
                    success: function(respuesta) {
                        if (respuesta === 'registrado') {
                        // El producto ya está registrado, mostrar una alerta con el mensaje correspondiente
                        $('.alert').removeClass('alert-success').addClass('alert-warning m-0 alert-dismissible fade show').html('<i class="bi bi-question-diamond-fill"></i> El servicio ya se encuentra registrado.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
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