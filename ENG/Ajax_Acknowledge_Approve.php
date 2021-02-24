<?php
	include "connectpcr.php";

	$Acknow_ID = $_POST["Acknow_ID"];
	$sql = "SELECT * FROM employee WHERE Emp_ID = '".$Acknow_ID."'";
	$query = $condbmc->query($sql);
	$row = $query->fetch_assoc();
	$sqlpos = "SELECT * FROM position WHERE Position_ID = '".$row["Position_ID"]."'";
	$querypos = $condbmc->query($sqlpos);
	$rowpos = $querypos->fetch_assoc();
	$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$row["Sectioncode_ID"]."'";
	$querysec = $condbmc->query($sqlsec);
	$rowsec = $querysec->fetch_assoc();
		
		$data3 = array(
				"position_ac"   => $row['Empname_engTitle']." ".$row['Empname_eng']." ".$row['Empsurname_eng'],
				"section_ac"  	 => $rowpos["Position_name"]." / ".$rowsec["Department"],
				
				
		);
	echo json_encode($data3);
	
	
		
	
?>