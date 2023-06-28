<?php

//Usuarios
$sinwpp = Perfil::getUsersCount('sinwpp');
$conwpp = Perfil::getUsersCount('conwpp');
$totales = Perfil::getUsersCount(null);

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
                <h1 class="h3 mb-0 text-gray-800">Administrador de Usuarios</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Usuarios (Sin Whatsapp)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sinwpp; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Usuarios (Con WhatsApp)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $conwpp; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-trash fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Usuarios Totales
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totales; ?></div>
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

            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>Foto</th>
                                            <th>Correo</th>
                                            <th>Celular</th>
                                            <th>Telegram</th>
                                            <th>WhatsApp</th>
                                            <th>S.B. Color</th>
                                            <th>Acciones</th>
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

        const url = `../cuenta_api/admin-users/`;
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
            "columnDefs": [
                { "type": "num", "targets": 0 }
            ],
            order: [
                [0, 'asc']
            ]
        });

    }
    getPeticiones();

    function writePeticiones(data) {

        peticionesTable = document.getElementById('body-table');
        peticionesTable.innerHTML = '';


        data.forEach(element => {

            tr = `
                <tr>
                    <td>${element.id}</td>
                    <td>${element.username}</td>
                    <td>${element.password}</td>
                    <td><img style="width: 2rem; aspect-ratio: 1/1" class="img-profile rounded-circle" src="uploads/${element.foto_perfil}"></td>
                    <td>${element.correo}</td>
                    <td>${element.celular}</td>
                    <td>${element.telegram}</td>
                    <td>${element.whatsapp}</td>
                    <td>${element.sidebar_color}</td>
                    <td>
                        <div class="text-nowrap">
                            <a class="delete btn btn-warning btn-circle btn-sm" onclick="actualizarStatus(1,${element.id})">
                                <i class="fas fa-paper-plane"></i>
                            </a>
                            <a class="delete btn btn-success btn-circle btn-sm" onclick="actualizarStatus(3,${element.id})">
                                <i class="fas fa-check"></i>
                            </a>
                            <a class="delete btn btn-danger btn-circle btn-sm" onclick="actualizarStatus(2,${element.id})">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            `;

            peticionesTable.innerHTML += tr;

        });

    }
    </script>
    <script>
        let links = document.querySelectorAll('.delete');

        for(i = 0; i < links.length; i++){
            let currentLink = links[i];
        currentLink.addEventListener('click', actualizarStatus);
        }

        const actualizarStatus = async (statusNuevo,idPeticion) => {

            let statusLetra = '';

            if (statusNuevo == 1) {
                statusLetra = 'Procesando';
            }else if(statusNuevo == 2){
                statusLetra = 'Descartada';
            }else if(statusNuevo == 3){
                statusLetra = 'Completada'
            }

            let confirmation = confirm(`Quieres marcar como '${statusLetra}' esta peticion?`);

            if (confirmation) {

                const url = `controladores/updateStatus.controlador.php?status=${statusNuevo}&id=${idPeticion}`;

                const resp = await fetch(url, {
                    method: 'GET'
                });

                const {
                    data = {}
                } = await resp.json();

                if (data == '3') {
                    // document.getElementById(`completar${idPeticion}`).remove();
                    location.reload();
                }else if (data == '2') {
                    // document.getElementById(`descartar${idPeticion}`).remove();
                    location.reload();
                }else if (data == '1') {
                    // document.getElementById(`descartar${idPeticion}`).remove();
                    location.reload();
                }

            }else{
                return true;
            }

        }
    </script>

    
