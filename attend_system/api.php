<?php


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// 1) Able to read all data from database
// 2) Able to read specific data from database
// 3) Calculate the Discount Price.
// 4) Output in JSON Format.
// 5) Final Output for end user to see.

// include database
include 'connection.php';

// api (using GET METHOD)
if(isset($_GET['code'])) 
{
	$code = (isset($_GET['code'])) ? $_GET['code'] : NULL; 
	$id = (isset($_GET['id'])) ? $_GET['id'] : NULL; 


	// Code 1 : Able to read all employees data from database
	if ($code == 1) {
		$sql = "SELECT * FROM employee";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			
		if($result)
		{
			$data = $item = array(); // initialize empty array

			foreach ($result as $row) {
				
				$item = array(
					'emp_id' => $row['emp_id'],
					'emp_fullname' => $row['emp_fullname'],
					'emp_code' => $row['emp_code'],
					'emp_status' => $row['emp_status']
				);

				array_push($data, $item);
			}

			response($data, 200);

		}else{
			response(NULL, 400);
		}
	}

	// code 2 : Able to read specific data from database (active staff only)
	else if ($code == 2) {

		$sql = "Select * from employee, group_staff,attendance
where employee.emp_code = group_staff.emp_code and group_staff.gs_id = attendance.gs_id AND att_datetime = CURDATE() AND employee.emp_status = 'active'";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$count = 0;
		if($result)
		{
			$data = $item = array(); // initialize empty array

			foreach ($result as $row) {
				$count++;
				$item = array(
					'count' => $count,
					'emp_fullname' => $row['emp_fullname'],
					'emp_code' => $row['emp_code'],
					'att_status' => $row['att_status'],
					'att_remarks' => $row['att_remarks']
				);

				array_push($data, $item);
			}

			response($data, 200);

		}else{
			response(NULL, 400);
		}
	}
		
	// code 3 : monthly
// 	else if ($code == 3) {

// 		$sql = "select  employee.emp_preferredName, employee.emp_code, attendance.att_status, attendance.att_datetime FROM employee, group_staff, attendance 
// WHERE employee.emp_code = group_staff.emp_code AND group_staff.gs_id=attendance.gs_id AND employee.emp_status = 'active' ;";
// 		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
// 		$count = 0;
// 		if($result) mcm ni ke
// 		{
// 			$data = $item = array(); // initialize empty array

// 			foreach ($result as $row) {
// 				$count++;
// 				$item = array(
// 					'count' => $count,
// 					'emp_preferredName' => $row['emp_preferredName'],
// 					'emp_code' => $row['emp_code'],
// 					'att_status' => $row['att_status'],
// 					'' => $row['']
// 				);

// 				array_push($data, $item);
// 			}

// 			response($data, 200);

// 		}else{
// 			response(NULL, 400);
// 		}
// 	}

	// code 4 : year and month
	else if ($code == 4) {

		$year = $_GET['year'];
		$month = $_GET['month'];

		if ($month == 'All') {

			for ($months=1; $months <= 12 ; $months++) { 
				
				$totalDate = cal_days_in_month(CAL_GREGORIAN, $months, $year);
				$dateCombine = date('Y-m-d', strtotime($year . '-' . $months . '-01'));
				$montName = date('F', strtotime($dateCombine));

				echo strtoupper($montName)."<br><br>";

				echo "<table border='1' width = '100%'>";
				echo "<tr>";
				echo "<td> Name </td>";
				echo "<td> Employee ID </td>";
				for ($day=1; $day <= $totalDate; $day++) { 
					echo "<td><center> $day </center></td>";
				}
				
				echo "</tr>";
				echo "<hr>";
			}

		}else {

			$totalDate = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$dateCombine = date('Y-m-d', strtotime($year . '-' . $month . '-01'));
			$montName = date('F', strtotime($dateCombine));
			//////////////////////////
			$sql = "select  employee.emp_preferredName, employee.emp_code FROM employee, group_staff WHERE employee.emp_code = group_staff.emp_code AND employee.emp_status = 'active'";

			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$count = 0;
			$data = $item = array(); // initialize empty array

			
			//////////////////////////
			echo "<b>" . strtoupper($montName)  . "<b><br><br>";

			echo "<table border='1' width = '100%' class='table table-bordered table-striped'> ";
			echo "<thead class='thead-dark'>";
			echo "<tr>";
			echo "<th> # </th>";
			echo "<th> Name </th>";
			echo "<th> Employee ID </th>";
			for ($day=1; $day <= $totalDate; $day++) { 
				echo "<th><center> $day </center></th>";
			}
			echo "</thead>";
			echo "</tr>";

			echo "<tbody>";
			if ($result) {	

					foreach ($result as $row) {
					echo "<tr>";				
						$count++;
						$item = array(
							'count' => $count,
							'emp_preferredName' => $row['emp_preferredName'],
							'emp_code' => $row['emp_code'],
						);
					echo "<th>" . $count . "</th>";
					echo "<th>" . $row['emp_preferredName'] . "</th>";
					echo "<th>" . $row['emp_code'] . "</th>";

					for ($day=1; $day <= $totalDate; $day++) { 

						$sql2 = "select attendance.att_status from attendance join group_staff join employee 
						where attendance.gs_id = group_staff.gs_id AND DAY(att_datetime) = " . $day . " AND employee.emp_status = 'active' AND employee.emp_code = group_staff.emp_code;";
						$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

						$item2 = array(); // initialize empty array

							foreach ($result2 as $row2) {
							$item2 = array(
									'att_status' => $row2['att_status'],
								);
								echo "<th><center>" . $row2['att_status'] . "</center></th>";
								
							}//foreach 
						}// for
					
					echo "</tr>";
					}
			}
			echo "</tbody>";
			
		}

	}

	else{
		response(NULL, 405); // method not allowed
	}
}
else
{
	response(NULL, 405); // method not allowed
}

function response($data, $response_code)
{
	http_response_code($response_code);
	echo json_encode($data, JSON_PRETTY_PRINT);
}



