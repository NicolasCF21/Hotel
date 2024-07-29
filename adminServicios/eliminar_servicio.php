<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM SERVICIO WHERE id_servicio ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT s.id_servicio, s.nombre_servicio, s.descripcion_servicio, s.imagen_servicio, s.tarifa_servicio, c.categoria_servicio
        FROM servicio s JOIN categoria_servicio c
        ON s.id_categoria_servicio = c.id_categoria_servicio
        WHERE s.nombre_servicio!='Sin servicio'
        ORDER BY id_servicio";
        $resultset = $con->query($sql);
?>
        <table class="table table-hover table-striped border table-sm" id="tabla" >
            <tr><th>N°</th><th>Nombre</th><th>Tipo</th><th>Descripcion</th><th>Tarifa</th><th>Imagen</th><th></th><th></th></tr>
            <?php
                if($resultset->num_rows>0){
                    while($fila = $resultset->fetch_assoc()){
                        echo "<tr id='tabla' class='articulo'><td>".$fila["id_servicio"]."</td><td>".$fila["nombre_servicio"]."</td><td>".$fila["categoria_servicio"]."</td><td>".$fila["descripcion_servicio"]."</td><td>$".$fila["tarifa_servicio"]."</td><td> <img src='".$fila["imagen_servicio"]."'  class='img-fluid' style='max-width:200px'> </td>
                                <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/adminServicios/actualizar.php?id=".$fila['id_servicio']."' type='submit' id='btnActualizar' value='".$fila["id_servicio"]."'><i class='bi bi-pencil-square'></i> </a></td>   
                                <td><button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_servicio"]."'><i class='bi bi-trash-fill'></i></button></td></tr>";
                    }
                }
            ?>
        </table>



