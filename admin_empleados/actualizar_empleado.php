<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    if(!isset($_SESSION["Admin"])){ 
        header('Location: ../admin/login.php');
    }

    if(isset($_GET['error'])){
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
        <strong>ERROR</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo $_GET['error'];
        echo '</div>';
        
    }

    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET['id'];
    $sql = "SELECT e.id_empleado, e.nombre_empleado, e.apellido_empleado, e.telefono, e.documento, e.correo, e.sueldo, c.cargo_empleado, t.jornada, t.entrada, t.salida
    FROM empleado e JOIN cargo_empleado c
    ON e.id_cargo_empleado = c.id_cargo_empleado
    JOIN turnos_empleados t
    ON e.id_turno_empleados = t.id_turno_empleados
    WHERE id_empleado=$id";

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
                    <strong>¡Correcto!</strong> Datos del empleado actualizados correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <?php
                    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'error') {
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>¡Error!</strong> Datos del empleado no se pudieron actualizar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                    <h3 class="text-center">Actualización Datos de Empleados</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);                                
                        while($fila = $resulset->fetch_assoc()){;
                        ?>
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id_empleado" id="id_empleado" value="'<?php echo $fila['id_empleado'];?>'">
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Empleado" value="<?php echo $fila['nombre_empleado']; ?>  "required>
                                    <label for="nombre">Nombre Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido Empleado" value="<?php echo $fila['apellido_empleado'];?>  "required>
                                    <label for="apellido">Apellido Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="documento" name="documento" class="form-control" placeholder="Documento Empleado" value="<?php echo $fila['documento']; ?>  "required>
                                    <label for="documento">Documento Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Telefono Empleado" value="<?php echo $fila['telefono']; ?>  "required>
                                    <label for="telefono">Telefono Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Empleado" value="<?php echo $fila['correo']; ?>  "required>
                                    <label for="correo">Correo Empleado:</label>
                                </div>
                            </div>                  
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="categoria" name="categoria" aria-label="Default select example" required>
                                    <option option selected hidden>--Seleccione el cargo del empleado--</option>
                                    <?php     
                                            $con = $conexion->conectarDB();
                                            $sql = "SELECT id_cargo_empleado, cargo_empleado FROM cargo_empleado";
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
                                    <label for="categoria">Cargo Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="sueldo" name="sueldo" class="form-control" placeholder="Sueldo Empleado" value="<?php echo $fila['sueldo'] ;?>" required>
                                    <label for="sueldo">Sueldo Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="jornada" name="jornada" class="form-control" placeholder="Horario Empleado" value="<?php echo $fila['jornada']; ?>" required>
                                    <label for="jornada">Jornada Empleado:</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="jornada" name="jornada" disabled class="form-control" placeholder="Entrada Empleado" value="<?php echo $fila['entrada']; ?>" required>
                                    <label for="jornada">Entrada Empleado:</label>
                                </div>
                            </div>                          
                            <div class="col-lg-4">
                                <div class="form-floating my-3">
                                    <input type="text" id="salida" name="salida" disabled class="form-control" placeholder="Salida Empleado" value="<?php echo $fila['salida']; ?>" required>
                                    <label for="salida">Salida Empleado:</label>
                                </div>
                            </div>                                 
                            <?php }?>
                            <div class="text-center my-3">
                                <input class="btn btn-success" type="submit" value="Actualizar"></input>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>