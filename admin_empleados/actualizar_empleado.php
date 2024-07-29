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
    $sql = "SELECT * FROM empleado WHERE id_empleado=$id";

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
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'actualizado') {
                        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i><strong> ¡Exito!</strong> La información fue actualizada correctamente
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i><strong> ¡Error!</strong> La información no ha sido actualizada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';            
                    }
                ?>
                    <h3 class="">Actualización de Empleado</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);                        
                        while($fila = $resulset->fetch_assoc()){; 
                        ?>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id" id="id" value="'<?php echo $fila['id_empleado']; ?>'">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Empleado" value="<?php echo $fila['nombre_empleado']; ?>" required>
                                    <label for="nombre">Nombre Empleado:</label>
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
                            <div class="col-lg-4">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido Empleado" value="<?php echo $fila['apellido_empleado']; ?>  "required>
                                    <label for="apellido">Apellido Empleado:</label>
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
                            <div class="col-lg-4">
                                <div class="form-floating my-3">                                    
                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Empleado" value="<?php echo $fila['correo']; ?>  "required>
                                    <label for="correo">Correo electronico Empleado:</label>
                                    <?php
                                    if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'email'){
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
                            <div class="col-lg-4">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="documento" name="documento" class="form-control" placeholder="Documento Empleado" value="<?php echo $fila['documento']; ?>  "maxlength="10" disabled>
                                    <label for="documento">Documento Identidad Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Telefono Empleado" value="<?php echo $fila['telefono']; ?>  "maxlength="10" required>
                                    <label for="telefono">Telefono Empleado:</label>
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
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="cargo" name="cargo" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el cargo--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_cargo_empleado, cargo_empleado FROM  cargo_empleado";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_cargo_empleado"] == $fila["id_cargo_empleado"])
                                                    echo "<option value='".$datos["id_cargo_empleado"] ."' selected='selected'>" . $datos["cargo_empleado"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_cargo_empleado"] ."'>" . $datos["cargo_empleado"]. "</option>";
                                            }
                                            $con->close();
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
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT * FROM  tipo_contrato";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_tipo_contrato"] == $fila["id_tipo_contrato"])
                                                    echo "<option value='".$datos["id_tipo_contrato"] ."' selected='selected'>" . $datos["contrato"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_tipo_contrato"] ."'>" . $datos["contrato"]. "</option>";
                                            }
                                            $con->close();
                                    ?>
                                    </select>
                                    <label for="contrato">Contrato empleado:</label>
                                </div>
                            </div>                        
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="Sueldo Empleados" value="<?php echo $fila['sueldo'] ;?>" required>
                                    <label for="sueldo">Sueldo Empleados:</label>
                                    <?php
                                    if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'sueldo   '){
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
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="turno" name="turno" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el turno--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT * FROM  TURNOS_EMPLEADOS";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_turno_empleados"] == $fila["id_turno_empleados"])
                                                    echo "<option value='".$datos["id_turno_empleados"] ."' selected='selected'>".$datos["jornada"].": ".$datos["entrada"]." - ".$datos["salida"]."</option>";
                                                else
                                                    echo "<option value='".$datos["id_turno_empleados"] ."'>".$datos["jornada"].": ".$datos["entrada"]." - ".$datos["salida"]."</option>";
                                            }
                                            $con->close();
                                    ?>
                                    </select>
                                    <label for="turno">Turno de trabajo:</label>
                                </div>
                            </div>
                                                        
                            <?php }?>
                        <div class="text-center my-3">
                            <input class="btn btn-info" type="submit" value="Actualizar"></input>
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
    </body>
</html>