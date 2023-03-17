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
        <script src="../js/bootstrap.bundlE.min.js"></script>
        <style>
            .filtro{
                display:none;
            }
        </style>
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
                    <h3 class="text-center">Empleados</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <form>
                                <input class="form-control" id="buscador" name="buscador" type="text" placeholder="Buscar...">
                            </form>
                        </div>
                        <div class="col-lg-2 ">
                            <a class='btn btn-info btn-sm mt-1' href='http://localhost/hotel/admin_empleados/registrar_empleado.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-plus-fill me-2'></i>Añadir Empleado</a>
                        </div>
                    </div>
                    
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT e.id_empleado, e.nombre_empleado, e.apellido_empleado, e.telefono, e.correo, c.id_cargo_empleado, c.cargo_empleado, t.jornada
                        FROM empleado e JOIN cargo_empleado c
                        ON e.id_cargo_empleado = c.id_cargo_empleado
                        JOIN turnos_empleados t
                        ON  e.id_turno_empleados = t.id_turno_empleados";                        
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border" id="tabla" >
                        <tr><th>N°</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Correo</th><th>Cargo</th><th>Turno</th><th>Acciones</th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_empleado"]."</td><td>".$fila["nombre_empleado"]."</td><td>".$fila["apellido_empleado"]."</td><td>".$fila["telefono"]."</td><td>".$fila["correo"]."</td><td>".$fila["cargo_empleado"]."</td><td>".$fila["jornada"]."</td>
                                    <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/admin_empleados/actualizar_empleado.php?id=".$fila['id_empleado']."' type='submit' id='btnActualizar' value='".$fila["id_empleado"]."'><i class='bi bi-pencil-square'></i> </a>
                                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_empleado"]."'><i class='bi bi-trash-fill'></i>  </button></td>                                    
                                  </tr>";
                                }
                            }
                            ?>
                    </table>                    
                </div>
            </div>
        </div>
        <script>
             function confirmar(id){
                var mensaje;
                if(confirm("¿Desea eliminar a el empleado")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Empleado eliminado correctamente");
                };
                xhttp.open("GET","eliminar_empleado.php?id="+id);
                xhttp.send();
                }
            }   

        </script>
        <script src="script.js"></script>
    </body>
</html>