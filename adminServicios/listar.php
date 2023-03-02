<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
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
                    <h3 class="text-center">Servicios</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <form>
                                <input type="text" id="buscador" name="buscador" placeholder="Buscar..." class="form-control">
                            </form>
                        </div>
                        <div class="col-lg-2">
                            <a class='btn btn-success btn-sm mt-1' href='http://localhost/hotel/adminServicios/registrar.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-plus-fill me-2'></i>Añadir Servicio</a>
                        </div>
                    </div>
                    
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT s.id_servicio, s.nombre_servicio, s.descripcion_servicio, s.imagen_servicio, s.tarifa_servicio, c.categoria_servicio
                        FROM servicio s JOIN categoria_servicio c
                        ON s.id_categoria_servicio = c.id_categoria_servicio ";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border table-sm" id="tabla" >
                        <tr><th>N°</th><th>Nombre</th><th>Tipo</th><th>Descripcion</th><th>Tarifa</th><th>Imagen</th><th></th><th></th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_servicio"]."</td><td>".$fila["nombre_servicio"]."</td><td>".$fila["categoria_servicio"]."</td><td>".$fila["descripcion_servicio"]."</td><td>$".$fila["tarifa_servicio"]."</td><td> <img src='".$fila["imagen_servicio"]."'  class='img-fluid' style='max-width:200px'> </td>
                                    <td><a class='btn btn-success btn-sm' href='http://localhost/hotel/adminServicios/actualizar.php?id=".$fila['id_servicio']."' type='submit' id='btnActualizar' value='".$fila["id_servicio"]."'><i class='bi bi-cloud-arrow-up-fill'></i> Actualizar</a></td>
                                    <td><button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_servicio"]."'><i class='bi bi-trash-fill'></i>Eliminar</button></td></tr>";
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
                if(confirm("¿Desea eliminar el servicio")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Servicio eliminado exitosamente");
                };
                xhttp.open("GET","eliminar_servicio.php?id="+id);
                xhttp.send();
                }
            }   
        </script>
        <script src="script.js"></script>
    </body>
</html>