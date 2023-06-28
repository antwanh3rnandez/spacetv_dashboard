<?php
class AccessLog{

    //Insertar peticion nueva
    public static function newAccess($username, $type, $ip_address, $user_agent)
    {
        // if (isset($_POST['login'])) {
            // Recogemos los valores del formulario
            $usuario = $username;
            $tipo = $type;
            $ip = $ip_address;
            $userAgent = $user_agent;

            // Preparamos la consulta SQL para insertar los datos en la tabla
            $stmt = Conexion::conectar()->prepare("INSERT INTO access_log (usuario, tipo, ip, user_agent) VALUES (?, ?, ?, ?)");

            // Ejecutamos la consulta con los valores del formulario
            if ($stmt->execute([$usuario, $tipo, $ip, $userAgent])) {
                return true;
            } else {
                print_r(Conexion::conectar()->errorInfo());
            }
        // } else {
        //     return false;
        // }
    }

    public static function getAccessLog(){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM access_log");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAccessLogUser($user){
        $stmt = Conexion::conectar()->prepare("SELECT id, usuario, tipo, fecha FROM access_log WHERE usuario = '$user'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>