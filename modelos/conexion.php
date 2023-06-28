<?php

class Conexion{

    public static function conectar()
    {

        if ($_SERVER['HTTP_HOST'] == '127.0.0.1') {
            $servername = '127.0.0.1';
            $username = 'root';
            $password = "";
            $db = 'spacetv_dashboard';
        }else{
            $servername = 'localhost';
            $username = 'newuser';
            $password = 'jorgeantwan$1234';
            $db = 'spacetv_dashboard';
        }

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
            $connection->exec("set names utf8");
            return $connection;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

?>