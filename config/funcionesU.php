<?php
    function registrarUsuario(array $datos, $conexion){
        $sql = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, apellido_usuario, email, telefono, documento, fecha_nacimiento, password) VALUES(?,?,?,?,?,?,?);");
        if ($sql->execute($datos)) {
            return true;
        }
        return false;    
    }
    function esNulo(array $parametros){
        foreach($parametros as $parametro)
        if(strlen(trim($parametro)) < 1){
            return true;
        }
        return false;
    }
    function esEmail($email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    function validarPassword($password,$password2){
        if($password==$password2){
            return true;
        }
        return false;
    }
    function emailExiste($email, $conexion){
        $sql = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE email LIKE ? LIMIT 1");
        $sql->execute([$email]);
        if ($sql->fetchColumn() > 0) {
            return true;
        }
        return false;    
    }
    function documentoExiste($documento, $conexion){
        $sql = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE documento LIKE ? LIMIT 1");
        $sql->execute([$documento]);
        if ($sql->fetchColumn() > 0) {
            return true;
        }
        return false;    
    }
    function campoNombre($nombre){
        if(!preg_match("/^[a-zA-Zá-úÁ-Ú ñ-Ñ ]*$/",$nombre)){
            return true;
        }
        return false;
    }
    function campoApellido($apellido){
        if(!preg_match("/^[a-zA-Zá-úÁ-Ú ñ-Ñ ]*$/",$apellido)){
            return true;
        }
        return false;
    }
    function campoTelefono($telefono){
        if(!is_numeric($telefono)){
            return true;
        }
        return false;
    }
    function campoDocumento($documento){
        if(!is_numeric($documento)){
            return true;
        }
        return false;
    }
    function mayorEdad($edad){
        if ($edad>18) {            
            return true;
        }
        return false;
    }
    function mostrarMensajes(array $errors){
        if(count($errors)>0){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
            foreach($errors as $error){
                echo'<li>'.$error.'</li>';
            }
            echo '</ul>';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
  
        }
    }
?>
