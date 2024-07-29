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
  <title>Pagina Hotel</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/custom.css">
  <link rel="stylesheet" href="./libs/bootstrap-icons/bootstrap-icons.css">
  <script src="./js/bootstrap.min.js"></script> 
  <script src="./js/bootstrap.bundle.min.js"></script> 
  <style>
    .card.card-img-scale img{
    --fa-style-family-brands: "Font Awesome 6 Brands";
    --fa-font-brands: normal 400 1em/1 "Font Awesome 6 Brands";
    --fa-font-regular: normal 400 1em/1 "Font Awesome 6 Free";
    --fa-style-family-classic: "Font Awesome 6 Free";
    --fa-font-solid: normal 900 1em/1 "Font Awesome 6 Free";
    --bs-blue: #1d3b53;
    --bs-indigo: #6610f2;
    --bs-purple: #6f42c1;
    --bs-pink: #e83e8c;
    --bs-red: #d6293e;
    --bs-yellow: #f7c32e;
    --bs-green: #0cbc87;
    --bs-teal: #20c997;
    --bs-cyan: #17a2b8;
    --bs-black: #000;
    --bs-gray: #747579;
    --bs-gray-dark: #0b0a12;
    --bs-gray-100: #f5f5f6;
    --bs-gray-200: #dfdfe3;
    --bs-gray-300: #c5c5c7;
    --bs-gray-400: #96969a;
    --bs-gray-500: #85878a;
    --bs-gray-600: #747579;
    --bs-gray-700: #5e5e5f;
    --bs-gray-800: #0b0a12;
    --bs-gray-900: #0b0a12;
    --bs-primary: #5143d9;
    --bs-white: #fff;
    --bs-secondary: #85878a;
    --bs-success: #0cbc87;
    --bs-info: #17a2b8;
    --bs-warning: #f7c32e;
    --bs-danger: #d6293e;
    --bs-light: #f5f5f6;
    --bs-dark: #0b0a12;
    --bs-orange: #fd7e14;
    --bs-mode: #fff;
    --bs-primary-rgb: 81, 67, 217;
    --bs-secondary-rgb: 133, 135, 138;
    --bs-success-rgb: 12, 188, 135;
    --bs-info-rgb: 23, 162, 184;
    --bs-warning-rgb: 247, 195, 46;
    --bs-danger-rgb: 214, 41, 62;
    --bs-light-rgb: 245, 245, 246;
    --bs-dark-rgb: 11, 10, 18;
    --bs-orange-rgb: 253, 126, 20;
    --bs-mode-rgb: 255, 255, 255;
    --bs-primary-text: #0a58ca;
    --bs-secondary-text: #6c757d;
    --bs-success-text: #146c43;
    --bs-info-text: #087990;
    --bs-warning-text: #997404;
    --bs-danger-text: #b02a37;
    --bs-light-text: #6c757d;
    --bs-dark-text: #495057;
    --bs-primary-bg-subtle: #cfe2ff;
    --bs-secondary-bg-subtle: #f8f9fa;
    --bs-success-bg-subtle: #d1e7dd;
    --bs-info-bg-subtle: #cff4fc;
    --bs-warning-bg-subtle: #fff3cd;
    --bs-danger-bg-subtle: #f8d7da;
    --bs-light-bg-subtle: #fcfcfd;
    --bs-dark-bg-subtle: #ced4da;
    --bs-primary-border-subtle: #9ec5fe;
    --bs-secondary-border-subtle: #e9ecef;
    --bs-success-border-subtle: #a3cfbb;
    --bs-info-border-subtle: #9eeaf9;
    --bs-warning-border-subtle: #ffe69c;
    --bs-danger-border-subtle: #f1aeb5;
    --bs-light-border-subtle: #e9ecef;
    --bs-dark-border-subtle: #adb5bd;
    --bs-white-rgb: 255, 255, 255;
    --bs-black-rgb: 0, 0, 0;
    --bs-body-color-rgb: 116, 117, 121;
    --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
    --bs-body-font-family: "DM Sans", sans-serif;
    --bs-body-font-size: 1rem;
    --bs-body-font-weight: 400;
    --bs-body-line-height: 1.5;
    --bs-body-color: #747579;
    --bs-emphasis-color-rgb: 0, 0, 0;
    --bs-secondary-color: rgba(116, 117, 121, 0.75);
    --bs-secondary-color-rgb: 116, 117, 121;
    --bs-secondary-bg: #dfdfe3;
    --bs-secondary-bg-rgb: 223, 223, 227;
    --bs-tertiary-color: rgba(116, 117, 121, 0.5);
    --bs-tertiary-color-rgb: 116, 117, 121;
    --bs-tertiary-bg: #f5f5f6;
    --bs-tertiary-bg-rgb: 245, 245, 246;
    --bs-body-bg: #fff;
    --bs-body-bg-rgb: 255, 255, 255;
    --bs-heading-color: var(--bs-gray-900);
    --bs-link-color: #5143d9;
    --bs-link-color-rgb: 81, 67, 217;
    --bs-link-decoration: none;
    --bs-link-hover-color: #4136ae;
    --bs-link-hover-color-rgb: 65, 54, 174;
    --bs-code-color: #d63384;
    --bs-border-width: 1px;
    --bs-border-style: solid;
    --bs-border-color: var(--bs-gray-200);
    --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
    --bs-border-radius: 0.5rem;
    --bs-border-radius-sm: 0.4rem;
    --bs-border-radius-lg: 1rem;
    --bs-border-radius-xl: 1.5rem;
    --bs-border-radius-2xl: 2rem;
    --bs-border-radius-pill: 50rem;
    --bs-box-shadow: 0px 0px 40px rgba(29, 58, 83, 0.1);
    --bs-box-shadow-sm: 0 0.125rem 0.25rem rgba(29, 58, 83, 0.15);
    --bs-box-shadow-lg: 0 1rem 3rem rgba(29, 58, 83, 0.15);
    --bs-box-shadow-inset: inset 0 1px 2px rgba(var(--bs-body-color-rgb), 0.075);
    --bs-emphasis-color: #000;
    --bs-form-control-bg: var(--bs-body-bg);
    --bs-form-control-disabled-bg: var(--bs-secondary-bg);
    --bs-highlight-bg: #fff3cd;
    --bs-breakpoint-xs: 0;
    --bs-breakpoint-sm: 576px;
    --bs-breakpoint-md: 768px;
    --bs-breakpoint-lg: 992px;
    --bs-breakpoint-xl: 1200px;
    --bs-breakpoint-xxl: 1400px;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    -webkit-font-smoothing: antialiased;
    --bs-gutter-x: 1.6rem;
    --bs-gutter-y: 1.6rem;
    box-sizing: border-box;
    --bs-card-spacer-y: 1.25rem;
    --bs-card-spacer-x: 1.25rem;
    --bs-card-title-spacer-y: 0.5rem;
    --bs-card-title-color: var(--bs-gray-900);
    --bs-card-subtitle-color: ;
    --bs-card-border-width: 0;
    --bs-card-border-color: var(--bs-border-color);
    --bs-card-border-radius: 1rem;
    --bs-card-box-shadow: ;
    --bs-card-inner-border-radius: 1rem;
    --bs-card-cap-padding-y: 1.25rem;
    --bs-card-cap-padding-x: 1.25rem;
    --bs-card-cap-bg: var(--bs-mode);
    --bs-card-cap-color: ;
    --bs-card-height: ;
    --bs-card-color: ;
    --bs-card-bg: var(--bs-mode);
    --bs-card-img-overlay-padding: 1.25rem;
    --bs-card-group-margin: 0.9375rem;
    position: relative;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    min-width: 0;
    height: var(--bs-card-height);
    word-wrap: break-word;
    background-clip: border-box;
    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
    border-radius: var(--bs-card-border-radius);
    overflow: hidden !important;
    --bs-bg-opacity: 1;
    background-color: transparent !important;
    will-change: transform;
    }    
    img{
        vertical-align: middle;
    }
    h5, .h5{
        font-size: calc(1.255rem + 0.06vw)          
    }
  </style>

</head>
<body>
<section>
	<div class="container">

		<!-- Title -->
		<div class="row mb-4">
			<div class="col-12 text-center">
				<h2 class="mb-0">Habitaciones mas reservadas</h2>
			</div>
		</div>
        

		<div class="row g-4">
            <div class="col-sm-6 col-xl-4">
				<!-- Card START -->
				<div class="card card-img-scale overflow-hidden bg-transparent w-100 border-0">
					<!-- Image and overlay -->
					<div class="card-img-scale-wrapper rounded-3 position-relative">
						<!-- Image -->
						<img src="./imgHabitaciones/h1.jpg" class="card-img img-fluid" alt="hotel image">
						<!-- Badge -->
						<div class="position-absolute bottom-0 start-0 p-3">
							<div class="badge text-bg-dark fs-6 rounded-pill stretched-link"><i class="bi bi-geo-alt me-2"></i>Individual</div>
						</div>
					</div>

					<!-- Card body -->
					<div class="card-body px-2 bg-light bg-opacity-25">
						<!-- Title -->
						<h5 class="card-title"><a href="hotel-detail.html" class="stretched-link">Habitacion 102</a></h5>
						<!-- Price and rating -->
						<div class="d-flex justify-content-between align-items-center">
							<h6 class="text-success mb-0">$30000 <small class="fw-light">/por noche</small> </h6>
							<h6 class="mb-0">Ver más<i class="fa-solid fa-star text-warning ms-1"></i></h6>
						</div>
					</div>
				</div>
				<!-- Card END -->
			</div>
            <div class="col-sm-6 col-xl-4">
				<!-- Card START -->
				<div class="card card-img-scale overflow-hidden bg-transparent w-100 border-0">
					<!-- Image and overlay -->
					<div class="card-img-scale-wrapper rounded-3 position-relative">
						<!-- Image -->
						<img src="./imgHabitaciones/h1.jpg" class="card-img img-fluid" alt="hotel image">
						<!-- Badge -->
						<div class="position-absolute bottom-0 start-0 p-3">
							<div class="badge text-bg-dark fs-6 rounded-pill stretched-link"><i class="bi bi-geo-alt me-2"></i>Individual</div>
						</div>
					</div>

					<!-- Card body -->
					<div class="card-body px-2 bg-light bg-opacity-25">
						<!-- Title -->
						<h5 class="card-title"><a href="hotel-detail.html" class="stretched-link">Habitacion 102</a></h5>
						<!-- Price and rating -->
						<div class="d-flex justify-content-between align-items-center">
							<h6 class="text-success mb-0">$30000 <small class="fw-light">/por noche</small> </h6>
							<h6 class="mb-0">Ver más<i class="fa-solid fa-star text-warning ms-1"></i></h6>
						</div>
					</div>
				</div>
				<!-- Card END -->
			</div>
            <div class="col-sm-6 col-xl-4">
				<!-- Card START -->
				<div class="card card-img-scale overflow-hidden bg-transparent w-100 border-0">
					<!-- Image and overlay -->
					<div class="card-img-scale-wrapper rounded-3 position-relative">
						<!-- Image -->
						<img src="./imgHabitaciones/h1.jpg" class="card-img img-fluid" alt="hotel image">
						<!-- Badge -->
						<div class="position-absolute bottom-0 start-0 p-3">
							<div class="badge text-bg-dark fs-6 rounded-pill stretched-link"><i class="bi bi-geo-alt me-2"></i>Individual</div>
						</div>
					</div>

					<!-- Card body -->
					<div class="card-body px-2 bg-light bg-opacity-25">
						<!-- Title -->
						<h5 class="card-title"><a href="hotel-detail.html" class="stretched-link">Habitacion 102</a></h5>
						<!-- Price and rating -->
						<div class="d-flex justify-content-between align-items-center">
							<h6 class="text-success mb-0">$30000 <small class="fw-light">/por noche</small> </h6>
							<h6 class="mb-0">Ver más<i class="fa-solid fa-star text-warning ms-1"></i></h6>
						</div>
					</div>
				</div>
				<!-- Card END -->
			</div>
		</div> <!-- Row END -->
	</div>
</section>
</body>
</html>