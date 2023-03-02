<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM CATEGORIA_SERVICIO WHERE id_categoria_servicio ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM CATEGORIA_SERVICIO";
        $resultset = $con->query($sql);
?>
        <table class="table table-hover table-striped text-center table-sm border" id="tabla" >
            <tr><th>ID</th><th>Tipo Servicio</th><th></th><th></th></tr>
        <?php
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla' class='articulo'><td>".$fila["id_categoria_servicio"]."</td><td>".$fila["categoria_servicio"]."</td>
                <td><a class='btn btn-success btn-sm' href='http://localhost/hotel/adminHabitaciones/actualizar.php' type='submit' id='btnActualizar' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-cloud-arrow-up-fill me-2'></i>Modificar</a></td>
                <td><button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-trash-fill me-2'></i>Eliminar</button></td></tr>";
            }
        }
        ?>
        </table>  

