<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: ../admin/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagina Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php        
    include '../modules/menu.php';
    include '../modules/sidebar_admin.php';
?>
    <div class="col-xl-10 col-sm-10 col-md-9 py-3">
        <h3>Inventario habitaciones</h3>    
        <hr>
        <div class="row g-2">
            <?php
            include "../controller/conexion.php";
            $conexion = new Conexion();
            $con=$conexion->conectarDB();
            $sql = "SELECT * FROM habitacion;";
            $resultset = $con->query($sql);
            if($resultset->num_rows>0){
                while($fila = $resultset->fetch_assoc()){
            echo '
                <div class="col-lg-3 col-sm-12">
                <a href="http://localhost/hotel/habitaciones/inv_habitacion.php?id='.$fila["id_habitacion"].'" style="text-decoration:none;">
                    <div class="card text-bg-white shadow mb-3 border-5 border-top-0 border-end-0 border-bottom-0 border-primary" style="max-width: 430px;">                        
                        <div class="card-body text-center">
                            <img src="../img/hotel2.png" alt="Icono habitación" class="img-fluid w-25">                        
                            <h1 class="fs-5 mt-3">'.$fila["nombre_habitacion"].'</h1>

                        </div>
                    </div>
                </a>
                </div>';                
                }
            }?>
            
        </div>        
    </div>
</body>
</html>