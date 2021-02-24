<?php
include "connectpcr.php";
$sql_QAC = "SELECT * FROM pcr_qac_approver WHERE  qca_emp_code = '".$_GET["id"]."' AND qca_cta_id != '".$_GET["flow"]."'";
$result_QAC = mysqli_query($conn, $sql_QAC);
if($row_QAC = mysqli_fetch_array($result_QAC)){
	$sql_delete = "DELETE FROM pcr_qac_approver WHERE qca_emp_code = '".$_GET["id"]."' AND qca_cta_id = '".$_GET["flow"]."'";
	if($result_delete = mysqli_query($conn, $sql_delete)){
		echo "<script>";
		echo "alert('Successfully.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['flow'];echo '>';
	}else{
		echo "<script>";
		echo "alert('Error 1 : Please contact your system administrator for assistance.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['flow'];echo '>';
	}
	
}else{
	$sql_Up = "UPDATE pcr_user SET usr_rl_id = 1 WHERE usr_emp_code = '".$_GET["id"]."'";
	$result_Up = mysqli_query($conn, $sql_Up);
	$sql_delete = "DELETE FROM pcr_qac_approver WHERE qca_emp_code = '".$_GET["id"]."' AND qca_cta_id = '".$_GET["flow"]."'";
	if($result_delete = mysqli_query($conn, $sql_delete)){
		echo "<script>";
		echo "alert('Successfully.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['flow'];echo '>';
	}else{
		echo "<script>";
		echo "alert('Error 2 : Please contact your system administrator for assistance.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['flow'];echo '>';
	}
}

?>