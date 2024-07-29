<?php
$servername="localhost";
$username="root";
$password="";
$dbname="HOTEL2";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$meses = array();
$cantidades = array();

for ($i = 1; $i <= 12; $i++) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS cantidad_reservas FROM reservacion WHERE MONTH(fecha_reservacion)=$i AND YEAR(fecha_reservacion) = YEAR(NOW())");
    $row = mysqli_fetch_array($result);
    array_push($meses, "Mes " . $i);
    array_push($cantidades, $row['cantidad_reservas']);
}

$data = array(
    'labels' => ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    'datasets' => array(
        array(
            'label' => 'Reservas por mes',
            'data' => $cantidades,
            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            'borderColor' => 'rgba(54, 162, 235, 1)',            
            'borderWidth' => 1
        )
    )
);

$json_data = json_encode($data);

mysqli_close($conn);
?>
var reservasPorMesData = <?php echo $json_data; ?>;
