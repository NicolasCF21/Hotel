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
        $sql = "SELECT * FROM CATEGORIA_SERVICIO WHERE categoria_servicio!='Sin servicio' ORDER BY id_categoria_servicio";
        $resultset = $con->query($sql);
?>
        <table class="table table-hover table-striped text-center table-sm border " id="tabla" >
            <tr><th>N°</th><th>Tipo Servicio</th><th>Acciones</th></tr>
        <?php
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla' class='articulo'><td>".$fila["id_categoria_servicio"]."</td><td>".$fila["categoria_servicio"]."</td>
                <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/adminServicios/actualizar_tipo.php?id=".$fila['id_categoria_servicio']."' type='submit' id='btnActualizar' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-pencil-square'></i></a>
                <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-trash-fill '></i></button></td>
                </tr>";
            }
        }
        ?>
        </table>  

