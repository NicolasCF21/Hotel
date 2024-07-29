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
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> La habitación fue registrado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Registrado"]);
                    }
                    if(isset($_SESSION["Error"])){
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> La habitación no ha sido registrada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION["Error"]);
                    }                                                    
                ?>  
                    <div class="alert" role="alert" style="display:none;"></div>   
                    <h3 class="text-center">Registro de Habitaciones</h3>
                    <hr>
                    <form action="../config/registrarHabitacion.php" method="POST" enctype="multipart/form-data" id="formulario">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Habitacion" required >
                                    <label for="nombre">Nombre Habitacion:</label>                                
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                                        <option option selected hidden>--Elija el tipo de habitación--</option>
                                        <?php
                                            include '../controller/conexion.php';
                                            $conexion = new Conexion();
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_tipo_habitacion, tipo_habitacion FROM  tipo_habitacion";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_tipo_habitacion"]?>"><?php echo $datos["tipo_habitacion"]?></option>
                                        <?php
                                            }
                                            $con->close();
                                        ?>
                                    </select>
                                    <label for="categoria">Tipo de Habitación:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad Personas" required min="1" max="10">
                                    <label for="cantidad">Cantidad Personas:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="estado" name="estado" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el estado de la habitación--</option>
                                        <?php                                            
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_estado, estado_habitacion FROM  ESTADO_HABITACION";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_estado"]?>"><?php echo $datos["estado_habitacion"]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="estado">Estado Habitación:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="preciob" name="preciob" class="form-control" placeholder="Precio Temporada Baja" required min="1" max="100000">
                                    <label for="preciob">Precio:</label>
                                </div>
                            </div>                            
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                                                          
                                    <input class="form-control" name="imagen" type="file" id="imagen" required>                                    
                                    <label for="imagen" class="form-label ">Imagen Habitacion:</label>
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
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating my-3">
                                    <textarea type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" required></textarea>
                                    <label for="descripcion">Descripción:</label>
                                </div>
                            </div>
                              
                        </div>
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Registrar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>        
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
                        $('.alert').removeClass('alert-success').addClass('alert-warning m-0 alert-dismissible fade show').html('<i class="bi bi-question-diamond-fill"></i> La habitación ya se encuentra registrada.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
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