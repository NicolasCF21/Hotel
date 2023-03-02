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
        $sql = "SELECT * FROM SERVICIO";
        $resultset = $con->query($sql);
?>
        <table class="table table-hover table-striped text-center border" id="tabla" >
            <tr><th>ID</th><th>Categoria Servicio</th><th>Nombre Servicio</th><th>Descripcion</th><th>Precio</th><th>Imagen</th><th></th><th></th></tr>
            <?php
                if($resultset->num_rows>0){
                    while($fila = $resultset->fetch_assoc()){
                        echo "<tr id='tabla' class='articulo'><td>".$fila["id_servicio"]."</td><td>".$fila["id_categoria_servicio"]."</td><td>".$fila["nombre_servicio"]."</td><td>".$fila["descripcion"]."</td><td>".$fila["precio_servicio"]."</td><td> <img src='".$fila["imagen"]."'  class='img-fluid'> </td>
                        <td><a class='btn btn-info' href='http://localhost/hotel/adminServicios/actualizar.php?id=".$fila['id_servicio']."' type='submit' id='btnActualizar' value='".$fila["id_servicio"]."'><i class='bi bi-cloud-arrow-up-fill'></i> Actualizar</a></td>
                        <td><button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_servicio"]."'><i class='bi bi-trash-fill'></i>Eliminar</button></td></tr>";
                    }
                }
            ?>
        </table>



