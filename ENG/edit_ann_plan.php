<?php
session_start();
include "connectpcr.php";
date_default_timezone_set("Asia/Bangkok");
if($_POST["customer_s_edit"] == "" OR $_POST["customer_s_edit"] == "no" OR $_POST["customer_s_edit"] == "No"){
	$customer_s = "No";
}else{
	$customer_s = $_POST["customer_s_edit"];
}
$sql_cm = "SELECT * FROM pcr_section_anp WHERE sec_id = '".$_POST["section_edit"]."'";
$result_cm = mysqli_query($conn, $sql_cm);
$row_cm = mysqli_fetch_array($result_cm);

if($_POST["addition_edit"] == ""){
	$_POST["addition_edit"] = 0;
}
if($_POST["planning_edit"] == ""){
	$_POST["planning_edit"] = 0;
}


$sql_edit_ap = "UPDATE pcr_annual_plan SET anp_part_name = '".$_POST["part_number_edit"]."',anp_title = '".$_POST["title_pcr_edit"]."',anp_cus_sub = '".$customer_s."',
                anp_line = '".$_POST["line_edit"]."',anp_output = '".$_POST["output_edit"]."',anp_process_name = '".$_POST["process_edit"]."',anp_add_item = '".$_POST["addition_edit"]."',
                anp_plan_review = '".$_POST["planning_edit"]."',anp_ct_id = '".$_POST["Change_Type_edit"]."',anp_cp_id = '".$_POST["Change_Point_edit"]."',anp_sec_id = '".$_POST["section_edit"]."',
                anp_pro_id = '".$_POST["Product_edit"]."',anp_rk_id = '".$_POST["rank_edit"]."',anp_issue = '".$_SESSION["empid_pcr"]."',anp_concern = '".$_POST["concern_edit"]."',
                anp_company = '".$row_cm["sec_comp_type"]."' 
                WHERE anp_anp_number = '".$_GET["ann_number"]."' ";
 
$query = mysqli_query($conn,$sql_edit_ap);

if($query){
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