<?php
include "../ENG/auto_pcr_no.php";
include "../Function/function_form.php";
if($_SESSION["empid_pcr"] == ""){
	echo '<meta http-equiv=refresh content=0;URL=../index.php>';
}else{
	$i = 0;
	$pcr_number = $_GET["id"];
	$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
	$result_pcr = mysqli_query($conn, $sql_pcr);
	$row_pcr = mysqli_fetch_array($result_pcr);
	$sql_implementation = "SELECT mf_date_plan FROM pcr_implement_form WHERE mf_fm_id = '".$pcr_number."' ORDER BY mf_im_id ASC";
	$query_implementation = mysqli_query($conn, $sql_implementation);
	WHILE($row_implementation = mysqli_fetch_array($query_implementation)){
		$implementation[$i] = $row_implementation["mf_date_plan"];
		$i++;
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Process Change Report System.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="KaijuThemes">
	<link rel="shortcut icon" href="../images/Logo.png" />
    <link type='text/css' href="../assets/fonts/font.css" rel='stylesheet'>
    <link type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="../assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="../assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->
	<link type="text/css" href="../assets/plugins/iCheck/skins/square/_all.css" rel="stylesheet">
    <link type="text/css" href="../assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
	<link type="text/css" href="../assets/plugins/gridforms/gridforms/gridforms.css" rel="stylesheet"> 			<!-- Gridforms -->
	
	<link type="text/css" href="../assets/plugins/form-daterangepicker/daterangepicker-bs3.css" rel="stylesheet">    <!-- DateRangePicker -->
	<link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->
	<link type="text/css" href="../assets/plugins/clockface/css/clockface.css" rel="stylesheet">                   	<!-- Clockface -->
</head>

<body class="animated-content">
	<!-- header -->
	<?php
		include "header.php";
	?>
	<!-- End header -->
    <div id="wrapper">
        <div id="layout-static">
	<!-- Menu -->
	<?php
		include "menu.php";
	?>
	<!-- End Menu -->
            <div class="static-content-wrapper">
                <div class="static-content">
                    <div class="page-content">
                        <ol class="breadcrumb">
							<li><a href="homepage.php">Home</a></li>
							<li class="active"><a href="form-gridforms.html">Create</a></li>
						</ol>
                        <div class="container-fluid">
						<!--div class="alert alert-info">
							<h3>Grid Forms</h3>
							<p>Grid forms are dense forms designed for use in applications that require lots of data to be entered regularly. A tiny Javascript/CSS framework that helps you make forms on grids with ease.</p>
						</div-->
						<div data-widget-group="group1">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
										<div class="panel-heading ">
											<h2>Result Form : Process Change Report System</h2>
											<!-- <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div> -->
										</div>
										<div class="panel-body">
											<form class="grid-form" action="../ENG/Insert_pcr_result.php?pcr_number=<?phpecho $pcr_number?>" method="post" enctype="multipart/form-data" >
												<fieldset>
													<?php echo Select_General($conn, $condbmc, $pcr_number); ?>
												</fieldset>
												<br>
												<fieldset>
													<?php echo Select_Type($conn, $pcr_number); ?>
												</fieldset>		
												<br>
												<fieldset>
													<?php echo Select_Risk($conn, $pcr_number); ?>
												</fieldset>
												<br>
												<fieldset>
													<?php echo Select_Anuual($conn, $pcr_number); ?>
												</fieldset>
												<br>
												<br>
												<fieldset>
													<?php echo Select_Priority($conn, $pcr_number); ?>			
												</fieldset>
												<br>
												<fieldset >
													<legend>Details of Process Change (File upload Result <font color="#CC0000">*Maximum file upload size 10 MB</font>)</legend>
													<br>
													<div class="col-sm-10 col-xs-10 col-md-10 col-lg-10 control-label" >
														<div class="">
															<label><input type="file" id="file" name="file" onchange="Filevalidation()" required />
															</label>
														</div>
													</div>
												</fieldset>
												<br>
												<br>
												<fieldset>
													<legend>Implementation Result</legend>
													<br>
													
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center></center>
														</label>
															<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><b><u>[Plan]</u></b></center>
														</label>
														<label class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<center><b><u>[Actual]</u></b></center>
														</label>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">1. PCR plan submission</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[0]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">2. Planning review</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[1]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">3. Process preparation</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[2]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">4. Product / Process evaluation</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[3]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">5. Revise document standard</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[4]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd">
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control" name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">6. 6 step / Quality report</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[5]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">7. PCR result submission</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[6]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">8. Production Start Date</label>
														<label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 ">
															<center><?phpecho date("d-M-yy", strtotime($implementation[7]))?></center>
														</label>
														<div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
															<div class="input-group  in-bd" >
																<span class="input-group-addon"><i class="ti ti-calendar"></i></span>
																<input type="date" class="form-control " name="pcr_plan[]" required>
															</div>
														</div>
													</div>
												</fieldset>
												<br>
												<br>
												<fieldset>
													<legend>Data attachments</legend>
													<br>
													<?php
													$i = 1;
													$sql_attach_doc = "SELECT * FROM pcr_attach_doc WHERE att_id = '".$pcr_number."'";
													$query_attach_doc = mysqli_query($conn, $sql_attach_doc);
													$row_attach_doc = mysqli_fetch_array($query_attach_doc);
													if($row_attach_doc["att_pfmea"] != ""){
														echo '<div class="form-group">';
															echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">'.$i.'. PFMEA :</label>';
															echo '<label class="col-sm-3 col-xs-3 col-md-3 col-lg-3 ">';
																echo '<input class="form-control" name="PFMEA" placeholder="Document Number" required />';
															echo '</label>';
														echo '</div>';
														echo '<br>';
														$i++;
													}
													
													if($row_attach_doc["att_qa_network"] != ""){
														echo '<div class="form-group">';
															echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">'.$i.'. QA Network :</label>';
															echo '<label class="col-sm-3 col-xs-3 col-md-3 col-lg-3 ">';
																echo '<input class="form-control" name="qa" placeholder="Document Number" required />';
															echo '</label>';
														echo '</div>';
														echo '<br>';
														$i++;
													}
													
													if($row_attach_doc["att_control_plan"] != ""){
														echo '<div class="form-group">';
															echo '<label class="col-sm-2 col-xs-2 col-md-2 col-lg-2 control-label">'.$i.'. Control plan ,PCC :</label>';
															echo '<label class="col-sm-3 col-xs-3 col-md-3 col-lg-3 ">';
																echo '<input class="form-control" name="Control" placeholder="Document Number" required />';
															echo '</label>';
														echo '</div>';
														echo '<br>';
														$i++;
													}
													
													if($row_attach_doc["att_wi"] != ""){
														echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
															echo '<label>'.$i.'. Standardize work , WI</label>';
														echo '</div>';
														echo '<br>';
														echo '<br>';
														echo '<br>';
														$i++;
													}
													
													if($row_attach_doc["att_machine_spec"] != ""){
														echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
															echo '<label>'.$i.'. Machine specification</label>';
														echo '</div>';
														echo '<br>';
														echo '<br>';
														echo '<br>';
														$i++;
													}
													
													if($row_attach_doc["att_daily_check"] != ""){
														echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
															echo '<label>'.$i.'. Daily check sheet</label>';
														echo '</div>';
														echo '<br>';
														echo '<br>';
														echo '<br>';
														$i++;
													}
													
													if($row_attach_doc["att_other"] != ""){
														echo '<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 icheck-square">';
															echo '<label>'.$i.'. Other</label>';
														echo '</div>';
														echo '<br>';
														echo '<br>';
														$i++;
													}
													?>
												</fieldset>	
												<br>
												<fieldset>
													<legend>Approve of Department</legend>
													<br>
													<?php
													$sql_app1 = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = 1 AND ap_apr_id = 1";
													$result_app1 = mysqli_query($conn, $sql_app1);
													$row_app1 = mysqli_fetch_array($result_app1);
													$sql_app2 = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = 2 AND ap_apr_id = 1";
													$result_app2 = mysqli_query($conn, $sql_app2);
													$row_app2 = mysqli_fetch_array($result_app2);
													$sql_app3 = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = 3 AND ap_apr_id = 1";
													$result_app3 = mysqli_query($conn, $sql_app3);
													$row_app3 = mysqli_fetch_array($result_app3);
													$sql_app4 = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = 4 AND ap_apr_id = 1";
													$result_app4 = mysqli_query($conn, $sql_app4);
													$row_app4 = mysqli_fetch_array($result_app4);
													$sql_app5 = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_step = 5 AND ap_apr_id = 1";
													$result_app5 = mysqli_query($conn, $sql_app5);
													$row_app5 = mysqli_fetch_array($result_app5);
													$sql_app_f = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_apr_id = 2 AND ap_ph_id = 1";
													$result_app_f = mysqli_query($conn, $sql_app_f);
													$row_app_f = mysqli_fetch_array($result_app_f);
													$sql_app_a = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_apr_id = 3 AND ap_ph_id = 1";
													$result_app_a = mysqli_query($conn, $sql_app_a);
													$row_app_a = mysqli_fetch_array($result_app_a);
													?>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>(Checker 1) Employee ID.</label>
															<input type="text" id="appdepart_name0" value="<?phpecho $row_app1["ap_emp_code"]?>" name="appdepart_name0" list="list_app0">
															<datalist id="list_app0">
																<?phpphp
																	echo appdepart($condbmc);			
																?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input type="text" id="appdepart_Position0" value="<?phpecho Emp_Data($condbmc,$row_app1["ap_emp_code"], 1)?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input type="text" id="appdepart_department0" <?phpif($row_app1["ap_emp_code"] != ""){?> value="<?phpecho Emp_Data($condbmc,$row_app1["ap_emp_code"], 2)?>"<?php}?> disabled>
														</div>
													</div>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>(Checker 2) Employee ID.</label>
															<input type="text" id="appdepart_name1" value="<?phpecho $row_app2["ap_emp_code"]?>" name="appdepart_name1" list="list_app1">
															<datalist id="list_app1">
																<?phpphp
																	echo appdepart($condbmc);			
																?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input type="text" id="appdepart_Position1" value="<?phpecho Emp_Data($condbmc,$row_app2["ap_emp_code"], 1)?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input type="text" id="appdepart_department1" <?phpif($row_app2["ap_emp_code"] != ""){?> value="<?phpecho Emp_Data($condbmc,$row_app2["ap_emp_code"], 2)?>"<?php}?> disabled>
														</div>
													</div>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>(Checker 3) Employee ID.</label> 
															<input type="text" id="appdepart_name2" value="<?phpecho $row_app3["ap_emp_code"]?>" name="appdepart_name2" list="list_app2" >
															<datalist id="list_app2">
																<?phpphp
																	echo appdepart($condbmc);			
																?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input type="text" id="appdepart_Position2" value="<?phpecho Emp_Data($condbmc,$row_app3["ap_emp_code"], 1)?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input type="text" id="appdepart_department2" <?phpif($row_app3["ap_emp_code"] != ""){?> value="<?phpecho Emp_Data($condbmc,$row_app3["ap_emp_code"], 2)?>"<?php}?> disabled>
														</div>
													</div>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>(Checker 4) Employee ID.</label>
															<input type="text" id="appdepart_name3" value="<?phpecho $row_app4["ap_emp_code"]?>" name="appdepart_name3" list="list_app3" >
															<datalist id="list_app3">
																<?phpphp
																	echo appdepart($condbmc);			
																?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input type="text" id="appdepart_Position3" value="<?phpecho Emp_Data($condbmc,$row_app4["ap_emp_code"], 1)?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input type="text" id="appdepart_department3" <?phpif($row_app4["ap_emp_code"] != ""){?> value="<?phpecho Emp_Data($condbmc,$row_app4["ap_emp_code"], 2)?>"<?php}?> disabled>
														</div>
													</div>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>(Checker 5) Employee ID.</label>
															<input type="text" id="appdepart_name4" value="<?phpecho $row_app5["ap_emp_code"]?>" name="appdepart_name4" list="list_app4" >
															<datalist id="list_app4">
																<?phpphp
																	echo appdepart($condbmc);			
																?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input type="text" id="appdepart_Position4" value="<?phpecho Emp_Data($condbmc,$row_app5["ap_emp_code"], 1)?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input type="text" id="appdepart_department4" <?phpif($row_app5["ap_emp_code"] != ""){?> value="<?phpecho Emp_Data($condbmc,$row_app5["ap_emp_code"], 2)?>"<?php}?> disabled>
														</div>
													</div>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>(Final Approve) Employee ID.</label>
															<input list="list_Final" value="<?phpecho $row_app_f["ap_emp_code"]?>" id="appdepart_Final" type="text" name="appdepart_final"   required />
															<datalist id="list_Final">
																<?phpphp
																	echo appdepart_Final($condbmc);			
																?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input type="text" id="appdepart_Pos_F" value="<?phpecho Emp_Data($condbmc,$row_app_f["ap_emp_code"], 1)?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input type="text" id="appdepart_department_F" value="<?phpecho Emp_Data($condbmc,$row_app_f["ap_emp_code"], 2)?>" disabled>
														</div>
													</div>
												</fieldset>
												<br>
												<fieldset>
													<legend>Approve Acknowledge Department</legend>
													<br>
													<div data-row-span="3">
														<div data-field-span="1">
															<label>Employee ID.</label>
															<input id="ackdepart_name" value="<?phpecho $row_app_a["ap_emp_code"]?>" list="list_ackdepart" type="text" name="ackdepart_name"   required />
															<datalist id="list_ackdepart">
																<?phpecho appdepart_acknowledge($condbmc);?>
															</datalist>
														</div>
														<div data-field-span="1">
															<label>Name - surname</label>
															<input id="ackdepart_Position_first" type="text" value="<?phpecho Emp_Data($condbmc,$row_app_a["ap_emp_code"], 1)?>" name="ackdepart_Position_first" disabled>
														</div>
														<div data-field-span="1">
															<label>Position / Department</label>
															<input id="ackdepart_department" type="text" value="<?phpecho Emp_Data($condbmc,$row_app_a["ap_emp_code"], 2)?>" name="ackdepart_department" disabled>
														</div>
													</div>
												</fieldset>
												<br>
												<div class="clearfix pt-md">
													<div class="pull-right">
														<button type="submit" class="btn-primary btn">Submit Form</button>
														<button class="btn-default btn">Cancel</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
        <!-- footer -->
		<?php
			include "footer.php";
		?>
		<!-- END footer -->

                </div>
            </div>
        </div>

    
    <!-- Switcher -->
	<?php
		include "Switcher.php";
	?>
	<!-- /Switcher -->
    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="../assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="../assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="../assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="../assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="../assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->
<script type="text/javascript" src="../assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="../assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="../assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="../assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="../assets/js/application.js"></script>
<script type="text/javascript" src="../assets/demo/demo.js"></script>
<script type="text/javascript" src="../assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
  
<!-- Load page level scripts-->
    
<script type="text/javascript" src="../assets/plugins/form-daterangepicker/moment.min.js"></script>              			<!-- Moment.js for Date Range Picker -->

<script type="text/javascript" src="../assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js"></script> 			<!-- Color Picker -->

<script type="text/javascript" src="../assets/plugins/form-daterangepicker/daterangepicker.js"></script>     				<!-- Date Range Picker -->
<script type="text/javascript" src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>      			<!-- Datepicker -->
<script type="text/javascript" src="../assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>      			<!-- Timepicker -->
<script type="text/javascript" src="../assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> <!-- DateTime Picker -->

<script type="text/javascript" src="../assets/plugins/clockface/js/clockface.js"></script>     								<!-- Clockface -->


<script type="text/javascript" src="../assets/demo/demo-pickers.js"></script>
<!-- End loading page level scripts--> 
 
<!-- Load page level scripts-->    
<script type="text/javascript" src="../assets/plugins/gridforms/gridforms/gridforms.js"></script>  								<!-- Gridforms -->
<!-- End loading page level scripts-->

<script>
$(document).ready(function(){

	$('#appdepart_name0').on('change',function(){ //ยังไม่เสร็จ
		var AP_ID0 = $(this).val();
		console.log(AP_ID0);
			$.ajax({
                type: 'POST',
                data: {AP_ID: AP_ID0},
                url: '../ENG/Ajax_Department_Approve.php',
				dataType: "JSON",
                success: function(data2) {
					console.log(data2);
					document.getElementById('appdepart_Position0').value = data2.position_ap;
					document.getElementById('appdepart_department0').value = data2.section_ap;
					
                }
            });
                    return false;
		
	});
});

</script>

<script>
$(document).ready(function(){
	


	$('#appdepart_name1').on('change',function(){ //ยังไม่เสร็จ
		var AP_ID1 = $(this).val();
		console.log(AP_ID1);
			$.ajax({
                type: 'POST',
                data: {AP_ID: AP_ID1},
                url: '../ENG/Ajax_Department_Approve.php',
				dataType: "JSON",
                success: function(data2) {
					console.log(data2);
					document.getElementById('appdepart_Position1').value = data2.position_ap;
					document.getElementById('appdepart_department1').value = data2.section_ap;
					
                }
            });
                    return false;
		
	});
});

</script>
<script>
$(document).ready(function(){
	


	$('#appdepart_name2').on('change',function(){ //ยังไม่เสร็จ
		var AP_ID2 = $(this).val();
		console.log(AP_ID2);
			$.ajax({
                type: 'POST',
                data: {AP_ID: AP_ID2},
                url: '../ENG/Ajax_Department_Approve.php',
				dataType: "JSON",
                success: function(data2) {
					console.log(data2);
					document.getElementById('appdepart_Position2').value = data2.position_ap;
					document.getElementById('appdepart_department2').value = data2.section_ap;
					
					
                }
            });
                    return false;
		
	});
});

</script>
<script>
$(document).ready(function(){
	


	$('#appdepart_name3').on('change',function(){ //ยังไม่เสร็จ
		var AP_ID3 = $(this).val();
		console.log(AP_ID3);
			$.ajax({
                type: 'POST',
                data: {AP_ID: AP_ID3},
                url: '../ENG/Ajax_Department_Approve.php',
				dataType: "JSON",
                success: function(data2) {
					console.log(data2);
					document.getElementById('appdepart_Position3').value = data2.position_ap;
					document.getElementById('appdepart_department3').value = data2.section_ap;
					
                }
            });
                    return false;
		
	});
});

</script>
<script>
$(document).ready(function(){
	


	$('#appdepart_name4').on('change',function(){ //ยังไม่เสร็จ
		var AP_ID4 = $(this).val();
		console.log(AP_ID4);
			$.ajax({
                type: 'POST',
                data: {AP_ID: AP_ID4},
                url: '../ENG/Ajax_Department_Approve.php',
				dataType: "JSON",
                success: function(data2) {
					console.log(data2);
					document.getElementById('appdepart_Position4').value = data2.position_ap;
					document.getElementById('appdepart_department4').value = data2.section_ap;
                }
            });
                    return false;
		
	});
});

</script>
<script>
$(document).ready(function(){

	$('#appdepart_Final').on('change',function(){ 
		var Final_ID = $(this).val();
		console.log(Final_ID);
			$.ajax({
                type: 'POST',
                data: {Final_ID: Final_ID},
                url: '../ENG/Ajax_Final_Approve.php',
				dataType: "JSON",
                success: function(data1) {
					console.log(data1);
					document.getElementById('appdepart_Pos_F').value = data1.position;
					document.getElementById('appdepart_department_F').value = data1.section;
                }
            });
                    return false;
		
	});


});
</script>
<script>
$(document).ready(function(){
	$('#ackdepart_name').on('input change',function(){ //ยังไม่เสร็จ
		var Acknowledge_ID = $(this).val();
		console.log(Acknowledge_ID);
			$.ajax({
                type: 'POST',
                data: {Acknow_ID: Acknowledge_ID},
                url: '../ENG/Ajax_Acknowledge_Approve.php',
				dataType: "JSON",
                success: function(data3) {
					console.log(data3);
					document.getElementById("ackdepart_Position_first").value = data3.position_ac;
					document.getElementById("ackdepart_department").value = data3.section_ac;
                }
            });
                    return false;
		
	});
});

</script>	

<script> 
    Filevalidation = () => { 
        const fi = document.getElementById('file'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 10240) { 
                    alert("File too large for upload, Maximum file size 10mb"); 
					  document.getElementById('file').value = null;
                }
            } 
        } 
    } 
	
	 

</script> 


</body>
</html>
<?php
}
?>