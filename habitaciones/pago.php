<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE);
if(!isset($_SESSION["Usuario"])){
    header('Location: http://localhost/hotel/user/login.php');
}
date_default_timezone_set("America/Bogota");
include '../controller/conexion.php';
$conexion = new Conexion();
$con=$conexion->conectarDB();
$id=$_GET["id"];
$sql="SELECT id_reservacion, total_pago FROM reservacion ORDER BY id_reservacion DESC LIMIT 1;";
$res=$con->query($sql);
if($res->num_rows>0){
    while ($fila=$res->fetch_assoc()) {
        $pago = $fila["total_pago"];
    }
}
1236123681361873
?>
<!DOCTYPE html>
<head>
	<link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
	<title>Pagina Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://unpkg.com/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
    <script src="../js/jquery-3.6.1.min.js"></script> 
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <?php include '../modules/menu.php'; ?>
    <div class="container-fluid my-3"> 
    <?php
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'tarjeta') {
            echo '<div class="alert alert-warning mb-2 m-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-question-diamond-fill"></i> El número de tarjeta es invalido
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';        
        }
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'fecha') {
            echo '<div class="alert alert-warning mb-2 m-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-question-diamond-fill"></i> La fecha de la tarjeta es invalida
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';       
        }
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'codigo') {
            echo '<div class="alert alert-warning mb-2 m-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-question-diamond-fill"></i> El codigo de la tarjeta es invalido
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';           
        }
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'nombre') {
            echo '<div class="alert alert-warning mb-2 m-0 alert-dismissible fade show" role="alert">
                <i class="bi bi-question-diamond-fill"></i> Nombre de tarjeta es invalido
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';       
        }
    ?>       
        <div class="row g-5 justify-content-center">                          
            <div class="col-md-6 mb-5">
                <div class="p-4 rounded-4 shadow-lg">
                    <div class="row g-3">                                 
                        <div class="col-lg-12 mt-4">
                            <h3><i class="bi bi-wallet-fill"></i> Opciones de pago</h3>
                            <hr>
                        </div>
                        <div class="accordion accordion-icon accordion-bg-light" id="accordioncircle">								
								<div class="accordion-item mb-3">
									<h6 class="accordion-header" id="heading-1">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
											<i class="bi bi-credit-card text-primary me-2"></i>	<span class="me-5">Tarjeta Credito o Debito</span>
										</button>
									</h6>
									<div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordioncircle">									
										<div class="accordion-body">
											<div class="d-sm-flex justify-content-sm-between my-3">
												<h6 class="mb-2 mb-sm-0">Aceptamos:</h6>
												<ul class="list-inline my-0">
													<li class="list-inline-item"> <a><img src="../img/visa.png" style="max-width:40px;" alt=""></a></li>
													<li class="list-inline-item"> <a><img src="../img/american-express.png" style="max-width:40px;" alt=""></a></li>
													<li class="list-inline-item"> <a><img src="../img/visa (1).png" style="max-width:40px;" alt=""></a></li>
												</ul>
											</div>

											<form class="row g-3" action="procesar_pago.php" method="POST">										
												<div class="col-12">
                                                    <input type="hidden" name="tarjeta" id="tarjeta" value="tarjeta">
                                                    <input type="hidden" name="pago" id="pago" value="<?php echo $pago;?>">
													<label class="form-label" for="numeroTarjeta"><span class="h6 fw-normal">Número de tarjeta *</span></label>
													<div class="position-relative">
														<input type="text" class="form-control" maxlength="16" placeholder="XXXX XXXX XXXX XXXX" name="numeroTarjeta" id="numeroTarjeta">		
													</div>	
												</div>												
												<div class="col-lg-12">
													<label class="form-label"><span class="h6 fw-normal">Fecha de caducidad  *</span></label>
													<div class="input-group">
														<input type="text" class="form-control" maxlength="2" placeholder="Mes" name="mes">
														<input type="text" class="form-control" maxlength="4" placeholder="Año" name="anio">
													</div>
												</div>													
												<div class="col-lg-12">
													<label class="form-label"><span class="h6 fw-normal">CVV / CVC *</span></label>
													<input type="text" class="form-control" maxlength="4" placeholder="xxx" name="cvv">
												</div>							
												<div class="col-12">
													<label class="form-label"><span class="h6 fw-normal" >Nombre en la tarjeta *</span></label>
													<input type="text" class="form-control" aria-label="name of card holder" placeholder="Ingrese el nombre que aparece en la trajeta" name="nombre">
												</div>

												<div class="col-12 mt-3">
													<div class="d-sm-flex justify-content-sm-between align-items-center">
														<h4>$<?php echo $pago?> <span class="small fs-6"></span></h4>
														<button class="btn btn-primary mb-0" id="boton-tarjeta" type="submit">Pagar</button>
													</div>
												</div>

											</form>											
										</div>
									</div>
								</div>
						
								<div class="accordion-item mb-3">
									<h6 class="accordion-header" id="heading-2">
										<button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
											<i class="bi bi-globe2 text-primary me-2"></i> <span class="me-5">Transferencia bancaria</span>
										</button>
									</h6>
									<div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordioncircle">										
										<div class="accordion-body">
											<form class="row g-3 mt-1" action="procesar.php" method="POST">
												<ul class="list-inline mb-0">
													<li class="list-inline-item"> <h6 class="mb-0">Contamos con:</h6> </li>
													<li class="list-inline-item">
														<input type="radio" class="btn-check" name="options" id="option1">
														<label class="btn btn-light btn-primary-soft-check" for="option1">
														    Bancolombia
                                                            (03146738930)
														</label>
													</li>													
													<li class="list-inline-item">
														<input type="radio" class="btn-check" name="options" id="option2">
														<label class="btn btn-light btn-primary-soft-check" for="option2">
															Daviplata
                                                            (3217895783)
														</label>
													</li>													
													<li class="list-inline-item">
														<input type="radio" class="btn-check" name="options" id="option3">
														<label class="btn btn-light btn-primary-soft-check" for="option3">
															Nequi
                                                            (3140981627)
														</label>
													</li>
												</ul>

												<p class="mb-1">Para completar su transacción, seleccione su banco en la lista desplegable y haga clic en continuar para finalizar con su registrar su reservación</p>																								
												<div class="col-md-12">
													<select class="form-select" name="opcion">
														<option hidden>-- Seleccione su banco de preferencia --</option>
														<option value="Bancolombia">Bancolombia</option>
														<option value="Daviplata">Daviplata</option>
														<option value="Nequi">Nequi</option>
													</select>
												</div>		
                                                <div class="col-lg-12">
                                                    <label for="cuenta" class="form-label">Ingrese su numero de cuenta</label>
                                                    <input type="text" id="cuenta" name="cuenta" class="form-control">                                                    
                                                </div>										
												<div class="d-grid">
													<button class="btn btn-primary mb-0" type="submit">Pagar $<?php echo $pago;?></button>
												</div>

											</form>											
										</div>
									</div>
								</div>								
							</div>
                        </div>                    
                    </div>                
                </div>                
            </div>                    
        </div>             
    </div>     
    <?php
        include '../modules/footer.php';
    ?>
</body>
</html>
