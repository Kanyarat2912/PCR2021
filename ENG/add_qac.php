<?php
include "connectpcr.php";
$sql_user = "SELECT * FROM pcr_user WHERE  usr_emp_code = '".$_POST["Emp_ID"]."'";
$result_user = mysqli_query($conn, $sql_user);
if($row_user = mysqli_fetch_array($result_user)){
	$sql_QAC = "SELECT * FROM pcr_qac_approver WHERE  qca_emp_code = '".$_POST["Emp_ID"]."' AND qca_cta_id = '".$_GET["id"]."'";
	$result_QAC = mysqli_query($conn, $sql_QAC);
	if($row_QAC = mysqli_fetch_array($result_QAC)){
		echo "<script>";
		echo "alert('Please recheck role of associate.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/add_qac.php?id=';echo $_GET['id'];echo '>';
	}else{
		$sql_QAC = "SELECT * FROM pcr_user WHERE  usr_emp_code = '".$_POST["Emp_ID"]."'";
		$result_QAC = mysqli_query($conn, $sql_QAC);
		$row_QAC = mysqli_fetch_array($result_QAC);
		if($row_QAC["usr_rl_id"] == 5){
			$sql_IN = "INSERT INTO pcr_qac_approver (qca_emp_code, qca_cta_id, qca_level) VALUES ('".$_POST["Emp_ID"]."', '".$_GET["id"]."', '".$_POST["level"]."')";
			if($result_IN = mysqli_query($conn, $sql_IN)){
				echo "<script>";
				echo "alert('Successfully.');";
				echo "</script>";
				echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['id'];echo '>';
			}else{
				echo "<script>";
				echo "alert('Error 1 : Please contact your system administrator for assistance.');";
				echo "</script>";
				echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['id'];echo '>';
			}
		}else{
			$sql_Up = "UPDATE pcr_user SET usr_rl_id = 5 WHERE usr_emp_code = '".$_POST["Emp_ID"]."'";
			$result_Up = mysqli_query($conn, $sql_Up);
			$sql_IN = "INSERT INTO pcr_qac_approver (qca_emp_code, qca_cta_id, qca_level) VALUES ('".$_POST["Emp_ID"]."', '".$_GET["id"]."', '".$_POST["level"]."')";
			if($result_IN = mysqli_query($conn, $sql_IN)){
				echo "<script>";
				echo "alert('Successfully.');";
				echo "</script>";
				echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['id'];echo '>';
			}else{
				echo "<script>";
				echo "alert('Error 1 : Please contact your system administrator for assistance.');";
				echo "</script>";
				echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['id'];echo '>';
			}
		}
	}
}else{
	echo "<script>";
	echo "alert('Error : Please Register.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/flow_qac_d.php?id=';echo $_GET['id'];echo '>';
}

?>