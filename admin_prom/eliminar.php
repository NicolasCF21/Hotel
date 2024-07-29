<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM promociones WHERE id_promocion ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT p.id_promocion, p.nombre_prom, p.descripcion, p.fecha_inicio, p.fecha_fin, p.descuento, h.id_habitacion, h.nombre_habitacion, h.imagen_habitacion 
        FROM promociones p JOIN habitacion h ON p.id_habitacion = h.id_habitacion";
        $resultset = $con->query($sql);
?>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-sm border" id="tabla" >
            <thead>
                <tr><th>N°</th><th>Promoción</th><th>Habitación</th><th>Descripción</th><th>F.inicio</th><th>F.fin</th><th>Descuento</th><th>Imagen</th><th></th><th></th></tr>
            </thead>
            <tbody>
            <?php
                if($resultset->num_rows>0){
                    while($fila = $resultset->fetch_assoc()){
                        echo "<tr id='tabla' class='articulo'><td>".$fila["id_promocion"]."</td><td>".$fila["nombre_prom"]."</td><td>".$fila["nombre_habitacion"]."</td><td>".$fila["descripcion"]."</td><td>".$fila["fecha_inicio"]."</td><td>".$fila["fecha_fin"]."</td><td>".$fila["descuento"]."%</td><td> <img src='".$fila["imagen_habitacion"]."' class='img-fluid' style='max-width:200px'> </td>
                        <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/admin_prom/actualizar.php?id=".$fila['id_promocion']."' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-pencil-square'></i> </a></td>
                        <td><button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_promocion"]."'><i class='bi bi-trash-fill'></i>   </button></td></tr>";
                    }
                }
            ?>
            </tbody>                            
        </table>
    </div>
