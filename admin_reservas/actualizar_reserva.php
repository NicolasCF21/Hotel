<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    if(!isset($_SESSION["Admin"])){ 
        header('Location: ../admin/login.php');
    }

    

    if(isset($_GET['error'])){
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
        <strong>ERROR</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo $_GET['error'];
        echo '</div>';
        
    }

    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_GET['id'];
    $sql = "SELECT * FROM RESERVAS WHERE id_reserva=$id";

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
        <?php
          if(isset($_SESSION["ErrorDB"])){
            echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
            <strong>ERROR</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo $_SESSION ["ErrorDB"];
            echo '</div>';
            
        }
        if(isset($_SESSION["Status"])){
            echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
            <strong>Exito</strong> La operación ha sido realizada.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
            
        }
        
            include '../modules/menu.php';
        ?>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-xl-10 col-sm-8 col-md-9 py-3">
                    <h3>Detalles de Reserva</h3>
                    <hr>
                    <?php 
                    $resulset = $con->query($sql);
                        while($fila = $resulset->fetch_assoc()){; ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating my-3">
                                    <input type="hidden" name="id_reserva" id="id_reserva" value="'<?php echo $fila['id_reserva']; ?>'">
                                    <input type="text" id="habitacion" name="habitacion" class="form-control" placeholder="Nombre Habitacion" value="<?php echo $fila['id_habitacion']; ?>  "required>
                                    <label for="habitacion">Habitacion Adquirida:</label>
                                </div>                                                                
                            </div>  
                            <div class="col-lg-6">
                                <div class="form-floating my-3">                                    
                                    <input type="text" id="servicio" name="servicio" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['id_servicio']; ?>  "required>
                                    <label for="servicio">Servicio Añadido:</label>
                                </div>                                                                
                            </div>  
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="ingreso" name="ingreso" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['fecha_ingreso']; ?>  "required disabled>
                                    <label for="ingreso">Fecha Ingreso:</label>
                                </div>                                                                
                            </div>  
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="salida" name="salida" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['fecha_salida']; ?>  "required disabled>
                                    <label for="salida">Fecha Salida:</label>
                                </div>                                                                
                            </div> 
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['cant_personas']; ?>  "required disabled>
                                    <label for="cantidad">Cantidad Personas:</label>
                                </div>                                                                
                            </div> 
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="pago" name="pago" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['total_pago']; ?>  "required disabled>
                                    <label for="pago">Total pago:</label>                                
                                </div>                                                                
                            </div>  
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <select name="estado" id="estado" class="form-select" aria-label="Default select example" required>
                                        <option selected value="<?php echo $fila['estado_reservacion']?>"><?php echo $fila['estado_reservacion']?></option>
                                        <option value="Confirmar">Confirmar</option>
                                        <option value="No confirmar">No confirmar</option>
                                    </select>
                                    <label for="estado">Estado de Reservación:</label>                                
                                </div>                                                                
                            </div>                          
                            
                            <h3>Información cliente</h3>                      

                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['nombres']; ?>  "required disabled>
                                    <label for="nombres">Nombres:</label>
                                </div>                                                                
                            </div>                        
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['apellidos']; ?>  "required disabled>
                                    <label for="apellidos">Apellidos:</label>
                                </div>                                                                
                            </div>                        
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="documento" name="documento" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['documento']; ?>  "required disabled>
                                    <label for="documento">Documento Identidad:</label>
                                </div>                                                                
                            </div>                        
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['telefono']; ?>  "required disabled>
                                    <label for="telefono">Telefono:</label>
                                </div>                                                                
                            </div>  
                            <div class="col-lg-6">                            
                                <div class="form-floating my-3">                                                                
                                    <input type="text" id="correo" name="correo" class="form-control" placeholder="Nombre Servicio" value="<?php echo $fila['correo']; ?>  "required disabled>
                                    <label for="correo">Correo Electronico:</label>
                                </div>                                                                
                            </div>                        
                        <?php }?>
                        </div>
                        <div class="text-center my  -3">
                            <input class="btn btn-success" type="submit" value="Actualizar"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>