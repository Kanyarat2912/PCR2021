<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");
$number_pcr = $_GET["pcr_number"];
$emp_code = $_SESSION["empid_pcr"];

// Select PCR
$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$number_pcr."'";
$result_pcr = mysqli_query($conn, $sql_pcr);
$row_pcr = mysqli_fetch_array($result_pcr);

//File Upload 3
$RandomAccountNumber = uniqid();
$sur = strrchr($_FILES['file']['name'], "."); 
$newfilename = $RandomAccountNumber.$sur;
move_uploaded_file($_FILES["file"]["tmp_name"],"../images/Upload/DAR/".$newfilename);
$sql_uploaded = "INSERT INTO pcr_file_upload (fup_name,fup_ft_id,fup_fm_id) VALUES ('".$newfilename."',3,'".$number_pcr."')";
$query_uploaded = $conn->query($sql_uploaded);
//Update Anuual
$sql_ann = "UPDATE pcr_annual_plan SET status = 1 WHERE anp_anp_number = '".$row_pcr["fm_anp_id"]."'";
$query_ann = $conn->query($sql_ann);

//Upload PCR
$sql_cancel = "UPDATE pcr_form SET is_delete = 0 WHERE fm_pcr_number = '".$number_pcr."'";
if($query_cancel = $conn->query($sql_cancel)){
	$sql_log = "INSERT INTO pcr_cancel_log (pcr_id,Emp_ID) VALUES ('".$number_pcr."','".$emp_code."')";
	$query_log = $conn->query($sql_log);
	echo "<script>";
	echo "alert('Cancel PCR : Successfully.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
}
?>