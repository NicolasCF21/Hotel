<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $user = $_SESSION["Usuario"];
    
    include '../controller/conexion.php';  
    $conectar = new Conexion();
    $conex = $conectar->conectarDB();
    $consult = "SELECT * FROM usuarios WHERE id_usuario='".$user."'";
    $result = $conex->query($consult);
    
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
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
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
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'correcto'){
                        
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Exito!</strong> Usuario actualizado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }
                        if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Por favor completar el captcha
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                        }
                        ?>


                        <div class="my-3">
                            <h4>Perfil Usuario</h4>
                            <hr>
                        </div> 
                        <form action="update.php" method="POST">
                            <div class="row g-3">
                                <?php while($fila = $result->fetch_assoc()){ ?>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $fila['id_usuario'] ?>">
                                        <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $fila['nombre_usuario'] ?>" placeholder="Nombres Usuario" required>
                                        <label for="nombres">Nombres </label>
                                        <?php
                                            if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'nombre'){
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
                                            }
                                        ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="apellidos" name="apellidos" class="form-control"value="<?php echo $fila['apellido_usuario'] ?>" placeholder="Apellidos Usuario" required>
                                        <label for="apellidos">Apellidos </label>
                                        <?php
                                            if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'apellido'){
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
                                            }
                                        ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="documento" name="documento" class="form-control" value="<?php echo $fila['documento'] ?>" placeholder="Documento Identidad" disabled>
                                        <label for="documento">Documento Identidad</label>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $fila['fecha_nacimiento'] ?>" placeholder="Fecha Nacimiento" disabled>
                                        <label for="fecha">Fecha Nacimineto</label>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="telefono" name="telefono" class="form-control"value="<?php echo $fila['telefono'] ?>" placeholder="Telefono Usuario" required maxlength="10">
                                        <label for="telefono">Telefono </label>
                                        <?php
                                        if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'telefono'){
                                            echo '<div class="toast-container position-static">
                                            <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body text-danger fw-bold">
                                                        ¡Solo se permiten numeros!.
                                                    </div>
                                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        ?>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="email" name="email" class="form-control"value="<?php echo $fila['email'] ?>" placeholder="Telefono Usuario" required>
                                        <label for="email">Correo Electronico </label>
                                        <?php
                                        if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'correo'){
                                            echo '<div class="toast-container position-static">
                                            <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body text-danger fw-bold">
                                                        ¡Por favor ingrese un correo valido!.
                                                    </div>
                                                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        ?>
                                    </div>
                                </div>                            
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <div class="g-recaptcha" data-sitekey="6LfsFFYjAAAAAFwabLWwTZwdK6JoHsAy_k0wZYYh"></div>
                                    </div>                                
                                </div>
                            </div>
                            <?php } ?>                      
                        
                        <div class="container mt-4">
                            <div class="text-center">
                                <input class="btn btn-info" type="submit" name="submit"></input>
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