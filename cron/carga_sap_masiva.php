<?php

require_once('conexion.php');
require_once("phpmailer/class.phpmailer.php");
require_once("phpmailer/class.smtp.php");

date_default_timezone_set('America/Santiago');

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

                list($oc,$fecha,$dir,$suc,$ordenby,$sku,$descp,$cantidad,$precio,$comentario,$condicionentrega) = $arreglo;
                $dir = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '',$dir);
                $descp = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '',$descp);
                $sku = str_replace("i","",$sku);
                $comentario = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '',$comentario);
                $condicionentrega = substr($condicionentrega, 0, 1);

                $sql4 = "INSERT INTO INT_APRO_OC(DocNum, DocDate, Dir, Ordenby, ItemCode, ItemName, Quantity, ItemPrice, Estado, Sucursal, Comments, CondicionEntrega) 
                VALUES ('$oc','$fecha','$dir','$ordenby','$sku','$descp','$cantidad','$precio','20','$suc','$comentario', '$condicionentrega')";
                    $stmt4 = sqlsrv_query( $conn, $sql4 );
                    if( $stmt4 === true) {
                        die( print_r( sqlsrv_errors(), true) );
                }
            }
            fclose($fp);

                $resultado = substr($entrada, 2, 6);

                $sql_suc = "SELECT TOP 1 Sucursal FROM INT_APRO_OC WHERE DocNum = '$resultado'";
                $stmt_suc = sqlsrv_query( $conn, $sql_suc );
                    if( $stmt_suc === true) {
                        die( print_r( sqlsrv_errors(), true) );
                }
                $row = sqlsrv_fetch_array( $stmt_suc, SQLSRV_FETCH_ASSOC);
                $sucu = $row['Sucursal'];

                $sql_suc_c = "SELECT CodSuc, correo1, correo2, correo3 FROM INT_APRO_SUCURSALES WHERE CodSuc = '$sucu'";
                    $stmt_suc_c = sqlsrv_query( $conn, $sql_suc_c );
                    if( $stmt_suc_c === true) {
                        die( print_r( sqlsrv_errors(), true) );
                }
                $row2 = sqlsrv_fetch_array( $stmt_suc_c, SQLSRV_FETCH_ASSOC);
                $correo1 = $row2['correo1'];
                $correo2 = $row2['correo2'];
                $correo3 = $row2['correo3'];
                $correo4 = "jorge.silva@vicsa.cl";
                $correo5 = "vanessa.hung@vicsa.cl";
                $correo5 = "betzabe.jimenez@apro.cl";
                $correo6 = "damianys.lopez@apro.cl";
                $correo7 = "daniela.burgos@apro.cl";

                //Se envia Correo.
                $email_user = "notificador@vicsa.cl";
                $email_password = "Vicsa*317.";
                $the_subject = "Se ha cargado en la Plataforma Web la OC: ".$resultado;
                $address_to = "ordenes.apro@vicsa.cl";
                $address_to1 = $correo1;
                $address_to2 = $correo2;
                $address_to3 = $correo3;
                $address_to4 = $correo4;
                $address_to5 = $correo5;
                $address_to6 = $correo6;
                $address_to7 = $correo7;
                $from_name = "Integración Apro / Visa";
                $phpmailer = new PHPMailer();
                // ---------- datos de la cuenta de Gmail -------------------------------
                $phpmailer->Username = $email_user;
                $phpmailer->Password = $email_password; 
                //-----------------------------------------------------------------------
                // $phpmailer->SMTPDebug = 1;
                // $phpmailer->CharSet="UTF-8";
                // $phpmailer->SMTPSecure = 'ssl';
                // $phpmailer->Host = "smtp.gmail.com"; // GMail
                // $phpmailer->Port = 465;
                $phpmailer->CharSet="UTF-8";
	            $phpmailer->SMTPSecure = 'tls';
	            $phpmailer->Host = "smtp.office365.com"; // GMail
	            $phpmailer->Port = 587;
                $phpmailer->IsSMTP(); // use SMTP
                $phpmailer->SMTPAuth = true;
                $phpmailer->setFrom($phpmailer->Username,$from_name);
                $phpmailer->AddAddress($address_to); // recipients email
                $phpmailer->addCC($address_to1);
                $phpmailer->addCC($address_to2);
                $phpmailer->addCC($address_to3);
                $phpmailer->addCC($address_to4);
                $phpmailer->addCC($address_to5);
                $phpmailer->addCC($address_to6);
                $phpmailer->addCC($address_to7);
                $phpmailer->Subject = $the_subject;	
                $phpmailer->Body .= "<h3 style='color:#1F497E;'>Se ha cargado la OC: ".$resultado." en la plataforma Integracion Apro / Vicsa.</h3>";
                $phpmailer->Body .= "<p style='color:#1F497E;'>Apartir de ahora, la orden esta disponible para ser confirmada y posteriormente cargada en SAP.</p>";
                $phpmailer->Body .= "<p style='color:#1F497E;'>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
                //$phpmailer->Body .= "<p style='color:#1F497E;'><b>Link del sitio: </b> http://apro.vicsa.cl</p>";
                $phpmailer->IsHTML(true);
                $phpmailer->Send();
                //Fin correo
            rename ("C:/FTP/aproftp/ordenes/$entrada","C:/FTP/aproftp_proc/ordenes/$entrada");
        }
    }
    closedir($gestor);
}

?>