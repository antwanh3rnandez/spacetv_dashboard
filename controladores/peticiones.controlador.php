<?php 

class Peticiones{

    //Insertar peticion nueva
    public static function newPeticion()
    {
        if (isset($_POST['submit'])) {
            // Recogemos los valores del formulario
            $usuario = $_POST["usuario"];
            $tipo = $_POST["tipo"];
            $titulo = $_POST["titulo"];
            $anio = $_POST["anio"];
            $director = $_POST["director"];
            $estado = 1;

            // Preparamos la consulta SQL para insertar los datos en la tabla
            $stmt = Conexion::conectar()->prepare("INSERT INTO peticiones (usuario, tipo, titulo, a_titulo, director, estado) VALUES (?, ?, ?, ?, ?, ?)");

            // Ejecutamos la consulta con los valores del formulario
            // $stmt->execute([$usuario, $tipo, $titulo, $anio, $director, $estado]);

            if ($stmt->execute([$usuario, $tipo, $titulo, $anio, $director, $estado])) {
                return true;
            } else {
                print_r(Conexion::conectar()->errorInfo());
            }
        } else {
            return false;
        }
    }

    //Obtener peticiones totales por usuario
    public static function GetPeticiones($user)
    {
        if ($user !== null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM `peticiones` WHERE usuario = '$user'");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return $export;
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM `peticiones`");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // return $export;
        }
    }

    //Obtener peticiones por estatus y usuario
    public static function GetPeticionesStatus($user,$estado)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM `peticiones` WHERE usuario = '$user' AND estado = '$estado'");
        $stmt->execute();
        $export = $stmt->fetch(PDO::FETCH_ASSOC);
        return $export;
    }

    //Obtener peticiones totales de todos los usuarios (Count)
    public static function GetAllCount()
    {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `peticiones`");
        $stmt->execute();
        $export = $stmt->fetch(PDO::FETCH_ASSOC);
        return $export['count'];
    }

    //Obtener peticiones totales por usuario (Contador)
    public static function GetPeticionesCount($user)
    {
        if ($user !== null) {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `peticiones` WHERE usuario = '$user'");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `peticiones`");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }
    }

    //Obtener peticiones por estatus y usuario (Contador)
    public static function GetPeticionesStatusCount($user,$estado)
    {
        if ($user !== null) {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `peticiones` WHERE usuario = '$user' AND estado = '$estado'");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }else{
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as count FROM `peticiones` WHERE estado = '$estado'");
            $stmt->execute();
            $export = $stmt->fetch(PDO::FETCH_ASSOC);
            return $export['count'];
        }
    }

    


   
}

?>