<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");


//Annual Plan || PCR 2
$number_pcr = $_GET["pcr_number"];
$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$number_pcr."'";
$result_pcr = mysqli_query($conn, $sql_pcr);
$row_pcr = mysqli_fetch_array($result_pcr);
//File Upload 3
$RandomAccountNumber = uniqid();
$sur = strrchr($_FILES['file']['name'], "."); 
$newfilename = $RandomAccountNumber.$sur;
move_uploaded_file($_FILES["file"]["tmp_name"],"../images/Upload/Result/".$newfilename);
$sql_uploaded = "INSERT INTO pcr_file_upload (fup_name,fup_ft_id,fup_fm_id) VALUES ('".$newfilename."',2,'".$number_pcr."')";
$query_uploaded = $conn->query($sql_uploaded);

for($U=0;$U<8;$U++){
	$num = $U+1;
	$date_plan = date("Y-m-d",strtotime($_POST["pcr_plan"][$U]));
	$sql_implement_Form = "UPDATE pcr_implement_form SET mf_date_result = '".$date_plan."' WHERE mf_fm_id = '".$number_pcr."' AND mf_im_id = '".$num."' ";
	$query_implement_Form = $conn->query($sql_implement_Form);
}

$numm = $row_pcr["fm_state_app"];
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
		VALUES ('".$appdepart_name."','".$step_approve."',1,2,'".$number_pcr."')";
		$query_appdepart = $conn->query($sql_appdepart);
		$numm++;
	}
}
	$step_final = $numm;
	$sql_final = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) 
	VALUES ('".$_POST["appdepart_final"]."','".$step_final."',2,2,'".$number_pcr."')";
	$query_final = $conn->query($sql_final);
	$step_ackdepart = $numm+1;
	$sql_ackdepart = "INSERT INTO pcr_flow_approve (ap_emp_code,ap_step,ap_apr_id,ap_ph_id,ap_fm_id) 
	VALUES ('".$_POST["ackdepart_name"]."','".$step_ackdepart."',3,2,'".$number_pcr."')";
	$query_ackdepart = $conn->query($sql_ackdepart);

	if($_POST["PFMEA"] != "" ){
		$sql_att = "UPDATE pcr_attach_doc SET att_pfmea = '".$_POST["PFMEA"]."' WHERE att_id = '".$number_pcr."'";
		$query_att = $conn->query($sql_att);
	}
	if($_POST["qa"] != "" ){
		$sql_att = "UPDATE pcr_attach_doc SET att_qa_network = '".$_POST["qa"]."' WHERE att_id = '".$number_pcr."'";
		$query_att = $conn->query($sql_att);
	}
	if($_POST["Control"] != "" ){
		$sql_att = "UPDATE pcr_attach_doc SET att_control_plan = '".$_POST["Control"]."' WHERE att_id = '".$number_pcr."'";
		$query_att = $conn->query($sql_att);
	}
	
	$sql_Up_pcr = "UPDATE pcr_form SET fm_phase = 2, checkk = 0 WHERE fm_pcr_number = '".$number_pcr."'";
	if($query_Up_pcr = $conn->query($sql_Up_pcr)){
		if($_POST["appdepart_name0"] != ""){
			$send = $_POST["appdepart_name0"];
		}else{
			$send = $_POST["appdepart_final"];
		}
		include("mail-dept-r.php");
		echo "<script>";
		echo "alert('Result PCR : Successfully.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
	}else{
		echo "<script>";
		echo "alert('Error 1 : Please contact your system administrator for assistance.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
	}
	
?>