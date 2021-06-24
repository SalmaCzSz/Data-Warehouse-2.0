<?php
    include("bd/Reportes.php");
    include("templates/header.php");
?>

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Desempeño de las ventas en dos periodos</h3>
        </div>

        <div class="row">
            <div class="col-lg-8 col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">INGRESOS PERIODO 1</h6>
                    </div>
                    <div class="card-body" style="margin:auto; width:90%; heigth:100%"> <!-- style="margin:auto; width:50%; heigth:100%"-->
                        <?php
                            $reportes = new Reportes();
                            $reportes->recuperar_IngresosTienda();
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-6">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0">INGRESOS PERIODO 2</h6>
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