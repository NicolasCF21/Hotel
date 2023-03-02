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
                    <h3 class="text-center">Reservaciones</h3>
                    <hr>
            
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT r.id_reservacion, r.fecha_ingreso, r.fecha_salida, r.cantidad_personas, r.estado_reservacion, r.total_pago, r.forma_pago, u.nombre_usuario, h.nombre_habitacion, s.nombre_servicio FROM reservacion r JOIN usuarios u ON r.id_usuario = u.id_usuario
                        JOIN habitacion h ON r.id_habitacion= h.id_habitacion
                        JOIN servicio s ON r.id_servicio = s.id_servicio;";
                        $resultset = $con->query($sql);

                    ?>
                    
                    <table class="table table-hover table-striped text-center border" id="tabla" >
                    <form action='update.php' method='POST'>                               
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
                            <!--<th><td><button class='btn btn-success' type='submit' id='id' name='id' value='".$fila['id_reservacion']."'><i class='bi bi-plus-circle'></i> Editar</button></th>-->
                        </tr>
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
                                    <td>".$fila["estado_reservacion"]."</td> 
                                    <td>".$fila["forma_pago"]."</td> 
                                    <td>$".$fila['total_pago']."</td>            
                                    </tr>";
                                }
                            }
                            ?>
                            </form>

                    </table>
                    
                </div>
            </div>
        </div>
        
    </body>
</html>