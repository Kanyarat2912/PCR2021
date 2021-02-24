<?php
session_start();
include "../ENG/connectpcr.php";
include "modal_annual_plan.php";
function Select_Requested_Permission($conn, $condbmc, $status){
	$sql_Requested_Permission = "SELECT * FROM pcr_user WHERE usr_sr_id = '".$status."';";
	$result_Requested_Permission = mysqli_query($conn, $sql_Requested_Permission);
	WHILE($row_Requested_Permission = mysqli_fetch_array($result_Requested_Permission)){
		$sql_name = "SELECT * From employee WHERE Emp_ID = '".$row_Requested_Permission["usr_emp_code"]."'";
		$result_name = mysqli_query($condbmc, $sql_name);
		$row_name = mysqli_fetch_array($result_name);
		$sql_gc = "SELECT * From group_secname WHERE Sectioncode = '".$row_name["Sectioncode_ID"]."'";
		$result_gc = mysqli_query($condbmc, $sql_gc);
		$row_gc = mysqli_fetch_array($result_gc);
		$sql_p = "SELECT * From position WHERE Position_ID = '".$row_name["Position_ID"]."'";
		$result_p = mysqli_query($condbmc, $sql_p);
		$row_p = mysqli_fetch_array($result_p);
		$name = $row_name["Empname_engTitle"] . ' ' . $row_name["Empname_eng"] . ' ' . $row_name["Empsurname_eng"];
		$Sec_dept = $row_gc["Sectioncode"]." / ".$row_gc["Department"];
		echo '<tr class="odd gradeX">';
			echo '<td>'.$row_Requested_Permission["usr_emp_code"].'</td>';
			echo '<td>'.$name.'</td>';
			echo '<td>'.$row_p["Position_name"].'</td>';
			echo '<td class="center">'.$Sec_dept.'</td>';
			echo '<td class="center">';
				echo '<ul class="demo-btns center">';
				   echo '<li><a href="profile.php?Emp_ID='.$row_Requested_Permission["usr_emp_code"].'" class="btn btn-info-alt"><i class="ti ti-search"></i></a></li>';
				   echo '&nbsp;&nbsp;';
                   echo '<li><a href="../ENG/Approve_User.php?Emp_ID='.$row_Requested_Permission["usr_emp_code"].'&status=1" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>';
				   echo '&nbsp;&nbsp;';
                   echo '<li><a href="../ENG/Approve_User.php?Emp_ID='.$row_Requested_Permission["usr_emp_code"].'&status=0" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li>';        
                echo '</ul>';
			echo '</td>';
		echo '</tr>';
		
	}
	
}

function Select_CC_PCR($conn, $condbmc){
	$i=1;
	$sql_cc = "SELECT DISTINCT pcr_form FROM pcr_concern WHERE Emp_ID = '".$_SESSION["empid_pcr"]."' ";
	$result_cc = mysqli_query($conn, $sql_cc);
	WHILE($row_cc = mysqli_fetch_array($result_cc)){
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$row_cc["pcr_form"]."'";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
		$row_MY_PCR = mysqli_fetch_array($result_MY_PCR);
		$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
		$result_ANN = mysqli_query($conn, $sql_ANN);
		$row_ANN = mysqli_fetch_array($result_ANN);
		$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
		$result_PD = mysqli_query($conn, $sql_PD);
		$row_PD = mysqli_fetch_array($result_PD);
		$title = substr($row_ANN["anp_title"],0,20)."...";
		$sql_name = "SELECT * From employee WHERE Emp_ID = '".$row_MY_PCR["fm_usr_emp_code"]."'";
		$result_name = mysqli_query($condbmc, $sql_name);
		$row_name = mysqli_fetch_array($result_name);
		$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-success-alt"><i class="ti ti-search"></i></a></li></ul>';
		echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$row_name["Empname_eng"].' '.substr($row_name["Empsurname_eng"],0,1).'.</td>';
			echo '<td class="center">'.$Action.'</td>';
		echo '</tr>';
		$i++;
	}
}

function Select_ALL_PCR($conn, $condbmc){
	$i=1;
	$sql_MY_PCR =  "SELECT * FROM pcr_form 
					LEFT JOIN pcr_access_time
					ON pcr_form.fm_pcr_number = pcr_access_time.at_pcr_number";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
		$result_ANN = mysqli_query($conn, $sql_ANN);
		$row_ANN = mysqli_fetch_array($result_ANN);
		$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
		$result_PD = mysqli_query($conn, $sql_PD);
		$row_PD = mysqli_fetch_array($result_PD);
		$title = substr($row_ANN["anp_title"],0,20)."...";
		$sql_name = "SELECT * From employee WHERE Emp_ID = '".$row_MY_PCR["fm_usr_emp_code"]."'";
		$result_name = mysqli_query($condbmc, $sql_name);
		$row_name = mysqli_fetch_array($result_name);
		if($row_MY_PCR["is_delete"] == 1){
			if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 0 ){
				$status = "Plan";
				$style = "primary";
			}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 0){
				$status = "Result";
				$style = "primary";
			}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 1 ){
				$status = "Plan";
				$style = "primary";
			}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 3){
				$status = "Complete";
				$style = "success";
			}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 2 ){
				$status = "Reject/Plan";
				$style = "danger";
			}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 2){
				$status = "Reject/Result";
				$style = "danger";
			}
		}else{
			$status = "Cancel";
			$style = "danger";
		}
		
		$Action = '<center><ul class="demo-btns">';
						if($row_MY_PCR["fm_level"] == "Confidential"){
					$Action.=	'<li>
						<a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-'.$style.'-alt"><i class="ti ti-search"></i>
						</a></li>';
						}
						if($row_MY_PCR["fm_level"] == "Secret" || $row_MY_PCR["fm_level"] == "Top Secret" ){
							if($row_MY_PCR["at_request_status"] == 0){
								$Action.='<li><button pcr_number="'.$row_MY_PCR["fm_pcr_number"].'"  type="button"  class="request btn btn-inverse-alt" data-toggle="modal" data-target="#formModal"><i class="ti ti-key"></i>';
							}else if($row_MY_PCR["at_request_status"] == 1){
								$Action.=	'<li>
								<a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-'.$style.'-alt"><i class="ti ti-search"></i>
								</a></li>';
							}else{
								$Action.='<li><button pcr_number="'.$row_MY_PCR["fm_pcr_number"].'"  type="button"  class="btn btn-warning-alt"><i class="ti ti-reload"></i>';
							}
							

					 '</button>
					    </li>';
						}
						
						$Action.='</ul></center>';
		
		echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td> <input type="hidden" value='.$row_MY_PCR["fm_usr_emp_code"].'>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$row_name["Empname_eng"].' '.substr($row_name["Empsurname_eng"],0,1).'.</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center">'.$row_MY_PCR["fm_level"].'</td>';
			echo '<td class="center">'.$Action.'</td>';
			
		echo '</tr>';
		$i++;
	}
}

function Select_MY_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE fm_usr_emp_code = '".$_SESSION["empid_pcr"]."' AND is_delete = 1 ORDER BY fm_id DESC";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
		$result_ANN = mysqli_query($conn, $sql_ANN);
		$row_ANN = mysqli_fetch_array($result_ANN);
		$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
		$result_PD = mysqli_query($conn, $sql_PD);
		$row_PD = mysqli_fetch_array($result_PD);
		$title = substr($row_ANN["anp_title"],0,20)."...";
		if($row_MY_PCR["fm_state_app"] == 1){
			$Delete = '<li><a href="../INT/cancel.php?id='.$row_MY_PCR["fm_pcr_number"].'"  class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li>';
		}else{
			$Delete = '';
		}
		if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 0 ){
			$status = "Plan";
			$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;'.$Delete.'</ul>';
		}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 0){
			$status = "Result";
			$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;'.$Delete.'</ul>';
		}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 1 ){
			$status = "Plan";
			$Action = '<ul class="demo-btns"><li><a href="../INT/result.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-warning-alt">Result</a></li></ul>';
		}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 3){
			$status = "Complete";
			$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-success-alt"><i class="ti ti-search"></i></li></ul>';
		}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 2 ){
			$status = "Plan";
			$Action = '<ul class="demo-btns"><li><a href="../INT/RJ_Plan.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt">Reject</a></li>&nbsp;<li><a href="../INT/cancel.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></ul>';
		}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 2){
			$status = "Result";
			$Action = '<ul class="demo-btns"><li><a href="../INT/RJ_Result.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt">Reject</a>&nbsp;<li><a href="../INT/cancel.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></li></ul>';
		}
		
			
		echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center">'.$Action.'</td>';
		echo '</tr>';
		$i++;
	}
}

function Select_Request_PCR($conn, $condbmc){
		$i=1;
		$sql_MY_PCR = "SELECT * FROM pcr_form 
						LEFT JOIN pcr_access_time
						ON pcr_form.fm_pcr_number = pcr_access_time.at_pcr_number
						WHERE pcr_access_time.at_request_status = 2 ";
		$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
		WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
			$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
			$result_ANN = mysqli_query($conn, $sql_ANN);
			$row_ANN = mysqli_fetch_array($result_ANN);
			$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
			$result_PD = mysqli_query($conn, $sql_PD);
			$row_PD = mysqli_fetch_array($result_PD);
			$title = substr($row_ANN["anp_title"],0,20)."...";
			$sql_name = "SELECT * From employee WHERE Emp_ID = '".$row_MY_PCR["at_emp_code"]."'";
			$result_name = mysqli_query($condbmc, $sql_name);
			$row_name = mysqli_fetch_array($result_name);
			if($row_MY_PCR["is_delete"] == 1){
				if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 0 ){
					$status = "Plan";
					$style = "primary";
				}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 0){
					$status = "Result";
					$style = "primary";
				}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 1 ){
					$status = "Plan";
					$style = "primary";
				}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 3){
					$status = "Complete";
					$style = "success";
				}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 2 ){
					$status = "Reject/Plan";
					$style = "danger";
				}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 2){
					$status = "Reject/Result";
					$style = "danger";
				}
			}else{
				$status = "Cancel";
				$style = "danger";
			}
			$Action = '<center><ul class="demo-btns">';
					
					$Action.=	'<li>
						<a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-'.$style.'-alt"><i class="ti ti-search"></i>
						</a></li> &nbsp;';
					
						
								$Action.='<li><a href="../INT/access_time.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>&nbsp;';
						
								$Action.='<li><button pcr_number="'.$row_MY_PCR["fm_pcr_number"].'"  type="button"  class="cancelRequest btn btn-danger-alt" data-toggle="modal" data-target="#CancelModal"><i class="ti ti-close"></i>';
					 '</button>
					    </li>';
						
						$Action.='</ul><center>';


	
		
					  
			
			echo '<tr class="odd gradeX">';
				echo '<td class="center"><center>'.$i.'</center></td>';
				echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td> <input type="hidden" value='.$row_MY_PCR["fm_usr_emp_code"].'>';
				echo '<td class="center">'.$row_MY_PCR["fm_level"].'</td>';
				echo '<td class="center">'.$row_name["Empname_eng"].' '.substr($row_name["Empsurname_eng"],0,1).'.</td>';
				echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["at_request_date"])).'</td>';
				echo '<td class="center">'.$status.'</td>';
				echo '<td class="center">'.$Action.'</td>';
				
			echo '</tr>';
			$i++;
		}
	}
////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////
function Select_add_permis($conn, $condbmc){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
		$result_ANN = mysqli_query($conn, $sql_ANN);
		$row_ANN = mysqli_fetch_array($result_ANN);
		$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
		$result_PD = mysqli_query($conn, $sql_PD);
		$row_PD = mysqli_fetch_array($result_PD);
		$title = substr($row_ANN["anp_title"],0,20)."...";
		$sql_name = "SELECT * From employee WHERE Emp_ID = '".$row_MY_PCR["fm_usr_emp_code"]."'";
		$result_name = mysqli_query($condbmc, $sql_name);
		$row_name = mysqli_fetch_array($result_name);
		if($row_MY_PCR["is_delete"] == 1){
			if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 0 ){
				$status = "Plan";
				$style = "primary";
			}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 0){
				$status = "Result";
				$style = "primary";
			}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 1 ){
				$status = "Plan";
				$style = "primary";
			}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 3){
				$status = "Complete";
				$style = "success";
			}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 2 ){
				$status = "Reject/Plan";
				$style = "danger";
			}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 2){
				$status = "Reject/Result";
				$style = "danger";
			}
		}else{
			$status = "Cancel";
			$style = "danger";
		}
		
		$Action = '<center><ul class="demo-btns center">
						
						
						<li><button pcr_number="'.$row_MY_PCR["fm_pcr_number"].'"  type="button"  class="btn btn-danger-alt" data-toggle="modal" data-target="#DeleteModal"><i class="ti ti-close"></i>';
						'</button>
					    </li>
				   </ul></center>';
				  
		
		echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td> <input type="hidden" value='.$row_MY_PCR["fm_usr_emp_code"].'>';
			echo '<td class="center">'.$row_MY_PCR["fm_level"].'</td>';
			echo '<td class="center">'.$row_name["Empname_eng"].' '.substr($row_name["Empsurname_eng"],0,1).'.</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center">'.$Action.'</td>';
			
		echo '</tr>';
		$i++;
	}
}


//////////////////////////////////////////////////////////////////////////////
function Select_Annual_list($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_annual_plan  WHERE anp_is_delete = '1'";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_MY_PCR["anp_pro_id"]."'";
		$result_PD = mysqli_query($conn, $sql_PD);
		$row_PD = mysqli_fetch_array($result_PD);
		$sql_st = "SELECT * FROM pcr_section_anp WHERE sec_id = '".$row_MY_PCR["anp_sec_id"]."'";
		$result_st = mysqli_query($conn, $sql_st);
		$row_st = mysqli_fetch_array($result_st);
		$sql_r = "SELECT * FROM pcr_rank WHERE rk_id = '".$row_MY_PCR["anp_rk_id"]."'";
		$result_r = mysqli_query($conn, $sql_r);
		$row_r = mysqli_fetch_array($result_r);
		$title = substr($row_MY_PCR["anp_title"],0,20)."...";
		
		echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td id="">'.$row_MY_PCR["anp_anp_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.$row_st["sec_name"].'</td>';
			echo '<td class="center">'.$row_r["rk_name"].'</td>';
			echo '<td class="center">'.$row_st["sec_comp_type"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["anp_create_date"])).'</td>';
			echo '<td class="center"><center>
				<ul class="demo-btns center">
					<li><a href="edit_annual.php?id='.$row_MY_PCR["anp_anp_number"].'" class="btn btn-warning-alt">Edit</a></li>
					&nbsp;
					<li><a  class="btn btn-danger-alt" data-toggle="modal" 
					data-target="#Cancel_Modal"
					id="submit">Cancel</a></li>
				</ul>
				</center></td>';
		echo '</tr>';
		$i++;

		
		
	}

	
}
// href="../ENG/cancel_annual.php?id='.$row_MY_PCR["anp_anp_number"].'"


function Select_DPM_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] <= 2){
			$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
			$result_ANN = mysqli_query($conn, $sql_ANN);
			$row_ANN = mysqli_fetch_array($result_ANN);
			$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
			$result_PD = mysqli_query($conn, $sql_PD);
			$row_PD = mysqli_fetch_array($result_PD);
			$title = substr($row_ANN["anp_title"],0,20)."...";
			if($row_MY_PCR["fm_phase"] == 1 ){
				$status = "Plan";
			}else if($row_MY_PCR["fm_phase"] == 2 ){
				$status = "Result";
			}
			echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center"><ul class="demo-btns"><li><a href="../INT/app_pcr_dm.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;<li><a href="#Approve'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>&nbsp;<li><a href="#Reject'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></ul></td>';
			echo '</tr>';
			$i++;
		}
	}
}

function Select_ACK_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] == 3){
			$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
			$result_ANN = mysqli_query($conn, $sql_ANN);
			$row_ANN = mysqli_fetch_array($result_ANN);
			$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
			$result_PD = mysqli_query($conn, $sql_PD);
			$row_PD = mysqli_fetch_array($result_PD);
			$title = substr($row_ANN["anp_title"],0,20)."...";
			if($row_MY_PCR["fm_phase"] == 1 ){
				$status = "Plan";
			}else if($row_MY_PCR["fm_phase"] == 2 ){
				$status = "Result";
			}
			echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center"><ul class="demo-btns"><li><a href="../INT/app_pcr_ack.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;<li><a href="#Approve'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>&nbsp;<li><a href="#Reject'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></ul></td>';
			echo '</tr>';
			$i++;
		}
	}
}

function Select_QAP_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_apr_id"] == 4){
			$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
			$result_ANN = mysqli_query($conn, $sql_ANN);
			$row_ANN = mysqli_fetch_array($result_ANN);
			$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
			$result_PD = mysqli_query($conn, $sql_PD);
			$row_PD = mysqli_fetch_array($result_PD);
			$title = substr($row_ANN["anp_title"],0,20)."...";
			if($row_MY_PCR["fm_phase"] == 1 ){
				$status = "Plan";
			}else if($row_MY_PCR["fm_phase"] == 2 ){
				$status = "Result";
			}
			echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center"><ul class="demo-btns"><li><a href="../INT/app_pcr_qap.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li></ul></td>';
			//&nbsp;<li><a href="#Approve'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>&nbsp;<li><a href="#Reject'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li>
			echo '</tr>';
			$i++;
		}
	}
}

function Select_BKD_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_apr_id"] == 5){
			$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
			$result_ANN = mysqli_query($conn, $sql_ANN);
			$row_ANN = mysqli_fetch_array($result_ANN);
			$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
			$result_PD = mysqli_query($conn, $sql_PD);
			$row_PD = mysqli_fetch_array($result_PD);
			$title = substr($row_ANN["anp_title"],0,20)."...";
			if($row_MY_PCR["fm_phase"] == 1 ){
				$status = "Plan";
			}else if($row_MY_PCR["fm_phase"] == 2 ){
				$status = "Result";
			}
			echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center"><ul class="demo-btns"><li><a href="../INT/app_pcr_bkd.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li></ul></td>';
			//&nbsp;<li><a href="#Approve'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>&nbsp;<li><a href="#Reject'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li>
			echo '</tr>';
			$i++;
		}
	}
}

function Select_QAC_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
	$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
		$result_flow = mysqli_query($conn, $sql_flow);
		$row_flow = mysqli_fetch_array($result_flow);
		if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] == 6){
			$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
			$result_ANN = mysqli_query($conn, $sql_ANN);
			$row_ANN = mysqli_fetch_array($result_ANN);
			$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
			$result_PD = mysqli_query($conn, $sql_PD);
			$row_PD = mysqli_fetch_array($result_PD);
			$title = substr($row_ANN["anp_title"],0,20)."...";
			if($row_MY_PCR["fm_phase"] == 1 ){
				$status = "Plan";
			}else if($row_MY_PCR["fm_phase"] == 2 ){
				$status = "Result";
			}
			echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center"><ul class="demo-btns"><li><a href="../INT/app_pcr_qac.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;<li><a href="#Approve'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-success-alt"><i class="ti ti-check"></i></a></li>&nbsp;<li><a href="#Reject'.$row_MY_PCR["fm_pcr_number"].'" data-toggle="modal" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></ul></td>';
			echo '</tr>';
			$i++;
		}
	}
}
?>