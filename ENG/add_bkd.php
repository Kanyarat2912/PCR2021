<?php
session_start();
include "connectpcr.php";
$emp_id = $_POST["Emp_ID"];
$sql_user = "SELECT * From pcr_user WHERE usr_emp_code = '".$emp_id."'";
$result_user = mysqli_query($conn, $sql_user);
if($row_user = mysqli_fetch_array($result_user)){
	if($row_user["usr_rl_id"] == 1){
		$sql_Up = "UPDATE pcr_user SET usr_rl_id = 4 WHERE usr_emp_code = '".$emp_id."'";
		if($result_Up = mysqli_query($conn, $sql_Up)){
			echo "<script>";
			echo "alert('Successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/flow_bkd.php>';
		}else{
			echo "<script>";
			echo "alert('Error 1 : Please contact your system administrator for assistance.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/flow_bkd.php>';
		}
	}else{
		echo "<script>";
		echo "alert('Please recheck role of associate.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/flow_bkd.php>';
	}
}else{
	echo "<script>";
	echo "alert('Error : Please Register.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/flow_bkd.php>';
}
?>