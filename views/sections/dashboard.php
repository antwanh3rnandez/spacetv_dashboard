<?php

//Formato de Fecha 'Unix Time' Valida hasta el 2030
$hoy = date("U", time());
$expira = $_SESSION['session_exp_date'];
// $expiracion = date('d-m-Y', $expira);
// Calculamos los días restantes de servicio
$diasRestantes = round(($expira - $hoy) / (60 * 60 * 24));

// Asignamos un porcentaje y un color según el rango de días restantes
if ($diasRestantes <= 10) {
    $porcentaje = 0;
    $color = "danger";
}elseif ($diasRestantes <= 20) {
    $porcentaje = 10;
    $color = "danger";
}elseif ($diasRestantes <= 30) {
    $porcentaje = 20;
    $color = "warning";
}elseif ($diasRestantes <= 40) {
    $porcentaje = 30;
    $color = "warning";
}elseif ($diasRestantes <= 50) {
    $porcentaje = 40;
    $color = "info";
}elseif ($diasRestantes <= 60) {
    $porcentaje = 50;
    $color = "info";
}elseif ($diasRestantes <= 70) {
    $porcentaje = 60;
    $color = "primary";
}elseif ($diasRestantes <= 80) {
    $porcentaje = 70;
    $color = "primary";
}elseif ($diasRestantes <= 90) {
    $porcentaje = 80;
    $color = "sucess";
}elseif ($diasRestantes <= 100) {
    $porcentaje = 90;
    $color = "success";
}else {
    $porcentaje = 100;
    $color = "success";
}

//Fecha de creacion en -Unix Time
$createAt = intval($_SESSION['session_created_at']);

//Comparamos fecha de creacion con fecha actual para obtener antiguedad
$antiguedadSegundos = $hoy - $createAt;
//Antiguedad en años (Año Unix = 31536000)
$antiguedad = $antiguedadSegundos / 31536000;
$antiguedadFormat = number_format($antiguedad, 2, '.', '');

//Peticiones
$enviadas = Peticiones::GetPeticionesStatusCount($_SESSION['session_username'],1);
$descartadas = Peticiones::GetPeticionesStatusCount($_SESSION['session_username'],2);
$completadas = Peticiones::GetPeticionesStatusCount($_SESSION['session_username'],3);
$totales = Peticiones::GetPeticionesCount($_SESSION['session_username']);
?>

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include "components/topbar.php";?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <div class="justify-content-end">
                    <a href="https://chat.whatsapp.com/EZw7R28G6ux1vvSDePSpdu" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                            class="fab fa-whatsapp fa-sm text-white-60"></i> Grupo Oficial</a>
                    <a href="https://t.me/joinchat/QhtIUmZElIMr36Jj" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i
                            class="fab fa-telegram fa-sm text-white-60"></i> Grupo Oficial</a>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Usuario</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $_SESSION['session_username']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Contraseña</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $_SESSION['session_password']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-lock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?= $color; ?> shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-<?= $color; ?> text-uppercase mb-1">Dias de Servicio Restante
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= ($diasRestantes > 5000) ? 'Unlimited' : $diasRestantes ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Conexiones Simultaneas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $_SESSION['session_max_connections']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Peticiones</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Acciones:</div>
                                    <a class="dropdown-item" href="?p=solicitar">Solicitar Peticion</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="?p=historial">Historial de Peticiones</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex pb-2 text-center">
                                        <div class="col mx-2">
                                            <div class="h5 font-weight-bold text-gray-600">Procesando</div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2 pb-2 text-center">
                                        <div class="col card mx-2 py-3 border-bottom-warning">
                                            <div class="card-body">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$enviadas;?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 text-center">
                                        <div class="col mx-2">
                                            <div class="p font-weight-light text-gray-800 text-nowrap">Se están procesando</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex pb-2 text-center">
                                        <div class="col mx-2">
                                            <div class="h5 font-weight-bold text-gray-600">Descartadas</div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2 pb-2 text-center">
                                        <div class="col card mx-2 py-3 border-bottom-danger">
                                            <div class="card-body">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$descartadas;?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 text-center">
                                        <div class="col mx-2">
                                            <div class="p font-weight-light text-gray-800 text-nowrap">No se encontro en internet</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex pb-2 text-center">
                                        <div class="col mx-2">
                                            <div class="h5 font-weight-bold text-gray-600">Completadas</div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2 pb-2 text-center">
                                        <div class="col card mx-2 py-3 border-bottom-success">
                                            <div class="card-body">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$completadas;?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 text-center">
                                        <div class="col mx-2">
                                            <div class="p font-weight-light text-gray-800 text-nowrap">Añadidas al catálogo</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex pb-2 text-center">
                                        <div class="col mx-2">
                                            <div class="h5 font-weight-bold text-gray-600">Totales</div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-2 pb-2 text-center">
                                        <div class="col card mx-2 py-3 border-bottom-primary">
                                            <div class="card-body">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totales;?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 text-center">
                                        <div class="col mx-2">
                                            <div class="p font-weight-light text-gray-800 text-nowrap">Todas sus peticiones</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mx-2 text-center">
                                <p>Las peticiones estan limitadas a que pueda encontrarse el contenido en internet disponible para su descarga, si no se encuentra el contenido o no esta disponible para su descarga la peticion se descarta. </p>
                                <!-- <p>Si se elimino, puede a volverla a enviar esperando al menos 1 mes para que exista una posibilidad de que se encuentre en intenet y no se vuelva a descartar.</p> -->
                            </div>
                            <div class="d-flex mb-1 justify-content-center">
                                <a href="?p=solicitar" class="mx-2 d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-paper-plane fa-sm text-white-50"></i> Solicitar Peticion</a>
                                <a href="?p=historial" class="mx-2 d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-clock fa-sm text-white-50"></i> Historial de Peticiones</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Servicio Restante (%)</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Opciones:</div>
                                    <a class="dropdown-item" href="http://www.spacetv.com.mx" target="_blank">Renovar Servicio</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="https://wa.me/+5218125949904?text=Buenas,%20me%20interesaria%20preguntar%20las%20promociones%20actuales" target="_blank">Validar Promociones</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success ?>"></i> 100 a 91
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary ?>"></i> 90 a 71
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info ?>"></i> 70 a 51
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-warning ?>"></i> 50 a 21
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-danger ?>"></i> 20 a 0
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-xl-9 mb-4 d-flex">

                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Contenido agregado recientemente</h6>
                        </div>
                        <?php 
                            // $marginTop = 5;
                            // if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])) {
                            //     $marginTop = 0;
                            // }
                        ?>
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="mt-0 carousel slide multi-item-carousel" data-ride="carousel">
                                <ol class="carousel-indicators" style="display: none"></ol>
                                <div class="carousel-inner"></div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 mb-4 d-flex">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">¡Felicidades!</h6>
                        </div>
                        <div class="card-body mx-auto text-center">
                            <!-- Crea el contenedor para el slider -->
                            <div id="mi-slider" class="carousel slide" data-ride="carousel">
                                
                                <!-- Indicadores del slider -->
                                <ol class="carousel-indicators" style="display: none">
                                    <?php
                                    //Validamos antiguedad y mostramos promociones acorde a ello
                                    if ($antiguedadFormat >= 4) {
                                        $diapositivas = array(
                                            array("imagen" => "1.png", "titulo" => "Diapositiva 1", "descripcion" => "Esta es la diapositiva 1"),
                                            array("imagen" => "2.png", "titulo" => "Diapositiva 2", "descripcion" => "Esta es la diapositiva 2"),
                                            array("imagen" => "3.png", "titulo" => "Diapositiva 3", "descripcion" => "Esta es la diapositiva 3"),
                                            array("imagen" => "4.png", "titulo" => "Diapositiva 4", "descripcion" => "Esta es la diapositiva 4"),
                                            array("imagen" => "5.png", "titulo" => "Diapositiva 5", "descripcion" => "Esta es la diapositiva 5")
                                        );
                                    }elseif ($antiguedadFormat >= 3) {
                                        $diapositivas = array(
                                            array("imagen" => "2.png", "titulo" => "Diapositiva 2", "descripcion" => "Esta es la diapositiva 2"),
                                            array("imagen" => "3.png", "titulo" => "Diapositiva 3", "descripcion" => "Esta es la diapositiva 3"),
                                            array("imagen" => "4.png", "titulo" => "Diapositiva 4", "descripcion" => "Esta es la diapositiva 4"),
                                            array("imagen" => "5.png", "titulo" => "Diapositiva 5", "descripcion" => "Esta es la diapositiva 5")
                                        );
                                    }elseif ($antiguedadFormat >= 2) {
                                        $diapositivas = array(
                                            array("imagen" => "3.png", "titulo" => "Diapositiva 3", "descripcion" => "Esta es la diapositiva 3"),
                                            array("imagen" => "4.png", "titulo" => "Diapositiva 4", "descripcion" => "Esta es la diapositiva 4"),
                                            array("imagen" => "5.png", "titulo" => "Diapositiva 5", "descripcion" => "Esta es la diapositiva 5")
                                        );
                                    }else {
                                        $diapositivas = array(
                                            array("imagen" => "4.png", "titulo" => "Diapositiva 4", "descripcion" => "Esta es la diapositiva 4"),
                                            array("imagen" => "5.png", "titulo" => "Diapositiva 5", "descripcion" => "Esta es la diapositiva 5")
                                        );
                                    }
                                    
                                    // Genera los indicadores del slider
                                    foreach ($diapositivas as $index => $diapositiva) {
                                        $clase_activo = ($index == 0) ? "active" : "";
                                        echo "<li data-target='#mi-slider' data-slide-to='$index' class='$clase_activo'></li>";
                                    }
                                    ?>
                                </ol>

                                <!-- Diapositivas del slider -->
                                <div class="carousel-inner">
                                    <?php
                                    // Genera el contenido de cada diapositiva
                                    foreach ($diapositivas as $index => $diapositiva) {
                                        $clase_activo = ($index == 0) ? "active" : "";
                                        echo "<div class='carousel-item $clase_activo'>";
                                        // echo "<img src='assets/img/promos/" . $diapositiva['imagen'] . "' class='d-block w-100' alt='" . $diapositiva['titulo'] . "'>";
                                        echo "<img src='assets/img/promos/" . $diapositiva['imagen'] . "' class='d-block w-100' alt='" . $diapositiva['titulo'] . "'>";
                                        // echo "<div class='carousel-caption d-none d-md-block'>";
                                        // echo "<h5>" . $diapositiva['titulo'] . "</h5>";
                                        // echo "<p>" . $diapositiva['descripcion'] . "</p>";
                                        // echo "</div>";
                                        echo "</div>";
                                    }
                                    ?>
                                </div>

                                <!-- Controles del slider -->
                                <a class="carousel-control-prev" href="#mi-slider" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#mi-slider" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                            <?php
                                if ($antiguedadFormat > 1) {
                                    $dom = " Años";
                                }elseif($antiguedadFormat < 1 && $antiguedadFormat > 0.1){
                                    $dom = " Meses";
                                }else {
                                    $dom = " Mes";
                                }
                            ?>
                            <h5 class="mt-3"><?=$antiguedadFormat . $dom;?></h5>
                            <p class="small">Estas promociones han sido seleccionadas para usted en base a la antiguedad que tiene su cuenta con nosotros, a sus renovaciones de manera oportuna o anticipada entre algunos otros factores.<br><br><b>*Promociones no acumulables*</b></p>
                            <a class="btn btn-info" target="_blank" rel="nofollow" href="https://wa.me/+5218125949904?text=Deseo%20aprovechar%20mi%20promocion%20que%20me%20salio%20en%20el%20dashboard%20de%20mi%20cuenta">Reclamar Promoción &rarr;</a>
                        </div>
                    </div>
                </div>
            
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <<!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="assets/js/demo/chart-area-demo.js"></script> -->
    <script src="assets/js/demo/chart-pie-demo.js"></script>
    
    <script>
    pieBar(<?=$porcentaje?>, "<?=$color?>");
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script>
        <?php
            $url = 'http://158.69.225.52:25461/updates_img.php';
            $json = file_get_contents($url);
            $data = json_decode($json, true);
            $html = '';
            $count = count($data);
            $numColumns = 4;
            if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])) {
                $numColumns = 1;
            }
            for ($i = 0; $i < $count; $i += $numColumns) {
                $active = $i == 0 ? ' active' : '';
                $html .= '<div class="carousel-item' . $active . '">';
                $html .= '<div class="row">';
                for ($j = $i; $j < $i + $numColumns && $j < $count; $j++) {
                    $value = $data[$j];
                    $ruta = str_replace('./', '/', "http://158.69.225.52:25461".$value['url']);
                    $html .= '<div class="col-md-' . (12 / $numColumns) . '">';
                    $html .= '<img src="' . $ruta . '" alt="' . $value['alt'] . '" class="d-block w-100">';
                    $html .= '</div>';
                }
                $html .= '</div>';
                $html .= '</div>';
            }
            echo '$(function() {
                $("#carouselExampleIndicators .carousel-indicators").html("<li data-target=\'#carouselExampleIndicators\' data-slide-to=\'0\'></li>".repeat(Math.ceil(' . $count / $numColumns . ')));
                $("#carouselExampleIndicators .carousel-inner").html(' . json_encode($html) . ');
            });';
        ?>
    </script>

</body>

</html>
