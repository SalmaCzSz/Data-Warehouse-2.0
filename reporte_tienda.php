<?php
    include("bd/Reportes.php");
    include("templates/header.php");
?>

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Desempeño de las ventas</h3>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                    <span>SUCURSAL NORTE:</span>
                                </div>
                                <div class="text-dark fw-bold h6 mb-0" style="font-size: 12px;">
                                    <span>
                                        <?php
                                            $reportes = new Reportes();
                                            $reportes->recuperar_InfoTienda('Norte');
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
                                    <span>SUCURSAL SUR:</span>
                                </div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h6 mb-0 me-3" style="font-size: 12px;">
                                            <?php
                                                $reportes = new Reportes();
                                                $reportes->recuperar_InfoTienda('Sur');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-store fa-2x text-gray-300"></i></div>
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
                                    <span>SUCURSAL PUEBLA:</span>
                                </div>
                                <div class="text-dark fw-bold h6 mb-0" style="font-size: 12px;">
                                    <?php
                                        $reportes = new Reportes();
                                        $reportes->recuperar_InfoTienda('Puebla');
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-store fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="grafica_VentasTienda">
            <div class="col-lg-8 col-xl-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">INGRESO MENSUAL POR TIENDA - <?php echo date('Y'); ?></h6>
                    </div>
                    <div class="card-body" style="margin:auto; width:90%; heigth:100%"> <!-- style="margin:auto; width:50%; heigth:100%"-->
                        <?php
                            $reportes = new Reportes();
                            $reportes->recuperar_IngresosTienda();
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="grafica_CantidadVentas">
            <div class="col-lg-8 col-xl-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">CANTIDAD DE VENTAS POR TIENDA - <?php echo date('Y'); ?></h6>
                    </div>
                    <div class="card-body" style="margin:auto; width:90%; heigth:100%"> <!-- style="margin:auto; width:50%; heigth:100%"-->
                        <?php
                            $reportes = new Reportes();
                            $reportes->recuperar_NoVentasTienda();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        include("templates/footer.php");
    ?>