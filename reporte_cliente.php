<?php
    include("bd/Reportes.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tablero de Control</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-leaf"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Menú</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php">
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
                
                <form action="" method="post" id="consulta_clientes">
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Desempeño de los clientes</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-12 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <center>
                                            <table>
                                                <tr>
                                                    <td> <span>Cliente: </span> </td>
                                                    <td>
                                                        <select name="nombres_clientes" id="nombres_clientes" style="width:250px;" class="form-select">
                                                            <option value="Seleccione"> Seleccione </option>
                                                            <?php
                                                                $reportes = new Reportes();
                                                                $reportes->recuperar_Clientes();
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-primary"  name="btn_buscar" id="btn_buscar" onclick="Buscar()"> Buscar </button>
                                                    </td>
                                                </tr>
                                                <tr colspan="3" style="text-align: center;">  
                                                    <center>
                                                    <?php
                                                        if(isset($_POST['btn_buscar'])) {
                                                            $nombre = $_POST['nombres_clientes'];

                                                            if($nombre != 'Seleccione'){
                                                                $reportes = new Reportes();
                                                                $reportes->recuperar_InfoClientes($nombre);
                                                            }
                                                        } 
                                                    ?>  
                                                    </center>                                                               
                                                </tr>
                                            </table>   
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-5 col-xl-4">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary fw-bold m-0">COMPRAS POR SUCURSAL</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['btn_buscar'])) {
                                            $nombre = $_POST['nombres_clientes'];

                                            if($nombre != 'Seleccione'){
                                                $reportes = new Reportes();
                                                $reportes->recuperar_EstadisticasCliente('ClComSuc', $nombre , 'compras_sucursal');
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5 col-xl-4">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary fw-bold m-0">PRODUCTOS ADQUIRIDOS</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['btn_buscar'])) {
                                            $nombre = $_POST['nombres_clientes'];

                                            if($nombre != 'Seleccione'){
                                                $reportes = new Reportes();
                                                $reportes->recuperar_EstadisticasCliente('ClPrAd', $nombre, 'productos_adquiridos');
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5 col-xl-4">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary fw-bold m-0">MONTO TOTAL POR PRODUCTO ($)</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(isset($_POST['btn_buscar'])) {
                                            $nombre = $_POST['nombres_clientes'];

                                            if($nombre != 'Seleccione'){
                                                $reportes = new Reportes();
                                                $reportes->recuperar_EstadisticasCliente('MontoComSuc', $nombre, 'monto_producto');
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
               

                    <div class="row">
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                                <span>TOTAL COMPRAS:</span>
                                            </div>
                                            <div class="text-dark fw-bold h6 mb-0">
                                                <span style="font-size: 15px;">
                                                    <?php
                                                        if(isset($_POST['btn_buscar'])) {
                                                            $nombre = $_POST['nombres_clientes'];

                                                            if($nombre != 'Seleccione'){
                                                                $reportes = new Reportes();
                                                                $reportes->recuperar_TotalCompras($nombre);
                                                            }
                                                        } 
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-store fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                                <span>TOTAL PRODUCTOS ADQUIRIDOS:</span>
                                            </div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h6 mb-0 me-3">
                                                        <?php
                                                            if(isset($_POST['btn_buscar'])) {
                                                                $nombre = $_POST['nombres_clientes'];

                                                                if($nombre != 'Seleccione'){
                                                                    $reportes = new Reportes();
                                                                    $reportes->recuperar_TotalProductos($nombre);
                                                                }
                                                            } 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-shopping-basket fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                                <span>MONTO TOTAL PRODUCTOS:</span>
                                            </div>
                                            <div class="text-dark fw-bold h6 mb-0">
                                                <?php
                                                    if(isset($_POST['btn_buscar'])) {
                                                        $nombre = $_POST['nombres_clientes'];

                                                        if($nombre != 'Seleccione'){
                                                            $reportes = new Reportes();
                                                            $reportes->recuperar_MontoTotalCl($nombre);
                                                        }
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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
    <!--Scripts para las gráficas-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script  type="text/javascript">
        function Buscar(){
            var select = document.getElementById("nombres_clientes").value;//El <select>

            if(select == "Seleccione"){
                alert("Por favor, seleccione un cliente.");
            }     
        }
    </script>
</body>
</html>
