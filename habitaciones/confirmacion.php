<?php
    session_start();
    
    date_default_timezone_set("America/Bogota");
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
        <script src="../js/jquery-3.6.1.min.js"></script>
    </head>
    <body>
        <?php
        include '../modules/menu.php';
        ?>
        <div class="container my-4">
            <div class="alert alert-success text-center" role="alert">
                <i class="bi bi-check-circle" style="font-size:70px;"></i>
                <h2 class="alert-heading ">¡Reservación Registrada!</h2>
                <p>Gracias por realizar la reservación en nuestro sitio web. Ahora podras ver la información de tu reservación en tu perfil o podrás descargar la factura 
                en la parte inferior de la pagina.</p>
                <p><strong>¡Esperamos que disfrutes y tengas una gran estancia con nosotros, te esperamos.!</strong></p>    
            </div>
            <div class="d-grid gap-2 d-md-block text-center">
                <a type="submit" class="btn btn-success" href="http://localhost/hotel/factura/factura_reser.php" target="_blank"> <i class="bi bi-download"></i> Descargar factura</a>            
            </div>
        </div>
        
        
    </body>
    <footer>
        <?php
            include '../modules/footer.php';
        ?>
    </footer>
    
</html>