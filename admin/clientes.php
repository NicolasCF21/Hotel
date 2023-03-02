<?php
 error_reporting (E_ALL ^ E_NOTICE);    
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
        <style>
            .filtro{
                display:none;
            }
        </style>
    </head>
    <body>
        <?php
            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                    <h3 class="text-center">Usuarios</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <input type="text" id="buscador" name="buscador" placeholder="Buscar..." class="form-control">
                        </div>
                    </div>
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT * FROM USUARIOS";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border" id="tabla" >
                        <tr><th>N°</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>No. Documento</th><th>No. Telefono</th><th></th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_usuario"]."</td><td>".$fila["nombre_usuario"]."</td><td>".$fila["apellido_usuario"]."</td><td>".$fila["email"]."</td><td>".$fila["documento"]."</td><td>".$fila["telefono"]."</td><td>
                                    <button class='btn btn-danger' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_usuario"]."'><i class='bi bi-person-x-fill me-2'></i>Eliminar</button></td></tr>";
                                    //file_put_contents("registros.txt",($fila["email"])."\n",FILE_APPEND);
                                }
                            }
                            ?>
                    </table>
                    
                </div>
            </div>
        </div>
        <script>
             function confirmar(id){
                var mensaje;
                if(confirm("¿Desea eliminar el Usuario")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Correo eliminado exitosamente");
                };
                xhttp.open("GET","eliminarClientes.php?id="+id);
                xhttp.send();
                }
            }   

        </script>
        <script src="script.js"></script>
    </body>
</html>