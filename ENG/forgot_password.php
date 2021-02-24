<?php
date_default_timezone_set("Asia/Bangkok");
include "connectpcr.php";
$sql_user = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$_POST["username"]."';";
$result_user = mysqli_query($conn, $sql_user);
if($row_user = mysqli_fetch_array($result_user)){
	$sql_email = "SELECT * FROM email WHERE EmpID = '".$_POST["username"]."';";
	$result_email = mysqli_query($condbmc, $sql_email);
	if($row_email = mysqli_fetch_array($result_email)){
		if($_POST["email"] == $row_email["mail"]){
			$rand = (rand(10,100));
			ini_set("SMTP","10.72.220.5");
			ini_set("port","25");
			$strTo = $row_email["mail"];
			$link = "microsoft-edge:http://sdm148020/PCR-2020/INT/change_password.php?emp=".$_POST["username"]."&confirm=".$rand;
			$strSubject = "Forgot Password of PCR System";
			$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
			$strVar = "My Message";
			$headers =  'MIME-Version: 1.0' . "\r\n"; 
			$headers .= 'From: "HRIS : PCR" <hris.information.a9z@ap.denso.com>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
			$strMessage = "
				<h1><font color= #124373 ><b>PCR | DENSO</b></font></h1>
				<br>
				<p>Dear sir,</p>
				<p>As your request from PCR System > please click here to <b><u><font color = red><a href = ".$link.">“Forgot Password”</a></font></u></b></p>
				<br>
				<br>
				<p> ----------------------------------------------------------------------------------------------------------------- </p>
				<p> If you encounter problems, please contact us. </p>
				<p>Human Resources Information System</p>
				<p> Tel : 2534,2550  </p>
				<p> Email : hris.information.a9z@ap.denso.com </p>
				";

			$flgSend = mail($strTo,$strSubject,$strMessage,$headers);  // @ = No Show Error //
			if($flgSend){
				$sql_Up_code = "UPDATE pcr_user SET code = '".$rand."' WHERE usr_emp_code = '".$_POST["username"]."';";
				$result_Up_code = mysqli_query($conn, $sql_Up_code);
				echo "<script language=\"JavaScript\">";
				echo "alert('Password has been send by email.');";
				echo "</script>";
				echo '<meta http-equiv=refresh content=0;URL=../index.php>';
			}else{
				echo "<script language=\"JavaScript\">";
				echo "alert('Can not send mail Please check the validity of the email address.');";
				echo "</script>";
				echo '<meta http-equiv=refresh content=0;URL=../INT/forgot.php>';
			}
		}else{
			echo "<script language=\"JavaScript\">";
			echo "alert('The email address is invalid : Please try again.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/forgot.php>';
		}
	}else{
		echo "<script language=\"JavaScript\">";
		echo "alert('Please contact your system administrator for assistance.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../index.php>';
	}
}else{
	echo "<script language=\"JavaScript\">";
	echo "alert('No data in the system : Please register.');";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../index.php>';
}


?>