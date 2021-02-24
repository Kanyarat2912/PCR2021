<?php
date_default_timezone_set('asia/bangkok');
include "../ENG/connectpcr.php";
session_start();
$pcr_number = $_GET["PCR"];
$require_bkd = $_POST["Requies"];
$more_request = $_POST["Comment_myapprover"];
$Creat_date_ap = date("Y-m-d H:i:s");
$emp_code = $_SESSION["empid_pcr"];
$sql = "SELECT * FROM pcr_form WHERE  fm_pcr_number = '".$pcr_number."'";
$sql_approver_dep = mysqli_query($conn,$sql);
$sql_ap_dep = mysqli_fetch_array($sql_approver_dep);
$state_flow = $_GET["step"]+1;
		// insert table pcr_qap_form  =>  data = fm_state_app is state approver form pcr ***
		$sql_insert_BKD = "INSERT INTO pcr_bkd_form (bkd_id,bkd_request_type,Emp_ID,bkd_comment,bkd_create_date)
		VALUES('".$pcr_number."','".$require_bkd."','".$emp_code."','".$more_request."','".$Creat_date_ap."')";
		$sql_bkd_approver = mysqli_query($conn,$sql_insert_BKD);	
		// update table pcr_flow_approve => data = date , comment , ap_sap_id ***
		$sql_update_ap = "UPDATE pcr_flow_approve SET ap_emp_code = '".$emp_code."',ap_tsmp = '".$Creat_date_ap."',ap_sap_id = '1',ap_comments = '".$more_request."' WHERE ap_apr_id = 5 AND ap_ph_id = 1 AND ap_sap_id = 0 AND ap_fm_id = '".$pcr_number."' ";	
		$sql_approver_bkd = mysqli_query($conn,$sql_update_ap);	
		// update table pcr_form => data = fm_state_app is state approver form pcr ***
		$sql_update_stateap = "UPDATE pcr_form SET fm_state_app = '".$state_flow."' WHERE  fm_pcr_number = '".$pcr_number."' AND fm_phase = 1 ";
		$sql_update_stateap_form = mysqli_query($conn,$sql_update_stateap);	
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
			$sql_qac = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) VALUES ('".$row_flow_qacf["qca_emp_code"]."','".$state."',6,1,'".$pcr_number."')"; 
			$query_qac = mysqli_query($conn,$sql_qac);
		}
		if($sql_approver_bkd){
			$sql_select_dept = "SELECT * From pcr_flow_approve WHERE ap_step = '".$state_flow."' AND ap_ph_id = 1 AND ap_fm_id = '".$pcr_number."'";
			$result_select_dept = mysqli_query($conn, $sql_select_dept);
			$row_select_dept = mysqli_fetch_array($result_select_dept);
			$send = $row_select_dept["ap_emp_code"];
			$number_pcr = $pcr_number;
			include "mail-dept.php"; 
			echo "<script language=\"JavaScript\">";
			echo "alert('Approver successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/app_bkd.php>';
		} else{
			echo "<script language=\"JavaScript\">";
			echo "alert('Can not Update.');";
			echo "</script>";
		}
 
// Close connection
mysqli_close($conn);
?>