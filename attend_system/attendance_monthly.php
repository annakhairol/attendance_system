
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
		          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="index.php">Employee List</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="attendance.php">Attendance</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</div>

	<div class="container-fluid mt-5">

		<div class="row">
			<div class="col-md-6">
				<h3> Year </h3>
				<select id="year" class="form-control" onchange="getData()">
					<option value="2021"> 2021 </option>
				</select>
			</div>

			<div class="col-md-6">
				<h3> Month </h3>
				 <select id="month" class="form-control" onchange="getData()">
				 	<option value="All"> All </option>
	                <option value="1" <?= (date('m') == '1') ? 'selected' : '' ?>> 01 - January </option>
	                <option value="2" <?= (date('m') == '2') ? 'selected' : '' ?>> 02 - Febuary </option>
	                <option value="3" <?= (date('m') == '3') ? 'selected' : '' ?>> 03 - March </option>
	                <option value="4" <?= (date('m') == '4') ? 'selected' : '' ?>> 04 - April </option>
	                <option value="5" <?= (date('m') == '5') ? 'selected' : '' ?>> 05 - May </option>
	                <option value="6" <?= (date('m') == '6') ? 'selected' : '' ?>> 06 - June </option>
	                <option value="7" <?= (date('m') == '7') ? 'selected' : '' ?>> 07 - July </option>
	                <option value="8" <?= (date('m') == '8') ? 'selected' : '' ?>> 08 - August </option>
	                <option value="9" <?= (date('m') == '9') ? 'selected' : '' ?>> 09 - September </option>
	                <option value="10" <?= (date('m') == '10') ? 'selected' : '' ?>> 10 - October </option>
	                <option value="11" <?= (date('m') == '11') ? 'selected' : '' ?>> 11 - November </option>
	                <option value="12" <?= (date('m') == '12') ? 'selected' : '' ?>> 12 - December </option>
	            </select>
			</div>
			
		</div>
	</div>

	<div class="container-fluid mt-5 mb-10">
		<div id="showData"></div>
	</div>

	
	<script type="text/javascript">
		
			$(document).ready(function() {
				getData();
			});

			function getData()
			{
				var month = $('#month').val();
				var year = $('#year').val();

				$('#showData').empty(); // reset div

				$.ajax({
					type : 'GET',
					url : 'api.php?code=4&year='+year+'&month='+month,
					dataType : "html",
					success : function(response) {
						$('#showData').html(response);
					}
				});

			}
	</script>

</body>
</html>