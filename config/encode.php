<?php
    
        //opne SSL
        // La frase a encriptar
        $frase = "mensaje en php";
        echo "La frase original es: " .$frase;

        //Protocolo de cifrado
        $cifrado = "AES-128-CTR"; //AES, se usa para cifrar datos y protegerlos.

        //Usar OpenSSl
        $liv_longitud = openssl_cipher_iv_length($cifrado);
        $options = 0;

        //Inicializar Vector para encriptar
        $encription_iv ="1234567891011121";

        //Guaradar nuestra llave de encripcion
        $encription_key ="AdSi";

        //Encriptar
        $encriptado  = openssl_encrypt($frase,$cifrado,$encription_key,
        $options,$encription_iv);
        echo "<br>".$encriptado;
        
        //Desencriptar
        $decryption_iv = $encription_iv;
        $decryption_key = $encription_key;

        $desencriptado = openssl_decrypt($encriptado,$cifrado,$decryption_key,$options,$decryption_iv);
        echo "<br> Mensaje Decodificado: ".$desencriptado;
        echo "<br>";

        //limpieza de caracteres
        $frase2 ='<a href="script.js">Enlace para el hack</a>';
        echo htmlspecialchars($frase2);
        


    
?>