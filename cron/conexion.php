<?php
$serverName = "6.28.32.160";
$connectionInfo = array( "Database"=>"TRK_VICSA", "UID"=>"aproint", "PWD"=>"4pR0*1920", "CharacterSet" =>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

?>