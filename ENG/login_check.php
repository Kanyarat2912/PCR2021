<?php 
$empid = $_POST["username"];
$pass = $_POST["password"];
date_default_timezone_set('asia/bangkok');
session_start();
include "connectpcr.php";
$sql = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$empid."' AND usr_password = '".$pass."' ";
$query = $conn->query($sql);
if($row = $query->fetch_assoc()){
	if($row["usr_sr_id"] == 1){
		if($row["usr_exp_date"] == date('Y-m-d') OR $row["usr_exp_date"] < date('Y-m-d')){
			echo "<script language=\"JavaScript\">";
			echo "alert('Password expired : Please change the new password. ')";
			echo "</script>";
			echo '<meta http-equiv=refresh content=0;URL=../INT/change_password.php?emp=';echo $_POST["username"];echo '&confirm=';echo $row["code"];echo '>';
			
		}else{
			$sqllog = "INSERT INTO login_log (Emp_ID,ip) value ('".$empid."','".$_SERVER['REMOTE_ADDR']."')";
			$querylog = $conn->query($sqllog);
			$sqlemp = "SELECT * FROM employee WHERE Emp_ID = '".$empid."'";
			$queryemp = $condbmc->query($sqlemp);
			$rowemp = $queryemp->fetch_assoc();
			$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$rowemp["Sectioncode_ID"]."'";
			$querysec = $condbmc->query($sqlsec);
			$rowsec = $querysec->fetch_assoc();
			$sqlpos = "SELECT * FROM position WHERE Position_ID = '".$rowemp["Position_ID"]."'";
			$querypos = $condbmc->query($sqlpos);
			$rowpos = $querypos->fetch_assoc();
			$sqlcom = "SELECT * FROM company WHERE Company_ID = '".$rowemp["Company_ID"]."'";
			$querycom = $condbmc->query($sqlcom);
			$rowcom = $querycom->fetch_assoc();
			$_SESSION["empname_pcr"] = $rowemp["Empname_eng"];
			$_SESSION["emplast_pcr"] = $rowemp["Empsurname_eng"];
			$_SESSION["empid_pcr"] = $empid;
			$_SESSION["sct_pcr"] = $rowsec["Sectioncode"];
			$_SESSION["dept_pcr"] = $rowsec["Department"];
			$_SESSION["postid_pcr"] = $rowpos["Position_ID"];
			$_SESSION["pos_pcr"] = $rowpos["Position_name"];
			$_SESSION["companyid_pcr"] = $rowcom["Company_ID"];
			$_SESSION["company_pcr"] = $rowcom["Company_shortname"];
			$_SESSION['role_pcr'] = $row["usr_rl_id"];	
			echo '<meta http-equiv=refresh content=0;URL=../INT/homepage.php>';
		}
	}else if($row["usr_sr_id"] == 2){
		echo "<script language=\"JavaScript\">";
		echo "alert('Not approved : Please contact your system administrator for assistance.')";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/login.php>';
	}else if($row["usr_sr_id"] == 3){
		echo "<script language=\"JavaScript\">";
		echo "alert('Waiting for PE admin approve.')";
		echo "</script>";
		echo '<meta http-equiv=refresh content=0;URL=../INT/login.php>';
	}

}else{
	echo "<script language=\"JavaScript\">";
	echo "alert('Login fail : Please register or verify the username and password.')";
	echo "</script>";
	echo '<meta http-equiv=refresh content=0;URL=../index.php>';
}

?>