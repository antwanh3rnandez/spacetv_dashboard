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
                <h1 class="h3 mb-0 text-gray-800">Renovar Cuenta</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Renovacion Automatica</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body mx-8">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm"></div>
                                    <div class="col-sm">
                                    <div class="ms-text-center pb-2">
                                        <div class="ms-label ms-large ms-action2 ms-light" id="price">11.00</div>
                                        <div class="ms-label ms-large ms-action2 ms-light">USD</div>
                                    </div>
                                    <div class="ms-text-center">
                                        <h6>Seleccione el periodo a renovar</h6>
                                    </div>
                                    <div class="ms-text-center py-2">
                                        <button class="selected" onclick="updatePrice('11.00', this, '1-mes.png')">1 MES</button>
                                        <button onclick="updatePrice('55.00', this, '6-meses.png')">1 SEMESTRE</button>
                                        <button onclick="updatePrice('100.00', this, '12-meses.png')">1 ANUALIDAD</button>
                                        <button onclick="updatePrice('22.00', this, '2-meses.png')" class="mt-2">2 MESES</button>
                                        <button onclick="updatePrice('110.00', this, '12-meses.png')">2 SEMESTRES</button>
                                        <button onclick="updatePrice('200.00', this, '24-meses.png')">2 ANUALIDADES</button>
                                    </div>
                                    <div id="alerts" class="ms-text-center"></div>
                                    <div id="alerta" class="ms-text-center"></div>
                                    <div id="loading" class="spinner-container ms-div-center">
                                        <div class="spinner"></div>
                                    </div>
                                    <div id="content" class="hide">
                                        <div style="display: flex; justify-content: center; align-items: center; ">
                                            <div class="ms-card ms-fill" style="width: 300px;">
                                                <div class="ms-card-content" style="display: flex; justify-content: center; align-items: center;">
                                                    <img src="assets/img/paquetes/1-mes.png" style="max-width: 100%; max-height: 100%;" id="image">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="payment_options"></div>
                                    </div>
                                    </div>
                                    <div class="col-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    

