<?php
    $fecha1 = date_create($_POST['ingreso']);
    $fecha2 = date_create($_POST['salida']);
    $diferencia = $fecha1->diff($fecha2);
    
    echo $diferencia->d * 50000;
?>