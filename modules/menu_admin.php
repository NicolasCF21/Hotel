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
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-2 border-bottom sticky-top">
            <div class="container">
                <a href="http://localhost/hotel/index.php" class="navbar-brand">
                    <img src="http://localhost/hotel/img/Logo1.png" alt="Logo hotel" style="max-width:170px">
                </a>
                <button class="navbar-toggler" style="border:none;" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center " id="navbar">
                    <ul class="navbar-nav me-5">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>"  href="http://localhost/hotel/index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold <?php if (basename($_SERVER['PHP_SELF']) == 'habitaciones.php') echo 'active'; ?>" href="http://localhost/hotel/vistas/habitaciones.php">Habitaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold <?php if (basename($_SERVER['PHP_SELF']) == 'servicios.php') echo 'active'; ?>" href="http://localhost/hotel/vistas/servicios.php">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold <?php if (basename($_SERVER['PHP_SELF']) == 'reseñas.php') echo 'active'; ?>" href="http://localhost/hotel/vistas/reseñas.php">Reseñas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold <?php if (basename($_SERVER['PHP_SELF']) == 'contacto.php') echo 'active'; ?>" href="http://localhost/hotel/vistas/contacto.php">Contacto</a>
                        </li>
                    </ul>
                    <div>
                        <a href="http://localhost/hotel/user/login.php"><i class="bi bi-person-circle text-black" style="font-size:22px;"></a></i>
                    </div>
                </div>
            </div>
        </nav>
    </body>