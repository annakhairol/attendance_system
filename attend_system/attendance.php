
<!DOCTYPE html>
<html>
<head>
	<title> Employee Attendance System </title>

	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

	<!-- datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">

    	.pagination a {
		  transition: background-color .3s;
		  margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
		}

		.pagination{
		    display: inline-flex;
		}
		div.dataTables_wrapper div.dataTables_paginate{
		    text-align: center;
		}

		pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; }
		.string { color: green; }
		.number { color: blue; }
		.boolean { color: darkorange; }
		.null { color: magenta; }
		.key { font-weight: bold; }

    </style>

</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="#">ST Xpert</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavDropdown">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link" aria-current="page" href="index.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="index.php">Employee List</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" href="attendance.php">Attendance</a>
		        </li>		        
		      </ul>
		    </div>
		  </div>
		</nav>
	</div>

	<div class="container-fluid">
		<h2>Today: <span id="date-time"></span></h2>
		<script type="text/javascript">
			var dt = new Date();
			document.getElementById('date-time').innerHTML=dt;
		</script>
	</div>

	<div class="container-fluid mt-5">
		<button type="button" class="btn btn-success btn-sm float-left" onclick="document.location='attendance_check.php'" style="margin-right: 5px;">Create Attendance</button>
		<button type="button" class="btn btn-secondary btn-sm float-left" onclick="document.location='attendance_monthly.php'">Monthly Report</button>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary btn-sm float-right" onclick="getDataList()">
		   <i class="fa fa-refresh"> Reload</i> 
		</button>

	</div>

	<div class="container-fluid mt-5 mb-10">
		<table id="dataList" border="1" class="table table-bordered table-striped" width="100%" style="margin-top: 15px">
		  <thead class="thead-dark">
		    <tr>
		      <th> # </th>
		      <th> Name </th>
		      <th> Employee ID </th>
		      <th> Attend/Absent </th>
		      <th> Remark </th>
		    </tr>
		  </thead>
		  <tbody></tbody>
		</table>
	</div>

	
	<script type="text/javascript">
		
			$(document).ready(function() {
				getDataList();
			});

			function getDataList()
			{
				var table = $('#dataList').DataTable().clear().destroy();	

				table = $('#dataList').DataTable({
					"pagingType": "full_numbers",
					'paging' 		: true,
					'ordering' 		: true,
					'info' 			: false,
					'lengthChange' 	: false,
					'responsive' 	: false,
					// 'buttons' 		: [ 'copy', 'excel', 'pdf', 'colvis' ],
				});

				// table.buttons().container().appendTo( '#dataList_wrapper .col-md-6:eq(0)' );

				$.ajax({
					type : 'GET',
					url : 'api.php?code=2',
					dataType : "JSON",
					success : function(response) {

						$.each(response, function(key, value) {

							table.row.add([
								response[key].count,
								response[key].emp_fullname,
								response[key].emp_code,
								response[key].att_status,								
								response[key].att_remarks,
							]).draw();

						});

						// output(syntaxHighlight(response));
					}
				});

			}

			function output(inp) {
				if( $('pre').length )  
				{
				  	$('pre').html(inp);
				}else{
			   		document.body.appendChild(document.createElement('pre')).innerHTML = inp;
				}
			}

			function syntaxHighlight(json) {
			    if (typeof json != 'string') {
			         json = JSON.stringify(json, undefined, 2);
			    }
			    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
			    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
			        var cls = 'number';
			        if (/^"/.test(match)) {
			            if (/:$/.test(match)) {
			                cls = 'key';
			            } else {
			                cls = 'string';
			            }
			        } else if (/true|false/.test(match)) {
			            cls = 'boolean';
			        } else if (/null/.test(match)) {
			            cls = 'null';
			        }
			        return '<span class="' + cls + '">' + match + '</span>';
			    });
			}

	</script>

</body>
</html>