<?php

class Perfil{

    public static function getPerfil($user, $pass)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM `usuarios` WHERE username = '$user' AND password = '$pass'");
        $stmt->execute();
        $export = $stmt->fetch(PDO::FETCH_ASSOC);
        return $export;

    }

    public static function crearPerfil($user, $pass)
    {

        //Validamos que no exista un perfil para dicho usuario
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `usuarios` WHERE username = '$user' AND password = '$pass'");
        $stmt->execute();
        $export = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $export['count'];

        if ($count < 1) {

            // Inicializamos variables
            $username = $user;
            $password = $pass;
            $foto_default = "undraw_profile.svg";
            $sidebar_color = "dark";

            // Preparamos la consulta SQL para insertar los datos en la tabla
            $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (username, password, foto_perfil, sidebar_color) VALUES (?, ?, ?, ?)");

            // Ejecutamos la consulta con los valores del formulario
            if ($stmt->execute([$username, $password, $foto_default, $sidebar_color])) {
                return true;
            } else {
                print_r(Conexion::conectar()->errorInfo());
            }

        }
    }

    public static function editarPerfil()
    {
        if (isset($_POST['submit'])) {

            $username = $_POST['usuario'];
            $password = $_POST['password'];
            $foto = $_FILES["foto"];
            
            // Verificar si se subió una imagen
            if ($foto["size"] > 0) {
                // Verificar si es una imagen válida
                if (strpos($foto["type"], "image/") !== 0) {
                    die("Error: El archivo subido no es una imagen válida.");
                }
                
                // Crear un nombre único para la imagen
                $extension = pathinfo($foto["name"], PATHINFO_EXTENSION);
                $nombre_archivo = uniqid() . "." . $extension;
                
                // Mover la imagen al directorio de uploads
                $uploads_dir = "uploads/";
                if (move_uploaded_file($foto["tmp_name"], $uploads_dir . $nombre_archivo)) {
                    
                    $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET foto_perfil=:foto_perfil WHERE username=:username AND password=:password");
                    $stmt->bindParam(':foto_perfil', $nombre_archivo);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    
                    if ($stmt->execute()) {
                        return true;
                    } else {
                        print_r(Conexion::conectar()->errorInfo());
                    }
                } else {
                    return false;
                }

            }
        }
    }

    public static function editarDatos($user, $pass)
    {
        if (isset($_POST['submit'])) {

            $username = $user;
            $password = $pass;
            
            $correo = $_POST['correo'];
            $celular = $_POST['celular'];
            $telegram = $_POST['telegram'];
            $countryCode = $_POST['countrycode'];
            $whatsapp = $_POST['whatsapp'];
            $w = '+'.$countryCode.$whatsapp;

            $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET correo=:correo, celular=:celular, telegram=:telegram, country_whatsapp=:countryCode, whatsapp=:whatsapp WHERE username=:username AND password=:password");
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':telegram', $telegram);
            $stmt->bindParam(':countryCode', $countryCode);
            $stmt->bindParam(':whatsapp', $w);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            if($stmt->execute()) {
                return true;
            } else{
                print_r(Conexion::conectar()->errorInfo());
            }

        }
    }

    public static function editarPreferencias($user, $pass)
    {
        if (isset($_POST['submit'])) {
            
            $username = $user;
            $password = $pass;

            $sidebar_color = $_POST['color-select'];

            $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET sidebar_color=:sidebar_color WHERE username=:username AND password=:password");
            $stmt->bindParam(':sidebar_color', $sidebar_color);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                return true;
            }else{
                print_r(Conexion::conectar()->errorInfo());
            }

        }
    }

    public static function getUsers()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM `usuarios`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUsersCount($type)
    {
        if ($type == null) 
        {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `usuarios`");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }elseif ($type == 'conwpp') 
        {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `usuarios` WHERE whatsapp IS NOT NULL");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }elseif ($type == 'sinwpp') 
        {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `usuarios` WHERE whatsapp IS NULL");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }
    }
}

?>