<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM turnos_empleados WHERE id_turno_empleados ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM turnos_empleados";
        $resultset = $con->query($sql);
?>
    <table class="table table-hover table-striped border" id="tabla" >
        <tr><th>N°</th><th>Jornada</th><th>Entrada</th><th>Salida</th><th>Acciones</th></tr>
        <?php
            if($resultset->num_rows>0){
                while($fila = $resultset->fetch_assoc()){
                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_turno_empleados"]."</td><td>".$fila["jornada"]."</td><td>".$fila["entrada"]."</td><td>".$fila["salida"]."</td>
                                    <td><a class='btn btn-success btn-sm' href='http://localhost/hotel/admin_empleados/actualizar_turno.php?id=".$fila['id_turno_empleados']."' type='submit' id='btnActualizar' value='".$fila["id_turno_empleados"]."'><i class='bi bi-cloud-arrow-up-fill'></i> </a>
                                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_turno_empleados"]."'><i class='bi bi-trash-fill'></i>  </button></td>
                                    
                    </td></tr>";
                }
            }
            ?>
    </table>                    
