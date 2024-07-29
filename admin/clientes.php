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
                    <h3>Usuarios</h3>
                    <hr>                    
                    <?php
                        include '../controller/conexion.php';
                        $conexion = new Conexion();
                        $con = $conexion->conectarDB();
                        $sql = "SELECT * FROM USUARIOS";
                        $resultset = $con->query($sql);

                    ?>
                    <table class="table table-hover table-striped border table-responive" id="tabla" >
                        <thead>
                            <tr><th>N°</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>No. Documento</th><th>No. Telefono</th></tr>
                        </thead>                        
                        <tbody>
                        <?php
                            if($resultset->num_rows>0){
                                while($fila = $resultset->fetch_assoc()){
                                    echo "<tr id='tabla' class='articulo'><td>".$fila["id_usuario"]."</td><td>".$fila["nombre_usuario"]."</td><td>".$fila["apellido_usuario"]."</td><td>".$fila["email"]."</td><td>".$fila["documento"]."</td><td>".$fila["telefono"]."</td></tr>";
                                    //file_put_contents("registros.txt",($fila["email"])."\n",FILE_APPEND);
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
                    "lengthMenu": [[10, 25, 50], [10, 25, 50]],              
                    dom: '<"row"<"col-sm-6"l><"col-sm-6"f><"col-sm-12"t><"col-sm-6"i><"col-sm-6"p>>',
                    language:{                    
                        url:'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                    }
                });
            })
        </script>
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
    </body>
</html>