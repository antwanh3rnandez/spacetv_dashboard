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
                <h1 class="h3 mb-0 text-gray-800">Preferencias</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-9 col-lg-9">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Editar preferencias del panel</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="color-select">Selecciona un color para la barra lateral:</label>
                                    <select class="form-control" id="color-select" name="color-select" required>
                                        <option value="" style="background-color: #fff; color: #000;" hidden <?=(!$perfil['sidebar_color']) ? 'selected' : ''?>>Selecciona un color</option>
                                        <option value="primary" style="background-color: var(--primary); color: #fff;" <?=($perfil['sidebar_color'] == 'primary') ? 'selected' : ''?>>Azul</option>
                                        <option value="secondary" style="background-color: var(--secondary); color: #fff; <?=($perfil['sidebar_color'] == 'secondary') ? 'selected' : ''?>">Gris</option>
                                        <!-- <option value="success" style="background-color: var(--success); color: #fff; <?//=($perfil['sidebar_color'] == 'success') ? 'selected' : ''?>">Verde</option> -->
                                        <option value="danger" style="background-color: var(--danger); color: #fff;" <?=($perfil['sidebar_color'] == 'danger') ? 'selected' : ''?>>Rojo</option>
                                        <option value="warning" style="background-color: var(--warning); color: #fff;" <?=($perfil['sidebar_color'] == 'warning') ? 'selected' : ''?>>Amarillo</option>
                                        <!-- <option value="info" style="background-color: var(--info); color: #fff;" <?//=($perfil['sidebar_color'] == 'info') ? 'selected' : ''?>>Cyan</option> -->
                                        <option value="dark" style="background-color: var(--dark); color: #fff;" <?=($perfil['sidebar_color'] == 'dark') ? 'selected' : ''?>>Oscuro</option>
                                    </select>
                                    <div class="mt-3" id="color-preview"></div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Guardar Preferencias</button>
                                </div>
                                <?php
                                $editar = Perfil::editarPreferencias($perfil['username'], $perfil['password']);
                                if ($editar) {
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
                                            title: 'Preferencias Actualizadas'
                                        })                         
                                    </script>";
                                    echo "<script>
                                            setTimeout('document.location.reload()',3000);
                                        </script>";
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Info</h6>
                        </div>
                        <div class="card-body">
                            <i class="text-success">Seguimos trabajando para usted</i><br><br>
                            <p>Proximamente traeremos para usted nuevas funciones y mejoras para nuestro panel.</p>
                            <p>No sera necesario salir de su panel para renovar, administrar y manejar todo lo relacionado a su cuenta y servicio</p>
                            <h5 class="text-primary"><em>SpaceTV+</em></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    
    <script>
    // Obtiene los elementos del DOM necesarios
    var colorSelect = document.getElementById("color-select");
    var colorPreview = document.getElementById("color-preview");

    // Crea una función que actualice la previsualización del color
    function updateColorPreview() {
    //   var selectedColor = colorSelect.value;
      var selectedColor = `Previsualizacion`;
      var selectedOption = colorSelect.options[colorSelect.selectedIndex];
      var backgroundColor = selectedOption.style.backgroundColor;
      colorPreview.style.backgroundColor = backgroundColor;
      colorPreview.innerHTML = "<h5 class='text-center text-white py-2'>" + selectedColor.toUpperCase() + "</h5>";
    }

    // Llama a la función cuando cambie la selección
    colorSelect.addEventListener("change", function() {
      updateColorPreview();
    });

    // Llama a la función al cargar la página
    updateColorPreview();
  </script>
