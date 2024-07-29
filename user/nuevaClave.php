<?php
     session_start();
    if($_REQUEST['tokenUser'] !="" && $_REQUEST['id'] !=""){        
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="http://localhost/hotel/img/Logo2.png">
        <title>Pagina Hotel</title>
        <meta charset="UTF-8">          
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../libs/bootstrap-icons/bootstrap-icons.css">
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery-3.6.1.min.js"></script>
        <style>
            span{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
    <?php
        include '../modules/menu.php';    
    ?>        
    
        <div class="max-w-screen-lg mx-auto">
            <div class="container  h-100 d-flex px-0  px-sm-4 my-3">
                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-lg-12">
                        <div class="shadow-lg rounded-3 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1 bg-light bg-opacity-50">
                                    <div class="p-3 p-lg-5">
                                        <img src="../img/password.svg" alt="imagen" class="img-fluid" style="width:500px;">
                                    </div>
                                    <div class="vr opacity-4 d-none d-block"></div>
                                </div>
                                <div class="col-lg-6 order-1">
                                    <div class="p-4 p-sm-5">
                                        <a href="http://localhost/hotel/index.php">
                                            <img src="../img/Logo1.png" alt="Logo" class="mb-4" style="max-width:180px">
                                        </a>
                                        <h1 class="mb-2 h3 fw-bold">Restaurar Contraseña</h1>
                                        <form action="updateClave.php" method="POST"  id="form">                                            
                                            <div class="">                                                                                                        
                                                <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id']; ?>">
                                                <input type="hidden" id="token" name="token" value="<?php echo $_REQUEST['tokenUser']; ?>">
                                                <div class="mb-3 mt-4 position-relative">
                                                    <label for="psw1">Nueva contraseña</label>
                                                    <input type="password" class="form-control mt-1" id="psw1" name="psw1" placeholder="Nueva contraseña" required>                                                    
                                                    <span class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3 me-2 bi bi-eye-slash-fill" id="pass2" action="hide"></span>                                      
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label for="psw2">Confirmar contraseña</label>  
                                                    <input type="password" class="form-control mt-1" id="psw2" name="psw2" placeholder="Confirmar contraseña" required>                                                    
                                                    <span class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3 me-2 bi bi-eye-slash-fill" id="pass" action="hide"></span>                                      
                                                </div> 
                                                <!-- alertas-->
                                                <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert" id="success-alert" style="display:none;"><i class="bi bi-check-circle-fill me-2"></i>
                                                    Contraseña restaurada con éxito.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>                                      
                                                <div class="alert alert-danger alert-dismissible fade show mt-2" id="alerta" style="display:none;" role="alert"><i class="bi bi-exclamation-circle-fill me-2"></i>
                                                    Las contraseñas no coinciden
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="text-center mt-4 d-grid">
                                                    <input type="submit" id="cambio" name="cambio" value="Restaurar Contraseña" class="btn btn-primary rounded-pill"/>
                                                </div>                                      
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>        
        <script>
            $(document).ready(function(){
                $('#pass').click(function(){
                    if ($('#psw2').attr('type') == 'password') {
                        $('#psw2').attr('type', 'text');                        
                        $('#pass').addClass('bi-eye-fill').removeClass('bi-eye-slash-fill');
                    } else {
                        $('#psw2').attr('type', 'password');
                        $('#pass').addClass('bi-eye-slash-fill').removeClass('bi-eye-fill');
                    }
                });
            });
            $(document).ready(function(){
                $('#pass2').click(function(){
                    if ($('#psw1').attr('type') == 'password') {
                        $('#psw1').attr('type', 'text');                        
                        $('#pass2').addClass('bi-eye-fill').removeClass('bi-eye-slash-fill');
                    } else {
                        $('#psw1').attr('type', 'password');
                        $('#pass2').addClass('bi-eye-slash-fill').removeClass('bi-eye-fill');
                    }
                });
            });
            $(document).ready(function() {
                $('#form').submit(function(event) {
                    event.preventDefault(); // evita que el formulario se envíe automáticamente

                    // obtiene los datos del formulario
                    var id = $('#id').val();
                    var token = $('#token').val();
                    var psw1 = $('#psw1').val();
                    var psw2 = $('#psw2').val();
                    console.log(id);
                    console.log(token);
                    console.log(psw1);                    
                    console.log(psw2);                    
                    if (psw1 !== psw2) {
                        $('#alerta').show();
                        return;
                    }else {
                        $.ajax({
                            type: 'POST',
                            url: 'updateClave.php',
                            data: {id: id, token: token, psw1: psw1, psw2: psw2},                            
                            success: function(response) {
                                if (reponse='success') {
                                    $('#success-alert').show();
                                } else {
                                    $('#error-alert').show();
                                }
                            }
                        });
                    }

                });
            });

        </script>
        
    </body> 
</html>
<?php
    }else{
        $_SESSION['errorCon'] = "No ha solicitado el proceso de restablecer contraseña";
        header("location: http://localhost/hotel/user/login.php");
    }
?>