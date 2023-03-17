<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $user = $_SESSION["Usuario"];
    
    include '../controller/conexion2.php';  
    $conectar = new Conectar();
    $conex = $conectar->conectarDb();
    $consult = "SELECT * FROM usuarios WHERE id_usuario='".$user."'";
    $result = $conex->query($consult);
    
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
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Exito!</strong> Usuario actualizado correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        }
                        ?>
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
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="apellidos" name="apellidos" class="form-control"value="<?php echo $fila['apellido_usuario'] ?>" placeholder="Apellidos Usuario" required>
                                        <label for="apellidos">Apellidos </label>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="documento" name="documento" class="form-control" value="<?php echo $fila['documento'] ?>" placeholder="Documento Identidad" required>
                                        <label for="documento">Documento Identidad</label>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="telefono" name="telefono" class="form-control"value="<?php echo $fila['telefono'] ?>" placeholder="Telefono Usuario" required>
                                        <label for="telefono">Telefono </label>
                                    </div>                                
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="text" id="email" name="email" class="form-control"value="<?php echo $fila['email'] ?>" placeholder="Telefono Usuario" required>
                                        <label for="email">Correo Electronico </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <input type="password" id="password" name="password" class="form-control"  placeholder="Contraseña Usuario" required>
                                        <label for="password">Contraseña</label>
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
    </body>
</html>