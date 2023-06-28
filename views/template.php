<?php

$perfil = Perfil::getPerfil($_SESSION['session_username'], $_SESSION['session_password']);

$whiteList = ['dashboard','solicitar','historial','access_log','perfil','datos','preferencias', 'renovar_cuenta'];
$whiteListAdmin = ['dashboard','solicitar','historial','access_log','perfil','datos','preferencias', 'renovar_cuenta', 'admin_peticiones', 'admin_usuarios', 'admin_access_log'];

if (isset($_GET['p'])) {
    if ($perfil['username'] == 'jorgehdz') {
        if (in_array($_GET['p'], $whiteListAdmin)) {
            $section = $_GET['p'];
        }else{
            $section = 'dashboard';
        }
    }else{
        if (in_array($_GET['p'], $whiteList)) {
            $section = $_GET['p'];
        }else{
            $section = 'dashboard';
        }
    }
}else{
    $section = 'dashboard';
}

//Admin 
$sectionClean = str_replace("_", " ", $section);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SpaceTV+ / <?=ucfirst($sectionClean)?></title> 
    <link rel="shortcut icon" href="assets/img/spacetv-logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="assets/img/spacetv-logo.png" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Librerias para paypal -->
    <?= 
    ($section == 'renovar_cuenta') ? 
    '<link href="assets/css/renovar.css" rel="stylesheet">' 
    : ''?>
    <?= 
    ($section == 'renovar_cuenta') ? 
        '<script src="assets/js/paypal/script.js"></script>' .
        '<script>
        function updatePrice(price, buttonElement, image) {
          let priceElement = document.getElementById("price");
          if (priceElement) {
            priceElement.innerText = price;
          }
          
          let buttons = document.querySelectorAll(".ms-text-center button");
          buttons.forEach(function(button) {
            button.classList.remove("selected");
          });
          
          if (buttonElement) {
            buttonElement.classList.add("selected");
          }
  
          let imageProduct = document.getElementById("image");
          if (imageProduct) {
            imageProduct.src = `assets/img/paquetes/` + image;
          }
        }
      </script>'
    : 
    '' ?>

    <style>
		.preview-img {
			max-width: 200px;
			max-height: 200px;
			border-radius: 50%;
            aspect-ratio: 1/1;
		}
	</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "components/sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <?php
            include('sections/' . $section . '.php');
            ?>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "components/footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realmente desea cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione cerrar para finalizar su sesión activa.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>   

    <script>
	// Función para previsualizar la imagen seleccionada
	function previewImage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('.preview-img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	// Event listener para detectar cambios en el input de imagen
	$('#foto').change(function() {
		previewImage(this);
	});
    </script>

    <script>
		function addCountry(){
            let clave = document.getElementById('countrycode').value;
            let preinput = document.getElementById('preinput');
            
            preinput.innerText = '+'+clave;
        }
	</script>

</body>

</html>
