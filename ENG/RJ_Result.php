<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");

//PCR 2
$emp_code = $_SESSION["empid_pcr"];
$number_pcr = $_GET["pcr_number"];

//File Upload 3
$RandomAccountNumber = uniqid();
$sur = strrchr($_FILES['file']['name'], "."); 
$newfilename = $RandomAccountNumber.$sur;
if(move_uploaded_file($_FILES["file"]["tmp_name"],"../images/Upload/Plan/".$newfilename)){
$sql_uploaded = "Update pcr_file_upload SET fup_name='".$newfilename."' WHERE fup_fm_id = '".$number_pcr."' AND fup_ft_id = 2";
$query_uploaded = $conn->query($sql_uploaded);
}

if($POST["pcr_plan"] != ""){
	for($U=0;$U<8;$U++){
		$num = $U+1;
		$date_plan = date("Y-m-d",strtotime($_POST["pcr_plan"][$U]));
		$sql_implement_Form = "Update pcr_implement_form SET mf_date_result = '".$date_plan."' WHERE mf_fm_id = '".$number_pcr."' AND mf_im_id = '".$num."'";
		$query_implement_Form = $conn->query($sql_implement_Form);
	}
}

//Flow Approve 6
$sql_del = "DELETE FROM pcr_flow_approve WHERE ap_fm_id = '".$number_pcr."' AND ap_ph_id = 2";
$query_del = $conn->query($sql_del);
$sql_ap = "SELECT MAX(ap_step) AS step From pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_ph_id = 1  ";
$result_ap = mysqli_query($conn, $sql_ap);
$row_ap = mysqli_fetch_array($result_ap);
$set = $row_ap["step"]+1;
$numm = $row_ap["step"]+1;
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
	
	//PCR attach_doc
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
	$sql_up_reject = "Update pcr_reject SET status = 1 WHERE pcr_id = '".$number_pcr."' AND fh=2 AND status=0";
	$query_up_reject = $conn->query($sql_up_reject);
	
	$sql_up_form = "Update pcr_form SET checkk = 0, fm_state_app = '".$set."' WHERE fm_pcr_number = '".$number_pcr."'";
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