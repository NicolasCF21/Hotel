<?php
function validateImage() {
    $directorio = "../imgHabitaciones/";
    $archivo = $directorio . basename($_FILES["imagen"]["name"]);

    if(move_uploaded_file($_FILES["imagen"]["name"], $archivo)){
        echo "<br>El archivo ".basename($_FILES["imagen"]["name"]." ha sido subido exitosamente!");
    }else{
        echo "Ha ocurrido un error.";
    }

    return $archivo;
}
?>