<?php 
    class reportes {
        /* Funciones para reporte_tienda.php */
        function recuperar_InfoTienda($tienda){
            include("Conexion.php");

            $query = "exec sp_InfoTienda 'Sucursal " . $tienda ."'";
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while($fila = sqlsrv_fetch_array($resultado)){
                echo "ID: $fila[id_tienda] <br>";
                echo "Telefono: $fila[tel_tienda] <br>";
                echo "Estado: $fila[nomb_edo] <br>";
                echo "Dirección: $fila[direc_tienda]";
            }
            sqlsrv_close($conn_sis);
        }

        function recuperar_IngresosTienda(){
            include("Conexion.php");

            $ingresos_t1 = array();
            $t1 = 1;

            while ($t1 <= 12) {
                $query = "exec sp_IngresosTienda " . $t1 . ", 'Sucursal Norte'" ;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['monto_total'])){
                    $ingresos_t1[$t1] = '0'; 
                } else {
                    $ingresos_t1[$t1] = $fila['monto_total']; 
                }
                $t1++;
            }

            $sucursal_norte = implode(',',$ingresos_t1);


            $ingresos_t2 = array();
            $t2 = 1;

            while ($t2 <= 12) {
                $query = "exec sp_IngresosTienda " . $t2 . ", 'Sucursal Sur'" ;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['monto_total'])){
                    $ingresos_t2[$t2] = '0'; 
                } else {
                    $ingresos_t2[$t2] = $fila['monto_total']; 
                }
                $t2++;
            }

            $sucursal_sur = implode(',',$ingresos_t2);


            $ingresos_t3 = array();
            $t3 = 1;

            while ($t3 <= 12) {
                $query = "exec sp_IngresosTienda " . $t3 . ", 'Sucursal Puebla'" ;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['monto_total'])){
                    $ingresos_t3[$t3] = '0'; 
                } else {
                    $ingresos_t3[$t3] = $fila['monto_total']; 
                }
                $t3++;
            }

            $sucursal_puebla = implode(',',$ingresos_t3);


            echo "<canvas id='ingresos_tienda';> </canvas>";
            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>";

            echo "<script>
                                    
                var grafica = document.getElementById('ingresos_tienda').getContext('2d');
                var ingresos_mes = new Chart( grafica, {
                    type: 'bar',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets: [{
                                label: 'Sucursal Norte',
                                data: [" . $sucursal_norte . "],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1 
                            },
                            {
                                label: 'Sucursal Sur',
                                data: [" . $sucursal_sur . "],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Sucursal Puebla',
                                data: [" . $sucursal_puebla . "],
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1 
                            }
                        ]
                    }
                }); 
            ";
            echo "</script>";
            sqlsrv_close($conn_sis);
        }

        function recuperar_NoVentasTienda(){
            include("Conexion.php");

            $no_ventas_t1 = array();
            $t1 = 1;

            while ($t1 <= 12) {
                $query = "exec sp_NoVentasTienda " . $t1 . ", 'Sucursal Norte'" ;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['no_ventas'])){
                    $no_ventas_t1[$t1] = '0'; 
                } else {
                    $no_ventas_t1[$t1] = $fila['no_ventas']; 
                }
                $t1++;
            }

            $sucursal_norte = implode(',',$no_ventas_t1);


            $no_ventas_t2 = array();
            $t2 = 1;

            while ($t2 <= 12) {
                $query = "exec sp_NoVentasTienda " . $t2 . ", 'Sucursal Sur'" ;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['no_ventas'])){
                    $no_ventas_t2[$t2] = '0'; 
                } else {
                    $no_ventas_t2[$t2] = $fila['no_ventas']; 
                }
                $t2++;
            }

            $sucursal_sur = implode(',',$no_ventas_t2);


            $no_ventas_t3 = array();
            $t3 = 1;

            while ($t3 <= 12) {
                $query = "exec sp_NoVentasTienda " . $t3 . ", 'Sucursal Puebla'" ;
                $resultado = sqlsrv_query($conn_sis, $query);
                $fila = sqlsrv_fetch_array($resultado);
                
                if(is_null($fila['no_ventas'])){
                    $no_ventas_t3[$t3] = '0'; 
                } else {
                    $no_ventas_t3[$t3] = $fila['no_ventas']; 
                }
                $t3++;
            }

            $sucursal_puebla = implode(',',$no_ventas_t3);


            echo "<canvas id='no_ventas_tienda';> </canvas>";
            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>";

            echo "<script>
                                    
                var grafica = document.getElementById('no_ventas_tienda').getContext('2d');
                var ingresos_mes = new Chart( grafica, {
                    type: 'bar',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets: [{
                                label: 'Sucursal Norte',
                                data: [" . $sucursal_norte . "],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1 
                            },
                            {
                                label: 'Sucursal Sur',
                                data: [" . $sucursal_sur . "],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Sucursal Puebla',
                                data: [" . $sucursal_puebla . "],
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1 
                            }
                        ]
                    }
                }); 
            ";
            echo "</script>";
            sqlsrv_close($conn_sis);
        }
    

        /* Funciones para reporte_cliente.php */
        function recuperar_Clientes(){
            include("Conexion.php");

            $query = "exec sp_NombresClientes";
            $resultado = sqlsrv_query($conn_sis, $query);

            while ($fila = sqlsrv_fetch_array($resultado)) {
                echo "<option value='" . $fila['nomb_cte']. "'>" . $fila['nomb_cte'] ."</option>";
            }

            sqlsrv_close($conn_sis);
        }

        function recuperar_InfoClientes($cliente){
            include("Conexion.php");

            $query = "exec sp_InfoCliente '" . $cliente ."'";
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while($fila = sqlsrv_fetch_array($resultado)){
                echo "<td colspan='3'> <label> ID: " . $fila['id_cliente'] ."</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo " <label> Telefono: " . $fila['tel_cte'] ."</label> <br>";
                echo " <label> Dirección: " . $fila['dir_cte'] ."</label> </td>";
            }
            sqlsrv_close($conn_sis);
        }


        function recuperar_EstadisticasCliente($sp, $cliente, $canva){
            include("Conexion.php");

            $query = "exec sp_" . $sp . " '". $cliente . "'";
            $resultado = sqlsrv_query($conn_sis, $query);
            $productos = array();
            $cantidad = array();
            $cont = 1;
            
            while ($fila = sqlsrv_fetch_array($resultado)) {
                $productos[$cont] = $fila['Criterio'];
                $cantidad[$cont] = $fila['Cantidad']; 
                $cont++;
            }

            $array_productos = implode("', '",$productos);
            $array_cantidad = implode(',',$cantidad);

            echo "<canvas id='" . $canva . "';> </canvas>";
            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>";

            echo "<script>                          
                var grafica = document.getElementById('" . $canva . "').getContext('2d');
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

        function recuperar_TotalCompras($cliente){
            include("Conexion.php");

            $query = "exec sp_TotalCompras '" . $cliente . "'"; 
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while ($fila = sqlsrv_fetch_array($resultado)){
                echo " ▷ $fila[Total] compras";
            }
            sqlsrv_close($conn_sis);
        }

        function recuperar_TotalProductos($cliente){
            include("Conexion.php");

            $query = "exec sp_TotalProductos '" . $cliente . "'"; 
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while ($fila = sqlsrv_fetch_array($resultado)){
                echo " ▷ $fila[Total] productos";
            }
            sqlsrv_close($conn_sis);
        }

        function recuperar_MontoTotalCl($cliente){
            include("Conexion.php");

            $query = "exec sp_MontoTotalCl '" . $cliente . "'"; 
            $resultado = sqlsrv_query($conn_sis, $query);
            
            while ($fila = sqlsrv_fetch_array($resultado)){
                echo " ▷ $ $fila[Total] ";
            }
            sqlsrv_close($conn_sis);
        }
    }
?>