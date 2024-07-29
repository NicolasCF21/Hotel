<?php    
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    class reserva{
        function reservacion(){
            $conexion = new Conexion();
            $con = $conexion->conectarDB();        
            $ingreso = $_POST['ingreso'];
            $salida = $_POST['salida'];
            $usuario = $_POST['usuario'];
            $servicio = $_POST['servicio'];
            $habitacion = $_POST['habitacion'];
            $cantidadP = $_POST['personas'];
            $precio = $_POST['precio'];
            $pago = $_POST['pago'];
            $pagos = "En linea";
            $srv=5;

            $conn = $conexion->conectarDB();
            //Seleccionar el id de la hbitacion y tomar la cantidad de reservaciones
            $sen = "SELECT * FROM habitacion WHERE id_habitacion=$habitacion";
            $rs=$conn->query($sen);
            while ($fila = $rs->fetch_assoc()) {
                $cantidad=$fila["cant_reservas"];                
            }
            $conn->close();
            //Seleccionar el correo del usuario para enviarle la confirmacion de la reserva
            $conn = $conexion->conectarDB();
            $sen = "SELECT * FROM usuarios WHERE id_usuario='$usuario'";
            $rs=$conn->query($sen);
            while ($fila = $rs->fetch_assoc()) {
                $user=$fila["email"];                
            }
            $conn->close();

            $cant_reservas=$cantidad+1;
            
            $validar="SELECT id_habitacion FROM habitacion WHERE (id_estado='5' OR id_estado='2') AND id_habitacion=$habitacion;";
            $validando=$con->query($validar);
            if($validando->num_rows>0){                        
                header("Location: habitacion.php?id=$habitacion&mensaje=reservada");
            }
            
            elseif(!empty($servicio)){                      
                $sql="INSERT INTO reservacion (id_usuario, id_habitacion ,id_servicio, fecha_ingreso, fecha_salida, cantidad_personas, forma_pago, estado_reservacion, total_pago)
                VALUES('".$usuario."','".$habitacion."','".$servicio."','".$ingreso."','".$salida."','".$cantidadP."','".$pagos."','Registrada','".$pago."');";                
                               
            }else{                                                
                $sql="INSERT INTO reservacion (id_usuario, id_habitacion ,id_servicio, fecha_ingreso, fecha_salida, cantidad_personas, forma_pago, estado_reservacion, total_pago)
                VALUES('".$usuario."','".$habitacion."','".$srv."','".$ingreso."','".$salida."','".$cantidadP."','".$pagos."','Registrada','".$pago."');";                
                
            }
            
            
            if($con->query($sql)===TRUE){                    
                $sentencia="UPDATE habitacion SET id_estado='5',cant_reservas='$cant_reservas' WHERE id_habitacion=$habitacion";
                if($con->query($sentencia)===TRUE){
                    $senten="SELECT id_reservacion FROM reservacion ORDER BY id_reservacion DESC LIMIT 1;";
                    $res=$con->query($senten);
                    if ($res->num_rows>0) {
                        while ($fila=$res->fetch_assoc()) {
                            echo $id = $fila["id_reservacion"];
                            header("Location: ./pago.php"); 
                        }
                         
                    };                
                }             
            }else{
                echo $con->error;
            }
        }
    }
    $con = new reserva();
    $con->reservacion();
    
?>