<?php
    $user=$_SESSION["Usuario"];
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $sql = "SELECT nombre_usuario, apellido_usuario FROM usuarios WHERE id_usuario = '".$user."'";
    $resulset = $con->query($sql);
?>
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
    <div class="col-sm-4 col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="http://localhost/hotel/user/index.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                            <?php while ($fila = $resulset->fetch_assoc()) { ?>
                            <span class="fs-4 d-none d-sm-inline">Bienvenid@ <?php echo $fila['nombre_usuario']?></span>
                            <?php }?>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                            <li class="nav-item">
                                <a href="http://localhost/hotel/user/index.php" class="nav-link align-middle px-0 text-dark">
                                    <i class="fs-4 bi-house-fill"></i> <span class="ms-1 d-none d-sm-inline ">Inicio</span>
                                </a>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/user/reservacion.php" class="nav-link px-0 align-middle text-dark">
                                    <i class="fs-4 bi-calendar-event-fill"></i> <span class="ms-1 d-none d-sm-inline">Mis Reservaciones</span></a>
                            </li>
                            <li >
                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-dark">
                                    <i class="fs-4 bi-gear-fill"></i> <span class="ms-1 d-none d-sm-inline">Configuracion</span> </a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                        <li class="w-100">
                                            <a href="http://localhost/hotel/user/perfil.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Mis datos</span></a>
                                        </li>                                    
                                    </ul>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/user/cerrar_sesion_u.php" class="nav-link px-0 align-middle text-dark">
                                    <i class="fs-4 bi-door-open-fill"></i> <span class="ms-1 d-none d-sm-inline">Cerrar Sesion</span> </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>

    </body>
</html>
        
