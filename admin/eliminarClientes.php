<?php
     error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    //function eliminarCorreo(){
        $conexion = new Conexion();
        $con = $conexion->conectarDB();
        $id = $_GET["id"];
        $sql = "DELETE FROM USUARIOS WHERE id_usuario =$id";
       
        if ($con->query($sql) == true) {
            
        }
        $con->close();
        $con = $conexion->conectarDB(); 
        $sql = "SELECT * FROM USUARIOS";
        $resultset = $con->query($sql);
        if($resultset->num_rows>0){
            while($fila = $resultset->fetch_assoc()){
                echo "<tr id='tabla'><td>".$fila["id_usuario"]."</td><td>".$fila["nombre_usuario"]."</td><td>".$fila["apellido_usuario"]."</td><td>".$fila["email"]."</td><td>".$fila["documento"]."</td><td>".$fila["telefono"]."</td><td>
                <button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_usuario"]."'><i class='bi bi-person-x-fill me-2'></i>Eliminar</button></td></tr>";
                //file_put_contents("registros.txt",($fila["email"])."\n",FILE_APPEND);
            }
        }
    
    //}

?>

