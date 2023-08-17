<?php
require_once('conexion.php');

if ($gestor = opendir('C:/FTP/test/stock/')) {
    while (false !== ($entrada = readdir($gestor))) {
        if ($entrada != "." && $entrada != "..") {
            // echo "$entrada\n";
            // echo '<a href="#">'.$entrada.'</a>';
            // echo "<br>";
            // $archivo = "$entrada\n";
            $fp = fopen("C:/FTP/test/stock/$entrada", "r");

            while(!feof($fp)) {

                $linea = fgets($fp);

                $arreglo = explode("\t",$linea);

                list($fecha,$suc,$itemapro,$itemvicsa,$descp,$val1,$val2,$val3) = $arreglo;

                // $itemapro = str_replace("i","",$itemapro);
                // $itemvicsa = str_replace("i","",$itemvicsa);

                $sql4 = "INSERT INTO INT_APRO_STOCK_3(fecha,sucursal,ItemCodeApro, ItemCodeVicsa, ItemNameApro, stock1, stock2, stock3) 
                VALUES ('$fecha','$suc','$itemapro','$itemvicsa','$descp','$val1','$val2','$val3')";
                    $stmt4 = sqlsrv_query( $conn, $sql4 );
                    if( $stmt4 === true) {
                        die( print_r( sqlsrv_errors(), true) );
                    }
            }
            fclose($fp);
        }
    }
    closedir($gestor);
}

?>