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
                <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-3 col-lg-3">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Imagen Actual</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="text-center">
                                <div class="circle">
                                    <img style="aspect-ratio: 1/1;" class="w-100 img-profile rounded-circle" src="<?='uploads/'.$perfil['foto_perfil'];?>">
                                </div>
                                <div class="mt-3 p-image">
                                    <i class="fas fa-camera upload-button"></i>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Perfil</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?=$_SESSION['session_username'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="text" class="form-control" id="password" name="password" value="<?=$_SESSION['session_password'];?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto de perfil</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.png,.jpeg">
                                        <label class="custom-file-label" for="foto">Selecciona una imagen</label>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <h5 class="pt-3">Previsualizacion</h5>
                                    <img src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" alt="Previsualización de imagen" id="preview-img" class="preview-img mt-3">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                                <?php
                                $editar = Perfil::editarPerfil();
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
                                            title: 'Perfil Actualizado'
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
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
