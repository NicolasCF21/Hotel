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
     <table class="table table-hover table-striped text-center border" id="tabla" >
        <tr><th>N°</th><th>Cargo</th><th>Acciones</th></tr>
<?php
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla' class='articulo' ><td>".$fila["id_cargo_empleado"]."</td><td>".$fila["cargo_empleado"]."</td>
                <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/admin_empleados/actualizar_cargo.php?id=".$fila['id_cargo_empleado']."' type='submit' id='btnActualizar' value='".$fila["id_cargo_empleado"]."'><i class='bi bi-pencil-square'></i></a>
                <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_cargo_empleado"]."'><i class='bi bi-trash-fill'></i></button></td></tr>";
            }
        }

?>
    </table>