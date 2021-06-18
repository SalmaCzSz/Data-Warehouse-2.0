<?php
    include("bd/Consultas.php")
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Histórico</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-leaf"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Menú</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link " href="index.php">
                        <i class="fas fa-tachometer-alt"></i><span>Tablero de Control</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="historico.php">
                        <i class="fas fa-table"></i><span>Histórico</span></a>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <!--href="reporte.html"-->
                        <i class="fas fa-window-maximize"></i><span>Reportes</span></a>
                        <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuLink">
                            <li class="nav-item"> <a class="dropdown-item" href="#"> 
                                <i class="fas"></i><span> Artículos </span> </a>
                             </li>
                            <li class="nav-item"> <a class="dropdown-item " href="reporte_cliente.php"> 
                               <i ></i><span> Clientes </span> </a>
                            </li>
                            <li class="nav-item"> <a class="dropdown-item " href="#"> 
                                <i ></i><span> Tiempo </span> </a>
                            </li>
                            <li class="nav-item"> <a class="dropdown-item " href="reporte_tienda.php"> 
                               <i ></i><span> Tiendas </span> </a>
                            </li>
                        </ul>
                    </li>   
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <p style="font-size: 30px;text-align: center;margin: 0px;padding: 1px;height: 44px;">Data-Harehouse</p>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Histórico</h3>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No Venta</th>
                                            <th>Fecha</th>
                                            <th>Tienda</th>
                                            <th>Cliente</th>
                                            <th>Artículo</th>
                                            <th>Cantidad</th>
                                            <th>Monto Venta</th>
                                            <th>Monto Costo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consultas = new Consultas();
                                            $consultas->recuperar_HechosVentas();
                                        ?>   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>No Venta</strong></td>
                                            <td><strong>Fecha</strong></td>
                                            <td><strong>Tienda</strong></td>
                                            <td><strong>Cliente</strong></td>
                                            <td><strong>Artículo</strong></td>
                                            <td><strong>Cantidad</strong></td>
                                            <td><strong>Monto Venta</strong></td>
                                            <td><strong>Monto Costo</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>4CV70 - EQUIPO 5</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>