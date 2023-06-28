<?php

$perfil = Perfil::getPerfil($_SESSION['session_username'], $_SESSION['session_password']);

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
                <h1 class="h3 mb-0 text-gray-800">Solicitar Petición</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <?php
                if (!$perfil['whatsapp']) {
                ?>
                <div class="col-xl-12 col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        Necesita completar su perfil en la seccion de datos de contacto para poder realizar una nueva peticion. Puede completar su perfil desde <a href="?p=datos" class="alert-link">aqui</a>
                    </div>
                </div>
                <?php
                }else{
                ?>
                <div class="col-xl-4 col-lg-4">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Reglas</h6>
                        </div>
                        <?php 
                            $class = "";
                            if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])) {
                                $class = "small";
                            }
                        ?>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <!-- <h5 class="text-primary">Reglas:</h5> -->
                                <em style="color: #000;" class="<?=$class;?>">1.- Las peticiones estan limitadas a que pueda encontrarse el contenido en internet disponible para su descarga, si no se encuentra el contenido o no esta disponible para su descarga la petición se descarta. 
                                <br>2.- Si se elimino, puede a volverla a enviar esperando al menos 1 mes para que exista una posibilidad de que se encuentre en intenet y no se vuelva a descartar.
                                <br>3.- No se aceptan peticiones genericas como "Películas de Disney",  "Películas de los 80's", etc.
                                <br>4.- Si ya tiene varias peticiones en proceso, dele oportunidad a los demas usuarios de realizar las suyas.
                                <br>5.-<b> Usuarios que NO sigan estas reglas o abusen de las peticiones se les quitara el acceso al formulario y no podran realizar más peticiones.</b></em>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Formulario</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="#" method="post">
                                <div class="form-group mb-3 col-12">
                                    <label for="usuario" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $_SESSION['session_username']; ?>" readonly>
                                </div>
                                <div class="form-group mb-3 col-12">
                                    <label for="tipo" class="form-label">Tipo:</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="Serie">Serie</option>
                                    <option value="Pelicula">Película</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12">
                                    <label for="anio" class="form-label">Año:</label>
                                    <input type="number" oninput="if(value.length>4)value=value.slice(0,4)" min="1" max="<?= date('Y',strtotime('now'));?>" class="form-control" id="anio" name="anio" required>
                                </div>
                                <div class="form-group mb-3 col-12">
                                    <label for="titulo" class="form-label">Título:</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                                </div>
                                <div class="form-group mb-3 col-12">
                                    <label for="director" class="form-label">Director:</label>
                                    <input type="text" class="form-control" id="director" name="director" required>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-right"></i></span>
                                    <span class="text">Enviar</span></button>
                                </div>
                                <?php
                                $register = Peticiones::newPeticion();
                                if ($register) {
                                    echo '<script>
                                            if ( window.history.replaceState ) {
                                                window.history.replaceState( null, null, window.location.href );
                                            }
                                        </script>';
                                    echo "<script>
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        })                                      
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Peticion Enviada'
                                        })                         
                                    </script>";
                                    // echo "<script>
                                    //         setTimeout('document.location.reload()',3000);
                                    //     </script>";
                                }
                                ?>
                            </form>  
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->