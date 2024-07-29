<?php
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $usuario = $_SESSION["Usuario"];
    
    include '../controller/conexion.php';  
    $conectar = new Conexion();
    $conex = $conectar->conectarDB();
    $consult = "SELECT * FROM usuarios WHERE id_usuario='".$usuario."'";
    $result = $conex->query($consult);
    
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
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery-3.6.1.min.js"></script>
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
                            WHERE id_usuario=$usuario order by id_reservacion;";
                            $resultset = $con->query($sql);

                        ?>                        
                        <table class="table table-hover table-striped text-center border" id="tabla" >
                            <thead>
                                <tr><th>N°</th><th>Habitacion</th><th>Servicio</th><th>Fecha ingreso</th><th>fecha salida</th><th>Estado</th><th>Personas</th><th>Forma Pago</th><th>Pago Total</th><th></th><th></th></tr>
                            </thead>
                            <tbody>
                            <?php
                                if($resultset->num_rows>0){
                                    while($fila = $resultset->fetch_assoc()){
                                        echo "<tr id='tabla'><td>".$fila["id_reservacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["nombre_servicio"]."</td><td>".$fila["fecha_ingreso"]."</td><td>".$fila["fecha_salida"]."</td><td>".$fila["estado_reservacion"]."</td><td>".$fila['cantidad_personas']."</td><td>".$fila['forma_pago']."</td><td>$".$fila['total_pago']."</td>
                                        <td><button type='submit' onclick='confirmar(this.value)' class='btn btn-sm btn-danger' id='btnCancelar' value='".$fila['id_reservacion']."' ><i class='bi bi-x-circle' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='Tooltip on top'></i></button></td>
                                        <td><a href='http://localhost/hotel/factura/factura_user.php?id=".$fila['id_reservacion']."' value='".$fila['id_reservacion']."' type='submit' class='btn btn-sm btn-secondary' target='_blank'><i class='bi bi-download'></i></a></td>
                                        </tr>";
                                    }
                                }
                            ?>
                            </tbody>                            
                        </table>                                                                                                                                    
                    </div>
                </div>            
            </div>
        </div>
    </body>
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