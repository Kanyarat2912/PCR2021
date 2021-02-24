<?php  
session_start();
include "../ENG/connectpcr.php";
date_default_timezone_set("Asia/Bangkok");
	function Emp_Data($condbmc,$EMP, $num){
		$sql_ap_plan_name = "SELECT * From employee WHERE Emp_ID = '".$EMP."'";
		$result_ap_plan_name = mysqli_query($condbmc, $sql_ap_plan_name);
		$row_ap_plan_name = mysqli_fetch_array($result_ap_plan_name);
		$sql_ap_plan_gc = "SELECT * From group_secname WHERE Sectioncode = '".$row_ap_plan_name["Sectioncode_ID"]."'";
		$result_ap_plan_gc = mysqli_query($condbmc, $sql_ap_plan_gc);
		$row_ap_plan_gc = mysqli_fetch_array($result_ap_plan_gc);
		$sql_ap_plan_p = "SELECT * From position WHERE Position_ID = '".$row_ap_plan_name["Position_ID"]."'";
		$result_ap_plan_p = mysqli_query($condbmc, $sql_ap_plan_p);
		$row_ap_plan_p = mysqli_fetch_array($result_ap_plan_p);
		if($num == 1){
		return $Name = $row_ap_plan_name["Empname_engTitle"] . ' ' . $row_ap_plan_name["Empname_eng"] . ' ' . $row_ap_plan_name["Empsurname_eng"];
		}else{
		return $SP = $row_ap_plan_gc["Group"].' / '.$row_ap_plan_p["Position_name"];
		}
	}
	
	function Anuualplan($conn){
		$sqlann = "SELECT * FROM pcr_annual_plan WHERE status = 1 AND anp_company = '".$_SESSION["company_pcr"]."'";
		$resultann = mysqli_query($conn, $sqlann);
		while ($rowann = mysqli_fetch_array($resultann)) {
			echo "<option data-value='" . $rowann['anp_anp_number'] . "'>" . $rowann['anp_anp_number'] . "</option>";
		}
	}
	function appdepart_Final($condbmc){
		$sqlemp = "SELECT * FROM employee WHERE Emp_ID = '".$_SESSION["empid_pcr"]."'";
		$resultemp = mysqli_query($condbmc, $sqlemp);
		$rowemp = mysqli_fetch_array($resultemp);
		$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$rowemp["Sectioncode_ID"]."'";	
		$resultsec = mysqli_query($condbmc, $sqlsec);
		$rowsec = mysqli_fetch_array($resultsec);
		$sqlgroup = "SELECT * FROM sectioncode WHERE group_id = '".$rowsec["group_id"]."'";
		$resultgroup = mysqli_query($condbmc, $sqlgroup);
		WHILE($rowgroup = mysqli_fetch_array($resultgroup)){
		$sqlapp = "SELECT *FROM employee WHERE Sectioncode_ID = '".$rowgroup["Sectioncode"]."' AND Position_ID <= 'P211' AND Position_ID > 'P101'  AND Statuswork_ID = 1";	
		$resultapp = mysqli_query($condbmc, $sqlapp);
		WHILE($rowapp = mysqli_fetch_array($resultapp)){
			echo "<option value='" . $rowapp['Emp_ID'] . "'>"  . $rowapp['Empname_engTitle']." ".$rowapp['Empname_eng']." ".$rowapp['Empsurname_eng'] . "</option>";
		}
		}
	}
	
	function appdepart_acknowledge($condbmc){
		$sqlacp = "SELECT *FROM employee WHERE Position_ID <= 'P413' AND Position_ID > 'P302'  AND Statuswork_ID = 1 AND Company_ID= '".$_SESSION["companyid_pcr"]."'";	
		$resultacp = mysqli_query($condbmc, $sqlacp);
		WHILE($rowacp = mysqli_fetch_array($resultacp)){
			echo "<option value='" . $rowacp['Emp_ID'] . "'>"  . $rowacp['Empname_engTitle']." ".$rowacp['Empname_eng']." ".$rowacp['Empsurname_eng'] . "</option>";
		}
		
	}
	
	function appdepart($condbmc){
		$sqlemp = "SELECT * FROM employee WHERE Emp_ID = '".$_SESSION['empid_pcr']."'";
		$resultemp = mysqli_query($condbmc, $sqlemp);
		$rowemp = mysqli_fetch_array($resultemp);
		$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$rowemp['Sectioncode_ID']."'";	
		$resultsec = mysqli_query($condbmc, $sqlsec);
		$rowsec = mysqli_fetch_array($resultsec);
		$sqlgroup = "SELECT * FROM sectioncode WHERE group_id = '".$rowsec['group_id']."'";
		$resultgroup = mysqli_query($condbmc, $sqlgroup);
		WHILE($rowgroup = mysqli_fetch_array($resultgroup)){
			$sqlapp = "SELECT *FROM employee WHERE Sectioncode_ID = '".$rowgroup['Sectioncode']."' AND Position_ID < '".$_SESSION['postid_pcr']."' AND  Position_ID <= 'P514' AND Position_ID > 'P221' AND Statuswork_ID = 1";	
			$resultapp = mysqli_query($condbmc, $sqlapp);
			WHILE($rowapp = mysqli_fetch_array($resultapp)){
				echo '<option value='.$rowapp["Emp_ID"].'> '.$rowapp["Empname_engTitle"].' '.$rowapp["Empname_eng"].' '.$rowapp["Empsurname_eng"].'</option>';
			}
		}
		
	}

	function Select_General($conn, $condbmc, $pcr_number){ 
		$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_pcr = mysqli_query($conn, $sql_pcr);
		$row_pcr = mysqli_fetch_array($result_pcr);
		$sqlemp = "SELECT * FROM employee WHERE Emp_ID = '".$row_pcr["fm_usr_emp_code"]."'";
		$resultemp = mysqli_query($condbmc, $sqlemp);
		$rowemp = mysqli_fetch_array($resultemp);
		$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$rowemp['Sectioncode_ID']."'";	
		$resultsec = mysqli_query($condbmc, $sqlsec);
		$rowsec = mysqli_fetch_array($resultsec);
		echo '<legend>General Data</legend>';
		echo '<div data-row-span="4">';
			echo '<div data-field-span="1">';
				echo '<label>No.</label>';
				echo '<input type="text" value="'.$row_pcr["fm_pcr_number"].'" disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Date</label>';
				echo '<input type="text" value="'.date("d-M-y", strtotime($row_pcr["fm_create_date"])).'" disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Registant</label>';
				echo '<input type="text" value="'.$rowemp["Empname_eng"].' '.substr($rowemp["Empsurname_eng"],0,1).'." disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Department</label>';
				echo '<input type="text" value="'.$rowsec["Department"].'" disabled>';
			echo '</div>';
		echo '</div>';
	}
////////////////////////////////////////////////////////////////////
function Select_access_time($conn, $condbmc, $pcr_number){ 
	$sql_pcr = "SELECT * FROM pcr_form LEFT JOIN pcr_access_time
				ON '".$pcr_number."' = pcr_access_time.at_pcr_number
				WHERE pcr_access_time.at_request_status = 2 ";
	$result_pcr = mysqli_query($conn, $sql_pcr);
	$row_pcr = mysqli_fetch_array($result_pcr);
	$sqlemp = "SELECT * FROM employee WHERE Emp_ID = '".$row_pcr["at_emp_code"]."'";
	$resultemp = mysqli_query($condbmc, $sqlemp);
	$rowemp = mysqli_fetch_array($resultemp);
	$sqlsec = "SELECT * FROM sectioncode WHERE Sectioncode = '".$rowemp['Sectioncode_ID']."'";	
	$resultsec = mysqli_query($condbmc, $sqlsec);
	$rowsec = mysqli_fetch_array($resultsec);
	$sql_access = "SELECT * FROM pcr_access_time WHERE at_pcr_number = '".$pcr_number."'";
	$resultaccess = mysqli_query($conn, $sql_access);
	$rowaccess = mysqli_fetch_array($resultaccess );
		//echo '<fieldset>';
		//Query from table access time &pcr_form
			echo '<div data-row-span="4">';
				echo '<div data-field-span="3">';
					echo '<label></label>';
				echo '</div>';
				echo '<div data-field-span="1">';
					echo '<label>Date</label>';
						echo '<input type="text" value="'.date("d-M-y", strtotime($rowaccess["at_request_date"])).'" disabled>';
				echo '</div>';
			echo '</div>';
			echo'<div data-row-span="3">';
				echo '<div data-field-span="1">';
					echo '<label>Employee Code</label>';
						echo '<input type="text" value="'.$rowemp["Emp_ID"].'" disabled>';	
				echo '</div>';
				echo '<div data-field-span="1">';
					echo '<label>Name-Surname</label>';
						echo '<input type="text" value="'.$rowemp["Empname_eng"].' '.substr($rowemp["Empsurname_eng"],0,1).'." disabled>';
				echo '</div>';
				echo '<div data-field-span="1">';
					echo '<label>Department</label>';
						echo '<input type="text" value="'.$rowsec["Department"].'" disabled>';
				echo '</div>';
			echo '</div>';
			echo '<div data-row-span="2">';
				echo '<div data-field-span="1">';
					echo '<label>PCR Number</label>';
						echo '<input type="text" value="'.$rowaccess["at_pcr_number"].'" disabled>';
				echo '</div>';
				echo '<div data-field-span="1">';
					echo '<label>PCR Level</label>';
						echo '<input type="text" value="'.$row_pcr["fm_level"].'" disabled>';
				echo '</div>';
			echo '</div>';
			
}





////////////////////////////////////////////////////////////////////
	function Select_Type($conn, $pcr_number){ 
		$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_pcr = mysqli_query($conn, $sql_pcr);
		$row_pcr = mysqli_fetch_array($result_pcr);
		echo '<div class="form-group">';
			echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">PCR Type</label>';
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_pcr_leadtime"] == "Normal"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Normal </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> Normal </label>';
				}
				
			echo '</div>';	
			echo '<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';
			if($row_pcr["fm_pcr_leadtime"] == "Urgent"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Urgent </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> Urgent </label>';
				}
			echo '</div>';
		echo '</div>';
			echo '<div class="form-group">';
				echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">PCR Level</label>';
				echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
					if($row_pcr["fm_level"] == "Confidential"){
						echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Confidential </label>';
					}else{
						echo '<label class="radio-inline icheck" ><input type="radio" disabled> Confidential </label>';
					}
					
				echo '</div>';	
				echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_level"] == "Secret"){
						echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Secret </label>';
					}else{
						echo '<label class="radio-inline icheck" ><input type="radio" disabled> Secret </label>';
					}
				echo '</div>';
				echo '<div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">';
				if($row_pcr["fm_level"] == "Top Secret"){
						echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Top Secret </label>';
					}else{
						echo '<label class="radio-inline icheck" ><input type="radio" disabled> Top Secret </label>';
					}
				echo '</div>';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">Part Test Flow Out</label>';
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_flowout"] == "1"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Yes </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> Yes </label>';
				}
				
			echo '</div>';	
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_flowout"] == "0"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> No </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> No </label>';
				}
			echo '</div>';
	
		echo '</div>';
	}

	function Select_Risk($conn, $pcr_number){ 
		$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_pcr = mysqli_query($conn, $sql_pcr);
		$row_pcr = mysqli_fetch_array($result_pcr);
		echo '<legend>Risk and Effect Analysis</legend>';
		echo '<br>';
		echo '<div class="form-group">';
		echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">Quality</label>';
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_quality"] == "1"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Yes </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> Yes </label>';
				}
			echo '</div>';	
			echo '<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';
				if($row_pcr["fm_quality"] == "0"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> No </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> No </label>';
				}
			echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
			echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">Safety</label>';
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_safety"] == "1"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Yes </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> Yes </label>';
				}
			echo '</div>';	
			echo '<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';
				if($row_pcr["fm_safety"] == "0"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> No </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> No </label>';
				}
			echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
			echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">Delivery</label>';
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">';
				if($row_pcr["fm_delivery"] == "1"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> Yes </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> Yes </label>';
				}
			echo '</div>';	
			echo '<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';
				if($row_pcr["fm_delivery"] == "0"){
					echo '<label class="radio-inline icheck" ><input type="radio" checked disabled> No </label>';
				}else{
					echo '<label class="radio-inline icheck" ><input type="radio" disabled> No </label>';
				}
			echo '</div>';
		echo '</div>';
	}
	
	function Select_file($conn, $pcr_number){ 
		echo '<legend>Details of Process Change</legend>';
		echo '<br>';
		$sql_file = "SELECT * FROM pcr_file_upload WHERE fup_fm_id = '".$pcr_number."'";
		$query_file = mysqli_query($conn, $sql_file);
		WHILE($row_file = mysqli_fetch_array($query_file)){
			if($row_file["fup_ft_id"] == 1){
				$file_type = "Plan";
			}else if($row_file["fup_ft_id"] == 2){
				$file_type = "Result";
			}else if($row_file["fup_ft_id"] == 3){
				$file_type = "Dar";
			}
			if($_SESSION['role_pcr'] == 6 OR $_SESSION['role_pcr'] == 7 OR $_SESSION['role_pcr'] == 8){
				$file = "../images/Upload/".$file_type."/".$row_file["fup_name"];
			}else{
				$file = "../watermark/watermark.php?fh=".$row_file["fup_ft_id"]."&id=".$row_file["fup_name"];
			}
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">';
				echo '<div class="checkbox green icheck">';
					echo '<a href="'.$file.'" target="_blank">';
						echo '<img src="../images/PDF_'.$file_type.'.png" style="width:120px;height:120px;" class="img-circle">';
					echo '</a>';
					echo '&nbsp; &nbsp; &nbsp;';
				echo '</div>';
			echo '</div>';
		}	
	}

	function Select_file_cc($conn, $pcr_number, $emp_id){ 
		echo '<legend>Details of Process Change</legend>';
		echo '<br>';
		$sql_file = "SELECT * FROM pcr_file_upload WHERE fup_fm_id = '".$pcr_number."'";
		$query_file = mysqli_query($conn, $sql_file);
		WHILE($row_file = mysqli_fetch_array($query_file)){
			if($row_file["fup_ft_id"] == 1){
				$file_type = "Plan";
			}else if($row_file["fup_ft_id"] == 2){
				$file_type = "Result";
			}else if($row_file["fup_ft_id"] == 3){
				$file_type = "Dar";
			}
			
			echo '<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">';
				echo '<div class="checkbox green icheck">';
					echo '<a href="../watermark/watermarkCC.php?fh='.$row_file["fup_ft_id"].'&id='.$row_file["fup_name"].'&empid='.$emp_id.'" target="_blank">';
						echo '<img src="../images/PDF_'.$file_type.'.png" style="width:120px;height:120px;" class="img-circle">';
					echo '</a>';
					echo '&nbsp; &nbsp; &nbsp;';
				echo '</div>';
			echo '</div>';
		}	
	}		
	
	function Select_Anuual($conn, $pcr_number){ 
		$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
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
		if($row_anu["anp_plan_review"] == 1){
			$anp_plan_review = "Yes";
		}else{
			$anp_plan_review = "No";
		}
		echo '<legend>Annual Data</legend>';
		echo '<br>';
		echo '<div data-row-span="2">';
			echo '<div data-field-span="1">';
				echo '<label>Annual Plan</label>';
				echo '<input  type="text" value="'.$row_pcr["fm_anp_id"].'" disabled  />';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Addition Item</label>';
				echo '<input type="text" value="'.$anp_add_item.'" disabled>';
			echo '</div>';
		echo '</div>';
		echo '<div data-row-span="1">';
			echo '<div data-field-span="1">';
				echo '<label>Title</label>';
				echo '<input type="text" value="'.$row_anu["anp_title"].'" disabled>';
			echo '</div>';
		echo '</div>';
		echo '<div data-row-span="2">';
			echo '<div data-field-span="1">';
				echo '<label>Change Type</label>';
				echo '<input type="text" value="'.$row_CT["ct_name"].'" disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Rank</label>';
				echo '<input type="text" value="'.$row_RK["rk_name"].'" disabled >';
			echo '</div>';
		echo '</div>';
		echo '<div data-row-span="2">';
			echo '<div data-field-span="1">';
				echo '<label>Customer submission</label>';
				echo '<input type="text" value="'.$row_anu["anp_cus_sub"].'" disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Plan Review</label>';
				echo '<input type="text" value="'.$anp_plan_review.'" disabled>';
			echo '</div>';
		echo '</div>';
		echo '<div data-row-span="2">';
			echo '<div data-field-span="1">';
				echo '<label>Product</label>';
				echo '<input type="text" value="'.$row_PD["pro_name"].'" disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Part Name</label>';
				echo '<input type="text" value="'.$row_anu["anp_part_name"].'" disabled>';
			echo '</div>';
		echo '</div>';
		echo '<div data-row-span="2">';
			echo '<div data-field-span="1">';
				echo '<label>Part Number</label>';
				echo '<input type="text" value="'.$row_pcr["fm_part_number"].'" disabled>';
			echo '</div>';
			echo '<div data-field-span="1">';
				echo '<label>Change Point</label>';
				echo '<input type="text" value="'.$row_CP["cp_name"].'" disabled>';
			echo '</div>';
		echo '</div>';
	}
	
	function Select_Priority($conn, $pcr_number){ 
		echo '<legend>Priority Management Category</legend>';
		echo '<br>';
		$sql_Priority = "SELECT * FROM pcr_form_priority WHERE fp_fm_id = '".$pcr_number."'";
		$query_Priority = mysqli_query($conn, $sql_Priority);
		WHILE($row_Priority = mysqli_fetch_array($query_Priority)){
			$sql_Pr = "SELECT * FROM pcr_priority WHERE pri_id = '".$row_Priority["fp_pri_id"]."'";
			$query_Pr = mysqli_query($conn, $sql_Pr);
			$row_Pr = mysqli_fetch_array($query_Pr);
			echo '<div class="col-sm-1 col-xs-1 col-md-1 col-lg-1 icheck-square">';
				echo '<div class="checkbox green icheck">';
					echo '<img src="../images/simbol/'.$row_Pr["pri_name"].'.png" style="width:70px" class="img-circle" >';
				echo '</div>';
			echo '</div>';
		}
	}
	
	function Select_implementation($conn, $pcr_number){
		echo '<legend>Implementation Plan</legend>';
		echo '<div class="form-group">';
			echo '<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 "></div>';
			echo '<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">';
				echo '<h5><center>[Plan]</center></h5>';
			echo '</div>';
			echo '<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">';
				echo '<h5><center>[Actual]</center></h5>';
			echo '</div>';
		echo '</div>';
		$sql_implementation = "SELECT * FROM pcr_implement_form WHERE mf_fm_id = '".$pcr_number."' ORDER BY mf_im_id ASC";
		$query_implementation = mysqli_query($conn, $sql_implementation);
		WHILE($row_implementation = mysqli_fetch_array($query_implementation)){
			$sql_implement_type = "SELECT * FROM pcr_implement WHERE im_id = '".$row_implementation["mf_im_id"]."'";
			$query_implement_type = mysqli_query($conn, $sql_implement_type);
			$row_implement_type = mysqli_fetch_array($query_implement_type);
			$implement_id = $row_implementation["mf_im_id"].'. '.$row_implement_type["im_name"];
			echo '<div class="form-group">';
				echo '<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">'.$implement_id.'</label>';
		echo '<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 "><center>'.date("d-M-y", strtotime($row_implementation["mf_date_plan"])).'</center></label>';
				if($row_implementation["mf_date_result"] != "" OR $row_implementation["mf_date_result"] != null){
					echo '<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 "><center>'.date("d-M-y", strtotime($row_implementation["mf_date_result"])).'</center></label>';
				}else{
					echo '<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 "><center>-</center></label>';
				}
			echo '</div>';
		}
		echo '<br>';
	}
	
	function Select_attach_doc($conn, $pcr_number){ 
		echo '<legend>Data attachments</legend>';
		echo '<br>';
		$i = 1;
		$sql_attach_doc = "SELECT * FROM pcr_attach_doc WHERE att_id = '".$pcr_number."'";
		$query_attach_doc = mysqli_query($conn, $sql_attach_doc);
		$row_attach_doc = mysqli_fetch_array($query_attach_doc);
		if($row_attach_doc["att_pfmea"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
				if($row_attach_doc["att_pfmea"] != 1){
					echo '<label>'.$i.'. PFMEA [ Document Number : <font color="red">'.$row_attach_doc["att_pfmea"].'</font> ]</label>';
				}else{
					echo '<label>'.$i.'. PFMEA</label>';
				}
				
			echo '</div>';
			$i++;
		}
		
		if($row_attach_doc["att_qa_network"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';	
				if($row_attach_doc["att_qa_network"] != 1){
					echo '<label>'.$i.'. QA Network [ Document Number : <font color="red">'.$row_attach_doc["att_qa_network"].'</font> ]</label>';
				}else{
					echo '<label>'.$i.'. QA Network</label>';
				}
				
			echo '</div>';
			$i++;
		}
		
		if($row_attach_doc["att_control_plan"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
				if($row_attach_doc["att_control_plan"] != 1){
					echo '<label>'.$i.'. Control plan ,PCC [ Document Number : <font color="red">'.$row_attach_doc["att_control_plan"].'</font> ]</label>';
				}else{
					echo '<label>'.$i.'. Control plan ,PCC</label>';
				}
				
			echo '</div>';
			$i++;
		}
		
		if($row_attach_doc["att_wi"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
				echo '<label>'.$i.'. Standardize work , WI</label>';
			echo '</div>';
			$i++;
		}
		
		if($row_attach_doc["att_machine_spec"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
				echo '<label>'.$i.'. Machine specification</label>';
			echo '</div>';
			$i++;
		}
		
		if($row_attach_doc["att_daily_check"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
				echo '<label>'.$i.'. Daily check sheet</label>';
			echo '</div>';
			$i++;
		}
		
		if($row_attach_doc["att_other"] != ""){
			echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
				echo '<label>'.$i.'. Other</label>';
			echo '</div>';
			$i++;
		}
		

	}

	function Select_QAP($conn, $condbmc, $pcr_number, $ph){ 
		
		$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_pcr = mysqli_query($conn, $sql_pcr);
		$row_pcr = mysqli_fetch_array($result_pcr);
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = '".$row_pcr["fm_state_app"]."' AND ap_ph_id = '".$row_pcr["fm_phase"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_ph_id"] == 1){
			if($row_flow["ap_apr_id"] == 5 OR $row_flow["ap_apr_id"] == 6){
				$sql_mtf = "SELECT * FROM pcr_meeting_form WHERE mtf_qap_id = '".$pcr_number."'";
				$result_mtf = mysqli_query($conn, $sql_mtf);
				$row_mtf = mysqli_fetch_array($result_mtf);
				$sql_m = "SELECT * FROM pcr_qap_form WHERE qap_id = '".$pcr_number."'";
				$result_m = mysqli_query($conn, $sql_m);
				$row_m = mysqli_fetch_array($result_m);
				if($row_mtf["mtf_mt_id"] == 7){
					$meeting = "1 Step no meeting";
				}else{
					$meeting = "6 Step meeting";
				}
				echo '<legend>QA Planing : '.$meeting.'</font></legend>';
				echo '<br>';
				$EMP = $row_m["qap_chairman"];
				$App_QAP = "Input By : ".Emp_Data($condbmc, $EMP, 1);
				$TT = 1;
				WHILE($row_mtf = mysqli_fetch_array($result_mtf)){
					$sql_mf = "SELECT * FROM pcr_qap_meeting WHERE mt_id = '".$row_mtf["mtf_mt_id"]."'";
					$result_mf = mysqli_query($conn, $sql_mf);
					$row_mf = mysqli_fetch_array($result_mf);
					$mf = $TT.'. '.$row_mf["mt_name"];
					echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">'.$mf.'</label>';
					$TT++;
				}
				echo '<br>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 "><font color="#3333FF">'.$App_QAP.'</font></label>';
				
			}
				
		}else{
				$sql_mtf = "SELECT * FROM pcr_meeting_form WHERE mtf_qap_id = '".$pcr_number."'";
				$result_mtf = mysqli_query($conn, $sql_mtf);
				$row_mtf = mysqli_fetch_array($result_mtf);
				$sql_m = "SELECT * FROM pcr_qap_form WHERE qap_id = '".$pcr_number."'";
				$result_m = mysqli_query($conn, $sql_m);
				$row_m = mysqli_fetch_array($result_m);
				if($row_mtf["mtf_mt_id"] == 7){
					$meeting = "1 Step no meeting";
				}else{
					$meeting = "6 Step meeting";
				}
				echo '<legend>QA Planing : '.$meeting.'</font></legend>';
				echo '<br>';
				$TT = 1;
				WHILE($row_mtf = mysqli_fetch_array($result_mtf)){
					$sql_mf = "SELECT * FROM pcr_qap_meeting WHERE mt_id = '".$row_mtf["mtf_mt_id"]."'";
					$result_mf = mysqli_query($conn, $sql_mf);
					$row_mf = mysqli_fetch_array($result_mf);
					$mf = $TT.'. '.$row_mf["mt_name"];
					echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">'.$mf.'</label>';
					$TT++;
				}
				$App_QAP = "Input By : ".Emp_Data($condbmc ,$row_m["qap_chairman"], 1);
				echo '<br>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 "><font color="#3333FF">'.$App_QAP.'</font></label>';
		}
		
	}
	
	function Select_BKD($conn, $condbmc, $pcr_number){ 
		$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_pcr = mysqli_query($conn, $sql_pcr);
		$row_pcr = mysqli_fetch_array($result_pcr);
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = '".$row_pcr["fm_state_app"]."' AND ap_ph_id = '".$row_pcr["fm_phase"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_ph_id"] == 1){
			if($row_flow["ap_apr_id"] == 6){
				$sql_BKD = "SELECT * FROM pcr_bkd_form WHERE bkd_id = '".$pcr_number."'";
				$result_BKD = mysqli_query($conn, $sql_BKD);
				$row_BKD = mysqli_fetch_array($result_BKD);
				if($row_BKD["bkd_request_type"] == 1){
					$BKD_TYPE = "Requires";
				}else{
					$BKD_TYPE = "Not Requires";
				}
				$date_Requires = date("d-M-y", strtotime($row_BKD["bkd_update_date"]));
				echo '<legend>QA Audit</legend>';
				echo '<br>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 "><u>'.$BKD_TYPE.'</u></label>';	
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">Date : '.$date_Requires.'</label>';	
				echo '<label class="col-sm-1 col-xs-1 col-md-1 col-lg-1 ">Comment:</label>';
				echo '<label class="col-sm-10 col-xs-10 col-md-10 col-lg-10 ">'.$row_BKD["bkd_comment"].'</label>';
				$App_QAP = "Input By : ".Emp_Data($condbmc ,$row_BKD["Emp_ID"], 1);
				echo '<br>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 "><font color="#3333FF">'.$App_QAP.'</font></label>';
			}
		}else{
			$sql_BKD = "SELECT * FROM pcr_bkd_form WHERE bkd_id = '".$pcr_number."'";
				$result_BKD = mysqli_query($conn, $sql_BKD);
				$row_BKD = mysqli_fetch_array($result_BKD);
				if($row_BKD["bkd_request_type"] == 1){
					$BKD_TYPE = "Requires";
				}else{
					$BKD_TYPE = "Not Requires";
				}
				$date_Requires = date("d-M-y", strtotime($row_BKD["bkd_update_date"]));
				echo '<legend>BKD</legend>';
				echo '<br>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 "><u>'.$BKD_TYPE.'</u></label>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">Date : '.$date_Requires.'</label>';					
				echo '<label class="col-sm-1 col-xs-1 col-md-1 col-lg-1 ">Comment:</label>';
				echo '<label class="col-sm-10 col-xs-10 col-md-10 col-lg-10 ">'.$row_BKD["bkd_comment"].'</label>';
				$App_QAP = "Input By : ".Emp_Data($condbmc ,$row_BKD["Emp_ID"], 1);
				echo '<br>';
				echo '<label class="col-sm-12 col-xs-12 col-md-12 col-lg-12 "><font color="#3333FF">'.$App_QAP.'</font></label>';
		}
	
	
			
	}
	
	function Select_Flow_Dept($condbmc, $conn, $pcr_number, $fh){ 
		if($fh == 1){
			$F = "Plan";
		}else{
			$F = "Result";
		}
		echo '<table class="tg" width="100%">';
			echo '<tr style="height: 0px">';
				echo '<td colspan="2">';
					echo '<hr>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="">';
				echo '<h3><b>Approval '.$F.'</b></h3>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td></td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td style="color:#124373"><b>Approver of Department : </b></td>';
			echo '</tr>';
			
			$sql_ap_plan1 = "SELECT * From pcr_flow_approve WHERE ap_apr_id = 1 and ap_fm_id = '".$pcr_number."' and ap_ph_id = '".$fh."' || ap_apr_id = 2 and ap_fm_id = '".$pcr_number."' and ap_ph_id = '".$fh."'";
			$result_ap_plan1 = mysqli_query($conn, $sql_ap_plan1);
			$i = 0;
			while ($row_ap_plan1 = mysqli_fetch_array($result_ap_plan1)) {
				$sql_ap_plan_f = "SELECT * From pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
				$result_ap_plan_f = mysqli_query($conn, $sql_ap_plan_f);
				$row_ap_plan_f = mysqli_fetch_array($result_ap_plan_f);
				if ($row_ap_plan1["ap_step"] < $row_ap_plan_f["fm_state_app"]) {
					$comment = $row_ap_plan1["ap_comments"];
					$Time = $row_ap_plan1["ap_tsmp"];
					$color = "#6600FF";
				} else if ($row_ap_plan1["ap_step"] == $row_ap_plan_f["fm_state_app"]) {
					$comment = "Waiting for approval";
					$Time = "Waiting for approval";
					$color = "#FF4500";
				} else if ($row_ap_plan1["ap_step"] > $row_ap_plan_f["fm_state_app"]) {
					$comment = "-";
					$Time = "-";
					$color = "#2F4F4F";
				}
				$i = $i + 1;
				if($row_ap_plan1["ap_apr_id"] == 1){
					echo '<tr>';
						echo '<td style="width: 450px; color:'.$color.'"><b>Checker '.$i.' : </b>'.Emp_Data($condbmc, $row_ap_plan1["ap_emp_code"], 1).'</td>';
						echo '<td style="color:'.$color.'"><b>Department / Position : </b>'.Emp_Data($condbmc, $row_ap_plan1["ap_emp_code"], 2).'</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td style="color:'.$color.'"><b>Comments : </b>'.$comment.'</td>';
						echo '<td style="color:'.$color.'"><b>Time Approval : </b>'.$Time.'</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td><br></td>';
					echo '</tr>';		
				}else{
					echo '<tr>';
						echo '<td style="width: 450px; color:'.$color.'"><b>Final Approval : </b>'.Emp_Data($condbmc, $row_ap_plan1["ap_emp_code"], 1).'</td>';
						echo '<td style="color:'.$color.'"><b>Department / Position : </b>'.Emp_Data($condbmc, $row_ap_plan1["ap_emp_code"], 2).'</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td style="color:'.$color.'"><b>Comments : </b>'.$comment.'</td>';
						echo '<td style="color:'.$color.'"><b>Time Approval : </b>'.$Time.'</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td><br></td>';
					echo '</tr>';
														
				}
			}
		echo '</table>';
	}

	function Select_Flow_Ack($condbmc, $conn, $pcr_number, $fh){ 
		echo '<table class="tg" width="100%">';
			echo '<tr style="height: 0px">';
				echo '<td colspan="2">';
					echo '<hr>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td style="color:#124373"><b>Acknowledge Department : </b></td>';
			echo '</tr>';
			$sql_ap_plan = "SELECT * From pcr_flow_approve WHERE ap_apr_id = 3 and ap_fm_id = '".$pcr_number."' and ap_ph_id = '".$fh."'";
			$result_ap_plan = mysqli_query($conn, $sql_ap_plan);
			$row_ap_plan = mysqli_fetch_array($result_ap_plan);
					$sql_ap_plan_f = "SELECT * From pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
					$result_ap_plan_f = mysqli_query($conn, $sql_ap_plan_f);
					$row_ap_plan_f = mysqli_fetch_array($result_ap_plan_f);
					if ($row_ap_plan["ap_step"] < $row_ap_plan_f["fm_state_app"]) {
						$comment = $row_ap_plan["ap_comments"];
						$Time = $row_ap_plan["ap_tsmp"];
						$color = "#6600FF";
					} else if ($row_ap_plan["ap_step"] == $row_ap_plan_f["fm_state_app"]) {
						$comment = "Waiting for approval";
						$Time = "Waiting for approval";
						$color = "#FF4500";
					} else if ($row_ap_plan["ap_step"] > $row_ap_plan_f["fm_state_app"]) {
						$comment = "-";
						$Time = "-";
						$color = "#2F4F4F";
					}
					echo '<tr>';
						echo '<td style="width: 450px; color:'.$color.'"><b>Approval : </b>'.Emp_Data($condbmc, $row_ap_plan["ap_emp_code"], 1).'</td>';
						echo '<td style="color:'.$color.'"><b>Department / Position : </b>'.Emp_Data($condbmc, $row_ap_plan["ap_emp_code"], 2).'</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td style="color:'.$color.'"><b>Comments : </b>'.$comment.'</td>';
						echo '<td style="color:'.$color.'"><b>Time Approval : </b>'.$Time.'</td>';
					echo '</tr>';
			echo '<tr style="height: 0px">';
				echo '<td colspan="2">';
						echo '<hr>';
				echo '</td>';
			echo '</tr>';
		echo '</table>';
	}
	
	function Select_Flow_QAP($condbmc, $conn, $pcr_number){ 
		$sql_QAP_plan = "SELECT * From pcr_flow_approve WHERE ap_apr_id = 4 and ap_fm_id = '".$pcr_number."' and ap_ph_id = 1";
		$result_QAP_plan = mysqli_query($conn, $sql_QAP_plan);
		$row_QAP_plan = mysqli_fetch_array($result_QAP_plan);
		$sql_QAP_plan_f = "SELECT * From pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_QAP_plan_f = mysqli_query($conn, $sql_QAP_plan_f);
		$row_QAP_plan_f = mysqli_fetch_array($result_QAP_plan_f);
		if ($row_QAP_plan["ap_step"] < $row_QAP_plan_f["fm_state_app"]) {
			$comment = $row_QAP_plan["ap_comments"];
			$Time = $row_QAP_plan["ap_tsmp"];
			$color = "#6600FF";
		} else if ($row_QAP_plan["ap_step"] == $row_QAP_plan_f["fm_state_app"]) {
			$comment = "Waiting for approval";
			$Time = "Waiting for approval";
			$color = "#FF4500";
		} else if ($row_QAP_plan["ap_step"] > $row_QAP_plan_f["fm_state_app"]) {
			$comment = "-";
			$Time = "-";
			$color = "#2F4F4F";
		}
			echo '<table class="tg" width="100%">';
				echo '<tr>';
					echo '<td style="color:#124373"><b>QAP Approve : </b></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="width: 450px; color:'.$color.'"><b>Chairman : </b>'.Emp_Data($condbmc, $row_QAP_plan["ap_emp_code"], 1).'</td>';
					echo '<td style="color:'.$color.'"><b>Department / Position : </b>'.Emp_Data($condbmc, $row_QAP_plan["ap_emp_code"], 2).'</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="color:'.$color.'"><b>Comments : </b>'.$comment.'</td>';
					echo '<td style="color:'.$color.'"><b>Time Approval : </b>'.$Time.'</td>';
				echo '</tr>';
				echo '<tr style="height: 0px">';
					echo '<td colspan="2">';
						echo '<hr>';
					echo '</td>';
				echo '</tr>';
			echo '</table>';
			
	}
	
	function Select_Flow_BKD($condbmc, $conn, $pcr_number){ 
		$sql_show_bkd = "SELECT * From pcr_flow_approve WHERE ap_apr_id = 5  and ap_fm_id = '".$pcr_number."' and ap_ph_id = 1";
		$result_show_bkd = mysqli_query($conn, $sql_show_bkd);
		$row_show_bkd = mysqli_fetch_array($result_show_bkd);
		$sql_BKD_plan_f = "SELECT * From pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_BKD_plan_f = mysqli_query($conn, $sql_BKD_plan_f);
		$row_BKD_plan_f = mysqli_fetch_array($result_BKD_plan_f);
		if($row_show_bkd["ap_sap_id"] == 1 ){ 
			echo '<table class="tg" width="100%">';
				
				echo '<tr>';
					echo '<td></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="color:#124373"><b>QA Audit Approve : </b></td>';
				echo '</tr>';
				$sql_BKD_plan = "SELECT * From pcr_bkd_form WHERE bkd_id = '".$pcr_number."'";
				$result_BKD_plan = mysqli_query($conn, $sql_BKD_plan);
				$i = 0;
				while ($row_BKD_plan = mysqli_fetch_array($result_BKD_plan)) {
				$i = $i + 1;
					echo '<tr>';
						echo '<td style="width: 450px; color:#6600FF" >';
							echo '<b>Chairman : </b>'.Emp_Data($condbmc, $row_show_bkd["ap_emp_code"], 1).'';
						echo '</td>';
						echo '<td style="color:#6600FF"><b>Department / Position : </b>'.Emp_Data($condbmc, $row_show_bkd["ap_emp_code"], 2).'</td>';
					echo '</tr>';
					echo '<tr style="color:#6600FF">';
						echo '<td>';
							echo '<b>Comments : </b>'.$row_BKD_plan["bkd_comment"].'';
							//echo '<b>BKD Check : </b><u>'.$row_BKD_plan["bkd_request_type"].'</u>';
						echo '</td>';
						echo '<td>';
							echo '<b>Time Approval : </b>'.$row_BKD_plan["bkd_create_date"].'';
						echo '</td>';
					echo '</tr>';
					echo '<tr style="color:#6600FF">';
						echo '<td>';
							//echo '<b>Comments : </b>'.$row_BKD_plan["bkd_comment"].'';
						echo '</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td><br></td>';
					echo '</tr>';
				}
			echo '</table>';
													
		}	
	}
	
	
	function Select_Flow_QAC($condbmc, $conn, $pcr_number, $fh){
		$sql_show_QAC = "SELECT * From pcr_flow_approve WHERE ap_apr_id = 6  and ap_fm_id = '".$pcr_number."' and ap_ph_id = 1";
		$result_show_QAC = mysqli_query($conn, $sql_show_QAC);
		$row_show_QAC = mysqli_fetch_array($result_show_QAC);
		$sql_BKD_plan_f = "SELECT * From pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
		$result_BKD_plan_f = mysqli_query($conn, $sql_BKD_plan_f);
		$row_BKD_plan_f = mysqli_fetch_array($result_BKD_plan_f);
		if($row_show_QAC["ap_sap_id"] == 1 ){ 
		echo '<table class="tg" width="100%">';
			echo '<tr style="height: 0px">';
				echo '<td colspan="2">';
					echo '<hr>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td style="color:#124373"><b>QAC Approve : </b></td>';
			echo '</tr>';
			$i = 0;
			$sql_ap_plan1 = "SELECT * From pcr_flow_approve WHERE ap_apr_id = 6 AND ap_fm_id = '".$pcr_number."' AND ap_ph_id = '".$fh."'";
			$result_ap_plan1 = mysqli_query($conn, $sql_ap_plan1);
			while ($row_ap_plan1 = mysqli_fetch_array($result_ap_plan1)) {
				$i = $i + 1;
				$sql_ap_plan_f = "SELECT * From pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
				$result_ap_plan_f = mysqli_query($conn, $sql_ap_plan_f);
				$row_ap_plan_f = mysqli_fetch_array($result_ap_plan_f);
				if ($row_ap_plan1["ap_step"] < $row_ap_plan_f["fm_state_app"]) {
					$comment = $row_ap_plan1["ap_comments"];
					$Time = $row_ap_plan1["ap_tsmp"];
					$color = "#6600FF";
				} else if ($row_ap_plan1["ap_step"] == $row_ap_plan_f["fm_state_app"]) {
					$comment = "Waiting for approval";
					$Time = "Waiting for approval";
					$color = "#FF4500";
				} else if ($row_ap_plan1["ap_step"] > $row_ap_plan_f["fm_state_app"]) {
					$comment = "-";
					$Time = "-";
					$color = "#2F4F4F";
				}
				echo '<tr>';
					echo '<td style="width: 450px; color:'.$color.'"><b> Checker '. $i.' : </b>'.Emp_Data($condbmc, $row_ap_plan1["ap_emp_code"], 1).'</td>';
					echo '<td style="color:'.$color.'"><b>Drpartment / Position : </b>'.Emp_Data($condbmc, $row_ap_plan1["ap_emp_code"], 2).'</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td style="color:'.$color.'"><b>Comments : </b>'.$comment.'</td>';
					echo '<td style="color:'.$color.'"><b>Time Approval : </b>'.$Time.'</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td><br></td>';
				echo '</tr>';
			}												
		echo '</table>';
		}
	}

	
	function Select_annual_section($conn){
		echo '<option value="">Please Select</option>';
		$sql_se = "SELECT * From pcr_section_anp ";
		$result_se = mysqli_query($conn, $sql_se);
		WHILE($row_se = mysqli_fetch_array($result_se)){
			echo '<option value="'.$row_se["sec_id"].'">'.$row_se["sec_name"].'</option>';
		}
	}
	
	function Select_annual_Change_Type($conn){
		echo '<option value="">Please Select</option>';
		$sql_ct = "SELECT * From pcr_change_type ";
		$result_ct = mysqli_query($conn, $sql_ct);
		WHILE($row_ct = mysqli_fetch_array($result_ct)){
			echo '<option value="'.$row_ct["ct_id"].'">'.$row_ct["ct_name"].'</option>';
		}
	}
	
	function Select_annual_Rank($conn){
		echo '<option value="">Please Select</option>';
		$sql_r = "SELECT * From pcr_rank ";
		$result_r = mysqli_query($conn, $sql_r);
		WHILE($row_r = mysqli_fetch_array($result_r)){
			echo '<option value="'.$row_r["rk_id"].'">'.$row_r["rk_name"].'</option>';
		}
	}
	
	function Select_annual_Product($conn){
		echo '<option value="">Please Select</option>';
		$sql_pd = "SELECT * From pcr_product ";
		$result_pd = mysqli_query($conn, $sql_pd);
		WHILE($row_pd = mysqli_fetch_array($result_pd)){
			echo '<option value="'.$row_pd["pro_id"].'">'.$row_pd["pro_name"].'</option>';
		}
	}
	
	function Select_annual_Change_Point($conn){
		echo '<option value="">Please Select</option>';
		$sql_cp = "SELECT * From pcr_change_point ";
		$result_cp = mysqli_query($conn, $sql_cp);
		WHILE($row_cp = mysqli_fetch_array($result_cp)){
			echo '<option value="'.$row_cp["cp_id"].'">'.$row_cp["cp_name"].'</option>';
		}
	}
	
?>

	