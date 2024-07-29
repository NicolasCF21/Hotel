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
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                    <h3>Reservaciones</h3>
                    <hr>
            
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT r.id_reservacion, r.fecha_ingreso, r.fecha_salida, r.cantidad_personas, r.estado_reservacion, 
                        r.total_pago, r.forma_pago, u.nombre_usuario, h.nombre_habitacion, s.nombre_servicio 
                        FROM reservacion r JOIN usuarios u ON r.id_usuario = u.id_usuario
                        JOIN habitacion h ON r.id_habitacion= h.id_habitacion
                        JOIN servicio s ON r.id_servicio = s.id_servicio
                        WHERE fecha_salida >= CURDATE();";
                        $resultset = $con->query($sql);

                    ?>
                    
                    <table class="table table-hover table-striped text-center border" id="tabla" >
                    <form action='update.php' method='POST'> 
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Huesped</th>
                            <th>Habitación</th> 
                            <th>Servicio</th>
                            <th>Fecha ingreso</th>
                            <th>Fecha salida</th>
                            <th>Estado</th> 
                            <th>Forma Pago</th>                            
                            <th>Pago Total</th>
                            <th>Factura</th>
                            <!--<th><td><button class='btn btn-success' type='submit' id='id' name='id' value='".$fila['id_reservacion']."'><i class='bi bi-plus-circle'></i> Editar</button></th>-->
                        </tr>
                        </thead>                                                      
                        <tbody>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla'>
                                    <td>".$fila["id_reservacion"]."</td>
                                    <td>".$fila["nombre_usuario"]."</td>
                                    <td>".$fila["nombre_habitacion"]."</td>
                                    <td>".$fila["nombre_servicio"]."</td>
                                    <td>".$fila["fecha_ingreso"]."</td>
                                    <td>".$fila["fecha_salida"]."</td>
                                    <td><div class='badge text-bg-primary py-2'>".$fila["estado_reservacion"]."</div></td> 
                                    <td>".$fila["forma_pago"]."</td> 
                                    <td>$".$fila['total_pago']."</td>   
                                    <td><a href='http://localhost/hotel/factura/factura_user.php?id=".$fila['id_reservacion']."' value='".$fila['id_reservacion']."' type='submit' class='btn btn-sm btn-secondary' target='_blank'><i class='bi bi-file-text'></i></a></td>
                                    </tr>";
                                }
                            }
                            ?>
                        </tbody>                        
                            </form>

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
        
    </body>
</html>