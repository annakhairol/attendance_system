<?php include 'connection.php' ?>
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
		<h2>Date: <span id="date-time"></span></h2>
		<script type="text/javascript">
			var dt = new Date();
			document.getElementById('date-time').innerHTML=dt;
		</script>
	</div>
	<div class="container-fluid mt-5">
		<button type="button" class="btn btn-danger btn-sm float-right" onclick="history.back()">Cancel</button>
	</div>

	<div class="container-fluid mt-5 mb-10">
		<table id="dataList" border="1" class="table table-bordered table-striped" width="100%" style="margin-top: 15px">
		  <thead class="thead-dark">
		    <tr>
		      <th> # </th>
		      <th> Employee Name </th>
		      <th> Employee ID </th>
		      <th> Attend/Absent </th>
		      <th> Remarks </th>
		    </tr>
		  </thead>
		  <tbody>
		  	<form id="formAttendance" method="POST" action="">
			  	<?php 
			  			$sql = "SELECT * FROM employee, group_staff WHERE employee.emp_code = group_staff.emp_code";
	            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	            $count = 1;

	            if(mysqli_num_rows($result) > 0)
	            {

	            	foreach ($result as $row) {
	            		$emp_fullname = $row['emp_fullname'];
		            	$emp_code = $row['emp_code'];
		            	$gs_id = $row['gs_id'];

		            	echo "<tr>";
		            	echo "<td>$count</td>";
		            	echo "<td>$emp_fullname</td>";
		            	echo "<td>
		            						$emp_code
		            						<input type='hidden' name='gs_id[]' value='$gs_id'>
		            				</td>";
		            	echo "<td>
							            	<select name='present[]' class='form-control' required>
									      			<option value='/'> / - Attend </option>
									      			<option value='X'> X - Absent </option>
									      			<option value='H'> H - Holiday </option>
									      		</select>
		            				</td>";
		            	echo "<td><textarea name='txtremark[]' rows='2' cols='50' class='form-control'> </textarea></td>";
		            	echo "</tr>";

		            	$count++;
	            	}
	            	
	            }
	                    
			  	?>

			  	 <tr>
			    	<td colspan="5" align="center">
			    		<input type="text" name="sv_id" value="1"> 
			    		<!-- kalau ada session boleh letak ID supervisor yg create this file -->
			    		<input type="reset" name="resetbtn" class="btn btn-primary" value="Reset">
	            <input type="submit" name="submitbtn" class="btn btn-success" value="Submit">
			    	</td>
			    </tr>

		  	</form>
		  </tbody>

		</table>
	</div>
</body>
</html>

<?php

if (isset($_POST['submitbtn'])) 
{
	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";

	$sv_id = addslashes($_POST['sv_id']); // try la truncate balik db kau tuu mksd kau truncate?  test?data yg ada

	foreach ($_POST['gs_id'] as $key => $data) {
		$gs_id = addslashes($_POST['gs_id'][$key]);
		$present = addslashes($_POST['present'][$key]);
		$remarks = addslashes($_POST['txtremark'][$key]);

    mysqli_query($conn,"INSERT INTO attendance(att_datetime, att_status, att_remarks, sv_id, gs_id, created_at) VALUES 
      (CURDATE(), '$present', '$remarks', '$sv_id', '$gs_id', CURRENT_TIMESTAMP())") or die(mysqli_error($conn));
	}

	echo "<script type='text/javascript' >
		      alert('Attendance is successfully recorded.');
		    </script>";

	mysqli_close($conn);

}

?>
