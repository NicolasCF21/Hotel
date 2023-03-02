<?php
    class Seguridad {
        private $password;
        
        
        function limpiarP($password){
            $this->$password=htmlspecialchars($password);

            return $this->$password;
        }

        function encriptarP($password){
            $clean=$this->limpiarP($password);
            $cifrado="AES-128-CTR";
            $options=0;
            $iv_longitud=openssl_cipher_iv_length($cifrado);
            $encription_iv="1234567891011121";
            $encription_key="AdSi";
            $encriptado=openssl_encrypt($clean,$cifrado,$encription_key,
            $options,$encription_iv);

            return $encriptado;

        }
        
    }
    /*
    $limpieza = new Seguridad();
    //$frase= $limpieza->limpiarP('<a href ="test.php">Texto</a>');
    echo $frase;
    $texto = '<a href="test.php">Texto</a>';
    $password = $limpieza->encriptarP($texto);
    echo "La contraseña limpia y codificada seria: ".$password;
    */
?>