<?php
    class Conexion{
        private $servidor = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "hotel2";

        function conectarDB(){
            try {
                $conexion = "mysql:host=".$this->servidor."; dbname=".$this->database;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $pdo = new PDO($conexion, $this->user, $this->password,$options);                
                return $pdo;
            } catch (PDOException $e) {
                echo 'Error conexion'.$e->getMessage();
                exit;
            }            
        }
        
    }

?>