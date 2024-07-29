<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    if(!isset($_SESSION["Admin"])){ 
        header('Location: ../admin/login.php');
    }

    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET['id'];
    $sql = "SELECT * FROM habitacion WHERE id_habitacion=$id";

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
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'correcto') {
                        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> El producto fue registrado correctamente en la habitación.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {                
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> El producto no ha sido registrada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                ?> 
                    <div class="alert" role="alert" style="display:none;"></div>
                    <h3>Registro Productos de Habitaciones</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);                        
                        while($fila = $resulset->fetch_assoc()){; 
                        ?>
                    <form action="../config/registrar.php" method="POST" enctype="multipart/form-data" id="formulario">
                        <div class="row">                        
                            <div class="col-lg-6 col-sm-6">
                                <input type="hidden" id="id" name="id" value="<?php echo $fila["id_habitacion"]?>">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="producto" name="producto" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el producto--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT * FROM  productos";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_producto"] == $fila["id_producto"])
                                                    echo "<option value='".$datos["id_producto"] ."' selected='selected'>" . $datos["nombre_producto"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_producto"] ."'>" . $datos["nombre_producto"]. "</option>";
                                            }
                                            $con->close();
                                    ?>
                                    </select>
                                    <label for="producto">Producto:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-floating my-3">
                                    <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad"required min="1">
                                    <label for="cantidad">Cantidad:</label>
                                </div>
                            </div>                                
                            <?php }                                                               
                            ?>                                                        
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Añadir"></input>
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
                    var producto = $('#producto').val();
                    var id = $('#id').val();

                    // Enviar la solicitud AJAX
                    $.ajax({
                    url: 'verificar.php',
                    data: {
                        producto: producto,
                        id: id
                    },
                    type: 'GET',
                    success: function(respuesta) {
                        if (respuesta === 'registrado') {
                        // El producto ya está registrado, mostrar una alerta con el mensaje correspondiente
                        $('.alert').removeClass('alert-success').addClass('alert-warning m-0 alert-dismissible fade show').html('<i class="bi bi-question-diamond-fill"></i> El producto ya se encuentra registrado en la habitación.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
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