<!DOCTYPE html>
<html>
<style>
     {
  font-family: arial, sans-serif;
  box-sizing: border-box;
}

#import_table {
  border-collapse: collapse;
  width :100%;
}
#import_table tr:nth-child(odd) {
  background: #f2f2f2;
}
#import_table td {
  padding: 10px;
}
#import_table th {
  padding: 10px;
}
#import_table tr td:first-child, {
  display: table-cell;
    vertical-align: inherit;
    font-weight: bold !important;
}
  .ui-datepicker-calendar {
        display: none;
    }
.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
  max-width: 100%;
}



</style>
  <head>
    <title>CSV To HTML Table</title>
      <title>Photo Copier Import</title>
      <link rel="icon" href="http://localhost:2301/photocopier/image/images.jfif" type="image/icon type">
      <script defer src="1b-read-csv.js"></script>
      <script type="text/javascript" src="http://localhost:2301/photocopier/jskendo/jquery-1.12.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
      <script src="http://localhost:2301/photocopier/jskendo/kendo.all.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
       </head>

      <?php

      include('dbimport.php'); 

        //Import Code
      $submit_value = 0;
       if (isset($_POST ['simpan'])) { 

            if ($_FILES['csv']['size'] > 0) {
             //get the csv file 
            $file = $_FILES['csv']['tmp_name']; 
             $handle = fopen($file, "r");
             $i = 0;
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
             if ($i > 0) {
        //SITE
         if ( substr($data[0], 0, 1) == '1')
         {$sitel = "TANGERANG";}
         elseif(substr($data[0], 0, 1)== '2')
         {$sitel = "SUKABUMI";}
         elseif(substr($data[0], 0, 1)== '3')
         {$sitel = "MAJALENGKA";} else {$sitel = "Wrong Format";}
         //DEPARTEMENT & SECTION
         if (substr($data[0], -4)== '0100')
         {$deparl = "Development"; $secl = 'Development';}
         elseif( substr($data[0], -4)== '0101')
         {$deparl = "Development"; $secl = 'Design & Marker';}
         elseif(substr($data[0], -4)== '0102')
         {$deparl = "Development"; $secl = 'Sample Production';}

         elseif(substr($data[0], -4)== '0200')
         {$deparl = "Engineering"; $secl = 'Engineering';}
         elseif(substr($data[0], -4)== '0201')
         {$deparl = "Engineering"; $secl = 'Facility';}
         elseif(substr($data[0], -4)== '0202')
         {$deparl = "Engineering"; $secl = 'General';}
         elseif(substr($data[0], -4)== '0203')
         {$deparl = "Engineering"; $secl = 'Machinery & Equipment';}

         elseif(substr($data[0], -4)== '0300')
         {$deparl = "Finance"; $secl='Finanace';}
         elseif(substr($data[0], -4)== '0301')
         {$deparl = "Finance"; $secl='Accounting';}
         elseif(substr($data[0], -4)== '0302')
         {$deparl = "Finance"; $secl='Payroll';}

         elseif(substr($data[0], -4)== '0400')
         {$deparl = "Human Resource"; $secl = 'Human Resource';}
         elseif(substr($data[0], -4)== '0401')
         {$deparl = "Human Resource"; $secl = 'Procurement';}
         elseif(substr($data[0], -4)== '0402')
         {$deparl = "Human Resource"; $secl = 'General';}
         elseif(substr($data[0], -4)== '0403')
         {$deparl = "Human Resource"; $secl = 'Recruitment';}

         elseif(substr($data[0], -4)== '0500')
         {$deparl = "Industrial Engineering"; $secl = 'Industrial Engineering';}
         elseif(substr($data[0], -4)== '0501')
         {$deparl = "Industrial Engineering"; $secl = 'Costing';}
         elseif(substr($data[0], -4)== '0502')
         {$deparl = "Industrial Engineering"; $secl = 'General';}
         elseif(substr($data[0], -4)== '0503')
         {$deparl = "Industrial Engineering"; $secl = 'Production';}
         elseif(substr($data[0], -4)== '0504')
         {$deparl = "Industrial Engineering"; $secl = 'Training & Development';}

         elseif(substr($data[0], -4)== '0600')
         {$deparl = "Information Technology"; $secl= 'Information Technology';}
         elseif(substr($data[0], -4)== '0601')
         {$deparl = "Information Technology"; $secl= 'Infrastructure';}
         elseif(substr($data[0], -4)== '0602')
         {$deparl = "Information Technology"; $secl= 'Systems';}

         elseif(substr($data[0], -4)== '0700')
         {$deparl = "Logistics"; $secl= 'Logistic';}
         elseif(substr($data[0], -4)== '0701')
         {$deparl = "Logistics"; $secl= 'Accessories Warehouse';}
         elseif(substr($data[0], -4)== '0702')
         {$deparl = "Logistics"; $secl= 'Custom';}
         elseif(substr($data[0], -4)== '0703')
         {$deparl = "Logistics"; $secl= 'Export';}
         elseif(substr($data[0], -4)== '0704')
         {$deparl = "Logistics"; $secl= 'Fabric Warehouse';}
         elseif(substr($data[0], -4)== '0705')
         {$deparl = "Logistics"; $secl= 'General';}
         elseif(substr($data[0], -4)== '0706')
         {$deparl = "Logistics"; $secl= 'Import';}
         elseif(substr($data[0], -4)== '0707')
         {$deparl = "Logistics"; $secl= 'Local Freight';}
         elseif(substr($data[0], -4)== '0708')
         {$deparl = "Logistics"; $secl= 'Warehouse Accessories';}
         elseif(substr($data[0], -4)== '0709')
         {$deparl = "Logistics"; $secl= 'Warehouse Fabric';}
         elseif(substr($data[0], -4)== '0710')
         {$deparl = "Logistics"; $secl= 'Warehouse Finished Goods';}
         elseif(substr($data[0], -4)== '0711')
         {$deparl = "Logistics"; $secl= 'Warehouse Mechinery & Equipment';}
         elseif(substr($data[0], -4)== '0712')
         {$deparl = "Logistics"; $secl= 'Warehouse Outsourcing';}
         elseif(substr($data[0], -4)== '0713')
         {$deparl = "Logistics"; $secl= 'Warehouse Scrap';}

         elseif(substr($data[0], -4)== '0800')
         {$deparl = "Management & Administraton"; $secl = 'Management & Administration';}
         elseif(substr($data[0], -4)== '0801')
         {$deparl = "Management & Administraton"; $secl = 'Area Maintenance';}
         elseif(substr($data[0], -4)== '0802')
         {$deparl = "Management & Administration"; $secl = 'General';}
         elseif(substr($data[0], -4)== '0803')
         {$deparl = "Management & Administration"; $secl = 'Information & Process Engineering (IPE)';}
         elseif(substr($data[0], -4)== '0804')
         {$deparl = "Management & Administration"; $secl = 'Medical';}
         elseif(substr($data[0], -4)== '0805')
         {$deparl = "Management & Administration"; $secl = 'Procurement';}
         elseif(substr($data[0], -4)== '0806')
         {$deparl = "Management & Administration"; $secl = 'Production Planning & Inventory Control (PPIC)';}
         elseif(substr($data[0], -4)== '0807')
         {$deparl = "Management & Administration"; $secl = 'Reception';}
         elseif(substr($data[0], -4)== '0808')
         {$deparl = "Management & Administration"; $secl = 'Security';}
         elseif(substr($data[0], -4)== '0809')
         {$deparl = "Management & Administration"; $secl = 'Transport';}

         elseif(substr($data[0], -4)== '0900')
         {$deparl = "Merchandising"; $sec = 'Merchandising';}

         elseif(substr($data[0], -4)== '1000')
         {$deparl = "Planning Information Control"; $secl ='Planning Information Control';}
         elseif(substr($data[0], -4)== '1001')
         {$deparl = "Planning Information Control"; $secl ='Accessories Monitoring';}
         elseif(substr($data[0], -4)== '1002')
         {$deparl = "Planning Information Control"; $secl ='Cutting Planner';}
         elseif(substr($data[0], -4)== '1003')
         {$deparl = "Planning Information Control"; $secl ='Fabric Monitoring';}
         elseif(substr($data[0], -4)== '1004')
         {$deparl = "Planning Information Control"; $secl ='General';}
         elseif(substr($data[0], -4)== '1005')
         {$deparl = "Planning Information Control"; $secl ='Sewing Planner';}
         elseif(substr($data[0], -4)== '1006')
         {$deparl = "Planning Information Control"; $secl ='Sub-con';}
         elseif(substr($data[0], -4)== '1007')
         {$deparl = "Planning Information Control"; $secl ='WIP';}

         elseif(substr($data[0], -4)== '2000')
         {$deparl = "Production"; $secl= 'Production';}
         elseif(substr($data[0], -4)== '2001')
         {$deparl = "Production"; $secl= 'Cutting';}
         elseif(substr($data[0], -4)== '2002')
         {$deparl = "Production"; $secl= 'Distribution';}
         elseif(substr($data[0], -4)== '2003')
         {$deparl = "Production"; $secl= 'Finishing';}
         elseif(substr($data[0], -4)== '2004')
         {$deparl = "Production"; $secl= 'General';}
         elseif(substr($data[0], -4)== '2005')
         {$deparl = "Production"; $secl= 'Sewing';}

         elseif(substr($data[0], -4)== '3000')
         {$deparl = "Production Planning & Inventory Control (PPIC)"; $secl= "Production Planning & Inventory Control (PPIC)";}
         elseif(substr($data[0], -4)== '3001')
         {$deparl = "Production Planning & Inventory Control (PPIC)"; $secl= "General";}

         elseif(substr($data[0], -4)== '4000')
         {$deparl = "Quality Assurance"; $secl = "Quality Assurance";}
         elseif(substr($data[0], -4)== '4001')
         {$deparl = "Quality Assurance"; $secl = "Laboratory";}
         elseif(substr($data[0], -4)== '4002')
         {$deparl = "Quality Assurance"; $secl = "Product Safety";}

         elseif(substr($data[0], -4)== '5000')
         {$deparl = "Sustainability"; $secl = "Sustainability";}
         elseif(substr($data[0], -4)== '5001')
         {$deparl = "Sustainability"; $secl = "General";}

         else {$deparl = "Wrong Format";}
         //end of location
         //
         $numcols = count($data);
         $pmodel = $_POST['model'];
         $month = $_POST['startDate'];
         $creatdate= date('Y-m-d H:i:s');
         $message = "Wrong Device Model !!";
         $succes = "Import Successfully Inserted !!";
         $succes2 = "Import Successfully Updated !!";
         $previous = "SELECT Top 1 idphoto_copier FROM  tphoto_copier  where Month ='$month' and PrinterModel ='$pmodel' and Site= '$sitel'" ;
         $params = array();
         $prev=sqlsrv_query($conn,$previous,$params) or die ("Could not add to log: " . print_r(sqlsrv_errors()));
         $row=sqlsrv_fetch_array($prev);



          
            if ($row = NULL and $pmodel == "iR-ADV C3530 III" or $pmodel == "iR-ADV C3525i III" or $pmodel =="iR-ADV C3720"){
                if ($numcols > 7 ) {
                    $sql="INSERT into tphoto_copier (Site, UserDepartment, Section,PrinterModel,Month,Usage,ColTotalUsg, BWTotalUsg, ColCopy, ColScan, ColPrint, BWCopy, BWScan, BWPrint,createdate) values
                            ('$sitel','$deparl','$secl','$pmodel','$month','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]',GETDATE())";
        
                    echo "<script type='text/javascript'>alert('$succes');window.location.href ='index.php';</script>";}
                        else {echo "<script type='text/javascript'>alert('$message');window.location.href ='index.php';</script>";}}
             else{
                //if ($numcols <=7 ) {
                    $sql="INSERT into tphoto_copier (Site, UserDepartment, Section,PrinterModel,Month,Usage,ColScan, BWCopy, BWScan, BWPrint,createdate) values
                               ('$sitel','$deparl','$secl','$pmodel','$month','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]',GETDATE())";
                    echo "<script type='text/javascript'>alert('$succes');window.location.href ='index.php';</script>";}
                  //      else{echo "<script type='text/javascript'>alert('$message');window.location.href ='index.php';</script>";}}
        // else{echo "<script type='text/javascript'>alert('Data for $pmodel already exist in $month Please Delete All the Data For $pmodel in $month for $sitel');window.location.href ='importview.php';</script>"; break;}
            $query=sqlsrv_query($conn,$sql, $params) or die(sqlsrv_errors());}



        $i++;
    }
    
        }}


      if (isset($_POST ['delete'])) { 

            if ($_FILES['csv']['size'] > 0) {
             //get the csv file 
            $file = $_FILES['csv']['tmp_name']; 
             $handle = fopen($file, "r");
             $i = 0;
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
             if ($i > 0) {
        //SITE
         if ( substr($data[0], 0, 1) == '1')
         {$sited = "TANGERANG";}
         elseif(substr($data[0], 0, 1)== '2')
         {$sited = "SUKABUMI";}
         elseif(substr($data[0], 0, 1)== '3')
         {$sited = "MAJALENGKA";} 
         //DEPARTEMENT & SECTION
         //end of location
         //
         $pmodel = $_POST['model'];
         $month = $_POST['startDate'];
         $dltmsg= "Data of '$pmodel' is deleted from '$month' periode for '$sited' !";
                  $sql = "DELETE tphoto_copier where Month = '$month' and PrinterModel = '$pmodel' and Site = '$sited'";

       echo "<script type='text/javascript'>alert('$dltmsg');window.location.href ='index.php';</script>";
      $query = sqlsrv_query($conn, $sql)or die(sqlsrv_errors());


        }
        $i++;
    }
    
        }}

    ?>

  <body>
 

      <!---(A) Photocopier SELECT-->

      <form action="" method="post" enctype="multipart/form-data">
 <div class="header">
    <div class="mb-3" style="max-width: 250px;" id="left">
      <label for="model">Model :</label>
      <select id="model" name="model" class="form-control" style="max-height:25px !important">
      <?php
     
        $query = "SELECT *  FROM  mprinter_model where  PrinterModel is not null" ;
        $sql=sqlsrv_query($conn,$query) or die(sqlsrv_errors());

        while ($row=sqlsrv_fetch_array($sql)) { ?>
        <option value="<?= $row['PrinterModel'];?>"><?= $row['PrinterModel'];?></option>             
  
       <?php } ?>
     </select>
    </div>
     <div class="mb-3" style="max-width: 250px;" id="left">
         <label for="startDate" >Periode :</label>
        <input name="startDate" id="startDate" class="form-control date-picker" style="max-height:25px !important;" required/>
     </div>

     <div class="mb-3" style="max-width: 250px;" id="right">
        <label for="csv" class="form-label">Default file input example</label>
      <input type='file' name="csv" id="csv" size="1000" class="form-control" style="max-height:25px !important;" required >
     </div>

     <div class="mb-3" style="max-width: 250px;" id="right">
           <input type="submit" name="simpan" id="simpan" value="Import" class="btn btn-success" onclick="return confirm('Are you sure you want to import all the data for this model?')">
          <a  name="import" id="import"  class="btn btn-success" href="index.php"><i class="fa fa-upload"></i> Cancel</a>
         <input type="submit" name="delete" id="delete" value="Delete" class="btn btn-danger"  onclick="return checkDelete()">

     </div>
 </div>
    <!---(A) Delete Modal-->

    <table id="import_table">
        <tr>
            <th>Dept ID </th>
            <th>User Name</th>
            <th>Total Print</th>
            <th>Color Total</th>
            <th>Black & White Total</th>
            <th>Color Copy</th>
            <th>Color Scan</th>
            <th>Color Print</th>
            <th>Black & white Copy</th>
            <th>Black & white Scan</th>
            <th>Black & white Print</th>


        </tr>
    </table>
          </form>

  </body>
</html>

    <script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker( {
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
			var d = moment();
			$('.date-picker').val(d.format('MMMM YYYY'));
			$('#grid').height(hgt+55);
		
        });

        var pmodel = document.getElementById("model").value;
        var vmonth = document.getElementsById("startDate").value;

        function checkDelete() {
            return confirm("All Data of " + pmodel + " for on This Periode Will be deleted Are you Sure ?")
        }
    </script>