<?php
  session_start();
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
</head>
<body>
  <div class="mt-5 ms-5">
    <form action="diferencia.php" method="POST">
    <?php 
      $fechaActual =  date("Y-m-d");
      echo $fechaActual."<br>";
    ?>
        <input type="date" name="ingreso" id="ingreso" placeholder="Fecha ingreso" min="<?= $fechaActual ?>">
        <input type="date" name="salida" id="salida" placeholder="Fecha salida">
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
  </div>
  <div>
    <h1>Date</h1>
   
  </div>
</body>
</html>