<?php
  session_start();
  date_default_timezone_set("America/Bogota");
  setlocale(LC_TIME, 'es_CO.UTF-8','esp');
  include "./controller/conexion.php";
  $conexion = new Conexion();
  $con = $conexion->conectarDB();  
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
  <title>Pagina Hotel</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="./css/custom.css">
  <link rel="stylesheet" href="./libs/bootstrap-icons/bootstrap-icons.css">
  <script src="./js/bootstrap.min.js"></script>  
  <link rel="stylesheet" href="./css/estil.css">  
  <style>
      .hover-in {
          overflow: hidden;
      }
      .hover-in img {
          transition: transform .6s ease;
      }
      .hover-in:hover img {
        transform: scale(1.1);
      }      
      .mt-n5{
        margin-top:-4.1rem;
    }
  </style>
</head>
<body>
  <?php
    include './modules/menu.php';
  ?>

  <div class="container-fluid ">
    <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./img/1-4.jpg" class="w-100 img-fluid" alt="Piscina hotel">
            <div class="carousel-caption d-none d-md-block">
              <h2 class="display-3 fw-semibold">Hotel Resplendor</h2>
              <p class="fs-5">Conoce y descubre las mejores habitaciones y ofertas para ti.</p>
              <a class="btn btn-light" type="button" href="http://localhost/hotel/vistas/habitaciones.php">Reservar Ahora</a>
            </div>
        </div>
        <div class="carousel-item">
          <img src="./img/sl4.jpg" class="w-100"  alt="Mesa con buena vista">
            <div class="carousel-caption d-none d-md-block" id="carousel2">
            <h2 class="display-3 fw-semibold">Descubre Nuevas Experiencias</h2>
            </div>
        </div>
        <div class="carousel-item">
          <img src="./img/sl-6.jpg" class="w-100" alt="Restaurante hotel">
            <div class="carousel-caption d-none d-md-block" id="carousel3">
            <h2 class="display-3 fw-semibold">El mejor lugar para relajarse</h2>
              
            </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <div class="container mt-5 ">
    <div class="card border-0 shadow rounded-4">
      <form action=" habitaciones/disponibilidad.php" method="POST">
        <?php
          $fechaActual=date("Y-m-d");
        ?>
        <div class="card-body p-4">
            <div class="row g-2">
              <div class="col-lg-3">
                <div class="form-floating">
                  <input type="date" name="ingreso" id="ingreso" class="form-control" min="<?= $fechaActual?>" required>
                  <label for="ingreso">Fecha de Ingreso</label>
                </div>
              </div>
    
              <div class="col-lg-3">
                <div class="form-floating">
                  <input type="date" name="salida" id="salida" class="form-control" min="<?= $fechaActual?>" required>
                  <label for="salida">Fecha de Salida</label>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-floating">
                  <input type="number" class="form-control form-control-sm" name="personas" id="personas" placeholder="Numero Personas" min="0" max="10" required>
                  <label for="personas">Número Personas:</label>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-floating">
                  <select class="form-select" id="tipo" name="tipo" aria-label="Default select example" required>
                  <option option selected hidden>--Seleccione el tipo de habitacion--</option>
                  <?php
                    
                    $sql="SELECT * FROM TIPO_HABITACION";
                    $resulset = $con->query($sql);
                    while($datos = mysqli_fetch_array($resulset)){
                      if($datos["id_tipo_habitacion"] == $fila["tipo_habitacion"])
                          echo "<option value='".$datos["id_tipo_habitacion"] ."' selected='selected'>" . $datos["tipo_habitacion"]. "</option>";
                      else
                          echo "<option value='".$datos["id_tipo_habitacion"] ."'>" . $datos["tipo_habitacion"]. "</option>";
                  }
                  $con->close();
                  ?>
                  </select>
                  <label for="tipo">Tipo habitación:</label>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-floating text-center">
                  <input class="btn btn-info" type="submit" value="Ver Disponibilidad"></input>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>       
    </div>  

    <div class="maxw-screen-lg mx-auto">
      <div class="container my-5">
        <h1 class="text-center display-5 fw-semibold">Bienvenidos a Hotel Resplendor</h1>   
        <figure class="text-center">
          <blockquote class="blockquote">
            <p>Resplendor es una lugar que ofrece una estancia de lujo. No es un simple hotel, sino un lugar especial 
            que nos encantaría compartir con nuestros huéspedes para ofrecer una experiencia única e inolvidable. Donde la comodidad y
            la tranquilidad es de lo que más disfrutarás</p>
          </blockquote>
        </figure>
      </div>
    </div>        

    <div class="max-w-screen-lg mx-auto bg-secondary bg-opacity-10">
      <div class="container text-center">
        <div class="row">
          <div class="col-12 col-lg-5 my-5">            
            <p class="display-5 fw-bold mt-5">Habitaciones</p>
            <p class="fw-semibold mt-5">El mejor alojamiento de la zona. Todas las habitaciones están equipadas con mini-bar, aire acondicionado, ducha caliente, camas,
              televisión, limpieza impecable, con el fin de brindar un refugio perfecto para cualquier huésped que busque algo más que una simple estadía en un hotel.
            </p>
            <a href="http://localhost/hotel/vistas/habitaciones.php" class="btn btn-outline-dark rounded-pill" role="button" >Ver habitaciones</a>
          </div>
          <div class="col-12 col-lg-7 my-5">
            <div class="hover-in">
              <img src="./img/h5.jpg" class="img-fluid w-100" alt="Habitacion de hotel">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="max-w-screen-lg mx-auto bg-secondary bg-opacity-10">
      <div class="container text-center">
        <div class="row">
          <div class="col-12 col-lg-7 my-5">
            <div class="hover-in">
              <img src="./img/2.jpg" class="img-fluid w-100" alt="Servicio al cuarto">
            </div>            
          </div>
          <div class="col-12 col-lg-5 my-5 order-sm-first order-lg-last">            
            <p class="display-5 fw-bold mt-5">Servicios</p>
            <p class="fw-semibold mt-5">El mejor alojamiento de la zona. Tambien cuenta con los mejores servicios, desde el restaurante con una gran variedad de platos asombrosos,
              pasando por el bar con una gran calida de productos disponibles para los huespedes, ademas de las diferentes actividades que se pueden realizar en las zonas verdes del hotel

            </p>
            
            <a href="http://localhost/hotel/vistas/servicios.php" class="btn btn-outline-dark rounded-pill" role="button" >Ver servicios</a>
          </div>
        </div>
      </div>
    </div>

    <?php 
      $conn=$conexion->conectarDB();
      $sentencia="SELECT p.id_promocion , p.id_habitacion, p.nombre_prom, p.fecha_inicio, p.fecha_fin, p.descuento, p.descripcion, p.imagen, h.nombre_habitacion FROM promociones p
      JOIN habitacion h ON p.id_habitacion = h.id_habitacion 
      WHERE estado='Activa' ORDER BY p.fecha_fin ASC;";
      $resulset=$conn->query($sentencia);       
      if ($resulset->num_rows>0) {
        echo'<div class="prom">
              <div class="container p-5"> 
                <h3 class="text-center display-5 mb-3 fw-semibold">Nuevas Ofertas</h3>  
                <div class="row g-4 justify-content-center">';
          while($fila=$resulset->fetch_assoc()) {         
            echo '<div class="col-lg-4 col-sm-10">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="hover-scal">
                                <div class="hover-scale-i position-relative">
                                    <div class="position-absolute top-0 end-0 py-3 z-index-1">
                                        <span class="bg-dark text-white d-inline-flex px-3 fs-sm py-2">Valido hasta: '.$fecha=strftime("%e de %B", strtotime($fila["fecha_fin"])).'</span>
                                    </div>
                                    <a href="http://localhost/hotel/habitaciones/habitacion.php?id='.$fila['id_promocion'].'"><img src="'.$fila["imagen"].'" title="" alt="" style="width:350px;" class="shadow rounded-3"></a>
                                </div>
                                <div class="p-3 text-center mx-4 mt-n5 bg-white position-relative border border-gray-300 shadow rounded-4" style="width: 300px;">                                                          
                                    <h5 class="pt-2 titulo"><a href="http://localhost/hotel/habitaciones/habitacion.php?id='.$fila['id_habitacion'].'" class="link-effect text-reset efecto">'.$fila["nombre_prom"].'</a></h5>                                    
                                    <span class="fs-sm">'.$fila["descuento"].'%</span>
                                    <p class="texto-cortado">'.$fila["descripcion"].'</p>
                                    
                                    <a class="titulo efecto" href="http://localhost/hotel/habitaciones/habitacion.php?id='.$fila['id_habitacion'].'" style="text-decoration:none;"><i class="bi bi-journal-text"></i> Ver oferta</a>
                                </div>
                            </div>
                        </div>    
                    </div>
                  </div>';
        }
          echo'</div> 
            </div>
          </div>';
      }
      ?>      

    <div>
      <?php
      include './modules/footer.php';
      ?>

    </div>
</body>
</html>