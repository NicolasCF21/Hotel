<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');
    }
    $usuario = $_SESSION["Usuario"];

    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET["id"];
    $sql = "UPDATE reservacion SET estado_reservacion='Cancelada' WHERE id_reservacion=$id AND estado_reservacion<>'Finalizada' ";

    if($con->query($sql)===TRUE) {
            
    }
    $con->close();
    $con = $conexion->conectarDB(); 
    $sql = "SELECT r.id_reservacion, r.fecha_ingreso, r.fecha_salida, r.estado_reservacion, r.cantidad_personas, r.total_pago, r.forma_pago, h.nombre_habitacion, s.nombre_servicio FROM reservacion r
    JOIN habitacion h ON r.id_habitacion = h.id_habitacion
    JOIN servicio s ON r.id_servicio = s.id_servicio
    WHERE id_usuario='".$usuario."' ORDER BY r.id_reservacion"; 
    $resultset = $con->query($sql);
    echo "<tr><th>#</th><th>Habitacion</th><th>Servicio</th><th>Fecha ingreso</th><th>fecha salida</th><th>Estado</th><th>Personas</th><th>Forma Pago</th><th>Pago Total</th><th></th><th></th></tr>";
    if($resultset->num_rows>0){
        while($fila = $resultset->fetch_assoc()){
            echo "<tr id='tabla'><td>".$fila["id_reservacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["nombre_servicio"]."</td><td>".$fila["fecha_ingreso"]."</td><td>".$fila["fecha_salida"]."</td><td>".$fila["estado_reservacion"]."</td><td>".$fila['cantidad_personas']."</td><td>".$fila['forma_pago']."</td><td>$".$fila['total_pago']."</td>
            <td><button type='submit' onclick='confirmar(this.value)' class='btn btn-sm btn-danger' id='btnCancelar' value='".$fila['id_reservacion']."' ><i class='bi bi-x-circle' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='Tooltip on top'></i></button></td>
            <td><a href='http://localhost/hotel/factura/factura_user.php?id=".$fila['id_reservacion']."' value='".$fila['id_reservacion']."' type='submit' class='btn btn-sm btn-secondary' target='_blank'><i class='bi bi-download'></i></a></td>
            </tr>";
        }
    }

?>








