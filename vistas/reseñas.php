<?php
    session_start();
    if (isset($_SESSION["Usuario"])) {
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pagina Hotel</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/bootstrap.min.js"></script>
    <style>
        
        .hover-in {
                overflow: hidden; /* [1.2] Hide the overflowing of child elements */
            }

                /* [2] Transition property for smooth transformation of images */
            .hover-in img {
                transition: transform .6s ease;
            }

                /* [3] Finally, transforming the image when container gets hovered */
            .hover-in:hover img {
                transform: scale(1.1);
            }
            .mt-n4{
                margin-top: -13.5rem;
            }
        .icon-md {
            width: 2.8rem;
            height: 2.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 1.2rem;
            line-height: 1;
        }
    </style>
	
</head>
<body>
    <?php
        include '../modules/menu.php';
        ?>
	<div class="container-fluid mb-3">    
        <div class="container-fluid text-center">
            <div class="hover-in position-relative">
                <img src="../img/comen.jpg" alt="Servicios" class="img-fluid d-block w-100">
                <div class="position-absolute mt-n4 p-5 ms-5  bg-white translate-middle-y shadow" style="width:525px;">
                    <h2 class="display-1">Testimonios</h2>
                    <h5 class="text-muted my-3">!Conoce las experiencias de otros huespedes¡</h5>                
                </div>  
            </div>                    
        </div>                
        <div class="container my-3">  
        <?php
        if(isset($_SESSION["exito"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i><strong>Exito!</strong> El comentario fue enviado para realizar la aprobación.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION["exito"]);
        }
        ?>          
            <div class="row gx-4 gy-2">
                <?php
                include '../controller/conexion.php';
                $conexion = new Conexion();
                $con = $conexion->conectarDB();
                $sql = "SELECT o.opinion, o.calificacion, o.fecha_reg, u.nombre_usuario 
                FROM opiniones o JOIN usuarios u
                ON o.id_usuario = u.id_usuario
                WHERE estado='Aprobada'
                ORDER BY fecha_reg DESC";
                $resultset = $con->query($sql);
                if($resultset->num_rows>0){
                    while($fila = $resultset->fetch_assoc()){
                
            echo'<div class="col-lg-4 my-4">
                    <div class="card shadow bg-light rounded border border-0">
                        <div class="text-center mt-3">
                            <div class="icon-md bg-primary bg-opacity-10 text-primary rounded-3 fs-xl ">
                                <i class="bi bi-quote fs-3"></i>
                            </div>
                        </div>                        
                        <div class="card-body p-5">
                            <blockquote class="blockquote mb-0">
                                <p class="text-muted">'.$fila['opinion'].'</p>
                                <div class="row">
                                    <div class="col-lg-9 col-sm-9">
                                        <h5 class="text-dark-emphasis mb-2">'.$fila['nombre_usuario'].'</h5>
                                    </div>
                                    <div class="col-lg-3 col-sm-3">
                                        <span class="small text-muted">'.$fila['calificacion'].'<i class="bi bi-star-fill text-warning ms-1"></i></span>
                                    </div>
                                </div>                                
                                <p class="small text-muted"><span>'.$fila['fecha_reg'].'</span></p>
                            </blockquote>
                        </div>
                    </div>
                </div>';
                    }
                }
                ?>
            </div>        
        </div>
    </div>
    <div class="container-fluid bg-secondary bg-opacity-25 py-5">
        <div class="container">
            <h1 class="text-center fw-bold">Escribe una opinion, describe tu experiencia con nosotros</h1>
            <h4 class="text-center my-4">Comparte tu experiencia y ayuda a otras personas a conocer la calidad de nuestros servicios</h4>
            <form action="../user/registrar_opinion.php" method="POST">
                <div class="row g-2">
                    <div class="col-lg-6">
                        <div class="form-floating my-2">
                            <textarea class="form-control" placeholder="Dejanos conocer tu opinion" id="opinion" name="opinion" required></textarea>
                            <label for="opinion">Dejanos conocer tu opinion</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating my-2">
                            <input type="text" class="form-control" placeholder="Dejanos conocer tu opinion" id="calificacion" name="calificacion" required>
                            <label for="calificacion">Dejanos conocer tu valoración</label>
                            <?php
                            if(isset($_SESSION["texto"])){
                                echo '<div class="toast-container position-static">
                                        <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body text-danger fw-bold">
                                                    ¡Por favor ingrese un valor númerico!.
                                                </div>
                                                <button     type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>';
                                unset($_SESSION["texto"]);
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_SESSION["registrarse"])){
                    echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle-fill"></i><strong> ¡Debe iniciar sesion para realizar un comentario.!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    unset($_SESSION["registrarse"]);
                }
                ?>
                <div class="text-center mt-4 ">
                    <button class="btn btn-primary rounded-pill" type="submit">Enviar</button>
                </div> 
                
            </form>
        </div>
    </div>
    <div class="mt-1">
        <?php
            include '../modules/footer.php';
        ?>
    </div>
    <script>
        //Hacer visible el toast de alerta
        var toast = document.querySelector('.toast');
        var bootstrapToast = new bootstrap.Toast(toast);
        bootstrapToast.show();
    </script>    	
</body>
</html>
