<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
                    <h3>Tipo de Servicios</h3>
                    <hr>
                    <div class="row mb-2">                        
                        <div class="col-lg-12 col-sm-12 text-end">
                            <a class='btn btn-info btn-sm' href='http://localhost/hotel/adminServicios/registrar_tipo.php' type='submit' id='btnRegistrar' value='".$fila["id_habitacion"]."'><i class='bi bi-plus-circle me-2'></i>Agregar Tipo</a>
                        </div>
                    </div>                   
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT * FROM CATEGORIA_SERVICIO WHERE categoria_servicio!='Sin servicio' ORDER BY id_categoria_servicio";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped text-center table-sm border " id="tabla" >
                        <thead>
                            <tr><th>N°</th><th>Tipo Servicio</th><th>Acciones</th></tr>
                        </thead>                        
                        <tbody>
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
                        </tbody>                        
                    </table>     
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
        <script>
             $(document).ready(function(){
                $('#tabla').DataTable({
                    language:{
                        dom: '<"row"<"col-sm-6"l><"col-sm-6"f><"col-sm-12"t><"col-sm-6"i><"col-sm-6"p>>',
                        url:'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                    }
                });
            })
        </script>
        <script>
             function confirmar(id){
                var mensaje;
                if(confirm("¿Desea eliminar el tipo del servicio?")){
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