<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pagina Hotel</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/custom.css">
  <link rel="stylesheet" href="./libs/bootstrap-icons/bootstrap-icons.css">
  <script src="./js/bootstrap.bundle.min.js"></script>  
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
              <button class="btn btn-light" type="button">Reservar Ahora</button>
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
    <div class="card">
      <form action="">
        <div class="card-body">
            <div class="row g-2">
            <div class="col-lg-3">
              <div class="form-floating">
                <input type="date" name="fechaIngreso" id="fechaIngreso" class="form-control">
                <label for="fechaIngreso">Fecha de Ingreso</label>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-floating">
                <input type="date" name="fechaSalida" id="fechaSalida" class="form-control">
                <label for="fechaSalida">Fecha de Salida</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-floating">
                <input type="number" class="form-control form-control-sm" name="adultos" id="adultos" placeholder="Adultos">
                <label for="adultos">Adultos:</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-floating">
                <input type="number" class="form-control form-control-sm" name="niños" id="niños" placeholder="Niños">
                <label for="adultos">Niños:</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-floating text-center">
                <button class="btn btn-success mt-2" type="button">Ver Disponibilidad</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div> 
    <hr class="my-5">
  </div>
  <div class="maxw-screen-lg mx-auto">
    <div class="container mt-5 mb-5" >
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
    
  <div></div>

  <div class="max-w-screen-lg mx-auto bg-success bg-opacity-10">
    <div class="container text-center">
      <div class="row">
        <div class="col-12 col-lg-5 my-5">
          <p class="display-6 fw-semibold">Hotel Resplendor</p>
          <p class="display-5 fw-bold">Habitaciones</p>
          <p class="fw-semibold mt-4">El mejor alojamiento de la zona. Todas las habitaciones están equipadas con mini-bar, aire acondicionado, ducha caliente, camas,
            televisión, limpieza impecable, con el fin de brindar un refugio perfecto para cualquier huésped que busque algo más que una simple estadía en un hotel.
          </p>
          <a href="http://localhost/hotel/vistas/habitaciones.php" class="btn btn-outline-dark rounded-pill" role="button" >Ver habitaciones</a>
        </div>
        <div class="col-12 col-lg-7 my-5">
          <img src="./img/h5.jpg" class="img-fluid w-100" alt="Habitacion de hotel">
        </div>
      </div>
    </div>
  </div>
  <div class="max-w-screen-lg mx-auto bg-secondary bg-opacity-10">
    <div class="container text-center">
      <div class="row">
        <div class="col-12 col-lg-7 my-5">
          <img src="./img/2.jpg" class="img-fluid w-100" alt="Servicio al cuarto">
        </div>
        <div class="col-12 col-lg-5 my-5">
          <p class="display-6 fw-semibold">Hotel Resplendor</p>
          <p class="display-5 fw-bold">Servicios</p>
          <p class="fw-semibold mt-4">El mejor alojamiento de la zona. Tambien cuenta con los mejores servicios, desde el restaurante con una gran variedad de platos asombrosos,
            pasando por el bar con una gran calida de productos disponibles para los huespedes, ademas de las diferentes actividades que se pueden realizar en las zonas verdes del hotel

          </p>
          <a href="http://localhost/hotel/vistas/servicios.php" class="btn btn-outline-dark rounded-pill" role="button" >Ver servicios</a>
        </div>
      </div>
    </div>
  </div>
  <div>
    <?php
    include './modules/footer.php';
    ?>

  </div>
</body>
</html>