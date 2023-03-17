const formulario = document.forms["form1"];
var valores = "";

for (let i=0; i<formulario.length; i++) {
    valores += formulario[i].value+"<br>";// += es un contador
}

function validarNombre(user){
    let users = document.forms["form"]["nombre"].value;
    let letras = /^[a-zA-Zá-ú]+$/;
    if (letras.test(users)) {
        document.getElementById("verificarN").style.color = "green";
        document.getElementById("nombre").style.color = "green";
    }else{
        document.getElementById("verificarN").innerHTML = "El campo solo puede contener letras";
        document.getElementById("verificarN").style.color = "red";
        document.getElementById("nombre").style.borderColor = "red";
    }
}