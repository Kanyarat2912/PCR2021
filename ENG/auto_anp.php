<?php
	include("connectpcr.php");
	date_default_timezone_set("Asia/Bangkok");
	
	$dn = "DN";
	$fy = "FY";
	$date = date("Y-m-d");
	$New_fy_date = date("Y")."-04-01";
	
	/* select seq from pcr_auto_gen tbl */	
	$sql = "SELECT * FROM pcr_auto_gen WHERE num = 1 ";
	$result = $conn->query($sql);
	$data = $result->fetch_assoc();
		
	$month = date("m");
	
	if($month < 4){
		$yy = date("Y", strtotime("-1 year", strtotime($date)));
		$fyy = substr($yy,-2);
		$num = sprintf("%03d", $data["seq"]);
	}else{
		$yy = date("Y");
		$fyy = substr($yy,-2);		
			if($date == $New_fy_date){
				$num = sprintf("%03d", "1");
			}else{
				$num = sprintf("%03d", $data["seq"]);
			}
	}	
	
		
	$an_num = $dn."-".$fy.$fyy."-".$num;
	
	$num_pls = $num+1;
	
	
	// $sql2 = "UPDATE pcr_auto_gen SET seq = '".$num_pls."' WHERE num = 1 ";
	// $query2 = mysqli_query($conn,$sql2);
	
	
?>