<?php
date_default_timezone_set('asia/bangkok');
include "connectpcr.php";
$sql = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$_POST["username"]."'";
$query = $conn->query($sql);

if($row = $query->fetch_assoc()){
	if($row["usr_sr_id"] == 1){
		echo "<script language=\"JavaScript\">";
		echo "alert('Register fail : Registered.')";
		echo "</script>";
	}else if($row["usr_sr_id"] == 2){
		echo "<script language=\"JavaScript\">";
		echo "alert('Register fail : Please contact your system administrator for assistance.')";
		echo "</script>";
	}else if($row["usr_sr_id"] == 3){
		echo "<script language=\"JavaScript\">";
		echo "alert('Register fail : Please wait for PE admin approved.')";
		echo "</script>";
	}
	echo '<meta http-equiv=refresh content=0;URL=../index.php>';
}else{
	$sql_email = "SELECT * FROM email WHERE EmpID = '".$_POST["username"]."';";
	$result_email = mysqli_query($condbmc, $sql_email);
	if($row_email = mysqli_fetch_array($result_email)){
		if($_POST["email"] == $row_email["mail"]){
			$sql_IN_User = "INSERT INTO pcr_user (usr_emp_code) VALUES ('".$_POST["username"]."')";
			$result_IN_User = mysqli_query($conn, $sql_IN_User);
			$sql_PE = "SELECT * FROM pcr_user WHERE usr_rl_id = 7";
			$query_PE = mysqli_query($conn, $sql_PE);
			WHILE($row_PE = mysqli_fetch_array($query_PE)){
				$sql_email_PE = "SELECT * FROM email WHERE EmpID = '".$row_PE["usr_emp_code"]."'";
				$result_email_PE = mysqli_query($condbmc, $sql_email_PE);
				$row_email_PE = mysqli_fetch_array($result_email_PE);
				ini_set("SMTP","10.72.220.5");
				ini_set("port","25");
				
				$strTo = $row_email_PE["mail"];
				$link = "microsoft-edge:http://sdm148020/PCR-2020/";
				$strSubject = "<Associate have requested permission to access PCR system>";
				$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
				$strVar = "My Message";
				$headers =  'MIME-Version: 1.0' . "\r\n"; 
				$headers .= 'From: "HRIS : PCR" <hris.information.a9z@ap.denso.com>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
				$strMessage = "
					<h1><font color= #124373 ><b>PCR | DENSO</b></font></h1>
					<br>
					<p>Dear sir,</p>
					<p>Associate have requested permission to access PCR system, details are as follows.</p> 
					<p>User Name : ".$_POST["username"]."</p>
					<p>Link to PCR System -> <b><u><font color = #124373><a href = ".$link.">“Click”</a></font></u></b></p>
					<br>
					<br>
					<p>Sincerely,</p>
					<p>Human Resources Information System</p>			
					<p> ----------------------------------------------------------------------------------------------------------------- </p>
					<p> If you encounter problems, please contact us. </p>
					<p> Tel : 2534,2550  </p>
					<p> Email : hris.information.a9z@ap.denso.com </p>
					";

				$flgSend = mail($strTo,$strSubject,$strMessage,$headers);  // @ = No Show Error //
			}
			
			echo "<script language=\"JavaScript\">";
			echo "alert('Register : Successfully.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../index.php>';
		}else{
			echo "<script language=\"JavaScript\">";
			echo "alert('The email address is invalid : Please try again.');";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../index.php>';
		}
		
	}else{
		echo "<script language=\"JavaScript\">";
		echo "alert('Can't Register : Please try again.');";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/register.php>';
	}
}
?>