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
                    <h3 class="text-center">Cargos de empleados</h3>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-10">
                            <form>
                                <input type="text" id="buscador" name="buscador" placeholder="Buscar..." class="form-control">
                            </form>
                        </div>
                        <div class="col-lg-2">
                            <a class='btn btn-info btn-sm mt-1' href='http://localhost/hotel/admin_empleados/registrar_cargo.php' type='submit' id='btnActualizar' value='".$fila["id_habitacion"]."'><i class='bi-cloud-plus-fill me-2'></i>Añadir </a>
                        </div>
                    </div>
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT * FROM cargo_empleado";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped text-center border" id="tabla" >
                        <tr><th>N°</th><th>Cargo</th><th>Acciones</th></tr>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo' ><td>".$fila["id_cargo_empleado"]."</td><td>".$fila["cargo_empleado"]."</td>
                                    <td><a class='btn btn-primary btn-sm' href='http://localhost/hotel/admin_empleados/actualizar_cargo.php?id=".$fila['id_cargo_empleado']."' type='submit' id='btnActualizar' value='".$fila["id_cargo_empleado"]."'><i class='bi bi-cloud-arrow-up-fill me-2'></i>Modificar</a>
                                    <button class='btn btn-danger btn-sm' type='submit' id='btnEliminar' onclick='confirmar(this.value)' value='".$fila["id_cargo_empleado"]."'><i class='bi bi-trash-fill me-2'></i>Eliminar</button></td></tr>";
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
                if(confirm("¿Desea eliminar el cargo")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){
                    document.getElementById("tabla").innerHTML = this.responseText;
                    alert("Cargo empleado eliminado correctamente");
                };
                xhttp.open("GET","eliminar_cargo.php?id="+id);
                xhttp.send();
                }
            }   

        </script>
        <script src="script.js"></script>
    </body>
</html>