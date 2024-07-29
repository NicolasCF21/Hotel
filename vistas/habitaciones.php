    <?php
        session_start();
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Pagina Hotel</title>
            <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            <link rel="stylesheet" href="../css/custom.css">
            <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">            
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel="stylesheet"/>
            <script src="../js/bootstrap.bundle.min.js"></script>    
            <script src="../js/jquery-3.6.1.min.js"></script>                              
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>     
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
            include '../controller/Product.php';
	        $tipo_habitacion = new Product();	
            ?>
            <div class="container-fluid text-center">
                <div class="hover-in position-relative">
                    <img src="../img/h6-2.jpg" alt="Habitaciones" class="img-fluid w-100">
                    <div class="position-absolute p-5 ms-5 mt-n4 bg-white translate-middle-y shadow">
                        <h2 class="display-1">Habitaciones</h2>
                        <h5 class="text-muted my-3">!Observa y elije la mas indicada para ti¡</h5>
                        <div class="position-absolute bg-dark top-25 start-50 pt-3 mb-5 px-3 translate-middle-x">
                            <p class="text-white fw-semibold">Reserva Ahora</p>
                        </div>
                    </div>    
                </div>
                <div class="container-fluid">                         
                    <div class="row g-4">             
                        <div class="col-lg-4 text-start mt-5">
                            <div class="hstack">
                                <button class="btn btn-light mb-0 d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                    <i class="fa-solid fa-sliders-h me-1"></i> Mostrar filtros
                                </button>					
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-xxl-3">
                                    <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Filtros avanzados</h5>
                                            <button  type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body flex-column p-3 p-xl-0">
                                            <form class="rounded-3 shadow" id="search-form" method="POST" action="">
                                                <div class="card bg-light card-body rounded-0 rounded-top border-0 p-4">                                                
                                                    <div class="list-group">
                                                        <h3>Tipo habitación</h3>
                                                        <div class="brandSection"> 
                                                    <?php
				                                        $tipo = $tipo_habitacion->getBrand();
				                                        foreach($tipo as $tipos){	
				                                    ?>                                                                                                                                                       
                                                            <div class="list-group-item checkbox border-0 bg-light">
                                                                <label style="font-size:17px;"><input type="checkbox" class="productDetail brand" value="<?php echo $tipos["id_tipo_habitacion"]; ?>"  > <?php echo $tipos["tipo_habitacion"]; ?></label>
                                                            </div>
                                                    <?php }	?>                                                                                                                                                         
                                                        </div>  
                                                    </div>
                                                    
                                                </div>                                            
                                                <hr class="my-0">
                                                <div class="card card-body bg-light rounded-0 rounded-bottom-2 border-0 p-4">                                                
                                                    <div class="list-group">
                                                        <h3>Precio</h3>	
                                                        <div class="list-group-item border-0 bg-light">
                                                            <input id="priceSlider" data-slider-id='ex1Slider' type="text" data-slider-min="1000" data-slider-max="65000" data-slider-step="1" data-slider-value="14"/>
                                                            <div class="priceRange">1000 - 75000</div>
                                                            <input type="hidden" id="minPrice" value="0" />
                                                            <input type="hidden" id="maxPrice" value="75000" />                  
                                                        </div>			
                                                    </div>                                                                                                        
                                                </div>                                                                                      
                                            </form>
                                        </div>
                                    </div>
                                </div>                            
                            </div>                            
                        </div>
                        <div class="col-lg-8">
                            <div class="row searchResult"></div>
                        </div>
                        <nav>
                            <ul class="pagination justify-content-center"></ul>
                        </nav>                        
                    </div>
                </div>            
                
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
            url: "hb.php",
            type: "GET",
            data: { pagina: pagina },
            dataType: "json",
            success: function(response) {
                // Limpiar la tabla y la paginación
                $(".searchResult").empty();
                $(".pagination").empty();

                // Agregar las filas a la tabla
                $.each(response.filas, function(index, fila) {
                $(".searchResult").append(
                    "<div class='col-lg-12 col-sm-12'>"+
                        "<div class='card bg-secondary bg-opacity-25 my-3 border-0 shadow-sm' style='max-width: 900px;'>"+
                            "<div class='row g-2'>"+
                                "<div class='col-md-7 order-sm-last '>"+
                                    "<div class='card-body text-start'>"+
                                        "<h2 class='text-center card-title fs-3'><a style='text-decoration:none;' class='text-dark' href='http://localhost/hotel/habitaciones/habitacion.php?id="+fila.id_habitacion+"'>"+fila.nombre_habitacion+"</a></h2>"+                                    
                                        "<div class='d-flex'>"+                                                                                
                                            "<small class='fw-bold'>Tipo: "+fila.tipo_habitacion+"</small>"+
                                        "</div>"+
                                        "<div class='mb-0'>"+ 
                                            "<p>"+fila.descripcion_habitacion+"</p>"+
                                        "</div>"+    
                                        "<div class='text-center'>"+ 
                                            "<i class='bi-tv' style='font-size:25px'></i>"+
                                            "<i class='bi-wifi ms-2' style='font-size:25px'></i>"+
                                            "<i class='bi-water ms-2' style='font-size:25px;'></i>"+
                                        "</div>"+                                            
                                        "<div class='mt-0 text-start d-flex justify-content-between'>"+
                                            "<h5 class='fw-bold mb-0 me-1'>$"+fila.precio_Tb+"<small class='fw-light'>/por noche</small></h5>"+  
                                            "<a class='btn btn-sm btn-dark' href='http://localhost/hotel/habitaciones/habitacion.php?id="+fila.id_habitacion+"'>Reservar</a>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"+              
                                "<div class='col-md-5'>"+
                                    "<div class='hover-in order-lg-first p-2'>"+
                                        "<a href='../habitaciones/habitacion.php?id="+fila.id_habitacion+"'>"+
                                            "<img src='"+fila.imagen_habitacion+"' class='img-fluid rounded-2 my-3'>"+
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
    <script src="../js/search.js"></script>            
        </body>
    </html>

