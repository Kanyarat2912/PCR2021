<?php
date_default_timezone_set("Asia/Bangkok");
include "connectpcr.php";
$sql_user = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$_GET["Emp_ID"]."';";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_array($result_user);
	$Date_EX  = date ("Y-m-d", strtotime("+3 month"));
	$sql_Up_user = "UPDATE pcr_user SET usr_password = '".$_POST["password"]."', usr_exp_date = '".$Date_EX."'  WHERE usr_emp_code = '".$_GET["Emp_ID"]."';";
	if($result_Up_user = mysqli_query($conn, $sql_Up_user)){
		echo "<script language=\"JavaScript\">";
		echo "alert('Change password : Successfully.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
	}else{
		echo "<script language=\"JavaScript\">";
		echo "alert('Can't Change password : Please try again.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/change_password_sys.php>';
	}

?>