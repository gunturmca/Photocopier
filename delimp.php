  
<?php
   include('dbimport.php');
  if (isset($_POST ['delete'])) { 
       $pmodel = $_POST['model'];
       $month = $_POST['startDate'];
       $sql = "DELETE tphoto_copier where Month = '$month' and PrinterModel = '$pmodel'";
      $query = sqlsrv_query($conn, $sql)or die(sqlsrv_errors());
    }
?>