<?php
// Establecer la conexión con la base de datos
$conn = mysqli_connect("localhost", "root", "", "hotel2");

// Obtener el número total de filas
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM servicio WHERE nombre_servicio <> 'Sin servicio'");
$row = mysqli_fetch_assoc($result);
$total_filas = $row["total"];

// Establecer el número de filas por página
$filas_por_pagina = 2;

// Obtener el número total de páginas
$total_paginas = ceil($total_filas / $filas_por_pagina);

// Obtener la página actual
if (isset($_GET["pagina"])) {
  $pagina_actual = $_GET["pagina"];
} else {
  $pagina_actual = 1;
}

// Calcular el índice de la primera fila en la página actual
$primer_indice = ($pagina_actual - 1) * $filas_por_pagina;

// Obtener las filas de la página actual
$query = "SELECT * FROM servicio WHERE nombre_servicio <> 'Sin servicio' LIMIT $primer_indice, $filas_por_pagina";
$result = mysqli_query($conn, $query);

// Crear un array con los datos de las filas
$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode(array(
  "total_paginas" => $total_paginas,
  "filas" => $rows
));
?>
