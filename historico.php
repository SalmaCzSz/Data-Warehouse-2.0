<?php
    include("bd/Consultas.php");
    include("templates/header.php");
?>

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

<?php
    include("templates/footer.php");
?>
    