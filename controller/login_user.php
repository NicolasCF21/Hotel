<?php
    session_start();

    class Login{
        private $email;
        private $password;

        function inicio(){
            $email= $_POST["email"];
            include '../config/seguridad.php';
            $encriptar = new Seguridad();
            $password = $encriptar->encriptarP($_POST["password"]);

            include 'conexion.php';
            $conexion = new Conexion();
            $con = $conexion->conectarDB();
            $sql = "SELECT * FROM USUARIOS
            WHERE email='".$email."'AND password='".$password."';";
            $resulset = $con->query($sql);

            if($resulset->num_rows>0){
                while($fila=$resulset->fetch_assoc()){
                    $_SESSION["Usuario"]=$fila["id_usuario"];
                    header('Location:../user/indexU.php');
                }
            }else{
                $_SESSION["Error"]="¡Credenciales de acceso incorrectos. Intente nuevamente!";
                header('Location:../user/login.php');
            }
            
            $con->close();
            
        }
    }
    $init = new Login();
    $init->inicio();


?>