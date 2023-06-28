<?php

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
                <h1 class="h3 mb-0 text-gray-800">Historial de Accesos</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Tipo</th>
                                            <th>Fecha</th>
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
    const getAccessLog = async () => {

        const url = `../cuenta_api/access-log/<?=$_SESSION['session_username']?>`;
        const resp = await fetch(url, {
            method: 'GET',
            cache: 'no-cache'
        });
        // const prods = await resp.json();
        const {
            data = {}
        } = await resp.json();

        // console.log(data);
        writeAccessLog(data);
        accessLog = data;

        tabla = $('#table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
            },
            order: [
                [0, 'desc']
            ]
        });

    }
    getAccessLog();

    function writeAccessLog(data) {

        accessLogTable = document.getElementById('body-table');
        accessLogTable.innerHTML = '';


        data.forEach(element => {

            // let date = moment(element.updated_at);

            let date = moment(element.fecha);

            moment.locale('es');
            date.locale(false);

            let tipo = ``;
            if (element.tipo == "Entrada") {
                tipo = `<i title="Entrada" class="fas fa-power-off btn-success btn-sm"></i>`;
            }else if(element.tipo == "Salida"){
                tipo = `<i title="Salida" class="fas fa-power-off btn-danger btn-sm"></i>`;
            }

            tr = `
                <tr>
                    <td>${element.usuario}</td>
                    <td>${tipo}</td>
                    <td data-sort="${ date.format() }"> 
                        ${ date.format('D MMMM YYYY')+` a las `+date.format('h:mm:ss a') } 
                    </td>
                </tr>
            `;

            accessLogTable.innerHTML += tr;

        });

    }
    </script>

    
