<?php
    session_start();
    include "../controller/conexion.php";
    $conexion = new Conexion();
    $con=$conexion->conectarDB();
    $tipo=$_POST['tipo'];
    $cantidad=$_POST['personas'];
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/estil.css">    
    </head>
    <body>
        <?php
        include '../modules/menu.php';
        ?>
        <div class="container-fluid text-center"> 
            <div class="container my-4">
                <h1>Habitaciones Disponibles</h1>
                <hr>
            </div>           
            <div class="container mt-5 mb-5 text-start">
                <div class="row g-3">
                    <?php                
                        $sql = "SELECT h.id_habitacion, h.nombre_habitacion, h.descripcion_habitacion, h.imagen_habitacion, h.precio_Tb, t.tipo_habitacion
                        FROM habitacion h JOIN tipo_habitacion t
                        ON h.id_tipo_habitacion = t.id_tipo_habitacion
                        WHERE h.id_estado='1' AND t.id_tipo_habitacion=$tipo";
                        $resultset = $con->query($sql);
                        if($resultset->num_rows>0){
                            while($fila = $resultset->fetch_assoc()){
                                echo ' 
                                <div class="col-lg-4 col-sm-auto">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="hover-scale">
                                                <div class="hover-scale-in position-relative">
                                                    <div class="position-absolute top-0 end-0 p-3 z-index-1">
                                                        <span class="bg-dark text-white d-inline-flex px-3 fs-sm py-2">$'.$fila["precio_Tb"].'</span>
                                                    </div>
                                                    <a href="http://localhost/hotel/habitaciones/habitacion.php?id='.$fila['id_habitacion'].'"><img src="'.$fila["imagen_habitacion"].'" title="" alt="" style="width:350px;" class="shadow"></a>
                                                </div>
                                                <div class="p-3 text-center mx-4 mt-n4 bg-white position-relative border border-gray-300 shadow" style="width: 300px;">                                
                                                    <span class="fs-sm">'.$fila["tipo_habitacion"].'</span>
                                                    <h5 class="pt-2 titulo"><a href="http://localhost/hotel/habitaciones/habitacion.php?id='.$fila['id_habitacion'].'" class="link-effect text-reset efecto">'.$fila["nombre_habitacion"].'</a></h5>                                    
                                                    <p class="texto-cortado">'.$fila["descripcion_habitacion"].'</p>
                                                    <a class="titulo efecto" href="http://localhost/hotel/habitaciones/habitacion.php?id='.$fila['id_habitacion'].'" style="text-decoration:none;"><i class="bi bi-journal-text"></i> Reservar</a>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>  
                                ';
                            }
                        }else{
                            echo "
                            <div>
                                <p>No se encuentran habitaciones disponibles</p>
                            </div>";
                        }
                    ?>
                </div>
            </div>
            </div>  
            <?php
            include '../modules/footer.php';
            ?>
        </div>
    </body>
</html>

