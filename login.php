<?php

// Obtener la dirección IP del cliente
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
}

// Obtener el User-Agent del cliente
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if(isset($_SESSION["session_username"])){
    echo("<script>window.location = 'dashboard.php';</script>");
}
 
if(isset($_POST["login"])){

 
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];

        if(false === ($str = @file_get_contents("http://158.69.225.52:25461/player_api.php?username=".$username."&password=".$password.""))){
            $message = 'Cuenta expirada ó datos ingresados invalidos!';
        }else{

            $json = json_decode($str, true); // decode the JSON into an associative array

            // get the data
            $se_username = isset($json['user_info']['username']) ? $json['user_info']['username'] : '';
            $se_password = isset($json['user_info']['password']) ? $json['user_info']['password'] : '';
            $auth = isset($json['user_info']['auth']) ? $json['user_info']['auth'] : '';
            $status = isset($json['user_info']['status']) ? $json['user_info']['status'] : '';
            $exp_date = isset($json['user_info']['exp_date']) ? $json['user_info']['exp_date'] : 32521737600;
            $created_at = isset($json['user_info']['created_at']) ? $json['user_info']['created_at'] : '';
            $max_connections = isset($json['user_info']['max_connections']) ? $json['user_info']['max_connections'] : '';

            if($username == $se_username && $password == $se_password && $status == "Active"){

                $newRow = AccessLog::newAccess($username, "Entrada", $ip_address, $user_agent);
            
                if ($newRow) {

                    $crearPerfil = Perfil::crearPerfil($username, $password);

                    if ($crearPerfil || !$crearPerfil) {
                        
                        $_SESSION['session_username']=$username;
                        $_SESSION['session_password']=$password;
                        $_SESSION['session_exp_date']=$exp_date;
                        $_SESSION['session_created_at']=$created_at;
                        $_SESSION['session_max_connections']=$max_connections;
                    
                        echo("<script>window.location = 'index.php';</script>");

                    }
                }

            }else{
                $message = "Su cuenta esta expirada";
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaceTV+ - Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/spacetv-logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="assets/img/spacetv-logo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        

    </style>
</head>
<body>

    <div class="login-box">
    <img class="logo" src="assets/img/spacetv-logo.png">
        <h2>Iniciar sesión</h2>
        <form method="POST" enctype="multipart/form-data">
          <div class="user-box">
            <input type="text" class="form-control" id="username" name="username" required="">
            <label>Usuario</label>
          </div>
          <div class="user-box">
                <input type="password" class="form-control" id="password" name="password" required="">
                <span id="imgContrasena" data-activo=false><img src="https://cdn3.iconfinder.com/data/icons/show-and-hide-password/100/show_hide_password-09-256.png" class="icon"></span>
                <label>Contraseña</label>
          </div>
          <!-- <div class="user-box">
              <input type="checkbox" class="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'">
              <p class="checkbox-label">Mostrar Contraseña</p>
          </div> -->
          <button type="submit" name="login">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Iniciar
          </button>
        </form>
        <div class="user-box" style="display: flex; align-items: center;">
            <?php if (!empty($message)) {echo "<p class='error'>" . $message . "</p>";} ?>
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>
        $("#imgContrasena").click(function () {

            let control = $(this);
            let estatus = control.data('activo');
            let image = control.find('img');
            if (estatus == false) {
                control.data('activo', true);
                $(image).attr('src', 'https://cdn3.iconfinder.com/data/icons/show-and-hide-password/100/show_hide_password-10-256.png');
                $("#password").attr('type', 'text');
            }
            else {
                control.data('activo', false);
                $(image).attr('src', 'https://cdn3.iconfinder.com/data/icons/show-and-hide-password/100/show_hide_password-09-256.png');
                $("#password").attr('type', 'password');
            }
        });
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.1.18/jquery.backstretch.min.js" integrity="sha512-bXc1hnpHIf7iKIkKlTX4x0A0zwTiD/FjGTy7rxUERPZIkHgznXrN/2qipZuKp/M3MIcVIdjF4siFugoIc2fL0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
		
		$.backstretch([
			"assets/img/bg/ALT3.png"
			, "assets/img/bg/2.jpg"
			, "assets/img/bg/3.jpg"
			
			
		], {duration: 0, fade: 2000});
		
	</script>
      
</body>
</html>