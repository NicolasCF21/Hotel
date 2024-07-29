<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM HABITACION WHERE id_habitacion ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT h.id_habitacion, h.nombre_habitacion, h.descripcion_habitacion, h.cantidad_personas, h.precio_Tb , h.imagen_habitacion, 
        t.tipo_habitacion, e.estado_habitacion
        FROM habitacion h JOIN tipo_habitacion t
        ON h.id_tipo_habitacion = t.id_tipo_habitacion
        JOIN estado_habitacion e ON h.id_estado = e.id_estado
        ORDER BY id_habitacion";
        $resultset = $con->query($sql);
?>
    <table class="table table-hover table-striped table-sm border" id="tabla" >
        <tr><th>N°</th><th>Nombre</th><th>Tipo</th><th>Descripcion</th><th>Personas</th><th>Estado</th><th>Precio</th><th>Imagen</th><th></th><th></th></tr>
<?php
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla' class='articulo'><td>".$fila["id_habitacion"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["tipo_habitacion"]."</td><td>".$fila["descripcion_habitacion"]."</td><td>".$fila["cantidad_personas"]."</td><td>".$fila["estado_habitacion"]."</td><td>$".$fila["precio_Tb"]."</td><td> <img src='".$fila["imagen_habitacion"]."' class='img-fluid' style='max-width:200px'> </td>
                    <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/adminHabitaciones/actualizar.php?id=".$fila['id_habitacion']."' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-pencil-square'></i> </a></td>
                    <td><button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_habitacion"]."'><i class='bi bi-trash-fill'></i>   </button></td></tr>";
            }
        }

?>
    </table>

