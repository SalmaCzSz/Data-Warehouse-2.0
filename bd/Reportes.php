<?php 
    class reportes {
        /* Función para el Histórico */
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
    
    }
?>