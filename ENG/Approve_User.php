<?php
date_default_timezone_set("Asia/Bangkok");
include "connectpcr.php";
session_start();
if($_GET["status"] == 1){
	$rand = (rand(10,100));
	$sql_UP_User = "UPDATE pcr_user SET usr_sr_id = 1, code = '".$rand."' WHERE usr_emp_code = '".$_GET["Emp_ID"]."'";
	$result_UP_User = mysqli_query($conn, $sql_UP_User);
	$sql_UP_Reg = "INSERT INTO pcr_register_approve (reg_emp_code,reg_app_em_code) VALUES ('".$_GET["Emp_ID"]."','".$_SESSION["empid_pcr"]."')";
	$result_UP_Reg = mysqli_query($conn, $sql_UP_Reg);
	$sql_email = "SELECT * FROM email WHERE EmpID = '".$_GET["Emp_ID"]."';";
	$result_email = mysqli_query($condbmc, $sql_email);
	$row_email = mysqli_fetch_array($result_email);
	ini_set("SMTP","10.72.220.5");
	ini_set("port","25");
	$strTo = $row_email["mail"];
	$link = "microsoft-edge:http://sdm148020/PCR-2020/INT/change_password.php?emp=".$_GET["Emp_ID"]."&confirm=".$rand;
	$empid = $emp;
	$strSubject = "Setting Password of PCR System";
	$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
	$strVar = "My Message";
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: "HRIS : PCR" <hris.information.a9z@ap.denso.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
	$strMessage = "
		<h1><font color= #124373 ><b>PCR | DENSO</b></font></h1>
		<br>
		<p>Dear sir,</p>
		<p>As your request from PCR System > please click here to <b><u><font color = red><a href = ".$link.">“Setting Password”</a></font></u></b></p>
		<br>			
		<p> ----------------------------------------------------------------------------------------------------------------- </p>
		<p> If you encounter problems, please contact us. </p>
		<p> Tel : 2534,2550  </p>
		<p> Email : hris.information.a9z@ap.denso.com </p>
		";

		$flgSend = mail($strTo,$strSubject,$strMessage,$headers);  // @ = No Show Error //
		if($flgSend){
			echo "<script language=\"JavaScript\">";
			echo "alert('Successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/PE_APP_USER.php>';

		}else{
			echo "<script language=\"JavaScript\">";
			echo "alert('Can not send mail : Please contact your system administrator for assistance.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/PE_APP_USER.php>';
		}
}else{
	$sql_name = "SELECT * From employee WHERE Emp_ID = '".$_SESSION["empid_pcr"]."'";
	$result_name = mysqli_query($condbmc, $sql_name);
	$row_name = mysqli_fetch_array($result_name);
	$name = $row_name["Empname_engTitle"] . ' ' . $row_name["Empname_eng"] . ' ' . $row_name["Empsurname_eng"];	
	$sql_UP_User = "UPDATE pcr_user SET usr_sr_id = 2 WHERE usr_emp_code = '".$_GET["Emp_ID"]."'";
	$result_UP_User = mysqli_query($conn, $sql_UP_User);
	$sql_email = "SELECT * FROM email WHERE EmpID = '".$_GET["Emp_ID"]."';";
	$result_email = mysqli_query($condbmc, $sql_email);
	$row_email = mysqli_fetch_array($result_email);
	ini_set("SMTP","10.72.220.5");
	ini_set("port","25");
	$strTo = $row_email["mail"];
	$link = "microsoft-edge:http://sdm148020/PCR-2020/INT/change_password.php?emp=".$_GET["Emp_ID"]."&confirm=".$rand;
	$empid = $emp;
	$strSubject = "Reject Permission to access of PCR System";
	$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
	$strVar = "My Message";
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: "HRIS : PCR" <hris.information.a9z@ap.denso.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
	$strMessage = "
		<h1><font color= #124373 ><b>PCR | DENSO</b></font></h1>
		<br>
		<p>Dear sir,</p>
		<p>The request to access the PCR system was Rejected.</p>
		<br>
		<h6>by. ".$name." | Date Time : ".date("d/M/Y H:i:s")."</h6>
		<br>	
		<p> ----------------------------------------------------------------------------------------------------------------- </p>
		<p> If you encounter problems, please contact us. </p>
		<p> Tel : 2534,2550  </p>
		<p> Email : hris.information.a9z@ap.denso.com </p>
		";

		$flgSend = mail($strTo,$strSubject,$strMessage,$headers);  // @ = No Show Error //
		if($flgSend){
			echo "<script language=\"JavaScript\">";
			echo "alert('Reject Successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/PE_APP_USER.php>';

		}else{
			echo "<script language=\"JavaScript\">";
			echo "alert('Can not send mail : Please contact your system administrator for assistance.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/PE_APP_USER.php>';
		}
}
?>