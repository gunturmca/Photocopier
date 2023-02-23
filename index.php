
<!DOCTYPE html>
<html>
<meta charset="utf-8">
  <title>Photo Copier Usage</title>

  <script type="text/javascript" src="http://localhost:2301/photocopier/jskendo/jquery-1.12.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<link rel="icon" href="http://localhost:2301/photocopier/image/images.jfif" type="image/icon type">
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



 
  <script src="http://localhost:2301/photocopier/jskendo/kendo.all.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
       

	
   

		

<script type="text/javascript">
 var index=1;
 var hgt;
 var frm;
var wnd;
 var flag = 0;
 var rowIndex1 = 1;
 var flagsrc = 0; 
 var nik1;
 var flag;
 var tgl;
 var site;
 var flagtoarray=0;
 var arrexcel=[];
 var arrkelas = [];

					$(document).ready(function() {
						
							
							 var taskb = document.documentElement.clientHeight;
							hgt = taskb -195
								$('#groupinput').height(hgt+20);

								$('#tgl').datepicker({
								autoclose: true,
								format: "M-yyyy",
								viewMode: "months", 
    							minViewMode: "months"
							});
								var d = moment();
							$('#tgl').val(d.format('MMM-YYYY'));

							$('#grid').height(hgt+55);

							
								site= $('#datasite').val();
								 tgl = $('#tgl').val();
								flagsrc = 0;
							
									
                    		
							 
							 //kelas();
							 $("#datasite").kendoMultiColumnComboBox({
								 
										dataTextField: "datasite",
										dataValueField: "datasite",
										height: 400,
										columns: [
											
											{ field: "datasite", title: "Site", width: "100%" },
											// { field: "nama", title: "Nama" },
											
									  		
										],
										footerTemplate: 'Total #: instance.dataSource.total() # items found',
										filter: "contains",
										filterFields: ["datasite"],
										dataSource: [
											{ datasite: "ALL" },
											{ datasite: "SUKABUMI" },
											{ datasite: "MAJALENGKA" },
											{ datasite: "TANGERANG" }
										],
										// change: function (e) {
										// 			var dataItem = e.sender.dataItem();
										// 			site = $('#datasite').val(dataItem.datasite) ;

										// 		}
									});
									 var multicolumncombobox = $("#datasite").data("kendoMultiColumnComboBox");
									 multicolumncombobox.value("ALL");
									 creategrid(flagsrc);
							 $("#search").click(function() {
								
								
								//  tgl = $('#tgl').val();
								// flagsrc = 1;
								// creategrid(flagsrc);
								// flag = 0
								// document.getElementById("new").disabled = false;
								$("#grid").remove();
								$('#groupinput').append("<div id='grid'></div>");   
								$('#groupinput').height(hgt+4);
								$('#grid').height(hgt+55);
								creategrid(flagsrc);
								document.getElementById("new").disabled = false;
							});

							$("#cancel").click(function() {
								arrexcel = [];
	
								// $('#tgl').val(d.format('MMM-YYYY'));
								
								 tgl = $('#tgl').val();
								document.getElementById("new").disabled = false;
								flagsrc = 1;
								var grid = $("#grid").data("kendoGrid");
								grid.showColumn(0);
								grid.showColumn("Site");
								grid.showColumn("Month");
								
								creategrid(flagsrc);
								
							});

							$("#new").click(function() {
								var grid = $("#grid").data("kendoGrid");
								
								var site= $('#datasite').val();
								if (site=='ALL')
								{
									alert('Please select site');
									return;
								}
								flag =1;
								arrexcel=[]
								var newRow = {add:"1",Site: site, Section: "", Month:$('#tgl').val(),PrinterModel: "",UserDepartment:"",Usage:1};

								grid.hideColumn(0);
								grid.hideColumn("Site");
								grid.hideColumn("Month");
								
								document.getElementById("new").disabled = true;
								grid.dataSource.insert(0, newRow);
								grid.editCell($("#grid td:eq(5)"));		
										
								
							});

							$("#save").click(function() {
								
								if (flag ==1)
								{
									insert();
									document.getElementById("new").disabled = false;
									
									
								}
								if (flag ==2)
								{
									update();
									document.getElementById("new").disabled = false;
								}
								
								
								
							});
							
					});

					function Delete(arr,value)
					{    
						var deleteMe = function(arr,me){
						var i = arr.length;
						for (var k = 0; k < i; k++) 
						{
							
							//alert(arr[k].idphoto_copier);
							if(arr[k].idphoto_copier === me ) arr.splice(k,1);
						//alert(arr[k].idphoto_copier);
						}
						// while( i-- ) if(arr[i] === me ) arr.splice(i,1);
						// alert(arr[i]);
						}
						deleteMe(arr,value);
						//alert(value);
					}

					function insert()
					{
							arrexcel = [];
								inserttoarray();
								var arr= JSON.stringify(arrexcel);
			
								if (arr.length > 1)
								{
									$.ajax({
									 url: "http://localhost:2301/photocopier/api/usagePrint/savedata",
									 type: 'post',
									 data:{arr:arr},
									 dataType: "json",
									 success: function(data)
										 {
											
											if (data.status==true)
											{
												document.getElementById("new").disabled = false;
												alert(data.message);
												$("#grid").remove();
												$('#groupinput').append("<div id='grid'></div>");   
												$('#groupinput').height(hgt+4);
												$('#grid').height(hgt+55);
												creategrid(flagsrc);

												arrexcel = [];
												flag=0;
											}
											else
											
											{
												
												alert(data.message);
											}
											
										 }
														  
									});
									
								}
								
								
					}
					function update()
					{
							
								
								var arr= JSON.stringify(arrexcel);
							
								if (arr.length > 2)
								{
									
									$.ajax({
									 url: "http://localhost:2301/photocopier/api/usagePrint/updatedata",
									 type: 'post',
									 data:{arr:arr},
									 dataType: "json",
									 success: function(data)
										 {
											
											if (data.status==true)
											{
												alert(data.message);
												
											}
											else
											
											{
												
												alert(data.message);
											}
										 }
														  
									});
								}
								
					}
					function inserttoarray() {
						
					var grid = $("#grid").data("kendoGrid");
					var data = grid.dataSource.data();
								
					var grid = $("#grid").data("kendoGrid")
					var ds = grid.dataSource.view();
					
					for (var i = 0; i < ds.length; i++) 
						{
								var dataItem = $("#grid").data("kendoGrid").dataSource.data()[i];
										var Add = ds[i].add;
										var Section = ds[i].Section;
										var PrinterModel = ds[i].PrinterModel;
										var Month = ds[i].Month;
										var UserDepartment = ds[i].UserDepartment;
										var Usage = ds[i].Usage;
										var Site = $('#datasite').val();;
										
										if (Add==1 && Site !== 'ALL')
										{
											
											if  ( Section !== ''  && PrinterModel !== ''  && Month !== ''
												&& UserDepartment !== '' && Usage !== '' && Site !== '')
												{	
															arrexcel.push({
															Add :Add,
															Site :Site,
															Section :Section,
															PrinterModel :PrinterModel,
															Month :Month,
															UserDepartment :UserDepartment,
															Usage :Usage,
															
															});
												}
												var arr= JSON.stringify(arrexcel);

											
										}
							}
						
					}
					function inserttoarray1() 
					
					{
											
					
							var grid = $("#grid").data("kendoGrid");  
							var dataItem = grid.dataItem(grid.select());  
							
									//alert(dataItem.PrinterModel);
										var idphoto_copier = dataItem.idphoto_copier;
										var Section = dataItem.Section;
										var PrinterModel = dataItem.PrinterModel;
										var Month = dataItem.Month;
										var UserDepartment = dataItem.UserDepartment;
						var Usage = dataItem.ColTotalUsg;
						var Site = dataItem.Site;
										var Site = dataItem.Site;
									
							if (idphoto_copier > 0) {
								if  ( Section !== ''  && PrinterModel !== ''  && Month !== ''
								&& UserDepartment !== '' && Usage !== '' && Site !== '')
								{
									Delete(arrexcel,idphoto_copier);
										arrexcel.push({
											 idphoto_copier :idphoto_copier,
											 Site :Site,
											 Section :Section,
											 PrinterModel :PrinterModel,
											 Month :Month,
											 UserDepartment :UserDepartment,
											 Usage :Usage,
											
											});
											
											var arr= JSON.stringify(arrexcel);
								}
								
											
											
							}
						
					}

						function creategrid(flagsrc) {
						  	//var datakelas=JSON.stringify(arrkelas);
							  	
							  	site= $('#datasite').val();
								 tgl = $('#tgl').val();
							$("#grid").kendoGrid({
									
									columns: [
										{
										title: "Action",
										width: "70px",
										template: "<a href='\\#'  title='Contact me!' class='x1' ><i class='fa fa-edit'></i></a> || <a href='\\\#' title='Contact me!' class='x2' id='x2'><i class='fa fa-trash-o'></i></a>",
									    filterable: false
										},
									  { field: "idphoto_copier",title:"idphoto_copier",hidden:true},
									  { field: "add",title:"add",hidden:true},
									  { 
										field: "Site",
										width: "200px",
										title:"Site",
										editor:function(container,options)
													{
													$('<input data-text-field="Site" data-value-field="Site" data-bind="value:' + options.field + '"/>')
													.appendTo(container)
													.kendoMultiColumnComboBox({
														enable: false,
														dataTextField: "Site",
														dataValueField: "Site",
														height: 400,
														columns: [
															
															
															{ field: "Site", title: "Site",width:"100%" },
															
															
															
														],
														footerTemplate: 'Total #: instance.dataSource.total() # items found',
														filter: "contains",
														filterFields: ["Site"],
														value: options.model.Site, // THIS IS THE CHANGE I MADE
														dataSource: {
															transport: {
																read: {
																	dataType: "json",
																	url: 'http://localhost:2301/photocopier/api/usagePrint/Site',
																}
															}
														},
														
													});
											},
										//values: datakelas,
										},
										{ field: "Month", format:"{0:MMM-YYYY}", width:130, editor: function(container, options){
										var input = $("<input/>"); 
										input.attr("name",options.field); 
										
										input.appendTo(container); 
										
										input.kendoDatePicker({
											start: "year",

											// defines when the calendar should return date
											depth: "year",

											// display month and year in the input
											format: "yyyy MMM",

											// specifies that DateInput is used for masking the input element
											dateInput: true});
										}},
									  /*{ field: "masuk",title:"Masuk"},*/

									  { field: "Section",title:"Section",
												editor:function(container,options)
													{
													$('<input data-text-field="PrinterLoc" data-value-field="PrinterLoc" data-bind="value:' + options.field + '"/>')
													.appendTo(container)
													.kendoMultiColumnComboBox({
														dataTextField: "PrinterLoc",
														dataValueField: "PrinterLoc",
														height: 400,
														columns: [
															
															
															{ field: "PrinterLoc", title: "Printer Location",width:"100%" },
															
															
															
														],
														footerTemplate: 'Total #: instance.dataSource.total() # items found',
														filter: "contains",
														filterFields: ["PrinterLoc"],
														value: options.model.LocCode, // THIS IS THE CHANGE I MADE
														dataSource: {
															transport: {
																read: {
																	dataType: "json",
																	url: 'http://localhost:2301/photocopier/api/usagePrint/dataPrinterLoc',
																}
															}
														},
														
													});
											},

										},
									  
									  { field: "PrinterModel",title:"Printer Model",
												editor:function(container,options)
													{
													$('<input data-text-field="PrinterModel" data-value-field="PrinterModel" data-bind="value:' + options.field + '"/>')
													.appendTo(container)
													.kendoMultiColumnComboBox({
														dataTextField: "PrinterLoc",
														dataValueField: "PrinterLoc",
														height: 400,
														columns: [
															
															
															{ field: "PrinterModel", title: "Printer Model",width:"100%" },
															
															
															
														],
														footerTemplate: 'Total #: instance.dataSource.total() # items found',
														filter: "contains",
														filterFields: ["PrinterModel"],
														value: options.model.LocCode, // THIS IS THE CHANGE I MADE
														dataSource: {
															transport: {
																read: {
																	dataType: "json",
																	url: 'http://localhost:2301/photocopier/api/usagePrint/dataPrinterModel',
																}
															}
														},
														
													});
											},
										},	
										
									  { field: "UserDepartment",title:"User Department",
										editor:function(container,options)
													{
													$('<input data-text-field="UserDepartment" data-value-field="UserDepartment" data-bind="value:' + options.field + '"/>')
													.appendTo(container)
													.kendoMultiColumnComboBox({
														dataTextField: "PrinterLoc",
														dataValueField: "PrinterLoc",
														height: 400,
														columns: [
															
															
															{ field: "UserDepartment", title: "User Department",width:"100%" },
															
															
															
														],
														footerTemplate: 'Total #: instance.dataSource.total() # items found',
														filter: "contains",
														filterFields: ["UserDepartment"],
														value: options.model.LocCode, // THIS IS THE CHANGE I MADE
														dataSource: {
															transport: {
																read: {
																	dataType: "json",
																	url: 'http://localhost:2301/photocopier/api/usagePrint/dataUserDepartment',
																}
															}
														},
														
													});
											},
										},
									 
										{field: "Usage",title: "Usage",width: 100,headerAttributes: {style: "font-weight: bold"},
										attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",Usage) #'
									},
									{field: "ColTotalUsg",title: "Color Usage",width: 100,
										attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",ColTotalUsg) #'
									},
									{field: "BwTotalUsg",title: "Black Usage",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",BwTotalUsg) #'
									}, 							
									{field: "ColCopy",title: "Color Copy",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",ColCopy) #'
									},
									{field: "ColScan",title: "Color Scan",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",ColScan) #'
									},
									{field: "ColPrint",title: "Color Print",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",ColPrint) #'
									},
									{field: "BWCopy",title: "Black Copy",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",BWCopy) #'
									},
									{field: "BWScan",title: "Black Scan",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
										template: '#= kendo.format("{0:n2}",BWScan) #'
									},
									{field: "BWPrint",title: "Black Print",width: 100,
									attributes: { style: "text-align: Right; font-size: 14px"},
									template: '#= kendo.format("{0:n2}",BWPrint) #'},

										
									  
									],
									
									dataSource: {
										transport: {
										read: 
											{
												url: "http://localhost:2301/photocopier/api/usagePrint/showdata",
												contentType: "application/json; charset=utf-8",
												dataType: "json",
												data:{flagsrc:flagsrc,tgl:tgl,site:site},
												type: 'get',
												
											},			
											},
											
											pageSize: 50,
											
											schema: {
												model: {
														//id: "idphoto_copier",
														fields: {
															Site : {type: "string"},
															Usage: { type: "number",format: "{0:n2}" },
															
														}
													}},
												
												
												},	
												
												sortable: true,
						
												pageable: {
												pageSizes: [50, 75, 100],
											},
										
										
										selectable: true,
									//filterable: true,
									// selectable: "cell",      
									// allowCopy: true,    
									editable: {
									mode: "incell"
									},   
									//navigatable:true,
									 
									 
									//editable: "cell",
									cellClose:  function(e) {
										
											// var columns = e.sender.getOptions().columns
											// 			var columnNames = [];
											// 			var dataItem = e.sender.dataItem($(e.container).parent())
											// for(let i = 0; i< columns.length;i++){
											// 	columnNames.push(columns[i].field)
											// 	var value = dataItem[columnNames[i]]
											// 	alert(columns[i].field + ' - ' + value);
												
												
											// }
											// var lastCell = $(e.target).closest('td');
         									//  var lastCellIndex = lastCell.index();

											// alert(columns[0].field)
											// var dataItem = e.sender.dataItem($(e.container).parent())
											if (flag ==2)
												{
															inserttoarray1();
												}
											
											// var value = dataItem[columnNames[1]]
											// alert(value);
											// dataItem.set(columnNames[1], value + 20)
									}
									
									//navigatable: true,
									//pageable: { pageSizes: false },        
								  }).on("click", "a.x1", function() {
									
									
									flagtoarray++;
									if (flagtoarray===2)
										{
											
											inserttoarray1();
											
											flagtoarray=0;
											
										}
				
										
											flag = 2;
											
											
										
									
								}).on("click", "a.x2", function() {
									
									var grid = $("#grid").data("kendoGrid");
									var tr = $(this).closest("tr");
									var dataItem = $("#grid").data("kendoGrid").dataItem(tr);
									//alert(dataItem.PrinterModel);
									var idphoto_copier = dataItem.idphoto_copier;
									$.ajax({
									 url: "http://localhost:2301/photocopier/api/usagePrint/deletedata",
									 type: 'get',
									 data:{idphoto_copier:idphoto_copier},
									 dataType: "json",
									 success: function(data)
										 {
											//creategrid(flagsrc,tgl,site);
										 }
														  
									});
									grid.removeRow(grid.select());
    									flag = 2
										return;
										
								});

								



								
								
										var grid = $('#grid').data('kendoGrid');

										grid.table.on('keydown', function moveToNext(e) {
										if (e.keyCode === kendo.keys.TAB && $($(e.target).closest('.k-edit-cell'))[0]) {
											
											e.preventDefault();
											var currentNumberOfItems = grid.dataSource.view().length;
											var row = $(e.target).closest('tr').index();
											var col = grid.cellIndex($(e.target).closest('td'));

											var dataItem = grid.dataItem($(e.target).closest('tr'));
											var field = grid.columns[col].field;
											var value = $(e.target).val();
											if (value === "")
											{
												alert('Please fill in the column the empty one');
											}
											//dataItem.set(field, value);
									if (value !== "")
									{
												if (row >= 0 && row < currentNumberOfItems && col >= 0 && col < grid.columns.length) {
												var nextCellRow;
												var nextCellCol;

												if(!e.shiftKey){
													nextCellCol = (col + 1) === grid.columns.length ? 0 : col + 1;
												} else {
													nextCellCol = (col - 1) === -1 ?  grid.columns.length - 1: col - 1;
												}

												if(!e.shiftKey){
													nextCellRow = nextCellCol === 0 ? row + 1 : row;
												} else {
													nextCellRow = nextCellCol === grid.columns.length - 1 ? row - 1 : row;
												}

												if(nextCellRow >= currentNumberOfItems || nextCellRow < 0){
													if (field=="Usage")
															{
																if (confirm('Are you sure you want to add row?')) {
																	var newRow = {add:"1",Site: site, Section: "", Month:$('#tgl').val(),PrinterModel: "",UserDepartment:"",Usage:1};
																	grid.dataSource.insert(0, newRow);
																	grid.editCell($("#grid td:eq(5)"));	
																} else {
						
																console.log('Thing was not saved to the database.');
																}
															}
													return;
												}
											
												// wait for cell to close and Grid to rebind when changes have been made
												if(!grid.tbody.find("tr:eq(" + nextCellRow + ") td:eq(" + nextCellCol + ")").is('.noneditable')){
												
													grid.editCell(grid.tbody.find("tr:eq(" + nextCellRow + ") td:eq(" + nextCellCol + ")"));
													if (field=="Usage")
															{
																if (confirm('Are you sure you want to add row?')) {
																	var newRow = {add:"1",Site: site, Section: "", Month:$('#tgl').val(),PrinterModel: "",UserDepartment:"",Usage:1};
																	grid.dataSource.insert(0, newRow);
																	grid.editCell($("#grid td:eq(5)"));	
																} else {
																// Do nothing!
																console.log('Thing was not saved to the database.');
																}
																
															}
													
												} else {
													
													grid.editCell(grid.tbody.find("tr:eq(" + nextCellRow + ") td:eq(" + nextCellCol + ")"));
													
												}

												}
											}

										}
										});
									
								}
	
								

								
						
						  </script>
						 
						
<body>
<div id = "frame">
	<div id = "siterpod" style="margin-bottom:3px">
	<table style = "margin-left:10px;margin-top:10px">
  <tr>
    <th ><p style="margin-left:0;"> Site</p></th>
    <th >
		<input name="datasite" id="datasite" style="margin-left:27px;margin-bottom:3px;margin-top:3px;width:100%">
				
	</th>

    
  </tr>
  <tr  >
    <th >Periode</th>
    <td><input style="margin-top: -5px;margin-bottom: -10px;margin-left: 28px" class="form-control datepicker"  name="tgl" id="tgl"  placeholder="Date"></td>
	<td ><button type="button" name="search" id="search" class="btn btn-success" style="margin-left:35px;margin-top:5px"><i class="fa fa-search"></i> Search</button></td>
					 
  </tr>
  </table>
					
						
                      
	</div>

	<div id = "newsave" style="align:right;position: absolute;right: 0px;margin-right:10px;">

		<a  name="import" id="import"  class="btn btn-success" href="importview.php"><i class="fa fa-upload"></i> Import</a>	
			<button type="button" name="cancel" id="cancel"  class="btn btn-success"><i class="fa fa-file"></i> Cancel</button>
			<button type="button" name="new" id="new"  class="btn btn-success"><i class="fa fa-file"></i> New</button>
			<button type="button" name="save" id="save" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
	</div>
	<div id="groupinput" style="margin-top:42px; margin-left:5px; margin-right:5px">
			<div id="grid" ></div>
	</div>
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
      <label for="exampleInputPassword1">Section</label>
      <input type="password" class="form-control" id="passbaru"  placeholder="Section">
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