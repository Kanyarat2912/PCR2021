<?php
include "connectpcr.php";
$annual = $_POST["anuual_ID"];
$sql = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$annual."' AND status = 1";
$query = $conn->query($sql);
if($row = $query->fetch_assoc()){
	$sqlct = "SELECT * FROM pcr_change_type WHERE ct_id = '".$row["anp_ct_id"]."'";
	$queryct = $conn->query($sqlct);
	$rowct = $queryct->fetch_assoc();
	$sqlrk = "SELECT * FROM pcr_rank WHERE rk_id = '".$row["anp_rk_id"]."'";
	$queryrk = $conn->query($sqlrk);
	$rowrk = $queryrk->fetch_assoc();
	$sqlpc = "SELECT * FROM pcr_change_point WHERE cp_id = '".$row["anp_cp_id"]."'";
	$querypc = $conn->query($sqlpc);
	$rowpc = $querypc->fetch_assoc();
	$sqlpd = "SELECT * FROM pcr_product WHERE pro_id = '".$row["anp_pro_id"]."'";
	$querypd = $conn->query($sqlpd);
	$rowpd = $querypd->fetch_assoc();
	if($row["anp_add_item"] == 1){
		$add_item = "Yes";
	}else{
		$add_item = "No";
	}
	if($row["anp_plan_review"] == 1){
		$plan_review = "Yes";
	}else{
		$plan_review = "No";
	}
	if($row["anp_cus_sub"] == ""){
		$cus_sub = "No";
	}else{
		$cus_sub = $row["anp_cus_sub"];
	}
	
	$data = array(
			"Add_item"		 => $add_item,
			"Title"  		 => $row["anp_title"],
			"Change_type"  	 => $rowct["ct_name"],
			"Rank"  		 => $rowrk["rk_name"],
			"Customer_sub"   => $cus_sub,
			"Plan_review"    => $plan_review,
			"Product"   	 => $rowpd["pro_name"],
			"P_name"   		 => $row["anp_part_name"],
			"Cp"   			 => $rowpc["cp_name"],
	);
	echo json_encode($data);
	
}else{
	$data = "NO";
	echo json_encode($data);
}
?>