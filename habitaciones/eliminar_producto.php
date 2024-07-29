<?php
    error_reporting (E_ALL ^ E_NOTICE);    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM productos WHERE id_producto =$id";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM productos ORDER BY id_producto";
        $resultset = $con->query($sql);
?>
    <table class="table table-hover table-striped text-center table-sm border" id="tabla" >
        <thead>
            <tr><th>N°</th><th>Nombre</th><th>Cantidad</th><th>Acciones</th></tr>
        </thead>        
        <tbody>
        <?php
            if($resultset->num_rows>0){
                while($fila = $resultset->fetch_assoc()){
                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_producto"]."</td><td>".$fila["nombre_producto"]."</td><td>".$fila["cantidad_producto"]."</td>
                    <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/habitaciones/actualizar_producto.php?id=".$fila['id_producto']."' type='submit' id='btnActualizar' value='".$fila["id_producto"]."'><i class='bi bi-pencil-square'></i> </a>
                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_producto"]."'><i class='bi bi-trash-fill'></i></button></td></tr>";
                }
            }
        ?>
        </tbody>
    </table>

