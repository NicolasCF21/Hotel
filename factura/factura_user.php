<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../img/Logo1.png',10,20,60);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(40,10,utf8_decode('Factura Reservación'),0,0,'C');
    // Salto de línea
    $this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

include '../controller/conexion.php';
$conexion = new Conexion();
$con = $conexion->conectarDB();
$id = $_GET['id'];
$sql = "SELECT u.nombre_usuario, u.apellido_usuario, u.documento, u.telefono, u.email FROM reservacion r
JOIN usuarios u ON r.id_usuario = u.id_usuario
WHERE r.id_reservacion=$id";
$resultset = $con->query($sql);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->cell(70);
$pdf->cell(56,10,utf8_decode('Ciudad: Guateque-Boyáca'),0,0,"C");
$pdf->Ln(8);

$pdf->cell(70);
$pdf->cell(30,10,utf8_decode('Dirección: '),0,0,"C");
$pdf->cell(40);
$pdf->cell(50,10,utf8_decode('N° Factura '),1,0,"C");
$pdf->Ln(8);

$pdf->cell(60);
$pdf->cell(70,10,utf8_decode('Telefono: 3206482912'),0,0,"C");
$pdf->Ln(8);

$pdf->cell(60);
$pdf->cell(75,10,utf8_decode('Correo: hotel@gmail.com'),0,0,"C");
$pdf->Ln(20);

$pdf->cell(45,10,utf8_decode('Fecha: '.$fecha = date("Y-m-d").''),0,0,'');
$pdf->cell(53);
$pdf->cell(35,10,utf8_decode('Fecha Reservacion:'),0,0,'');
$con = $conexion->conectarDB();
$id = $_GET['id'];
$sql = "SELECT fecha_reservacion FROM reservacion 
WHERE id_reservacion=$id";
$resultset = $con->query($sql);
while($fila = $resultset->fetch_assoc()){
$pdf->cell(10,10,utf8_decode($fila['fecha_reservacion']),0,0,'');
}
$con->close();
$pdf->Ln(10);
$con = $conexion->conectarDB();
$id = $_GET['id'];
$sql = "SELECT u.nombre_usuario, u.apellido_usuario, u.documento, u.telefono, u.email FROM reservacion r
JOIN usuarios u ON r.id_usuario = u.id_usuario
WHERE r.id_reservacion=$id";
$resultset = $con->query($sql);
while($fila = $resultset->fetch_assoc()){
$pdf->cell(18,10,utf8_decode('Nombres:'),0,0,'');
//$pdf->SetFont('Arial','B');
$pdf->cell(10,10,utf8_decode($fila['nombre_usuario']),0,0,'');
$pdf->cell(70);
$pdf->cell(19,10,utf8_decode('Apellidos:'),0,0,'');
$pdf->cell(10,10,utf8_decode($fila['apellido_usuario']),0,0,'');
$pdf->Ln(10);

$pdf->cell(22,10,utf8_decode('Documento:'),0,0,'');
$pdf->cell(10,10,utf8_decode($fila['documento']),0,0,'');
$pdf->cell(66); 
$pdf->cell(18,10,utf8_decode('Telefono:'),0,0,'');
$pdf->cell(10,10,utf8_decode($fila['telefono']),0,0,'');
$pdf->Ln(10);

$pdf->cell(35,10,utf8_decode('Correo Electronico:'),0,0,'');
$pdf->cell(10,10,utf8_decode($fila['email']),0,0,'');
$pdf->Ln(20);
}
$con->close();

$con = $conexion->conectarDB();
$id = $_GET['id'];
$sql = "SELECT r.id_reservacion, r.fecha_ingreso, r.fecha_salida, r.estado_reservacion, r.cantidad_personas, r.total_pago, r.forma_pago, h.nombre_habitacion, h.precio_habitacion, s.nombre_servicio, s.tarifa_servicio FROM reservacion r
JOIN habitacion h ON r.id_habitacion = h.id_habitacion
JOIN servicio s ON r.id_servicio = s.id_servicio
WHERE r.id_reservacion=$id";
$resultset = $con->query($sql);
while($fila = $resultset->fetch_assoc()){
$pdf->cell(18);
$pdf->cell(10,10,utf8_decode('Resumen de la reservación:'),0,0,'C');
$pdf->Ln(10);

$pdf->cell(25,10,utf8_decode('N° Reserva'),1,0,'C');
$pdf->cell(32,10,utf8_decode('Habitación'),1,0,'C');
$pdf->cell(28,10,utf8_decode('Servicio'),1,0,'C');
$pdf->cell(25,10,utf8_decode('Ingreso'),1,0,'C');
$pdf->cell(25,10,utf8_decode('Salida'),1,0,'C');
$pdf->cell(23,10,utf8_decode('Personas'),1,0,'C');
$pdf->cell(32,10,utf8_decode('Forma Pago'),1,0,'C');

$pdf->Ln(10);
$pdf->cell(25,10,utf8_decode($fila['id_reservacion']),1,0,'C');
$pdf->cell(32,10,utf8_decode($fila['nombre_habitacion']),1,0);
$pdf->cell(28,10,utf8_decode($fila['nombre_servicio']),1,0,'C');
$pdf->cell(25,10,utf8_decode($fila['fecha_ingreso']),1,0,'C');
$pdf->cell(25,10,utf8_decode($fila['fecha_salida']),1,0,'C');
$pdf->cell(23,10,utf8_decode($fila['cantidad_personas']),1,0,'C');
$pdf->cell(32,10,utf8_decode($fila['forma_pago']),1,0,'C');

$pdf->Ln(15);
$pdf->cell(118);
$pdf->cell(36,10,utf8_decode('Servicios'),1,0,'C');
$pdf->cell(36,10,utf8_decode('Tarifas'),1,0,'C');
$pdf->Ln(10);
$pdf->cell(118);
$pdf->cell(36,10,utf8_decode('Habitación:'),1,0,'C');
$pdf->cell(36,10,utf8_decode('$ '.$fila['precio_habitacion']),1,0,'C');
$pdf->Ln(10);
$pdf->cell(118);
$pdf->cell(36,10,utf8_decode('Servicio:'),1,0,'C');
$pdf->cell(36,10,utf8_decode('$ '.$fila['tarifa_servicio']),1,0,'C');
$pdf->Ln(15);
$pdf->cell(190,10,utf8_decode('Total Pago: $ '.$fila['total_pago']),1,0,'');


}
$pdf->Output();
?>