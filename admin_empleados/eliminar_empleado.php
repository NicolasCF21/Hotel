<?php
    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "UPDATE EMPLEADO SET estado='Inactivo' WHERE id_empleado ='$id'";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT e.id_empleado, e.nombre_empleado, e.apellido_empleado, e.telefono, e.correo, c.id_cargo_empleado, c.cargo_empleado, t.jornada            
        FROM empleado e JOIN cargo_empleado c
        ON e.id_cargo_empleado = c.id_cargo_empleado
        JOIN turnos_empleados t
        ON  e.id_turno_empleados = t.id_turno_empleados
        WHERE e.estado='Activo' ORDER BY id_empleado";  
        $resultset = $con->query($sql);
?>
    <table class="table table-hover table-striped border" id="tabla" >
        <tr><th>N°</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Correo</th><th>Cargo</th><th>Turno</th><th>Acciones</th></tr>
        <?php
            if($resultset->num_rows>0){
                while($fila = $resultset->fetch_assoc()){
                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_empleado"]."</td><td>".$fila["nombre_empleado"]."</td><td>".$fila["apellido_empleado"]."</td><td>".$fila["telefono"]."</td><td>".$fila["correo"]."</td><td>".$fila["cargo_empleado"]."</td><td>".$fila["jornada"]."</td>
                    <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/admin_empleados/actualizar_empleado.php?id=".$fila['id_empleado']."' type='submit' id='btnActualizar' value='".$fila["id_empleado"]."'><i class='bi bi-pencil-square'></i> </a>
                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_empleado"]."'><i class='bi bi-person-x'></i>  </button></td>                                    
                    </tr>";
                }
            }
            ?>
    </table>                    
