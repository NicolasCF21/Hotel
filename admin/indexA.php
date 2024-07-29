<?php
    session_start();
    if(!isset($_SESSION["Admin"])){
        header('Location: login.php');
    }
    $admin = $_SESSION["Admin"];
    include '../controller/conexion.php';
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $seql = 'UPDATE habitacion h set h.id_estado="2" WHERE h.id_habitacion IN(
        SELECT r.id_habitacion FROM reservacion r WHERE r.fecha_ingreso=CURDATE()
    );';  
    if($con->query($seql)===TRUE){      
    }else{        
    }

    $sql = "UPDATE reservacion SET estado_reservacion = 'Finalizada' WHERE fecha_salida < CURDATE();";
    if ($con->query($sql)===TRUE) {
        $sentencia="UPDATE habitacion h SET h.id_estado = '1'
        WHERE h.id_habitacion IN (
           SELECT r.id_habitacion FROM reservacion r        
           WHERE r.estado_reservacion = 'Finalizada' AND r.fecha_salida = (
              SELECT MAX(r2.fecha_salida) FROM reservacion r2 WHERE r2.id_habitacion = r.id_habitacion
           )
        );";
        if ($con->query($sentencia)===TRUE) {  
        }else{
        }
    }
    $con->close();
    

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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>        
    </head>
    <body>
        <?php
            include '../modules/menu.php';
        ?>
        
                <?php
                    include '../modules/sidebar_admin.php';
                ?>
                <div class="col-lg-10 col-sm-10 col-md-9">
                    <div class="my-4">
                        <h2>Informacion General</h2>
                        <hr class="mx-2">
                    </div>

                    <div class="row g-2 my-3">
                        <div class="col-lg-12">  
                            <div class="card border-top-0 border-bottom-0 border-start-0 border-end-0 shadow">
                                <div class="card-body">
                                <h1 class="fs-5 text-center">Ingresos</h1>             
                            <div class="chart">                                
                                <canvas id="pago_por_mes" class="my-4 w-100" width="522" height="220" style="display: block; box-sizing: border-box; height: 220px; width: 522px;"></canvas>
                            </div>      
                                </div>
                            </div>             
                            
                        </div>                        
                        <div class="col-lg-6 col-sm-12 mt-3">
                            <div class="card border-top-0 border-bottom-0 border-start-0 border-end-0 shadow">
                                <div class="card-body">
                                    <h1 class="text-center fs-5">Habitaciones mas reservadas(mes actual)</h1> 
                                    <table class="table table-hover table-striped table_responsive text-center border">
                                        <thead>
                                            <tr>
                                                <th>Habitación</th><th>Cantidad reservas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php  
                                        $mes_actual = date("n");                                                            
                                        $conn = $conexion->conectarDB();                   
                                        $sql2="SELECT r.id_habitacion, COUNT(*) AS num_reservas, h.nombre_habitacion, h.id_habitacion
                                        FROM reservacion r JOIN habitacion h ON r.id_habitacion = h.id_habitacion
                                        WHERE MONTH(r.fecha_reservacion) = $mes_actual
                                        GROUP BY r.id_habitacion 
                                        ORDER BY num_reservas DESC 
                                        LIMIT 3";
                                    
                                        $rs = $conn->query($sql2);
                                            if($rs->num_rows>0){
                                                while($fila = $rs->fetch_assoc()){                                        
                                            echo    '<tr>                                                
                                                        <td>'.$fila["nombre_habitacion"].'</td>
                                                        <td>'.$fila["num_reservas"].'</td>
                                                    </tr>';
                                            }
                                        }
                                        ?>
                                            
                                        </tbody>                            
                                    </table>
                                </div>
                            </div>                        
                                
                                             
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-3">
                            <div class="card border-top-0 border-bottom-0 border-start-0 border-end-0 shadow">
                                <div class="card-body">
                                    <h1 class="fs-5 text-center">Reservaciones</h1>
                                        <div class="chart-2">
                                            <canvas id="reservas_por_mes" class="my-4 w-100" width="522" height="220" style="display: block; box-sizing: border-box; height: 220px; width: 522px;"></canvas>
                                        </div>    
                                </div>
                            </div>                            
                        </div>                        
                    </div>
                    
                </div>            
            </div>
        </div>        
    </body>
    <script src="procesar.php"></script>
    <script src="script.js"></script>
    <script src="procesar2.php"></script>
    <script src="sct.js"></script>
</html>