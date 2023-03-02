<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include '../controller/conexion.php';
    include '../config/seguridad.php';
    # Aquí pon la clave secreta que obtuviste en la página de developers de Google
define("CLAVE_SECRETA", "6LfsFFYjAAAAAHYwBdD19EtdsyAVHxWjoiiw77EI");

# Comprobamos si enviaron el dato
if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
    header("Location: perfil.php?mensaje=error");
    exit("Debes completar el captcha");
}

# Antes de comprobar usuario y contraseña, vemos si resolvieron el captcha
$token = $_POST["g-recaptcha-response"];
$verificado = verificarToken($token, CLAVE_SECRETA);
# Si no ha pasado la prueba
if ($verificado) {
    /**
     * Llegados a este punto podemos confirmar que el usuario
     * no es un robot. Aquí debes hacer lo que se deba hacer, es decir,
     * comprobar las credenciales, darle acceso, etcétera, pues
     * ya ha pasado el captcha
     */
    echo "Has completado la prueba :)";
} else {
    exit("Lo siento, parece que eres un robot");

}
/**
 * Verifica el token del captcha y regresa true o false
 * true en caso de que el usuario haya pasado la prueba
 * false en caso contrario
 */
function verificarToken($token, $claveSecreta)
{
    # La API en donde verificamos el token
    $url = "https://www.google.com/recaptcha/api/siteverify";
    # Los datos que enviamos a Google
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    // Crear opciones de la petición HTTP
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), # Agregar el contenido definido antes
        ),
    );
    # Preparar petición
    $contexto = stream_context_create($opciones);
    # Hacerla
    $resultado = file_get_contents($url, false, $contexto);
    # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
    # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
    # al servidor de Google
    if ($resultado === false) {
        # Error haciendo petición
        return false;
    }

    # En caso de que no haya regresado false, decodificamos con JSON
    # https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/

    $resultado = json_decode($resultado);
    # La variable que nos interesa para saber si el usuario pasó o no la prueba
    # está en success
    $pruebaPasada = $resultado->success;
    # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
    return $pruebaPasada;
}
    $conexion = new Conexion();
    $con = $conexion->conectarDB();
    $id = $_POST["id_usuario"];
    $nombre = $_POST['nombres'];
    $apellido =$_POST['apellidos'];
    $documento = $_POST['documento'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['email'];
    $limpieza = new Seguridad();
    $password=$limpieza->encriptarP($_POST["password"]);
    
    $sql = "UPDATE usuarios SET nombre_usuario='$nombre', apellido_usuario='$apellido', documento='$documento', telefono='$telefono', email='$correo', password='$password' WHERE id_usuario=$id";

    
    if($con->query($sql)===TRUE) {
        header ("Location: perfil.php?mensaje=correcto"); 
    }else{
        header ("Location: perfil.php?mensaje=error"); 
    }
?>