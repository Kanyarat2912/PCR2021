<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");
//Part test flow out 1
$delivery = $_POST["delivery"];
var_dump($delivery);
$safety = $_POST["safety"];
$quality = $_POST["quality"];
$part_test = $_POST["Part_test_flow_out"];
if($_POST["pcr_level"] == "1"){
	$pcr_level = "Confidential";
}else if($_POST["pcr_level"] == "2"){
	$pcr_level = "Secret";
}else{
	$pcr_level = "Top Secret";
}
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
move_uploaded_file($_FILES["file"]["tmp_name"],"../images/Upload/Plan/".$newfilename);
$sql_uploaded = "INSERT INTO pcr_file_upload (fup_name,fup_ft_id,fup_fm_id) VALUES ('".$newfilename."',1,'".$number_pcr."')";
$query_uploaded = $conn->query($sql_uploaded);


//imprements 4
$pcr_plan_sub_plan = date("Y-m-d",strtotime($_POST["pcr_plan_sub_plan"]));
$plan_review_plan = date("Y-m-d",strtotime($_POST["plan_review_plan"]));
$pro_preparation_plan = date("Y-m-d",strtotime($_POST["pro_preparation_plan"]));
$product_evaluation_plan = date("Y-m-d",strtotime($_POST["product_evaluation_plan"]));
$revise_doc_stadart_plan = date("Y-m-d",strtotime($_POST["revise_doc_stadart_plan"]));
$six_report_plan = date("Y-m-d",strtotime($_POST["six_report_plan"]));
$pcr_result_sum_plan = date("Y-m-d",strtotime($_POST["pcr_result_sum_plan"]));
$product_start_date_plan = date("Y-m-d",strtotime($_POST["product_start_date_plan"]));


// Data attachments 5
$check_PFMEA =  $_POST["check_PFMEA"];
$check_qa_network =  $_POST["check_qa_network"];
$check_control_plan =  $_POST["check_control_plan"];
$standardize =  $_POST["standardize"];
$machine_sprci =  $_POST["machine_sprci"];
$daily_check =  $_POST["daily_check"];
$other =  $_POST["other"];


//Flow Approve 6
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



/////////////// INSERT //////////////////

$sql_PCR_Form = "INSERT INTO pcr_form 
				(fm_pcr_number,fm_pcr_leadtime,fm_part_number,fm_anp_id,fm_usr_emp_code,fm_quality,fm_safety,fm_delivery,fm_flowout,fm_level)
				VALUES ('".$number_pcr."','".$pcr_type."','".$part_number."','".$anuual_Plan_No."','".$emp_code."','".$quality."','".$safety."','".$delivery."','".$part_test."','".$pcr_level."')";
$query_PCR_Form = $conn->query($sql_PCR_Form);

if($query_PCR_Form = $conn->query($sql_PCR_Form)){
	for($O=0;$O<count($_POST["S"]);$O++){
		$sql_priority_Form = "INSERT INTO pcr_form_priority (fp_fm_id,fp_pri_id) VALUES ('".$number_pcr."','".$_POST["S"][$O]."')";
		$query_priority_Form = $conn->query($sql_priority_Form);
	}
	for($U=0;$U<8;$U++){
		$num = $U+1;
		$date_plan = date("Y-m-d",strtotime($_POST["pcr_plan"][$U]));
		$sql_implement_Form = "INSERT INTO pcr_implement_form (mf_date_plan,mf_im_id,mf_fm_id) VALUES ('".$date_plan."','".$num."','".$number_pcr."')";
		$query_implement_Form = $conn->query($sql_implement_Form);
	}
	$sql_attach_Form = "INSERT INTO pcr_attach_doc (att_id,att_pfmea,att_qa_network,att_control_plan,att_wi,att_machine_spec,att_daily_check,att_other) 
	VALUES ('".$number_pcr."','".$check_PFMEA."','".$check_qa_network."','".$check_control_plan."','".$standardize."','".$machine_sprci."','".$daily_check."','".$other."')";
	$query_attach_Form = $conn->query($sql_attach_Form);
	$gen = $_GET["number"]+1;
	$sql_gen = "UPDATE pcr_auto_gen SET seq = '".$gen."' WHERE num = 2";
	if($query_gen = $conn->query($sql_gen)){
			if($_POST["appdepart_name0"] != ""){
				$send = $_POST["appdepart_name0"];
			}else{
				$send = $_POST["appdepart_final"];
			}
			include("mail-dept.php");
			$sql_upann = "UPDATE pcr_annual_plan SET status = 0 WHERE anp_anp_number = '".$anuual_Plan_No."'";
			$query_upann = $conn->query($sql_upann);
			echo "<script>";
			echo "alert('Issue PCR : Successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
	}
	
	
	
}else{
	echo "<script>";
	echo "alert('Error 1 : Please contact your system administrator for assistance.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
}


?>
