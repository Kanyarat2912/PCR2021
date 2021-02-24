<?php
session_start();
include "connectpcr.php";
date_default_timezone_set("Asia/Bangkok");
if($_POST["customer_s"] == "" OR $_POST["customer_s"] == "no" OR $_POST["customer_s"] == "No"){
	$customer_s = "No";
}else{
	$customer_s = $_POST["customer_s"];
}
$sql_cm = "SELECT * FROM pcr_section_anp WHERE sec_id = '".$_POST["section"]."'";
$result_cm = mysqli_query($conn, $sql_cm);
$row_cm = mysqli_fetch_array($result_cm);

if($_POST["Addition"] == ""){
	$_POST["Addition"] = 0;
}
if($_POST["Planning"] == ""){
	$_POST["Planning"] = 0;
}

$sql_ADD = "INSERT INTO pcr_annual_plan (anp_anp_number,anp_part_name,anp_title,anp_cus_sub,anp_line,
										 anp_output,anp_process_name,anp_add_item,anp_plan_review,
										 anp_ct_id,anp_cp_id,anp_sec_id,anp_pro_id,anp_rk_id,anp_issue,
										 anp_concern,anp_company)
								value	('".$_GET["ann_number"]."','".$_POST["part_number"]."','".$_POST["title_pcr"]."',
										 '".$customer_s."','".$_POST["line"]."','".$_POST["output"]."','".$_POST["process"]."',
										 '".$_POST["Addition"]."','".$_POST["Planning"]."','".$_POST["ct"]."','".$_POST["cp"]."','".$_POST["section"]."',
										 '".$_POST["pd"]."','".$_POST["r"]."','".$_SESSION["empid_pcr"]."','".$_POST["concern"]."','".$row_cm["sec_comp_type"]."')
										 ";
if($result_ADD = mysqli_query($conn, $sql_ADD)){
	$gen = $_GET["number"]+1;
	$sql_gen = "UPDATE pcr_auto_gen SET seq = '".$gen."' WHERE num = 1";
	$query_gen = $conn->query($sql_gen);
	echo "<script>";
	echo "alert('Successfully.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/annual.php>';
}else{
	echo "<script>";
	echo "alert('Error 1 : Please contact your system administrator for assistance.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../INT/annual.php>';
}


?>