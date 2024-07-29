<?php
    session_start();
    date_default_timezone_set("America/Bogota");
    setlocale(LC_TIME, 'es_CO.UTF-8','esp');
    if(!isset($_SESSION["Usuario"])){
        header('Location: login.php');        
    }
    $usuario = $_SESSION["Usuario"];
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $conn = $conexion->conectarDB();
    $user = $_SESSION["Usuario"];
    $sentencia="SELECT id_usuario FROM usuarios where id_usuario=$user";
    $resultset=$conn->query($sentencia);
   
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
                    include '../modules/sidebar_user.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                    <div class="container-fluid">
                        <div class="my-3">
                            <h4>Eliminar cuenta</h4>
                            <hr>
                        </div> 
                        <div>
                            <h6>Antes de realizar la eliminación de la cuenta</h6>
                            <ul>                                
                                <li>Si eliminas tu cuenta, perderas toda la información registrada.</li>
						    </ul>
                        </div>
                        <div id="eliminar">
                            <?php
                                if ($resultset->num_rows>0) {
                                    while ($fila=$resultset->fetch_assoc()) {                                    
                            ?>
                            <button type='submit' onclick='confirmar(this.value)' class='btn btn-danger' id='btnCancelar' value='<?php echo $fila["id_usuario"]?>' ><i class='bi bi-x-circle me-2' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='Tooltip on top'></i>Eliminar mi cuenta</button>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    <script>    
         function confirmar(id){
                var mensaje;
                if(confirm("¿Esta seguro de eliminar su cuenta?")){
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function(){                
                    alert("Cuenta eliminda exitosamente");
                    window.location.href = "./login.php?action=true";
                };
                xhttp.open("GET","elim_cuenta.php?id="+id);
                xhttp.send();
                }
            } 
    </script>
    </body>
</html>