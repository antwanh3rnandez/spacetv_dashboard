<?php

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
                <h1 class="h3 mb-0 text-gray-800">Historial de Peticiones</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Procesando</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $enviadas; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Descartadas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $descartadas; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-trash fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Completadas
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $completadas; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Totales
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totales; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Historial</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Tipo</th>
                                            <th>Titulo</th>
                                            <th>Año</th>
                                            <th>Director</th>
                                            <th>Fecha</th>
                                            <th>Notas</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-table"></tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
    const getPeticiones = async () => {

        const url = `../cuenta_api/peticiones/<?=$_SESSION['session_username']?>`;
        const resp = await fetch(url, {
            method: 'GET',
            cache: 'no-cache'
        });
        // const prods = await resp.json();
        const {
            data = {}
        } = await resp.json();

        // console.log(data);
        writePeticiones(data);
        peticiones = data;

        tabla = $('#table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            },
            order: [
                [5, 'desc']
            ]
        });

    }
    getPeticiones();

    function writePeticiones(data) {

        peticionesTable = document.getElementById('body-table');
        peticionesTable.innerHTML = '';


        data.forEach(element => {

            // let date = moment(element.updated_at);

            let date = moment(element.fecha);

            moment.locale('es');
            date.locale(false);

            let estado = ``;
            if (element.estado == 1) {
                estado = `<button class="btn btn-warning btn-icon-split btn-sm">
                            <span class="icon text-white-50"><i class="fas fa-paper-plane"></i>
                            </span><span class="text">Enviada</span>
                        </button>`;
            }else if(element.estado == 2){
                estado = `<button class="btn btn-danger btn-icon-split btn-sm">
                            <span class="icon text-white-50"><i class="fas fa-times"></i>
                            </span><span class="text">Descartada</span>
                        </button>`;
            }else if(element.estado == 3){
                estado = `<button class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50"><i class="fas fa-check"></i>
                            </span><span class="text">Completada</span>
                        </button>`;
            }

            tr = `
                <tr>
                    <td>${element.usuario}</td>
                    <td>${element.tipo}</td>
                    <td>${element.titulo}</td>
                    <td>${element.a_titulo}</td>
                    <td>${element.director}</td>
                    <td data-sort="${ date.format() }"> 
                        ${ date.format('D MMMM YYYY')+` a las `+date.format('h:mm:ss a') } 
                    </td>
                    <td>${element.comentario}</td>
                    <td id="status${element.estado}">
                        ${estado}
                    </td>
                </tr>
            `;

            peticionesTable.innerHTML += tr;

        });

    }
    </script>

    
