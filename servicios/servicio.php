<?php
    session_start();
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET['id'];
    $sql = "SELECT * FROM SERVICIO WHERE id_servicio='$id'";
    $resultset = $con->query($sql);
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
    </head>
    <body>
        <?php
        include '../modules/menu.php';
        
        ?>
        <?php 
            $resulset = $con->query($sql);
                if($fila = $resulset->fetch_assoc()){; ?>
                    <div class="container my-4">
                        <h1 class="text-center">Servicio</h1>
                    </div>    
                    <div class="container text-center mb-5">
                        <div class="row">
                            <div class="col-lg-7">
                                <img src="<?php echo $fila['imagen_servicio']?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-5">
                                <h2><?php echo $fila['nombre_servicio'] ?></h2>
                                <h4 class="text-start">Descripcion Servicio</h4>
                                <p><?php echo $fila['descripcion_servicio']?></p>
                            </div>
                        </div>
                    </div>        
    </body>
    <?php }?>   
    <footer>
        <?php
            include '../modules/footer.php';
        ?>
    </footer>
</html>
