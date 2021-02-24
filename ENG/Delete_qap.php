<?php
include "connectpcr.php";
$sql_Up = "UPDATE pcr_user SET usr_rl_id = 1 WHERE usr_emp_code = '".$_GET["id"]."'";
if($result_Up = mysqli_query($conn, $sql_Up)){
	echo "<script>";
	echo "alert('Successfully.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qap.php>';
}else{
	echo "<script>";
	echo "alert('Error 1 : Please contact your system administrator for assistance.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qap.php>';
}
?>