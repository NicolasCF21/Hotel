<script>
$("#reservar").click(function(){
            var usuario = $("#usuario").val();
            var habitacion = $("#habitacion").val();
            var servicio = $("#servicio").val();
            var ingreso = $("#ingreso").val();
            var salida = $("#salida").val();
            var personas = $("#cantidad").val();
            var pago = $("#pago").val();
            alert(ingreso);
            return false;

            $.ajax({
            type: "POST",
            url: "registro_reservacion.php",//Hace referencia al action del formulario
            data: {
                usuario: usuario,
                habitacion: habitacion,
                servicio: servicio,
                ingreso: ingreso,
                salida: salida,
                personas: personas,
                pago: pago                      
                },
                cache : false,
                success: function(data){
                    alert(data);
                },
                        //xhr captura el codigo del error para que el navegador lo recibiera
                error: function(xhr, status, error){
                    console.error(xhr)
                }
            });
        });
</script>