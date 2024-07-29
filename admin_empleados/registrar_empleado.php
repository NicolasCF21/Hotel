<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
    require '../controller/conect.php';
    require '../config/funcionesE.php';    
    $con = new Conexion();
    $conexion = $con->conectarDB();

    $errors = [];

    if(!empty($_POST)){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $telefono=$_POST['telefono'];
        $documento=$_POST['documento'];
        $email=$_POST['email'];    
        $sueldo=$_POST['sueldo'];
        $cargo=$_POST['cargo'];
        $contrato=$_POST['contrato'];
        $horario=$_POST['horario'];
        $estado='activo';

        if(esNulo([$nombre, $apellido, $telefono, $documento, $email])){
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
        if(campoSueldo($sueldo)){
            $errors[]="El tipo de dato es incorrecto";
        }
        if(emailExiste($email, $conexion)){
            $errors[]="El email $email ya esta registrado";
        }
        if(documentoExiste($documento, $conexion)){
            $errors[]="El documento $documento ya esta registrado";
        }
        if (count($errors) == 0) {
            if (!registrarEmpleado([$cargo, $contrato ,$horario ,$nombre, $apellido, $documento, $telefono, $email, $sueldo, $estado], $conexion)){
                $errors[]= "Error al registrar el usuario";
            }else{
                $errors[]="Usuario registrado correctamente";
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
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3"> 
                <?php                    
                    if (!empty($errors)) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> Empleado registrado correctamente. 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }else{
                        mostrarMensajes($errors);
                    }
                ?>           
                    <h3 class="text-center">Registro de Empleados</h3>
                    <hr>
                    <form action="registrar_empleado.php" method="POST">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Habitacion" required>
                                    <label for="nombre">Nombre Empleado:</label>
                                    <span id="validaNom" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido Empleado" required>
                                    <label for="apellido">Apellido Empleado:</label>
                                    <span id="validaAp" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="documento" name="documento" class="form-control" maxlength="10" placeholder="Documento Identificacion" required>
                                    <label for="documento">Documento Identificacion:</label>
                                    <span id="validaDoc" class="text-danger"></span>
                                    <span id="validaDocu" class="text-danger"></span>
                                    
                                </div>  
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="telefono" name="telefono" class="form-control" maxlength="10" placeholder="Telefono Empleado:" required>
                                    <label for="telefono">Telefono Empleado:</label>
                                    <span id="validaTel" class="text-danger"></span>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electronico" required>
                                    <label for="email">Correo Electronico </label>
                                    <span id="validaEmail" class="text-danger"></span>
                                    <span id="validaCorreo" class="text-danger"></span>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="cargo" name="cargo" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el cargo de empleado--</option>
                                        <?php                                        
                                            $sql = "SELECT id_cargo_empleado, cargo_empleado FROM  cargo_empleado";
                                            $resulset = $conexion->prepare($sql);
                                            $resulset->execute();
                                            foreach($resulset as $datos){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_cargo_empleado"]?>"><?php echo $datos["cargo_empleado"]?></option>
                                        <?php
                                            }                                        
                                        ?>
                                    </select>
                                    <label for="cargo">Cargo empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="contrato" name="contrato" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el tipo de contrato--</option>
                                        <?php                                                                                        
                                            $sql = "SELECT * FROM tipo_contrato";
                                            $resulset = $conexion->prepare($sql);
                                            $resulset->execute();
                                            foreach($resulset as $datos){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_tipo_contrato"]?>"><?php echo $datos["contrato"]?></option>
                                        <?php
                                            }                                        
                                        ?>
                                    </select>
                                    <label for="contrato">Contrato empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="Sueldo Empleado" required>
                                    <label for="sueldo">Sueldo Empleado:</label>
                                    <span id="validaSuel" class="text-danger"></span>
                                </div>
                            </div>                        
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="horario" name="horario" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el horario de trabajo--</option>
                                        <?php                                                                                        
                                            $sql = "SELECT * FROM  turnos_empleados";
                                            $resulset = $conexion->prepare($sql);
                                            $resulset->execute();
                                            foreach($resulset as $datos){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_turno_empleados"]?>"><?php echo $datos["jornada"].": ".$datos["entrada"]."-".$datos["salida"]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <label for="horario">Jornada de trabajo:</label>
                                </div>
                            
                        </div>
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Registrar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="validar.js"></script>
    </body>
</html>