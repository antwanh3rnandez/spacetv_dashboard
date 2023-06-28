<?php

//Peticiones
// $enviadas = Peticiones::GetPeticionesCount(null);
$enviadas = Peticiones::GetPeticionesStatusCount(null,1);
$descartadas = Peticiones::GetPeticionesStatusCount(null,2);
$completadas = Peticiones::GetPeticionesStatusCount(null,3);
$totales = Peticiones::GetAllCount();

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
                <h1 class="h3 mb-0 text-gray-800">Administrador de Peticiones</h1>
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
                                        Recibidas (Nuevas)</div>
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
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Tipo</th>
                                            <th>Titulo</th>
                                            <th>Año</th>
                                            <th>Director</th>
                                            <th>Fecha</th>
                                            <th>Comentario</th>
                                            <th>Estado</th>
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

    let procesando = `<button class="btn btn-warning btn-icon-split btn-sm">
                        <span class="icon text-white-50"><i class="fas fa-paper-plane"></i>
                        </span><span class="text">Enviada</span>
                    </button>`;
    let descartada = `<button class="btn btn-danger btn-icon-split btn-sm">
                        <span class="icon text-white-50"><i class="fas fa-times"></i>
                        </span><span class="text">Descartada</span>
                    </button>`;
    let completada = `<button class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50"><i class="fas fa-check"></i>
                        </span><span class="text">Completada</span>
                    </button>`;

    const getPeticiones = async () => {

        const url = `../cuenta_api/peticiones/`;
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
                [6, 'asc']
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
                estado = procesando;
            }else if(element.estado == 2){
                estado = descartada;
            }else if(element.estado == 3){
                estado = completada;
            }

            let select = "selected";

            tr = `
                <tr>
                    <td>${element.id}</td>
                    <td>${element.usuario}</td>
                    <td>${element.tipo}</td>
                    <td>${element.titulo}</td>
                    <td>${element.a_titulo}</td>
                    <td>${element.director}</td>
                    <td data-sort="${ date.format() }"> 
                        ${ date.format('D MMMM YYYY')+` a las `+date.format('h:mm:ss a') } 
                    </td>
                    <td>
                        <div class="form-group">
                            <select style="width: 100%" class="form-control" id="comentario${element.id}" onChange="actualizarComentario(${element.id})">
                            <option value="Seleccione una opción" ${(!element.comentario) ? select : ''} >Seleccione una opción</option>
                            <option value="Procesando..." ${(element.comentario == 'Procesando...') ? select : ''} >Procesando...</option>
                            <option value="Duplicada" ${(element.comentario == 'Duplicada') ? select : ''} >Duplicada</option>
                            <option value="Ya se encuentra en catálogo" ${(element.comentario == 'Ya se encuentra en catálogo') ? select : ''} >Ya se encuentra en catálogo</option>
                            <option value="No se encontraron resultados" ${(element.comentario == 'No se encontraron resultados') ? select : ''} >No se encontraron resultados</option>
                            <option value="Hay que esperar un poco mas..." ${(element.comentario == 'Hay que esperar un poco mas...') ? select : ''} >Hay que esperar un poco mas...</option>
                            <option value="Añadida al catálogo" ${(element.comentario == 'Añadida al catálogo') ? select : ''} >Añadida al catálogo</option>
                            </select>
                        </div>
                    </td>
                    <td id="status${element.id}">
                        ${estado}
                    </td>
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
                    document.getElementById(`status${idPeticion}`).innerHTML = completada;
                }else if (data == '2') {
                    document.getElementById(`status${idPeticion}`).innerHTML = descartada;
                }else if (data == '1') {
                    document.getElementById(`status${idPeticion}`).innerHTML = procesando;
                }

            }else{
                return true;
            }

        }

        const actualizarComentario = async (idPeticion) => {

            let comentario = document.getElementById(`comentario${idPeticion}`).value;

            console.log(comentario);

            const url = `controladores/setcomment.controlador.php?comment=${comentario}&id=${idPeticion}`;

            const resp = await fetch(url, {
                method: 'GET'
            });

            const {
                data = {}
            } = await resp.json();

            // if (data == '3') {
            //     document.getElementById(`status${idPeticion}`).innerHTML = completada;
            // }else if (data == '2') {
            //     document.getElementById(`status${idPeticion}`).innerHTML = descartada;
            // }else if (data == '1') {
            //     document.getElementById(`status${idPeticion}`).innerHTML = procesando;
            // }


        }
    </script>

    
