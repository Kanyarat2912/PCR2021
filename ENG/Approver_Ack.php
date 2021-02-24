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
		$sql_ap_plan1 = "SELECT * From pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_emp_code = '".$emp_code."' ";
		$result_ap_plan1 = mysqli_query($conn, $sql_ap_plan1);
		$row_ap_plan1 = mysqli_fetch_array($result_ap_plan1);
		if($row_ap_plan1["ap_apr_id"] == 3){
			$sql_ap_an = "SELECT * From pcr_form left join pcr_annual_plan on pcr_form.fm_anp_id = pcr_annual_plan.anp_anp_number
			left join pcr_rank on  pcr_annual_plan.anp_rk_id = pcr_rank.rk_id 
			WHERE  fm_pcr_number = '".$pcr_number."' ";
			$result_ap_an = mysqli_query($conn, $sql_ap_an);
			$row_ap_an = mysqli_fetch_array($result_ap_an);
			if($row_ap_an["anp_rk_id"] == 6){
			$M = 2;
			$sql_QAP = "INSERT INTO pcr_flow_approve (ap_step,ap_apr_id,ap_ph_id,ap_fm_id) VALUES ('".$step."',5,1,'".$pcr_number."')"; 
			$query_QAP = mysqli_query($conn,$sql_QAP);
			}else{
			$M = 1;
			$sql_QAP = "INSERT INTO pcr_flow_approve (ap_step,ap_apr_id,ap_ph_id,ap_fm_id) VALUES ('".$step."',4,1,'".$pcr_number."')"; 
			$query_QAP = mysqli_query($conn,$sql_QAP);
			}
		}
		$sql_f = "UPDATE pcr_form SET fm_state_app = '".$step."' WHERE fm_pcr_number = '".$pcr_number."'"; 
		$query_f = mysqli_query($conn,$sql_f);
		$sql_a = "UPDATE pcr_flow_approve SET ap_sap_id = 1, ap_comments = '".$Comment_ap_dep."', ap_tsmp = '".$Creat_date_ap."' WHERE ap_fm_id = '".$pcr_number."' AND ap_emp_code = '".$emp_code."' AND ap_step = '".$_GET["step"]."'"; 
		if($query_a = mysqli_query($conn,$sql_a)){
			if($M == 1){
				$number_pcr = $pcr_number;
				include "mail-qap.php"; 
			}else if($M == 2){
				$number_pcr = $pcr_number;
				include "mail-bkd.php"; 
			}
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
		$sql_r = "INSERT INTO pcr_reject (Emp_ID,fh,pcr_id,comment) value ('".$emp_code."', 1, '".$pcr_number."', '".$Comment_reject_dep."')";
		$query_r = mysqli_query($conn,$sql_r);
		$sql_f = "UPDATE pcr_form SET checkk = 2 WHERE fm_pcr_number = '".$pcr_number."'"; 
		if($query_f = mysqli_query($conn,$sql_f)){
			$sql = "SELECT * FROM pcr_form WHERE  fm_pcr_number = '".$pcr_number."'";
			$sql_approver_dep = mysqli_query($conn,$sql);
			$sql_ap_dep = mysqli_fetch_array($sql_approver_dep);
			$send = $sql_ap_dep["fm_usr_emp_code"];
			$number_pcr = $pcr_number;
			include "mail-reject.php";
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