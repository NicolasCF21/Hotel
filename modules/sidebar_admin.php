<!DOCTYPE html>
<html>
    <head>
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.bundle.min.js"></script>
        
    </head>
    <body >
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">                    
                    <span class="fs-5 d-none d-sm-inline">Bienvenido <br> <?php echo $_SESSION["Admin"] ?></span>                
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu" >
                    <li class="nav-item">
                        <a href="http://localhost/hotel/admin/indexA.php" class="nav-link align-middle px-0 text-dark">
                            <i class="fs-4 bi-house-fill"></i> <span class="ms-1 d-none d-sm-inline ">Inicio</span>
                        </a>
                    </li>
                    <li>
                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-dark">
                        <i class="fs-4 bi-building"></i> <span class="ms-1 d-none d-sm-inline">Habitaciones</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="http://localhost/hotel/adminHabitaciones/listar.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Habitacion</span></a>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/adminHabitaciones/listar_tipo.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Tipo</span></a>
                            </li>                                    
                        </ul>
                    </li>
                    <li>
                    <?php
                        include '../controller/conexion2.php';
                        // Obtener el número de reservaciones nuevas
                        $conn = new Conectar();
                        $co = $conn->conectarDb();
                        $sql2 = "SELECT COUNT(*) AS reservas FROM reservacion WHERE fecha_reservacion >= CURDATE()";
                        $resultado = $co->query($sql2);
                        $num_reservas = 0;
                        if ($resultado && $resultado->num_rows > 0) {
                            $fila = $resultado->fetch_assoc();
                            $num_reservas = $fila['reservas'];
                        }
                        // Mostrar el icono si hay reservaciones nuevas
                        if ($num_reservas > 0) {                                                                                                                        
                        echo '<a id="link" href="http://localhost/hotel/admin_reservas/listar_reservacion.php" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-calendar-event-fill"></i> <span class="ms-1 d-none d-sm-inline">Reservaciones</span><span class="badge ms-2 py-1 mb-2 text-bg-danger rounded-pill">'.$num_reservas.'</span></a>';                    
                        }else{
                            echo '<a id="link" href="http://localhost/hotel/admin_reservas/listar_reservacion.php" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-calendar-event-fill"></i> <span class="ms-1 d-none d-sm-inline">Reservaciones</span></a>';                    
                        }
                        $co->close();
                        ?>
                    </li>
                    <li>
                        <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Usuarios</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="http://localhost/hotel/admin/clientes.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Lista</span></a>
                                </li>
                                <li>
                                    <a href="http://localhost/hotel/admin/comentarios.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Testimonios</span></a>
                                </li>
                            </ul>

                    </li>
                    <li>
                    <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-dark">
                        <i class="fs-4 bi-telephone-fill"></i> <span class="ms-1 d-none d-sm-inline">Servicios</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="http://localhost/hotel/adminServicios/listar.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Servicio</span></a>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/adminServicios/listar_tipo.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Tipo</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://localhost/hotel/admin_prom/promociones.php" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-bookmark-star-fill"></i> <span class="ms-1 d-none d-sm-inline">Promociones</span></a>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-person-workspace"></i> <span class="ms-1 d-none d-sm-inline">Empleados</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="http://localhost/hotel/admin_empleados/empleados.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Lista</span></a>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/admin_empleados/cargo_empleados.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Cargos</span></a>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/admin_empleados/lista_turnos.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Turnos</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-card-list"></i> <span class="ms-1 d-none d-sm-inline">Inventario</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                               <li class="w-100">
                                <a href="http://localhost/hotel/habitaciones/inventario.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Inv.Habitación</span></a>
                            </li>
                            <li>
                                <a href="http://localhost/hotel/habitaciones/listar_productos.php" class="nav-link px-0"> <span class="d-none d-sm-inline text-dark">Productos</span></a>
                            </li>                                    
                        </ul>
                    </li>
                    <li>
                        <a href="http://localhost/hotel/admin/cerrar_sesion_a.php" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-door-open-fill"></i> <span class="ms-1 d-none d-sm-inline">Cerrar Sesion</span> </a>
                    </li>
                </ul>                
            </div>
        </div>    
        <script>
            document.getElementById('link').addEventListener('click', function() {
                var elem = document.getElementById('link');
                elem.parentNode.removeChild(elem);
    });
</script>
        

    </body>
</html>
        
          