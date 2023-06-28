<?php

date_default_timezone_set('America/Monterrey');
session_start();

require_once('modelos/conexion.php');
require_once('controladores/peticiones.controlador.php');
require_once('controladores/access_log.controlador.php');
require_once('controladores/perfil.controlador.php');

// print_r($_SESSION);
if (isset($_SESSION['session_username']) && !empty($_SESSION['session_username']) && isset($_SESSION['session_password']) && !empty($_SESSION['session_password']) ) {
    if (isset($_GET['logout'])) {
        header('location: ?');
        include('logout.php');
    } else {
        include('views/template.php');
    }
} else {
    include('login.php');
}


?>