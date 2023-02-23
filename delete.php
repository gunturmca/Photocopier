<?php
//including the database connection file
//include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
//$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead
?>

<html>
<meta charset="utf-8">
  <title>Photo Copier Usage</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  <link rel="stylesheet" href="http://localhost:2301/photocopier/styles/kendo.common.min.css">
  <link rel="stylesheet" href="http://localhost:2301/photocopier/styles/kendo.rtl.min.css">
  <link rel="stylesheet" href="http://localhost:2301/photocopier/styles/kendo.default.min.css">
  <link rel="stylesheet" href="http://localhost:2301/photocopier/styles/kendo.dataviz.min.css">
  <link rel="stylesheet" href="http://localhost:2301/photocopier/styles/kendo.dataviz.default.min.css">
  <link rel="stylesheet" href="http://localhost:2301/photocopier/styles/kendo.mobile.all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

 
  <script src="http://localhost:2301/photocopier/jskendo/kendo.all.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">		
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">		

	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>  

  <script type="text/javascript">


					$(document).ready(function() {
						
							 var hgt;
							 var frm;
							 var wnd;
							 var taskb = document.documentElement.clientHeight;
							hgt = taskb -195
								$('#groupinput').height(hgt+32);

								
								
							$('#grid').height(hgt+60)

							
								flagsrc = 0;
							
							 creategrid(flagsrc,tgl,site);
							 //kelas();
							
							
							});


         
						function creategrid(flagsrc,tgl,site) {
					
							   $("#grid").kendoGrid({
									
									

									dataSource: {
                                                transport: {
                                                            read: 
                                                                {
                                                                    url: "http://localhost:2301/photocopier/api/usagePrint/showdata",
                                                                    contentType: "application/json; charset=utf-8",
                                                                    dataType: "json",
                                                                    type: 'get',
                                                                },			
                                                            },
                                                            schema: {
													model: {
														fields: {
															
															idphoto_copier: { field: "idphoto_copier" },
														}
													}},
                                                pageSize: 50,
                                                
												
                                            },

                                            height: 550,
                filterable: true,
                sortable: true,
                pageable: true,
                              columns: [
										
									  { field: "idphoto_copier",title:"idphoto_copier"},
									],
									
								
								  })
								
								}
	
								
						
						  </script>
						 
						
<body>
<div id = "frame">
	<div id = "siterpod" style="margin-bottom:3px">
	<table style = "margin-left:10px;margin-top:10px">
  <tr>
    <th>Site</th>
    <th>
		<select name="site" id="site" class="form-control" style="margin-left:27px">
				<option value="0">Tangerang</option>
				<option value="1">Sukabumi</option>
				<option value="2">Majalengka</option>
		</select>
	</th>
	<th></th>
    
  </tr>
  <tr >
    <th >Periode</th>
    <td><input style="margin-top: -5px;margin-bottom: -10px;margin-left: 28px;" class="form-control datepicker"  name="tgl" id="tgl"  placeholder="Date"></td>
	<td ><button type="button" name="search" id="search" class="btn btn-success" style="margin-left:35px;margin-top:5px"><i class="fa fa-search"></i> Search</button></td>
					 
  </tr>
  </table>
					
						
                      
	</div>

	<div id = "newsave" style="align:right;position: absolute;right: 0px;margin-right:10px;">
			<button type="button" name="new" id="new"  class="btn btn-success"><i class="fa fa-file"></i> New</button>
			
			<button type="button" name="save" id="save" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
	</div>
	<div id="grid" style="margin-top:42px; margin-left:5px; margin-right:5px"></div>
</div>



<div id="mylogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Photo Copier Usage</h4>
      </div>
      <div class="modal-body">
        <form name="form">
    
    <div class="form-group">
      <label for="exampleInputPassword1">Printer Location</label>
      <input type="password" class="form-control" id="passbaru"  placeholder="Printer Location">
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Printer Model</label>
      <input type="password" class="form-control" id="passlama"  placeholder="Printer Model">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Month</label>
      <input type="password" class="form-control" id="passbaru"  placeholder="Month">
    </div>
	<div class="form-group">
      <label for="exampleInputEmail1">Usage</label>
      <input type="password" class="form-control" id="passlama"  placeholder="Usage">
    </div>
   
  </form>
      </div>
      <div class="modal-footer">
       <button type="button" id="simpan" class="btn btn-success" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>