<?php
$servername="localhost";
$username="root";
$password="";
$dbname="HOTEL2";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$meses = array();
$total = array();

for ($i = 1; $i <= 12; $i++) {
    $result = mysqli_query($conn, "SELECT SUM(total_pago) AS total FROM reservacion WHERE MONTH(fecha_reservacion)=$i AND YEAR(fecha_reservacion) = YEAR(NOW())");
    $row = mysqli_fetch_array($result);
    array_push($meses, "Mes " . $i);
    array_push($total, $row['total']);
}

$data = array(
    'labels' => ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    'datasets' => array(
        array(
            'label' => 'Ingresos',
            'data' => $total,
            'backgroundColor' => [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
              ],    
            'borderColor' => [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],            
            'borderWidth' => 1
        )
    )
);

$json_data = json_encode($data);

mysqli_close($conn);
?>
var pagosPorMesData = <?php echo $json_data; ?>;
