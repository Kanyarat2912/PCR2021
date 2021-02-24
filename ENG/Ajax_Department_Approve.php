<?php
	include 'connectpcr.php'; 

	$Approve_ID = $_POST["AP_ID"];
	$sql = "SELECT * FROM employee WHERE Emp_ID = '".$Approve_ID."'";
	$query = $condbmc->query($sql);
	$row = $query->fetch_assoc();
	$sqlpos = "SELECT * FROM position WHERE Position_ID = '".$row["Position_ID"]."'";
	$querypos = $condbmc->query($sqlpos);
	$rowpos = $querypos->fetch_assoc();
	$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$row["Sectioncode_ID"]."'";
	$querysec = $condbmc->query($sqlsec);
	$rowsec = $querysec->fetch_assoc();
		
		$data2 = array(
				"position_ap"   => $row['Empname_engTitle']." ".$row['Empname_eng']." ".$row['Empsurname_eng'],
				"section_ap"  	 => $rowpos["Position_name"]." / ".$rowsec["Department"],
				
		);
	echo json_encode($data2);
	
?>