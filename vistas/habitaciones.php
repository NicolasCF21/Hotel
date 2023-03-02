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
            <img src="../img/h6-2.jpg" alt="Habitaciones" class="img-fluid w-100"  >
            <div class="carousel-caption d-none d-md-block" id="carousel4">
                <h2 class="display-1 fw-semibold">Habitaciones</h2>
            </div>    
        </div>  
        <div class="container mt-5 mb-5">
            <div class="row g-2">
                <?php
                    include '../controller/conexion.php';
                    $conexion = new Conexion();
                    $con = $conexion->conectarDB();
                    $sql = "SELECT * FROM HABITACION";
                    $resultset = $con->query($sql);
                    if($resultset->num_rows>0){
                        while($fila = $resultset->fetch_assoc()){
                            echo "<div class='col-lg-12 col-sm-12'>
                                    <div class='card bg-secondary bg-opacity-25 my-3' style='max-width: 1240px;'>
                                        <div class='row g-0'>
                                            <div class='col-md-5 order-sm-last order-lg-first'>
                                                <div class='card-body text-center mt-5'>
                                                    <h2 class='card-title'>".$fila["nombre_habitacion"]."</h2>
                                                        <p class='card-text text-start'>".$fila["descripcion_habitacion"]."</p>
                                                        <p class='fw-bold'>Precio: $".$fila["precio_habitacion"]."</p>
                                                        <i class='bi-tv' style='font-size:25px'></i>
                                                        <i class='bi-wifi ms-2' style='font-size:25px'></i>
                                                        <i class='bi-water ms-2' style='font-size:25px;'></i>
                                                        <div class='mt-3'>
                                                            <a class='btn btn-sm btn-dark' href='http://localhost/hotel/habitaciones/reservacion.php?id=".$fila['id_habitacion']."'>Reservar</a>
                                                            <a class='btn btn-sm btn-dark' type='button' href='http://localhost/hotel/habitaciones/habitacion.php?id=".$fila['id_habitacion']."'>Ver detalles</a>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class='col-md-7 '>
                                                <img src='".$fila["imagen_habitacion"]."' class='img-fluid rounded-end'>
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

