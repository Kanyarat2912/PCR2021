<?php  

include "../Function/function-index.php";
include "../ENG/connectpcr.php";
$DM = 0;
$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
	$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
	$result_flow = mysqli_query($conn, $sql_flow);
	$row_flow = mysqli_fetch_array($result_flow);
	if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] <= 2){
		$DM++;
	}
}
	if($DM != 0){
		$NUM = '<span class="badge badge-danger">'.$DM.'</span>';
	}
	
?>
<div class="static-sidebar-wrapper sidebar-default">
    <div class="static-sidebar">
		<div class="sidebar">
			<div class="widget">
				<div class="widget-body">
					<div class="userinfo">
						<div class="avatar">
							<!-- <img src="http://10.73.148.5/DBMC/IMG/emp120/<?php echo $_SESSION["empid_pcr"]?>.jpg" class="img-responsive img-circle">  -->
							<img src="../images/login/seoa.jpg"  class="img-responsive img-circle"> 
						</div>
						<div class="info">
							<span class="username"><?php echo $_SESSION["empname_pcr"]." ".substr($_SESSION["emplast_pcr"],0,1)."."; ?></span>
							<br>
							<span class="useremail"><?php echo $_SESSION["dept_pcr"] ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="widget stay-on-collapse" id="widget-sidebar">
				<nav role="navigation" class="widget-body">
					<ul class="acc-menu">
						<li class="nav-separator"><span>General</span></li>
						<li><a href="homepage.php"><i class="ti ti-home"></i><span>Home Page</span></a></li>
						<!-- <li><a href="#"><i class="ti ti-bookmark-alt"></i><span>Manual</span></span></a></li> -->
						<li><a href="change_password_sys.php"><i class="ti ti-key"></i><span>Change Password</span></a></li>
						<li class="nav-separator"><span>Report Menu</span></li>
						<li><a href="pcr_all.php"><i class="ti ti-crown"></i><span>PCR ALL</span></a></li>
						<li class="nav-separator"><span>In-process menu</span></li>
						<li><a href="app_dept.php"><i class="ti ti-email"></i><span>My Pending</span><?php  //echo $NUM ?></a></li>
							
						<?php  
							if($_SESSION["postid_pcr"] <= 'P413' AND $_SESSION["postid_pcr"] >= 'P301'){
								$Acknowledge = 0;
								$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
								$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
								WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
									$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
									$result_flow = mysqli_query($conn, $sql_flow);
									$row_flow = mysqli_fetch_array($result_flow);
									if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] == 3){
										$Acknowledge++;
									}
								}
								if($Acknowledge != 0){
									$Acknow = '<span class="badge badge-danger">'.$Acknowledge.'</span>';
								}
								//echo '<li><a href="app_ack.php"><i class="ti ti-email"></i><span>Acknowledge Department</span>'.$Acknow.'</a></li>';
							}
								
							if($_SESSION['role_pcr'] == 3){
								$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
								$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
								WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
									$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
									$result_flow = mysqli_query($conn, $sql_flow);
									$row_flow = mysqli_fetch_array($result_flow);
									if($row_flow["ap_apr_id"] == 4){
										$QAPF++;
									}
								}
								if($QAPF != 0){
									$QAP = '<span class="badge badge-danger">'.$QAPF.'</span>';
								}
								echo '<li><a href="app_qap.php"><i class="ti ti-email"></i><span>QA Planning From</span>'.$QAP.'</a></li>';
							}else if($_SESSION['role_pcr'] == 4){
								$BKDF = 0;
								$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
								$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
								WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
									$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
									$result_flow = mysqli_query($conn, $sql_flow);
									$row_flow = mysqli_fetch_array($result_flow);
									if($row_flow["ap_apr_id"] == 5){
										$BKDF++;
									}
								}
								if($BKDF != 0){
									$BKD = '<span class="badge badge-danger">'.$BKDF.'</span>';
								}
								echo '<li><a href="app_bkd.php"><i class="ti ti-email"></i><span>QA Audit From</span>'.$BKD.'</a></li>';
							}else if($_SESSION['role_pcr'] == 5){
								$QACF = 0;
								$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
								$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
								WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
									$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
									$result_flow = mysqli_query($conn, $sql_flow);
									$row_flow = mysqli_fetch_array($result_flow);
									if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] == 6){
										$QACF++;
									}
								}
								if($QACF != 0){
									$QAC = '<span class="badge badge-danger">'.$QACF.'</span>';
								}
								echo '<li><a href="app_qac.php"><i class="ti ti-email"></i><span>QA Check</span>'.$QAC.'</a></li>';
							}else if($_SESSION['role_pcr'] == 6){
								$Acknowledge = 0;
								$sql_MY_PCR_temp = "SELECT * FROM pcr_form WHERE checkk = 0";
								$result_MY_PCR_temp = mysqli_query($conn, $sql_MY_PCR_temp);
								WHILE($row_MY_PCR_temp = mysqli_fetch_array($result_MY_PCR_temp)){
									$sql_flow_temp = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR_temp["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR_temp["fm_state_app"]."'";
									$result_flow_temp = mysqli_query($conn, $sql_flow_temp);
									$row_flow_temp = mysqli_fetch_array($result_flow_temp);
									if($row_flow_temp["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow_temp["ap_apr_id"] == 3){
										$Acknowledge++;
									}
								}
								if($Acknowledge != 0){
									$Acknow = '<span class="badge badge-danger">'.$Acknowledge.'</span>';
								}
								
								$QAPF = 0;
								$sql_MY_PCR = "SELECT * FROM pcr_form WHERE checkk = 0";
								$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
								WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
									$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
									$result_flow = mysqli_query($conn, $sql_flow);
									$row_flow = mysqli_fetch_array($result_flow);
									if($row_flow["ap_apr_id"] == 4){
										$QAPF++;
									}
								}
								if($QAPF != 0){
									$QAP = '<span class="badge badge-danger">'.$QAPF.'</span>';
								}
								// echo '<li><a href="app_ack.php"><i class="ti ti-email"></i><span>Acknowledge Department</span>'.$Acknow.'</a></li>';
								// echo '<li><a href="app_qap.php"><i class="ti ti-email"></i><span>QA Planning From</span>'.$QAP.'</a></li>';
								echo '<li class="nav-separator"><span>Setting Menu</span></li>';
								echo '<li><a href="annual.php"><i class="ti ti-write"></i><span>Manage Annual Plan</span></a></li>';
								echo '<li><a href="javascript:;"><i class="ti ti-settings"></i><span>Setting Flow Approve</span></a>';
										echo '<ul class="acc-menu">';
											echo '<li><a href="flow_qap.php">Flow Approve QAP</a></li>';
											echo '<li><a href="flow_bkd.php">Flow Approve QA Audit</a></li>';
											echo '<li><a href="flow_qac.php">Flow Approve QAC</a></li>';
											
										echo '</ul>';
								echo '</li>';
								
							}else if($_SESSION['role_pcr'] == 7){
								$PE_APP = 0;
								$sql_PE_APP = "SELECT * FROM pcr_user WHERE usr_sr_id = 3";
								$result_PE_APP = mysqli_query($conn, $sql_PE_APP);
								WHILE($row_PE_APP = mysqli_fetch_array($result_PE_APP)){
									$PE_APP++;
								}
								if($PE_APP != 0){
									$NUM = '<span class="badge badge-danger">'.$PE_APP.'</span>';
								}
								// $sql_Request = "SELECT * FROM pcr_form WHERE fm_request_approve = 'wait' ";
								// $result_Request = mysqli_query($conn,$sql_Request);
								// WHILE($row_Request = mysqli_fetch_array($result_Request)){
								// 	$Request++;
								// }
								// if($Request != 0){
								// 	$num = '<span class="badge badge-danger">'.$Request.'</span>';
								// }
								
								echo '<li><a href="PE_APP_USER.php"><i class="ti ti-email"></i><span>Requested Permission</span>'.$NUM.'</a></li>';
								echo '<li><a href="javascript:;"><i class="ti ti-email"></i><span>Access managements</span>'.$NUM.'</a>';
											echo '<ul class="acc-menu">';
												echo '<li><a href="request_approve.php">Approve Permission Access</a></li>';
												echo '<li><a href="add_permission.php">Add Permission Access</a></li>';
											echo '</ul>';
								echo '</li>';
							}else if($_SESSION['role_pcr'] == 8){
								
							}
						
						$sql_CC = "SELECT * FROM pcr_concern WHERE Emp_ID = '".$_SESSION["empid_pcr"]."'";
						$result_CC = mysqli_query($conn, $sql_CC);
						if($row_CC = mysqli_fetch_array($result_CC)){
							echo '<li class="nav-separator"><span>Concerned Menu</span></li>';
							echo '<li><a href="concerned.php"><i class="ti ti-folder"></i><span>PCR Concerned</span></a></li>';
						}
						
							
						?>
					</ul>
				</nav>
			</div>
		</div>
   </div>
</div>

<!--li><a href="javascript:;"><i class="ti ti-view-list-alt"></i><span>UI Kit</span></a>
	<ul class="acc-menu">
		<li><a href="ui-typography.html">Typography</a></li>
		<li><a href="ui-buttons.html">Buttons</a></li>
		<li><a href="ui-modals.html">Modal</a></li>
		<li><a href="ui-progress.html">Progress</a></li>
		<li><a href="ui-paginations.html">Paginations</a></li>
		<li><a href="ui-breadcrumbs.html">Breadcrumbs</a></li>
		<li><a href="ui-labelsbadges.html">Labels &amp; Badges</a></li>
		<li><a href="ui-alerts.html">Alerts</a></li>
		<li><a href="ui-tabs.html">Tabs</a></li>
		<li><a href="ui-wells.html">Wells</a></li>
		<li><a href="ui-icons-fontawesome.html">FontAwesome Icons</a></li>
		<li><a href="ui-icons-themify.html">Themify Icons</a></li>
		<li><a href="ui-helpers.html">Helpers</a></li>
		<li><a href="ui-imagecarousel.html">Images &amp; Carousel</a></li>
	</ul>
</li-->