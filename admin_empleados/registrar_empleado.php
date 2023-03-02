<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
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
                    <strong>¡Correcto!</strong> Empleado registrado correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Empleado no se pudo registrar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                    <h3 class="text-center">Registro de Empleados</h3>
                    <hr>
                    <form action="../config/registrarEmpleado.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Habitacion" required>
                                    <label for="nombre">Nombre Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido Empleado" required>
                                    <label for="apellido">Apellido Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="documento" name="documento" class="form-control" placeholder="Documento Identificacion" required>
                                    <label for="documento">Documento Identificacion:</label>
                                </div>  
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Telefono Empleado:" required>
                                    <label for="telefono">Telefono Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-floating my-3">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electronico" required>
                                    <label for="email">Correo Electronico </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="cargo" name="cargo" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el cargo de empleado--</option>
                                        <?php
                                            include '../controller/conexion.php';
                                            $conexion = new Conexion();
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_cargo_empleado, cargo_empleado FROM  cargo_empleado";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
                                        ?>                                                    
                                        <option value="<?php echo $datos["id_cargo_empleado"]?>"><?php echo $datos["cargo_empleado"]?></option>
                                        <?php
                                            }
                                            $con->close();
                                        ?>
                                    </select>
                                    <label for="cargo">Cargo empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="Sueldo Empleado" required>
                                    <label for="sueldo">Sueldo Empleado:</label>
                                </div>
                            </div>                        
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="horario" name="horario" aria-label="Default select example" required>
                                        <option option selected hidden>--Seleccione el horario de trabajo--</option>
                                        <?php                                            
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT * FROM  turnos_empleados";
                                            $resulset = $con->query($sql);
                                            while($datos = mysqli_fetch_array($resulset)){
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
                            <input class="btn btn-success" type="submit" value="Registrar" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>