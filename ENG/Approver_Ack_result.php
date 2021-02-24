<?php
date_default_timezone_set('asia/bangkok');
include "../ENG/connectpcr.php";
session_start();

	$pcr_number = $_GET["PCR"];
	$Comment_ap_dep = $_POST["Comment_myapprover"];
	$Comment_reject_dep = $_POST["Comment_No_myapprover"];
	$Creat_date_ap = date("Y-m-d H:i:s");
	$emp_code = $_SESSION["empid_pcr"];
	$step = $_GET["step"]+1;
	
	if($_POST["submit"] == 1){
		$sql_ap_plan1 = "SELECT * From pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_emp_code = '".$emp_code."' AND ap_ph_id = 2 ";
		$result_ap_plan1 = mysqli_query($conn, $sql_ap_plan1);
		$row_ap_plan1 = mysqli_fetch_array($result_ap_plan1);
		if($row_ap_plan1["ap_apr_id"] == 3){
			$sql = "SELECT * FROM pcr_form WHERE  fm_pcr_number = '".$pcr_number."'";
			$sql_approver_dep = mysqli_query($conn,$sql);
			$sql_ap_dep = mysqli_fetch_array($sql_approver_dep);
			$sql_flow_qac = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$sql_ap_dep["fm_anp_id"]."'";
			$query_flow_qac = mysqli_query($conn,$sql_flow_qac);
			$row_flow_qac = mysqli_fetch_array($query_flow_qac);
			$sql_flow_pro = "SELECT * FROM pcr_product WHERE pro_id = '".$row_flow_qac["anp_pro_id"]."'";
			$query_flow_pro = mysqli_query($conn,$sql_flow_pro);
			$row_flow_pro = mysqli_fetch_array($query_flow_pro);
			$sql_flow_qacf = "SELECT * FROM pcr_qac_approver WHERE qca_cta_id = '".$row_flow_pro["flow"]."'";
			$query_flow_qacf = mysqli_query($conn,$sql_flow_qacf);
			While($row_flow_qacf = mysqli_fetch_array($query_flow_qacf)){
				$state = $_GET["step"]+$row_flow_qacf["qca_level"];
				$sql_qac = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) VALUES ('".$row_flow_qacf["qca_emp_code"]."','".$state."',6,2,'".$pcr_number."')"; 
				$query_qac = mysqli_query($conn,$sql_qac);
			}
			$sql_select_dept = "SELECT * From pcr_flow_approve WHERE ap_step = '".$step."' AND ap_ph_id = 2 AND ap_fm_id = '".$pcr_number."'";
			$result_select_dept = mysqli_query($conn, $sql_select_dept);
			$row_select_dept = mysqli_fetch_array($result_select_dept);
			$send = $row_select_dept["ap_emp_code"];
			$number_pcr = $pcr_number;
			include "mail-dept-r.php"; 
		}
		$sql_f = "UPDATE pcr_form SET fm_state_app = '".$step."' WHERE fm_pcr_number = '".$pcr_number."'"; 
		$query_f = mysqli_query($conn,$sql_f);
		$sql_a = "UPDATE pcr_flow_approve SET ap_sap_id = 1, ap_comments = '".$Comment_ap_dep."', ap_tsmp = '".$Creat_date_ap."' WHERE ap_fm_id = '".$pcr_number."' AND ap_emp_code = '".$emp_code."' AND ap_step = '".$_GET["step"]."'"; 
		if($query_a = mysqli_query($conn,$sql_a)){
			echo "<script language=\"JavaScript\">";
			echo "alert('Approver successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/app_ack.php>';
		} else{
			echo "<script language=\"JavaScript\">";
			echo "alert('Can not Update.');";
			echo "</script>";
		}
	}else{
		
		$sql_r = "INSERT INTO pcr_reject (Emp_ID,fh,pcr_id,comment) value ('".$emp_code."', 2, '".$pcr_number."', '".$Comment_reject_dep."')";
		$query_r = mysqli_query($conn,$sql_r);
		$sql_f = "UPDATE pcr_form SET checkk = 2 WHERE fm_pcr_number = '".$pcr_number."'"; 
		if($query_f = mysqli_query($conn,$sql_f)){
			$sql = "SELECT * FROM pcr_form WHERE  fm_pcr_number = '".$pcr_number."'";
			$sql_approver_dep = mysqli_query($conn,$sql);
			$sql_ap_dep = mysqli_fetch_array($sql_approver_dep);
			$send = $sql_ap_dep["fm_usr_emp_code"];
			$number_pcr = $pcr_number;
			include "mail-reject-r.php"; 
			echo "<script language=\"JavaScript\">";
			echo "alert('Reject successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/app_ack.php>';
		} else{
			echo "<script language=\"JavaScript\">";
			echo "alert('Can not Update.');";
			echo "</script>";
		}
	}
	

// Close connection
mysqli_close($conn);

?>