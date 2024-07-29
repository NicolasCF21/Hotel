<?php

    session_start();
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();    
    $idPr=$_GET["prom"];
    $id = $_GET['id'];
    $sql = "SELECT * FROM habitacion WHERE id_habitacion='".$id."'";
    $resultset = $con->query($sql);
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
        <?php 
        if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'reservada'){
            echo '<div class="alert alert-warning m-0 alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> La habitacion ya se encuentra reservada
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';        
        } 
            $resulset = $con->query($sql);
                if($fila = $resulset->fetch_assoc()){; ?>
                    <div class="container my-4">
                        <h1 class="text-center"><?php echo $fila['nombre_habitacion'] ?></h1>
                    </div>    
                    <div class="container text-center mb-5">
                        <div class="row g-4">
                            <div class="col-lg-7">
                                <img src="<?php echo $fila['imagen_habitacion']?>" alt="Imagen habitación de hotel" class="img-fluid">
                            </div>
                            <div class="col-lg-5 ">
                                <form action="reservacion.php" method="POST">
                                    <div class="card border-0 shadow bg-light">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4 class="text-center">Reservar Habitación</h4>
                                            </div>
                                            <div class="card-text my-4">
                                                <div class="row g-3">                            
                                                    <div class="col-lg-12">
                                                        <div class="form-floating">
                                                            <?php 
                                                                $fechaActual =  date("Y-m-d");
                                                            ?>
                                                            <input type="hidden" name="habitacion" id="habitacion" value="<?php echo $fila['id_habitacion']?>" class="form-control" placeholder="Habitacion">                                                
                                                            <input type="hidden" name="promocion" id="promocion" value="<?php echo $idPr?>" class="form-control" placeholder="Habitacion">                                                
                                                            <input type="date" name="ingreso" id="ingreso" class="form-control my-2" placeholder="Fecha Ingreso" required min="<?= $fechaActual?>">
                                                            <label for="ingreso">Fecha Ingreso</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-floating">
                                                            <input type="date" name="salida" id="salida" class="form-control" placeholder="Fecha Salida" required min="<?= $fechaActual?>"  >
                                                            <label for="salida">Fecha Salida</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-floating">
                                                            <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Fecha Salida" required min="1" max="<?php echo $fila["cantidad_personas"];?>">
                                                            <label for="cantidad">Número Personas:</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">  
                                                        <div class="text-start">
                                                            <i class="bi bi-exclamation-circle ms-2 me-1"></i><label for="servicio">Opcional</label>              
                                                        </div>     
                                                        <div class="form-floating">                                                        
                                                            <select class="form-select mt-2" id="servicio" name="servicio" aria-label="Default select example">
                                                                    <option option selected hidden value="">--Elija el tipo servicio--</option>
                                                                    <?php                                           
                                                                        $con1 = $conexion->conectarDB();
                                                                        $sql1 = "SELECT id_servicio, nombre_servicio FROM  SERVICIO WHERE nombre_servicio!='Sin servicio'";
                                                                        $resulset1 = $con1->query($sql1);
                                                                        while($datos = mysqli_fetch_array($resulset1)){
                                                                    ?>                                                    
                                                                    <option value="<?php echo $datos["id_servicio"]?>"><?php echo $datos["nombre_servicio"]?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                            </select>    
                                                            <label for="servicio">Servicios adicionales:</label>
                                                                                                                  
                                                        </div>
                                                    </div>
                                                </div>                                                                                    
                                                <div>                                                    
                                                    <button type="submit" class="btn btn-sm btn-dark mt-3" name="submit" id="submit" >Reservar</button>                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container text-center my-4">
            <h2>Descripcion Habitación</h2>
            <p><?php echo $fila['descripcion_habitacion']?></p>
            <hr>
        </div>
        
        <div class="bg-secondary bg-opacity-10 p-4 mt-3">
            <div class="container">
                <h2 class="text-center">Caracteristicas Habitación</h2>
                <div class="row my-4 g-4">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center"><i class="bi bi-arrows-fullscreen" style="font-size:40px;"></i></div>
                                <div class="card-tittle text-center"><h5>Tamaño</h5></div>
                                <div class="card-text text-center"><p>28 m2 a 33 m2</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                            <div class="text-center"><i class="bi bi-droplet-fill" style="font-size:40px;"></i></div>
                                <div class="card-tittle text-center"><h5>Baño</h5></div>
                                <div class="card-text text-center"><p>Independiente con ducha y bañera</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center"><i class="bi bi-calendar3-fill" style="font-size:40px;"></i></div>
                                <div class="card-tittle text-center"><h5>Cama</h5></div>
                                <div class="card-text text-center"><p>Cama de 130 x 180 cm</p></div>
                            </div>
                        </div>
                    </div>                
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center"><i class="bi bi-wifi" style="font-size:40px;"></i></div>
                                <div class="card-tittle text-center"><h5>Wifi</h5></div>
                                <div class="card-text text-center"><p>Servicio de internet inalambrico</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="text-center"><i class="bi bi-tv-fill" style="font-size:40px;"></i></div>
                                <div class="card-tittle "><h5>Televisión</h5></div>
                                <div class="card-text "><p>Tv de 40 pulgadas con servicio de cable</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center"><i class="bi bi-archive-fill" style="font-size:40px;"></i></div>
                                <div class="card-tittle text-center"><h5>Escritorio</h5></div>
                                <div class="card-text text-center"><p>Comodo escritorio de habitación</p></div>
                            </div>
                        </div>
                    </div>
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