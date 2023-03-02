<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM cargo_empleado WHERE id_cargo_empleado ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM cargo_empleado";
        $resultset = $con->query($sql);
?>
    <table class="table table-hover table-striped table-sm border" id="tabla" >
        <tr><th>ID</th><th>Cargo</th></tr>
<?php
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla' class='articulo' ><td>".$fila["id_cargo_empleado"]."</td><td>".$fila["cargo_empleado"]."</td>
                <td><a class='btn btn-success' href='http://localhost/hotel/admin_empleados/actualizar_cargo.php?id=".$fila['id_cargo_empleado']."' type='submit' id='btnActualizar' value='".$fila["id_cargo_empleado"]."'><i class='bi bi-cloud-arrow-up-fill me-2'></i>Modificar</a></td>
                <td><button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_cargo_empleado"]."'><i class='bi bi-trash-fill me-2'></i>Eliminar</button></td></tr>";
            }
        }

?>
    </table>