<?php
//$serverName = "117.102.117.180\SQLEXPRESS,41798"; 
//$connectionInfo = array( "Database"=>"photo_copier_usage", "UID"=>"ERP", "PWD"=>'123$qweRmCa2020');

$serverName = "S-ITD-LAP-012\SQLEXPRESS"; 
$connectionInfo = array( "Database"=>"photo_copier_usage", "UID"=>"", "PWD"=>'');
$conn = sqlsrv_connect( $serverName, $connectionInfo);


 //if( $conn ) {
 //     echo "Connection established.<br />";
 //}else{
  //   echo "Connection could not be established.<br />";
  //   die( print_r( sqlsrv_errors(), true));
// }

?>