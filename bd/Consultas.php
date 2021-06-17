<?php 
    class consultas {
        /* Funciones para el Índex */
        function recuperar_IngresoTotalAnual(){
            include("Conexion.php");

            $query = "exec sp_TotalVentasAnio";
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while ($fila = sqlsrv_fetch_array($resultado)){
                echo "$ $fila[monto_total]";
            }
            sqlsrv_close($conn_sis);
        }

        function recuperar_SucursalMasVentas(){
            include("Conexion.php");

            $query = "exec sp_TiendaMasVentas";
            $resultado = sqlsrv_query($conn_sis, $query);

            $fila = sqlsrv_fetch_array($resultado);
            echo "$fila[nomb_tienda]";
            sqlsrv_close($conn_sis);
        }

        function recuperar_ProductoMasVendido(){
            include("Conexion.php");

            $query = "exec sp_ProductoMasVendido";
            $resultado = sqlsrv_query($conn_sis, $query);

            $fila = sqlsrv_fetch_array($resultado);
            echo "$fila[nomb_art]";
            sqlsrv_close($conn_sis);
        }

        function recuperar_ClienteMasCompras(){
            include("Conexion.php");

            $query = "exec sp_ClienteDelMes";
            $resultado = sqlsrv_query($conn_sis, $query);
            
            $fila = sqlsrv_fetch_array($resultado);
            echo "$fila[nomb_cte]";
            sqlsrv_close($conn_sis);
        }


        /* Función para el Histórico */
        function recuperar_HechosVentas(){
            include("Conexion.php");

            $query = "exec sp_HechosVentas";
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while ($fila = sqlsrv_fetch_array($resultado)){
                echo "<tr>";
                    echo "<td> $fila[id_venta] </td>";
                    echo "<td> $fila[fecha] </td>";
                    echo "<td> $fila[nomb_tienda] </td>";
                    echo "<td> $fila[nomb_cte] </td>";
                    echo "<td> $fila[nomb_art] </td>";
                    echo "<td> $fila[cantidad] </td>";
                    echo "<td> $fila[monto_venta] </td>";
                    echo "<td> $fila[monto_costo] </td>";
                echo "</tr>";
            }    
            sqlsrv_close($conn_sis);
        }

        function recuperar_IngresosMes(){
            include("Conexion.php");

            $ingresos = array();
            $cont = 1;

            while ($cont <= 12) {
                $query = "exec sp_IngresosMes " . $cont;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['Total'])){
                    $ingresos[$cont] = '0'; 
                } else {
                    $ingresos[$cont] = $fila['Total']; 
                }
                $cont++;
            }

            $data = implode(',',$ingresos);

            echo "<canvas id='ingresos_mes';> </canvas>";
            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>";

            echo "<script>
                                    
                var grafica = document.getElementById('ingresos_mes').getContext('2d');
                var ingresos_mes = new Chart( grafica, {
                    type: 'bar',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets: [{
                            label: 'Ingresos por mes',
                            data: [" . $data . "],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                }); 
            ";
            echo "</script>";
            sqlsrv_close($conn_sis);
        }

        function recuperar_ProductosTienda($nombre_sucursal){
            include("Conexion.php");

            $query_productos = "exec sp_ProductosTienda 'Sucursal ". $nombre_sucursal . "'";
            $resultado_productos = sqlsrv_query($conn_sis, $query_productos);
            $productos = array();
            $cont = 1;
            
            while ($fila = sqlsrv_fetch_array($resultado_productos)) {
                $productos[$cont] = $fila['Articulos']; 
                $cont++;
            }

            $array_productos = implode("', '",$productos);

            $no_ventas = array();
            $tam_array = sizeof($productos);
            $i = 1;
            while ($i <= sizeof($productos)) {
                //echo $i . sizeof($productos);
                $query_cantidad = "exec sp_VentasProductoTienda 'Sucursal " . $nombre_sucursal . "', '". $productos[$i] . "'";
                $resultado_cantidad = sqlsrv_query($conn_sis, $query_cantidad);
                $fila = sqlsrv_fetch_array($resultado_cantidad);
                $no_ventas[$i] = $fila['Cantidad'];
                $i++;
            }

            $array_cantidad = implode(',',$no_ventas);

            echo "<canvas id='ventas_".$nombre_sucursal."';> </canvas>";
            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>";

            echo "<script>                          
                var grafica = document.getElementById('ventas_".$nombre_sucursal."').getContext('2d');
                var ingresos_mes = new Chart( grafica, {
                    type: 'doughnut',
                    data: {
                        labels: ['" . $array_productos . "'],
                        datasets: [{
                            label: 'Productos',
                            data: [" . $array_cantidad . "],
                            backgroundColor: [
                                'rgb(221, 160, 221)',
                                'rgb(255, 192, 203)',
                                'rgb(75, 192, 192)',
                                'rgb(175, 238, 238)',
                                'rgb(255, 205, 86)',
                                'rgb(201, 203, 207)',
                                'rgb(54, 162, 235)'
                            ],
                            hoverOffset: 4
                        }]
                    }
                }); 
            ";
            echo "</script>";
            sqlsrv_close($conn_sis);
        }     
    }
?>
   