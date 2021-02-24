<?php
date_default_timezone_set('asia/bangkok');
include "../ENG/connectpcr.php";
session_start();
$pcr_number = $_GET["PCR"];
$Comment_ap = $_POST["Comment_myapprover"];
$Creat_date_ap = date("Y-m-d H:i:s");
$emp_code = $_SESSION["empid_pcr"];
$step = $_GET["step"]+1;
if($_POST["meeting7"] != ""){
	$step_meeting = $_POST["meeting7"];
	$sql_qap_tablecenter = "INSERT INTO pcr_meeting_form (mtf_mt_id,mtf_qap_id)
	VALUES('".$step_meeting[$i]."','".$pcr_number."')";
	$sql_qap = mysqli_query($conn,$sql_qap_tablecenter);
}else{
	$step_meeting = $_POST["meeting"];
	// insert table pcr_qap_form  =>  data = fm_state_app is state approver form pcr ***
		for($i=0;$i<count($step_meeting);$i++){
			$sql_qap_tablecenter = "INSERT INTO pcr_meeting_form (mtf_mt_id,mtf_qap_id)
			VALUES('".$step_meeting[$i]."','".$pcr_number."')";
			$sql_qap = mysqli_query($conn,$sql_qap_tablecenter);
		}
}
	// update table pcr_flow_approve => data = date , comment , ap_sap_id ***
		$sql_update_ap = "UPDATE pcr_flow_approve SET ap_emp_code = '".$emp_code."',ap_tsmp = '".$Creat_date_ap."',ap_sap_id = '1',ap_comments = '".$Comment_ap."' WHERE ap_apr_id = 4 AND ap_ph_id = 1 AND ap_sap_id = 0 AND ap_fm_id = '".$pcr_number."' ";	
		$sql_approver = mysqli_query($conn,$sql_update_ap);	
		
	// update table pcr_form => data = fm_state_app is state approver form pcr ***
		$sql_update_stateap = "UPDATE pcr_form SET fm_state_app = '".$step."' WHERE  fm_pcr_number = '".$pcr_number."' AND fm_phase = 1 ";
		$sql_update_stateap_form = mysqli_query($conn,$sql_update_stateap);		

	// insert table pcr_qap_form  =>  data = fm_state_app is state approver form pcr ***
		$sql_insert_qap = "INSERT INTO pcr_qap_form (qap_id,qap_chairman,qap_comment,qap_create_date)
		VALUES('".$pcr_number."','".$emp_code."','".$Comment_ap."','".$Creat_date_ap."')";
		$sql_qap_approver = mysqli_query($conn,$sql_insert_qap);	
	
	$sql_QAP = "INSERT INTO pcr_flow_approve (ap_step,ap_apr_id,ap_ph_id,ap_fm_id) VALUES ('".$step."',5,1,'".$pcr_number."')"; 
	$query_QAP = mysqli_query($conn,$sql_QAP);
	
	if($sql_approver){
		$number_pcr = $pcr_number;
		include "mail-bkd.php"; 
		echo "<script language=\"JavaScript\">";
		echo "alert('Approver successfully.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/app_qap.php>';
	} else{
		echo "<script language=\"JavaScript\">";
		echo "alert('Can not Update.');";
		echo "</script>";
	}
?>