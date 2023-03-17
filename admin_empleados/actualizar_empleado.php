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
    $sql = "SELECT * FROM EMPLEADO WHERE id_empleado=$id";

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
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Correcto!</strong> Los datos se actualizaron correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Los datos no se lograron actualizar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                    <h3 class="text-center">Actualización de Empleado</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);                        
                        while($fila = $resulset->fetch_assoc()){; 
                        ?>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id_empleado" id="id_empleado" value="'<?php echo $fila['id_empleado']; ?>'">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Empleado" value="<?php echo $fila['nombre_empleado']; ?>  "required>
                                    <label for="nombre">Nombre Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido Empleado" value="<?php echo $fila['apellido_empleado']; ?>  "required>
                                    <label for="apellido">Apellido Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Empleado" value="<?php echo $fila['correo']; ?>  "required>
                                    <label for="correo">Correo electronico Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="documento" name="documento" class="form-control" placeholder="Correo Empleado" value="<?php echo $fila['documento']; ?>  "maxlength="10" required>
                                    <label for="documento">Documento Identidad Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Correo Empleado" value="<?php echo $fila['telefono']; ?>  "maxlength="10" required>
                                    <label for="telefono">Telefono Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="cargo" name="cargo" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el cargo--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_cargo_empleado, cargo_empleado FROM  CARGO_EMPLEADO";
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
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="Sueldo Empleados" value="<?php echo $fila['sueldo'] ;?>" required>
                                    <label for="sueldo">Sueldo Empleados:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="turno" name="turno" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el turno--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_turno_empleados, jornada FROM  TURNOS_EMPLEADOS";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                                if($datos["id_turno_empleados"] == $fila["id_turno_empleados"])
                                                    echo "<option value='".$datos["id_turno_empleados"] ."' selected='selected'>" . $datos["jornada"]. "</option>";
                                                else
                                                    echo "<option value='".$datos["id_turno_empleados"] ."'>" . $datos["jornada"]. "</option>";
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
    </body>
</html>