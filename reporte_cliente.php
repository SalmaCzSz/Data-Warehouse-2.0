<?php
    include("bd/Reportes.php");
    include("templates/header.php");
?>

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
    </form>
            
    <script  type="text/javascript">
        function Buscar(){
            var select = document.getElementById("nombres_clientes").value;//El <select>

            if(select == "Seleccione"){
                alert("Por favor, seleccione un cliente.");
            }     
        }
    </script>

    <?php
        include("templates/footer.php");
    ?>
