<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Untitled</title>

  <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.3.1119/styles/kendo.common.min.css">
  <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.3.1119/styles/kendo.rtl.min.css">
  <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.3.1119/styles/kendo.default.min.css">
  <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.3.1119/styles/kendo.dataviz.min.css">
  <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.3.1119/styles/kendo.dataviz.default.min.css">
  <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.3.1119/styles/kendo.mobile.all.min.css">

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://cdn.kendostatic.com/2014.3.1119/js/angular.min.js"></script>
  <script src="http://cdn.kendostatic.com/2014.3.1119/js/jszip.min.js"></script>
  <script src="http://cdn.kendostatic.com/2014.3.1119/js/kendo.all.min.js"></script></head>
<body>

  <div id="grid"></div>

<script>
 
  
    $("#grid").kendoGrid({
        excel: {
          fileName: "Northwind Products Stock List.xlsx",
          filterable:true,
          allPages:false
        },
        dataSource: {
            type: "odata",
            transport: {
                read: "http://demos.telerik.com/kendo-ui/service/Northwind.svc/Products"
            },
            pageSize: 7
        },
        sortable: true,
        pageable: true,
        columns: [
            { width: 300, field: "ProductName", title: "Product Name" },
            { field: "UnitsOnOrder", title: "Units On Order" },
            { field: "UnitsInStock", title: "Units In Stock" }
        ]
    });
</script>
</body>
</html>