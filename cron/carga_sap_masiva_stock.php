<?php
require_once('conexion.php');

if ($gestor = opendir('C:/FTP/aproftp/stock/')) {
    while (false !== ($entrada = readdir($gestor))) {
        if ($entrada != "." && $entrada != "..") {
            // echo "$entrada\n";
            // echo '<a href="#">'.$entrada.'</a>';
            // echo "<br>";
            // $archivo = "$entrada\n";
            $fp = fopen("C:/FTP/aproftp/stock/$entrada", "r");

            while(!feof($fp)) {

                $linea = fgets($fp);

                $arreglo = explode("\t",$linea);

                list($fecha,$suc,$itemapro,$itemvicsa,$descp,$val1,$val2,$val3) = $arreglo;

                $itemapro = str_replace("i","",$itemapro);
                // $itemvicsa = str_replace("i","",$itemvicsa);

                $sql4 = "UPDATE INT_APRO_STOCK SET stock_a = '$val1' WHERE ItemCodeApro = '$itemapro' AND sucursal = '$suc'";
                $stmt4 = sqlsrv_query( $conn, $sql4 );
                    if( $stmt4 === true) {
                        die( print_r( sqlsrv_errors(), true) );
                    }
            }
            fclose($fp);
            rename ("C:/FTP/aproftp/stock/$entrada","C:/FTP/aproftp_proc/stock/$entrada");
        }
    }
    closedir($gestor);
}

?>