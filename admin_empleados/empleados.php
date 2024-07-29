<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
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
        <script src="../js/bootstrap.bundlE.min.js"></script>  
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">                      
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
                    <h3>Empleados</h3>
                    <hr>
                    <div class="row mb-2">                        
                        <div class="col-lg-12 col-sm-12 text-end">
                            <a class='btn btn-info btn-sm mt-1' href='http://localhost/hotel/admin_empleados/registrar_empleado.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-plus-circle me-2'></i>Agregar Empleado</a>
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
                        ON  e.id_turno_empleados = t.id_turno_empleados
                        WHERE e.estado='Activo' ORDER BY id_empleado";                        
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border" id="tabla" >
                        <thead>
                            <tr><th>N°</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Correo</th><th>Cargo</th><th>Turno</th><th>Acciones</th></tr>
                        </thead>                        
                        <tbody>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_empleado"]."</td><td>".$fila["nombre_empleado"]."</td><td>".$fila["apellido_empleado"]."</td><td>".$fila["telefono"]."</td><td>".$fila["correo"]."</td><td>".$fila["cargo_empleado"]."</td><td>".$fila["jornada"]."</td>
                                    <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/admin_empleados/actualizar_empleado.php?id=".$fila['id_empleado']."' type='submit' id='btnActualizar' value='".$fila["id_empleado"]."'><i class='bi bi-pencil-square'></i> </a>
                                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_empleado"]."'><i class='bi bi-person-x'></i>  </button></td>                                    
                                  </tr>";
                                }
                            }
                        ?>
                        </tbody>                                            
                    </table>                    
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
        <script>
             $(document).ready(function(){
                $('#tabla').DataTable({
                    language:{
                        dom: '<"row"<"col-sm-6"l><"col-sm-6"f><"col-sm-12"t><"col-sm-6"i><"col-sm-6"p>>',
                        url:'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                    }
                });
            })
        </script>
        <script>
             function confirmar(id){
                var mensaje;
                if(confirm("¿Desea inactivar a el empleado?")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Empleado inactivado correctamente");
                };
                xhttp.open("GET","eliminar_empleado.php?id="+id);
                xhttp.send();
                }
            }   

        </script>        
    </body>
</html>