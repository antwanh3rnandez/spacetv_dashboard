<?php 
session_start();

require_once('modelos/conexion.php');
require_once('controladores/access_log.controlador.php');

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

$newRow = AccessLog::newAccess($_SESSION['session_username'], "Salida", $ip_address, $user_agent);

if ($newRow) {
    unset($_SESSION['session_username']);
    unset($_SESSION['session_password']);
    unset($_SESSION['session_exp_date']);
    unset($_SESSION['session_max_connections']);
    session_destroy();
    echo("<script>window.location = 'index.php';</script>");
}
?>
