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
        <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">        
    </head>
    <body>
        <?php        
            include '../modules/menu.php';
        ?>
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-10 col-md-9 py-3">
                    <h3 class="text-start">Habitaciones</h3>
                    <hr>
                    <div class="row mb-3">                        
                        <div class="col-lg-12 col-sm-12 text-end">
                            <a class='btn btn-info btn-sm mt-1' href='http://localhost/hotel/adminHabitaciones/registrar.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-plus-circle me-2'></i>Añadir Habitación</a>
                        </div>
                    </div>
                    
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT h.id_habitacion, h.nombre_habitacion, h.descripcion_habitacion, h.cantidad_personas, h.precio_Tb , h.imagen_habitacion, 
                        t.tipo_habitacion, e.estado_habitacion
                        FROM habitacion h JOIN tipo_habitacion t
                        ON h.id_tipo_habitacion = t.id_tipo_habitacion
                        JOIN estado_habitacion e ON h.id_estado = e.id_estado
                        ORDER BY id_habitacion";
                        $resultset = $con->query($sql);

                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-sm border" id="tabla" >
                            <thead>
                                <tr><th>N°</th><th>Nombre</th><th>Tipo</th><th>Descripcion</th><th>Personas</th><th>Estado</th><th>Precio</th><th>Imagen</th><th></th><th></th></tr>
                            </thead>
                            <tbody>
                            <?php
                                if($resultset->num_rows>0){
                                    while($fila = $resultset->fetch_assoc()){
                                        echo "<tr id='tabla' class='articulo'><td>".$fila["id_habitacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["tipo_habitacion"]."</td><td>".$fila["descripcion_habitacion"]."</td><td>".$fila["cantidad_personas"]."</td><td>".$fila["estado_habitacion"]."</td><td>$".$fila["precio_Tb"]."</td><td> <img src='".$fila["imagen_habitacion"]."' class='img-fluid' style='max-width:200px'> </td>
                                        <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/adminHabitaciones/actualizar.php?id=".$fila['id_habitacion']."' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-pencil-square'></i> </a></td>
                                        <td><button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_habitacion"]."'><i class='bi bi-trash-fill'></i>   </button></td></tr>";
                                    }
                                }
                            ?>
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
        <script>
             $(document).ready(function(){
                $('#tabla').DataTable({      
                    "lengthMenu": [[3, 5, 10, 25, 50], [3,5, 10, 25, 50]],              
                    dom: '<"row"<"col-sm-6"l><"col-sm-6"f><"col-sm-12"t><"col-sm-6"i><"col-sm-6"p>>',
                    language:{                    
                        url:'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                    }
                });
            })
        </script>
        <script>
             function confirmar(id){
                var mensaje;
                if(confirm("¿Desea eliminar la habitación?")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Habitación eliminada exitosamente");
                };
                xhttp.open("GET","eliminar_habitacion.php?id="+id);
                xhttp.send();
                }
            }   

        </script>        
    </body>
</html>