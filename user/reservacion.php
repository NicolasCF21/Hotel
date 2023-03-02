<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $usuario = $_SESSION["Usuario"];
    
    include '../controller/conexion2.php';  
    $conectar = new Conectar();
    $conex = $conectar->conectarDb();
    $consult = "SELECT * FROM usuarios WHERE id_usuario='".$usuario."'";
    $result = $conex->query($consult);
    
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
        <script src="../js/jquery-3.6.1.min.js"></script>
    </head>
    <body>
        <?php
            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_user.php';
                ?>
                <div class="col-lg-10 col-sm-8 col-md-9 py-3">
                    <div class="container">
                        <div class="my-3    ">
                            <h4>Mis Reservaciones</h4>
                            <hr>
                        </div> 
                        <?php                            
                            $con = $conectar->conectarDb();
                            $sql = "SELECT r.id_reservacion, r.fecha_ingreso, r.fecha_salida, r.estado_reservacion, r.cantidad_personas, r.total_pago, r.forma_pago, h.nombre_habitacion, s.nombre_servicio FROM reservacion r
                            JOIN habitacion h ON r.id_habitacion = h.id_habitacion
                            JOIN servicio s ON r.id_servicio = s.id_servicio
                            WHERE id_usuario='".$usuario."'";
                            $resultset = $con->query($sql);

                        ?>                        
                        <table class="table table-hover table-striped text-center border" id="tabla" >
                            <tr><th>N°</th><th>Habitacion</th><th>Servicio</th><th>Fecha ingreso</th><th>fecha salida</th><th>Estado</th><th>Personas</th><th>Forma Pago</th><th>Pago Total</th><th></th><th></th></tr>
                            <?php
                                if($resultset->num_rows>0){
                                    while($fila = $resultset->fetch_assoc()){
                                        echo "<tr id='tabla'><td>".$fila["id_reservacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["nombre_servicio"]."</td><td>".$fila["fecha_ingreso"]."</td><td>".$fila["fecha_salida"]."</td><td>".$fila["estado_reservacion"]."</td><td>".$fila['cantidad_personas']."</td><td>".$fila['forma_pago']."</td><td>$".$fila['total_pago']."</td>
                                        <td><button type='submit' onclick='confirmar(this.value)' class='btn btn-success' id='btnCancelar' value='".$fila['id_reservacion']."' ><i class='bi bi-x-circle' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='Tooltip on top'></i></button></td>
                                        <td><a href='http://localhost/hotel/factura/factura_user.php?id=".$fila['id_reservacion']."' value='".$fila['id_reservacion']."' type='submit' class='btn btn-secondary' target='_blank'><i class='bi bi-download'></i></a></td>
                                        </tr>";
                                    }
                                }
                            ?>
                        </table>                                                                                                                                    
                    </div>
                </div>            
            </div>
        </div>
    </body>
    <script>
         function confirmar(id){
                var mensaje;
                if(confirm("¿Esta seguro de cancelar la reservación?")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Reservación cancelada exitosamente");
                };
                xhttp.open("GET","cancelar_reserva.php?id="+id);
                xhttp.send();
                }
            } 
    </script>
</html>