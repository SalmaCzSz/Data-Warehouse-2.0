<?php
    include("bd/Consultas.php");
    include("templates/header.php");
?>

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4"> <h3 class="text-dark mb-0">Tablero de Control</h3> </div>
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <span>INGRESO TOTAL&nbsp; <?php echo date('Y'); ?> </span>
                                </div>
                                <div class="text-dark fw-bold h6 mb-0">
                                    <span style="font-size: 15px;">
                                        <?php
                                            $consultas = new Consultas();
                                            $consultas->recuperar_IngresoTotalAnual();
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                    <span>TIENDA CON MÁS VENTAS</span>
                                </div>
                                <div class="text-dark fw-bold h6 mb-0">
                                    <span style="font-size: 15px;">
                                        <?php
                                            $consultas = new Consultas();
                                            $consultas->recuperar_SucursalMasVentas();
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-store fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                    <span>ARTÍCULO MÁS VENDIDO</span>
                                </div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h6 mb-0 me-3">
                                            <?php
                                                $consultas = new Consultas();
                                                $consultas->recuperar_ProductoMasVendido();
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

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-warning py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-warning fw-bold text-xs mb-1">
                                    <span>CLIENTE DEL MES</span>
                                </div>
                                <div class="text-dark fw-bold h6 mb-0">
                                    <?php
                                        $consultas = new Consultas();
                                        $consultas->recuperar_ClienteMasCompras();
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto"><i class="far fa-smile fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">INGRESOS <?php echo date('Y'); ?> </h6>
                    </div>
                    <div class="card-body" style="margin:auto; width:90%; heigth:100%"> <!-- style="margin:auto; width:50%; heigth:100%"-->
                        <?php
                            $consultas = new Consultas();
                            $consultas->recuperar_IngresosMes();
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">VENTAS SUCURSAL NORTE</h6>
                    </div>
                    <div class="card-body">
                        <?php
                            $consultas = new Consultas();
                            $consultas->recuperar_ProductosTienda('Norte');
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">VENTAS SUCURSAL SUR</h6>
                    </div>
                    <div class="card-body">
                        <?php
                            $consultas = new Consultas();
                            $consultas->recuperar_ProductosTienda('Sur');
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">VENTAS SUCURSAL PUEBLA</h6>
                    </div>
                    <div class="card-body">
                        <?php
                            $consultas = new Consultas();
                            $consultas->recuperar_ProductosTienda('Puebla');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include("templates/footer.php");
?>
            