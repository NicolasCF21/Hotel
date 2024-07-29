<?php
    session_start();
    require '../controller/conect.php';
    require '../config/funcionesU.php';
    require '../config/seguridad.php';
    $con = new Conexion();
    $conexion = $con->conectarDB();
    $limpieza = new Seguridad();

    $errors = [];

    if(!empty($_POST)){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $telefono=$_POST['telefono'];
        $documento=$_POST['documento'];
        $email=$_POST['email'];
        $fecha=$_POST['fecha'];
        $password=$limpieza->encriptarP($_POST["password"]);
        $password2=$limpieza->encriptarP($_POST["password2"]);
        $fecha_nacimiento = strtotime($fecha);
        $hoy = new DateTime();
        $fecha_nacimiento = new DateTime(date('Y-m-d', $fecha_nacimiento));
        $edad = date_diff($hoy, $fecha_nacimiento)->y;

        if(!mayorEdad($edad)){
            $mensaje="Debe ser mayor de edad para registrarse";
        }else{
            if(esNulo([$nombre, $apellido, $telefono, $documento, $email, $fecha, $password, $password2])){
                $errors[]="Debe llenar todos los campos";
            }
            if(esEmail($email)){
                $errors[]="El correo no es valido";
            } 
            if(campoNombre($nombre)){
                $errors[]="El tipo de dato es incorrecto";
            }  
            if(campoApellido($apellido)){
                $errors[]="El tipo de dato es incorrecto";
            }
            if(campoDocumento($documento)){
                $errors[]="El tipo de dato es incorrecto";
            }
            if(campoTelefono($telefono)){
                $errors[]="El tipo de dato es incorrecto";
            }      
            if (!validarPassword($password, $password2)) {
                $errors[]="Las contraseñas no coinciden";
            }          
            if(emailExiste($email, $conexion)){
                $errors[]="El email $email ya esta registrado";
            }
            if(documentoExiste($documento, $conexion)){
                $errors[]="El documento $documento ya esta registrado";
            }
            if (count($errors) == 0) {
                if (!registrarUsuario([$nombre, $apellido, $email, $telefono, $documento, $fecha, $password], $conexion)){
                    $errors[]= "Error al registrar el usuario";
                }else{
                    $errors[]="Usuario registrado correctamente";
                }
            }
        }
                   
    }
               
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
    <title>Pagina Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <style>
        span{
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class="max-w-screen-lg mx-auto ">
        <?php
        include '../modules/menu.php';
        if(!empty($mensaje)) {
            echo '<div class="alert alert-danger alert-dismissible mt-2 fade show" role="alert">
                <strong>¡Error!</strong> '.$mensaje.' 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        elseif (!empty($errors)) {
            echo '<div class="alert alert-success alert-dismissible mt-2 fade show" role="alert">
                <strong>¡Exito!</strong> '.$errors[0].' 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }else{
            mostrarMensajes($errors);
        }
        ?>
        <div class="container">        
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-12 mt-3">
                    <form action="registro.php" method="POST" id="form">
                        <div class="card py-4 mb-4 border-0 shadow-lg" style="max-height: 750px; max-width: 700px">                            
                            <div class="card-body ">
                                <div class="text-center mb-4">
                                    <img src="../img/Logo1.png" style="max-width:200px">
                                </div>
                                <h1 class="card-title text-center fs-4">Registro Usuarios</h1>
                                <div class="row g-3 mt-2">   
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-floating">                                            
                                            <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre" required>
                                            <label for="nombre">Nombre</label>     
                                            <span id="validaNom" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                                            <label for="apellido">Apellido</label>
                                            <span id="validaAp" class="text-danger"></span>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Numero telefonico" maxlength="10" required>
                                            <label for="telefono">Número Telefonico</label>
                                            <span id="validaTel" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento Identidad" maxlength="10" required>
                                            <label for="documento">Doc. Identidad</label>
                                            <span id="validaDoc" class="text-danger"></span>
                                            <span id="validaDocu" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="input-group">                                        
                                            <span class="input-group-text">@</span>
                                            <div class="form-floating ">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electonico" required>
                                                <label for="email">Correo Electronico</label> 
                                                <span id="validaEmail" class="text-danger"></span>
                                            <span id="validaCorreo" class="text-danger"></span>                                               
                                            </div>                                
                                            
                                        </div>
                                                                                                                        
                                    </div>
                                    <div class="col-lg-6 col-sm-6">                                                                
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha nacimiento" required>
                                            <label for="fecha">Fecha Nacimiento</label> 
                                            <span id="edad" class="text-danger"></span>                                               
                                        </div>                                
                                            
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-floating position-relative">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                            <label for="password">Contraseña</label>
                                            <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-3 bi bi-eye-slash-fill" id="pass1" action="hide"></span>                                      
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-floating position-relative">
                                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmar contraseña" required>
                                            <label for="password2">Confirma contraseña</label>
                                            <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-3 bi bi-eye-slash-fill" id="pass2" action="hide"></span>                                      
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span id="validaPass" class="text-danger"></span>
                                </div>
                                    
                                <div>
                                    <h6 class="card-subtitle my-3">¿Ya tienes cuenta? <a href="http://localhost/hotel/user/login.php" style="text-decoration:none;">Iniciar Sesion</a></h6>
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
    <script src="script.js"></script>
    <script>
            $(document).ready(function(){
                $('#pass2').click(function(){
                    if ($('#password2').attr('type') == 'password') {
                        $('#password2').attr('type', 'text');                        
                        $('#pass2').addClass('bi-eye-fill').removeClass('bi-eye-slash-fill');
                    } else {
                        $('#password2').attr('type', 'password');
                        $('#pass2').addClass('bi-eye-slash-fill').removeClass('bi-eye-fill');
                    }
                });
            });
            $(document).ready(function(){
                $('#pass1').click(function(){
                    if ($('#password').attr('type') == 'password') {
                        $('#password').attr('type', 'text');                        
                        $('#pass1').addClass('bi-eye-fill').removeClass('bi-eye-slash-fill');
                    } else {
                        $('#password').attr('type', 'password');
                        $('#pass1').addClass('bi-eye-slash-fill').removeClass('bi-eye-fill');
                    }
                });
            });
        </script>
    <script>
        var form = document.getElementById("form");        
        form.password2.addEventListener("blur", validarContrasenas);    

        function validarContrasenas(event) {
            var password = form.elements["password"].value;
            var password2 = form.elements["password2"].value;

            if(password !== password2) {        
                var error = document.getElementById("validaPass");
                error.innerHTML = "¡Las contraseñas no coinciden!";
            }else{    
                var error = document.getElementById("validaPass");
                error.innerHTML = "";
            }
        }
    </script>
</body>
</html>