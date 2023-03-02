<!DOCTYPE html>
<html>
    <head>
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        include '../modules/menu.php';
        ?>
        
        <div class="container-fluid text-center">
            <img src="../img/s-7.jpg" alt="Servicios" class="img-fluid d-block w-100">
            <div class="carousel-caption d-none d-md-block" id="carousel4">
                <h2 class="display-1 fw-semibold">Servicios</h2>
            </div>  
        </div>  
        <div class="container mt-5 mb-5">
            <div class="row g-2">
                <?php
                    include '../controller/conexion.php';
                    $conexion = new Conexion();
                    $con = $conexion->conectarDB();
                    $sql = "SELECT * FROM servicio";
                    $resultset = $con->query($sql);
                    if($resultset->num_rows>0){
                        while($fila = $resultset->fetch_assoc()){
                            echo "<div class='col-lg-12 col-sm-12'>
                                    <div class='card mb-3 bg-secondary bg-opacity-25 mt-5' style='max-width: 1240px;'>
                                        <div class='row g-0'>
                                            <div class='col-md-5 order-sm-last order-lg-first'>
                                                <div class='card-body text-center mt-5'>
                                                    <h2 class='card-title'>".$fila["nombre_servicio"]."</h2>
                                                        <p class='card-text text-start'>".$fila["descripcion_servicio"]."</p>   
                                                        <p class='fw-bold'>Tarifa: $".$fila["tarifa_servicio"]."</p>                                                   
                                                        <i class='bi-tv' style='font-size:25px'></i>
                                                        <i class='bi-wifi ms-2' style='font-size:25px'></i>
                                                        <i class='bi-water ms-2' style='font-size:25px;'></i>
                                                        <div class='mt-3'>                                                        
                                                            <a class='btn btn-sm btn-dark' type='button' href='http://localhost/hotel/servicios/servicio.php?id=".$fila['id_servicio']."'>Ver detalles</a>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class='col-md-7'>
                                                <img src='".$fila["imagen_servicio"]."' class='img-fluid rounded-end'>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    }
                ?>
            </div>
        </div>
            <?php
            include '../modules/footer.php';
            ?>
        </div>
    </body>
</html>

