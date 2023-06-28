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
                <h1 class="h3 mb-0 text-gray-800">Datos de Contacto</h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Editar datos de contacto</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="<?=(!$perfil['correo']) ? '' : $perfil['correo']?>">
                                </div>
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" class="form-control" id="celular" name="celular" value="<?=(!$perfil['celular']) ? '' : $perfil['celular']?>">
                                </div>
                                <div class="form-group">
                                    <label for="text">Telegram</label>
                                    <input type="text" class="form-control" id="telegram" name="telegram" value="<?=(!$perfil['telegram']) ? '' : $perfil['telegram']?>">
                                </div>
                                <div class="form-group">
                                    <label for="countrycode">País (WhatsApp):</label>
                                    <select class="form-control" id="countrycode" name="countrycode" onchange="addCountry()" required>
                                        <option value="" <?=(!$perfil['country_whatsapp']) ? 'selected' : '' ?>>Seleccione una opción</option>
                                        <option value="52" <?=($perfil['country_whatsapp'] == '52') ? 'selected' : '' ?>>México (+52)</option>
                                        <option value="1" <?=($perfil['country_whatsapp'] == '1') ? 'selected' : '' ?>>Estados Unidos (+1)</option>
                                        <option value="54" <?=($perfil['country_whatsapp'] == '54') ? 'selected' : '' ?>>Argentina (+54)</option>
                                        <option value="61" <?=($perfil['country_whatsapp'] == '61') ? 'selected' : '' ?>>Australia (+61)</option>
                                        <option value="32" <?=($perfil['country_whatsapp'] == '32') ? 'selected' : '' ?>>Belgica (+55)</option>
                                        <option value="55" <?=($perfil['country_whatsapp'] == '55') ? 'selected' : '' ?>>Brasil (+55)</option>
                                        <option value="1" <?=($perfil['country_whatsapp'] == '1') ? 'selected' : '' ?>>Canadá (+1)</option>
                                        <option value="56" <?=($perfil['country_whatsapp'] == '56') ? 'selected' : '' ?>>Chile (+56)</option>
                                        <option value="86" <?=($perfil['country_whatsapp'] == '86') ? 'selected' : '' ?>>China (+86)</option>
                                        <option value="57" <?=($perfil['country_whatsapp'] == '57') ? 'selected' : '' ?>>Colombia (+57)</option>
                                        <option value="506" <?=($perfil['country_whatsapp'] == '506') ? 'selected' : '' ?>>Costa Rica (+506)</option>
                                        <option value="53" <?=($perfil['country_whatsapp'] == '53') ? 'selected' : '' ?>>Cuba (+53)</option>
                                        <option value="45" <?=($perfil['country_whatsapp'] == '45') ? 'selected' : '' ?>>Dinamarca (+45)</option>
                                        <option value="33" <?=($perfil['country_whatsapp'] == '33') ? 'selected' : '' ?>>Francia (+33)</option>
                                        <option value="49" <?=($perfil['country_whatsapp'] == '49') ? 'selected' : '' ?>>Alemania (+49)</option>
                                        <option value="91" <?=($perfil['country_whatsapp'] == '91') ? 'selected' : '' ?>>India (+91)</option>
                                        <option value="39" <?=($perfil['country_whatsapp'] == '39') ? 'selected' : '' ?>>Italia (+39)</option>
                                        <option value="31" <?=($perfil['country_whatsapp'] == '31') ? 'selected' : '' ?>>Países Bajos (+31)</option>
                                        <option value="51" <?=($perfil['country_whatsapp'] == '51') ? 'selected' : '' ?>>Perú (+51)</option>
                                        <option value="34" <?=($perfil['country_whatsapp'] == '34') ? 'selected' : '' ?>>España (+34)</option>
                                        <option value="41" <?=($perfil['country_whatsapp'] == '41') ? 'selected' : '' ?>>Suiza (+41)</option>
                                        <option value="44" <?=($perfil['country_whatsapp'] == '44') ? 'selected' : '' ?>>Reino Unido (+44)</option>
                                        <option value="58" <?=($perfil['country_whatsapp'] == '58') ? 'selected' : '' ?>>Venezuela (+58)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="whatsapp">Telefono (WhatsApp):</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="preinput">+</span>
                                        </div>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?=(!$perfil['whatsapp']) ? '' : substr($perfil['whatsapp'], 3)?>" aria-label="whatsapp" aria-describedby="preinput" maxlength="10" required>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Actualizar Datos</button>
                                </div>
                                <?php
                                $editar = Perfil::editarDatos($perfil['username'], $perfil['password']);
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
                                            title: 'Datos Actualizados'
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
                            <i class="text-success">Agradeceremos mantener sus datos actualizados</i><br><br>
                            <p>Las constantes eliminaciones de nuestra pagina de facebook nos podrian hacer perder el contacto con usted.</p>
                            <p>Es importante mantener sus datos siempre actualizados para poder tener un metodo de contacto confiable hacia con ustedes.</p>
                            <p>De esta manera usted siempre estara al tanto de las actualizaciones, mantenimientos y todo lo relacionado con el servicio y su cuenta.</p>
                            <h5 class="text-primary"><em>SpaceTV+</em></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    
