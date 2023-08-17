<?php
require_once('conexion.php');

if ($gestor = opendir('C:/FTP/aproftp/ordenes/')) {
    while (false !== ($entrada = readdir($gestor))) {
        if ($entrada != "." && $entrada != "..") {
            // echo "$entrada\n";
            // echo '<a href="#">'.$entrada.'</a>';
            // echo "<br>";
            // $archivo = "$entrada\n";
            $fp = fopen("C:/FTP/aproftp/ordenes/$entrada", "r");

            while(!feof($fp)) {

                $linea = fgets($fp);

                $arreglo = explode("\t",$linea);

                list($oc,$fecha,$dir,$suc,$ordenby,$sku,$descp,$cantidad,$precio,$comentario) = $arreglo;
                $dir = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '',$dir);
                $descp = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '',$descp);
                $sku = str_replace("i","",$sku);
                $comentario = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '',$comentario);

                $sql4 = "INSERT INTO INT_APRO_OC(DocNum, DocDate, Dir, Ordenby, ItemCode, ItemName, Quantity, ItemPrice, Estado, Sucursal, Comments) 
                VALUES ('$oc','$fecha','$dir','$ordenby','$sku','$descp','$cantidad','$precio','20','$suc','$comentario')";
                    $stmt4 = sqlsrv_query( $conn, $sql4 );
                    if( $stmt4 === true) {
                        die( print_r( sqlsrv_errors(), true) );
                    }
            }
            fclose($fp);
            rename ("C:/FTP/aproftp/ordenes/$entrada","C:/FTP/aproftp_proc/ordenes/$entrada");
        }
    }
    closedir($gestor);
}

?>