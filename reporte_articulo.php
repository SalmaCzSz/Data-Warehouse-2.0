<?php
    include("bd/Reportes.php");
    include("templates/header.php");
?>

    <form action="" method="post" id="consulta_clientes">
        <div class="container-fluid">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Desempeño de los artículos</h3>
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
                                            <td> <span>Artículo: </span> </td>
                                            <td>
                                                <select name="nombres_articulos" id="nombres_articulos" style="width:250px;" class="form-select">
                                                    <option value="Seleccione"> Seleccione </option>
                                                    <?php
                                                        $reportes = new Reportes();
                                                        $reportes->recuperar_Articulos();
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-primary"  name="btn_buscar" id="btn_buscar" onclick="Buscar()"> Buscar </button>
                                            </td>
                                        </tr>
                                        <tr colspan="3" style="text-align: center;">  
                                            <td colspan='3'>
                                                <center>
                                                <?php
                                                    if(isset($_POST['btn_buscar'])) {
                                                        $nombre = $_POST['nombres_articulos'];

                                                        if($nombre != 'Seleccione'){
                                                            $reportes = new Reportes();
                                                            $reportes->recuperar_InfoArticulos($nombre);
                                                        }
                                                    } 
                                                ?>  
                                                </center>   
                                            </td>                                                            
                                        </tr>
                                    </table>   
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="grafica_VentasTienda">
                <div class="col-lg-8 col-xl-8">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary fw-bold m-0">Ingresos por sucursal - <?php echo date('Y'); ?></h6>
                        </div>
                        <div class="card-body" style="margin:auto; width:90%; heigth:100%"> <!-- style="margin:auto; width:50%; heigth:100%"-->
                            <?php
                                $reportes = new Reportes();
                                if(isset($_POST['btn_buscar'])) {
                                    $nombre = $_POST['nombres_articulos'];

                                    if($nombre != 'Seleccione'){
                                        $reportes = new Reportes();
                                        $reportes->recuperar_IngresosProductoTienda($nombre);
                                    }
                                } 
                            ?> 
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card shadow border-start-primary py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                        <span>SUCURSAL NORTE:</span>
                                    </div>
                                    <div class="text-dark fw-bold h6 mb-0">
                                        <span style="font-size: 15px;">
                                            <?php
                                                if(isset($_POST['btn_buscar'])) {
                                                    $nombre = $_POST['nombres_articulos'];

                                                    if($nombre != 'Seleccione'){
                                                        $reportes = new Reportes();
                                                        $reportes->recuperar_TotalUnidades('Sucursal Norte', $nombre);
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
                    <br>
                    <div class="card shadow border-start-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                        <span>SUCURSAL SUR:</span>
                                    </div>
                                    <div class="row g-0 align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h6 mb-0 me-3">
                                                <?php
                                                    if(isset($_POST['btn_buscar'])) {
                                                        $nombre = $_POST['nombres_articulos'];

                                                        if($nombre != 'Seleccione'){
                                                            $reportes = new Reportes();
                                                            $reportes->recuperar_TotalUnidades('Sucursal Sur', $nombre);
                                                        }
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-store fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card shadow border-start-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                        <span>SUCURSAL PUEBLA:</span>
                                    </div>
                                    <div class="row g-0 align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark fw-bold h6 mb-0 me-3">
                                                <?php
                                                    if(isset($_POST['btn_buscar'])) {
                                                        $nombre = $_POST['nombres_articulos'];

                                                        if($nombre != 'Seleccione'){
                                                            $reportes = new Reportes();
                                                            $reportes->recuperar_TotalUnidades('Sucursal Puebla', $nombre);
                                                        }
                                                    } 
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
        </div>
    </form>

    <script  type="text/javascript">
        function Buscar(){
            var select = document.getElementById("nombres_articulos").value;//El <select>

            if(select == "Seleccione"){
                alert("Por favor, seleccione un artículo.");
            }     
        }
    </script>

    <?php
        include("templates/footer.php");
    ?>
