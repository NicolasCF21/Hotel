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
                    <h3 class="text-center">Tipo de Servicios</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <form>
                                <input type="text" id="buscador" name="buscador" placeholder="Buscar..." class="form-control">
                            </form>
                        </div>
                        <div class="col-lg-2">
                            <a class='btn btn-success' href='http://localhost/hotel/adminServicios/registrar_tipo.php' type='submit' id='btnRegistrar' value='".$fila["id_habitacion"]."'><i class='bi bi-cloud-plus-fill me-2'></i>Añadir Tipo</a>
                        </div>
                    </div>                   
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT * FROM CATEGORIA_SERVICIO";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped text-center table-sm border " id="tabla" >
                        <tr><th>N°</th><th>Tipo Servicio</th><th></th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_categoria_servicio"]."</td><td>".$fila["categoria_servicio"]."</td>
                                    <td><a class='btn btn-success btn-sm' href='http://localhost/hotel/adminServicios/actualizar_tipo.php?id=".$fila['id_categoria_servicio']."' type='submit' id='btnActualizar' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-cloud-arrow-up-fill me-2'></i>Modificar</a>
                                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_categoria_servicio"]."'><i class='bi bi-trash-fill me-2'></i>Eliminar</button></td>
                                    </tr>";
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
                if(confirm("¿Desea eliminar el tipo del servicio")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Tipo de servicio eliminado exitosamente");
                };
                xhttp.open("GET","eliminar_tipo.php?id="+id);
                xhttp.send();
                }
            }   

        </script>
        <script src="script.js"></script>
    </body>
</html>