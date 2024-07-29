<?php
    error_reporting (E_ALL ^ E_NOTICE);    
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM TIPO_HABITACION WHERE id_tipo_habitacion =$id";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM TIPO_HABITACION ORDER BY id_tipo_habitacion";
        $resultset = $con->query($sql);
?>
    <table class="table table-hover table-striped text-center table-sm border" id="tabla" >
        <tr><th>N°</th><th>Tipo Habitacion</th><th>Acciones</th></tr>
    <?php
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla' class='articulo' ><td>".$fila["id_tipo_habitacion"]."</td><td>".$fila["tipo_habitacion"]."</td>
                <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/adminHabitaciones/actualizar_tipo.php?id=".$fila['id_tipo_habitacion']."' type='submit' id='btnActualizar' value='".$fila["id_tipo_habitacion"]."'><i class='bi bi-pencil-square'></i></a>
                <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_tipo_habitacion"]."'><i class='bi bi-trash-fill'></i></button></td></tr>";
            }
        }

    ?>
    </table>

