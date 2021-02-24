<?php
include "../ENG/connectpcr.php";
session_start();
function request_function($conn)
{
	$pcr_number = $_POST['pcr_number'];
	$emp_code = $_SESSION["empid_pcr"];
	$status_request = 2;
	$condition = $_POST['condition'];
	if ($condition == 'insert_request_pcr') {
		$sql_access = "INSERT INTO pcr_access_time(at_pcr_number,at_emp_code,at_request_status)
		VALUES('".$pcr_number."','".$emp_code."','".$status_request."')";
		$result_access = mysqli_query($conn,$sql_access);
		header("Location: ../INT/pcr_all.php");
	}
}

request_function($conn);

