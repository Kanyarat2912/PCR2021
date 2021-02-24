<?php
$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$number_pcr."'";
$result_pcr = mysqli_query($conn, $sql_pcr);
$row_pcr = mysqli_fetch_array($result_pcr);
$sql_anu = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_pcr["fm_anp_id"]."'";
$result_anu = mysqli_query($conn, $sql_anu);
$row_anu = mysqli_fetch_array($result_anu);
$sql_CT = "SELECT * FROM pcr_change_type WHERE ct_id = '".$row_anu["anp_ct_id"]."'";
$result_CT = mysqli_query($conn, $sql_CT);
$row_CT = mysqli_fetch_array($result_CT);
$sql_RK = "SELECT * FROM pcr_rank WHERE rk_id = '".$row_anu["anp_rk_id"]."'";
$result_RK = mysqli_query($conn, $sql_RK);
$row_RK = mysqli_fetch_array($result_RK);
$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_anu["anp_pro_id"]."'";
$result_PD = mysqli_query($conn, $sql_PD);
$row_PD = mysqli_fetch_array($result_PD);
$sql_CP = "SELECT * FROM pcr_change_point WHERE cp_id = '".$row_anu["anp_cp_id"]."'";
$result_CP = mysqli_query($conn, $sql_CP);
$row_CP = mysqli_fetch_array($result_CP);
if($row_anu["anp_add_item"] == 1){
	$anp_add_item = "Yes";
}else{
	$anp_add_item = "No";
}
$sql_role = "SELECT * FROM pcr_concern_group WHERE ccr_product = '".$row_PD["pro_id"]."'";
$result_role = mysqli_query($conn, $sql_role);
While($row_role = mysqli_fetch_array($result_role)){
	$send = $row_role["ccr_emp_code"];
	$sql_email = "SELECT * FROM email WHERE EmpID = '".$send."';";
	$result_email = mysqli_query($condbmc, $sql_email);
	$row_email = mysqli_fetch_array($result_email);
	ini_set("SMTP","10.72.220.5");
	ini_set("port","25");
	$strTo = $row_email["mail"];
	$link = "microsoft-edge:http://sdm148020/PCR-2020/INT/cc.php?id=".$number_pcr."&Emp_ID=".$send."";
	$strSubject = "PCR Plan “Approved” No.<".$number_pcr.">";
	$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
	$strVar = "My Message";
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: "HRIS : PCR" <hris.information.a9z@ap.denso.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n"; 
	$strMessage = "
		<h1><font color= #124373 ><b>PCR | DENSO</b></font></h1>
	<p>Process Change Request Information, as the below details</p>
	<p>[Change point details]</p>
	<table style='width:50%; border-color:#000000' border='1'>
	  <tr>
		<td style='width:30%><b>Annual plan No</b></td>
		<td>".$row_pcr["fm_anp_id"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%><b>Annual plan No</b></td>
		<td>".$row_pcr["fm_anp_id"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Subject</b></td>
		<td>".$row_anu["anp_title"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Addition</b></td>
		<td>".$anp_add_item."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Rank</b></td>
		<td>".$row_RK["rk_name"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Change type</b></td>
		<td>".$row_CT["ct_name"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Product</b></td>
		<td>".$row_PD["pro_name"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Part name</b></td>
		<td>".$row_anu["anp_part_name"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Part number</b></td>
		<td>".$row_pcr["fm_part_number"]."</td>
	  </tr>
	  <tr>
		<td style='width:30%'><b>Change point</b></td>
		<td>".$row_CP["cp_name"]."</td>
	  </tr>
	</table>
	<br>
	
	<p>To see the details, please <b><u><font color = red><a href = ".$link.">“Cilck here”</a></font></u></b></p>
	<br>
	<p> ----------------------------------------------------------------------------------------------------------------- </p>
	<p> If you encounter problems, please contact us. </p>
	<p> Human Resources Information System</p>
	<p> Tel : 2534,2550  </p>
	<p> Email : hris.information.a9z@ap.denso.com </p>
		";

	$flgSend = mail($strTo,$strSubject,$strMessage,$headers);  // @ = No Show Error //
	if($flgSend){
		$sql_mail_log = "INSERT INTO log_send_mail(Emp_ID,pcr_form) 
		VALUES ('".$send."','".$number_pcr."')";
		$query_mail_log = $conn->query($sql_mail_log);
	}
}
?>