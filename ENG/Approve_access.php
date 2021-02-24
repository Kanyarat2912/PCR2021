<?php
date_default_timezone_set('asia/bangkok');
include "../ENG/connectpcr.php";
session_start();
$pcr_number = $_GET["PCR"];
$require_bkd = $_POST["Requies"];
$more_request = $_POST["Comment_myapprover"];
$Creat_date_ap = date("Y-m-d H:i:s");
$emp_code = $_POST["empid_pcr"];
$sql = "SELECT * FROM pcr_form WHERE  fm_pcr_number = '".$pcr_number."'";
$sql_approver_dep = mysqli_query($conn,$sql);
$sql_ap_dep = mysqli_fetch_array($sql_approver_dep);
$state_flow = $_GET["step"]+1;
		// insert table pcr_qap_form  =>  data = fm_state_app is state approver form pcr ***
		$sql_insert_BKD = "INSERT INTO pcr_bkd_form (bkd_id,bkd_request_type,Emp_ID,bkd_comment,bkd_create_date)
		VALUES('".$pcr_number."','".$require_bkd."','".$emp_code."','".$more_request."','".$Creat_date_ap."')";
		$sql_bkd_approver = mysqli_query($conn,$sql_insert_BKD);	
		
		if($sql_approver_bkd){
			$sql_select_dept = "SELECT * From pcr_flow_approve WHERE ap_step = '".$state_flow."' AND ap_ph_id = 1 AND ap_fm_id = '".$pcr_number."'";
			$result_select_dept = mysqli_query($conn, $sql_select_dept);
			$row_select_dept = mysqli_fetch_array($result_select_dept);
			$send = $row_select_dept["ap_emp_code"];
			$number_pcr = $pcr_number;
            //mail test
			include "mail_permission.php"; 
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