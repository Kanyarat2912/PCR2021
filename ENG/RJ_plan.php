<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");
//Part test flow out 1
$delivery = $_POST["delivery"];
$safety = $_POST["safety"];
$quality = $_POST["quality"];
$part_test = $_POST["Part_test_flow_out"];
if($_POST["normall_urgent"] == "1"){
	$pcr_type = "Normal";
}else{
	$pcr_type = "Urgent";;
}
//Annual Plan || PCR 2
$emp_code = $_SESSION["empid_pcr"];
$number_pcr = $_GET["pcr_number"];
$part_number =  $_POST["part_number"];
$anuual_Plan_No = $_POST["anuual_Plan_No"];

//File Upload 3
$RandomAccountNumber = uniqid();
$sur = strrchr($_FILES['file']['name'], "."); 
$newfilename = $RandomAccountNumber.$sur;
if(move_uploaded_file($_FILES["file"]["tmp_name"],"../images/Upload/Plan/".$newfilename)){
$sql_uploaded = "Update pcr_file_upload SET fup_name='".$newfilename."' WHERE fup_fm_id = '".$number_pcr."' AND fup_ft_id = 1";
$query_uploaded = $conn->query($sql_uploaded);
}

// Data attachments 5
$check_PFMEA =  $_POST["check_PFMEA"];
$check_qa_network =  $_POST["check_qa_network"];
$check_control_plan =  $_POST["check_control_plan"];
$standardize =  $_POST["standardize"];
$machine_sprci =  $_POST["machine_sprci"];
$daily_check =  $_POST["daily_check"];
$other =  $_POST["other"];
$sql_upatt = "Update pcr_attach_doc SET att_pfmea='".$check_PFMEA."',
										att_qa_network='".$check_qa_network."',
										att_control_plan='".$check_control_plan."',
										att_wi='".$standardize."',
										att_machine_spec='".$machine_sprci."',
										att_daily_check='".$daily_check."',
										att_other='".$other."'
										WHERE att_id = '".$number_pcr."'";
$query_upatt = $conn->query($sql_upatt);

// priority
$sql_delp = "DELETE FROM pcr_form_priority WHERE fp_fm_id = '".$number_pcr."'";
$query_delp = $conn->query($sql_delp);
for($O=0;$O<count($_POST["S"]);$O++){
	$sql_priority_Form = "INSERT INTO pcr_form_priority (fp_fm_id,fp_pri_id) VALUES ('".$number_pcr."','".$_POST["S"][$O]."')";
	$query_priority_Form = $conn->query($sql_priority_Form);
}

//Date 
if($POST["pcr_plan"] != ""){
	$sql_deli = "DELETE FROM pcr_implement_form WHERE mf_fm_id = '".$number_pcr."'";
	$query_deli = $conn->query($sql_deli);
	for($U=0;$U<8;$U++){
		$num = $U+1;
		$date_plan = date("Y-m-d",strtotime($_POST["pcr_plan"][$U]));
		$sql_implement_Form = "INSERT INTO pcr_implement_form (mf_date_plan,mf_im_id,mf_fm_id) VALUES ('".$date_plan."','".$num."','".$number_pcr."')";
		$query_implement_Form = $conn->query($sql_implement_Form);
	}
}

//Flow Approve 6
$sql_del = "DELETE FROM pcr_flow_approve WHERE ap_fm_id = '".$number_pcr."'";
$query_del = $conn->query($sql_del);
$numm = 1;
for($i=0;$i<5;$i++){
	if($i == 0){
		$appdepart_name = $_POST["appdepart_name0"];
	}else if($i == 1){
		$appdepart_name = $_POST["appdepart_name1"];
	}else if($i == 2){
		$appdepart_name = $_POST["appdepart_name2"];
	}else if($i == 3){
		$appdepart_name = $_POST["appdepart_name3"];
	}else if($i == 4){
		$appdepart_name = $_POST["appdepart_name4"];
	}
	if($appdepart_name != ""){
		$step_approve = $numm;
		$sql_appdepart = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) 
		VALUES ('".$appdepart_name."','".$step_approve."',1,1,'".$number_pcr."')";
		$query_appdepart = $conn->query($sql_appdepart);
		$numm++;
	}
}
	$step_final = $numm;
	$sql_final = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) 
	VALUES ('".$_POST["appdepart_final"]."','".$step_final."',2,1,'".$number_pcr."')";
	$query_final = $conn->query($sql_final);
	$step_ackdepart = $numm+1;
	$sql_ackdepart = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) 
	VALUES ('".$_POST["ackdepart_name"]."','".$step_ackdepart."',3,1,'".$number_pcr."')";
	$query_ackdepart = $conn->query($sql_ackdepart);
	
	//PCR Form
	$sql_up_form = "Update pcr_form SET fm_pcr_leadtime = '".$pcr_type."',
									fm_part_number = '".$part_number."',
									fm_state_app = 1,
									fm_anp_id = '".$anuual_Plan_No."',
									fm_quality = '".$quality."',
									fm_safety = '".$safety."',
									fm_delivery = '".$delivery."',
									fm_flowout = '".$part_test."',
									checkk = 0
									WHERE fm_pcr_number = '".$number_pcr."'";
	if($query_up_form = $conn->query($sql_up_form)){
		$sql_up_reject = "Update pcr_reject SET status = 1 WHERE pcr_id = '".$number_pcr."' AND fh=1 AND status=0";
		$query_up_reject = $conn->query($sql_up_reject);
		echo "<script>";
		echo "alert('Edit PCR : Successfully.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
	}else{
		echo "<script>";
		echo "alert('Error 1 : Please contact your system administrator for assistance.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
	}
	
?>