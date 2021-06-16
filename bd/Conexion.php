<?php
    $serverName = "localhost";
    $connectionInfo = array("Database" => "DW", "UID" => "<usuario>", "PWD" => "<contraseña>", "CharacterSet" => "UTF-8");
    $conn_sis = sqlsrv_connect($serverName, $connectionInfo);

    if(!$conn_sis){
        die(print_r(sqlsrv_errors(), true));
    } else {
        /*echo'<script type="text/javascript"> alert("Conexión establecida"); </script>';*/
    }
?>