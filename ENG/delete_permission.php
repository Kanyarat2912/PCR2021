<?php
include "connectpcr.php";
$sql_Up = "UPDATE pcr_access_time SET at_request_status = 0 WHERE at_emp_code = '".$_GET["id"]."'";
if($result_Up = mysqli_query($conn, $sql_Up)){
	echo "<script>";
	echo "alert('Successfully.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/add_permission.php.php>';
}else{
	echo "<script>";
	echo "alert('Error 1 : Please contact your system administrator for assistance.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/add_permission.php.php>';
}
?>