<?php
    session_start();
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
               
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
        </style>
    </head>
    <body>
        <?php
        include '../modules/menu.php';
        ?>
        <div class="container-fluid text-center">
            <div class="hover-in position-relative">
                <img src="../img/s-7.jpg" alt="Servicios" class="img-fluid d-block w-100">
                <div class="position-absolute mt-n4 p-5 ms-5  bg-white translate-middle-y shadow" style="width:525px;">
                    <h2 class="display-1">Servicios</h2>
                    <h5 class="text-muted my-3">!Descubre nuestros servicios¡</h5>
                    <div class="position-absolute bg-dark top-25 start-50 pt-3 mb-5 px-3 translate-middle-x">
                        <p class="text-white fw-semibold">Reserva Ahora</p>
                    </div>
                </div>  
            </div>
            <div class="container">
                <div class="row" id="tabla">            
                </div>
            </div>    
            <nav>
                <ul class="pagination justify-content-center"></ul>
            </nav>
            
        </div>  
        
        <?php
            include '../modules/footer.php';
        ?>
        <script>
    $(document).ready(function() {
      // Mostrar la primera página al cargar la página
      mostrarDatos(1);

      // Función para mostrar los datos de una página específica
      function mostrarDatos(pagina) {
        $.ajax({
          url: "sr.php",
          type: "GET",
          data: { pagina: pagina },
          dataType: "json",
          success: function(response) {
            // Limpiar la tabla y la paginación
            $("#tabla").empty();
            $(".pagination").empty();

            // Agregar las filas a la tabla
            $.each(response.filas, function(index, fila) {
              $("#tabla").append(
                "<div class='col-lg-12 col-sm-12'>"+
                    "<div class='card bg-secondary bg-opacity-25 my-3 border-0 shadow' style='max-width: 1240px;'>"+
                        "<div class='row g-0'>"+
                            "<div class='col-md-5 order-sm-last order-lg-first'>"+
                                "<div class='card-body text-center py-5'>"+
                                    "<h2>"+fila.nombre_servicio+"</h2>"+
                                    "<p class='card-text text-start'>"+fila.descripcion_servicio+"</p>"+                                    
                                    "<p class='fw-bold'>Tarifa: $"+fila.tarifa_servicio+"</p>"+                                                                          
                                    "<div class='mt-3'>"+
                                        "<a class='btn btn-sm btn-dark' href='http://localhost/hotel/servicios/servicio.php?id="+fila.id_servicio+"'>Ver detalles</a>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+              
                            "<div class='col-md-7'>"+
                                "<div class='hover-in'>"+
                                    "<a href='../servicios/servicio.php?id="+fila.id_servicio+"'>"+
                                        "<img src='"+fila.imagen_servicio+"' class='img-fluid rounded-end'>"+
                                    "</a>"+
                                "</div>"+            
                            "</div>"+
                        "</div>"+            
                    "</div>"+
                "</div>");
            });

            // Agregar los enlaces de la paginación
            for (var i = 1; i <= response.total_paginas; i++) {
              $(".pagination").append("<li class='page-item'><a class='page-link' href='#' data-pagina='" + i + "'>" + i + "</a></li>");
            }

            // Marcar como activo el enlace de la página actual
            $(".pagination li a").removeClass("active");
            $(".pagination li a[data-pagina='" + pagina + "']").addClass("active");
        }
        });
      }

      // Función para cambiar de página al hacer clic en un enlace de la paginación
      $(document).on("click", ".pagination li a", function(event) {
        event.preventDefault();
        var pagina = $(this).data("pagina");
        mostrarDatos(pagina);
      });
    });
  </script>
        
    </body>
</html>

