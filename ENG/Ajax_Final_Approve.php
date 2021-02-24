<?php
include "connectpcr.php";
$Final_ID = $_POST["Final_ID"];
$sql = "SELECT * FROM employee WHERE Emp_ID = '".$Final_ID."'";
$query = $condbmc->query($sql);
$row = $query->fetch_assoc();
$sqlpos = "SELECT * FROM position WHERE Position_ID = '".$row["Position_ID"]."'";
$querypos = $condbmc->query($sqlpos);
$rowpos = $querypos->fetch_assoc();
$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$row["Sectioncode_ID"]."'";
$querysec = $condbmc->query($sqlsec);
$rowsec = $querysec->fetch_assoc();
	
	$data1 = array(
			"position"   => $row['Empname_engTitle']." ".$row['Empname_eng']." ".$row['Empsurname_eng'],
			"section"  	 => $rowpos["Position_name"]." / ".$rowsec["Department"],
			
	);
	echo json_encode($data1);

?>