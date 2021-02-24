<?php
$pcr_number = $_GET["id"];
date_default_timezone_set('asia/bangkok');
include "../ENG/connectpcr.php";
include "../Function/function_form.php";
$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
$result_pcr = mysqli_query($conn, $sql_pcr);
$row_pcr = mysqli_fetch_array($result_pcr);
$sql_pcr_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$pcr_number."' AND ap_apr_id = 4 AND ap_ph_id = 1";
$result_pcr_flow = mysqli_query($conn, $sql_pcr_flow);
if($row_pcr_flow = mysqli_fetch_array($result_pcr_flow)){
	$QAP = 1;
}else{
	$QAP = 0;
};
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

	<!-- Load validator -->
	<link href="../assets/validator/validator.css" rel="stylesheet" />
	<script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script> 	
	<script src="../assets/validator/jquery.form.validator.min.js"></script>
	<script src="../assets/validator/security.js"></script>
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
							<li class="active"><a href="#">Access time</a></li>
						</ol>
                        <div class="container-fluid">
						<!--div class="alert alert-info">
							<h3>Grid Forms</h3>
							<p>Grid forms are dense forms designed for use in applications that require lots of data to be entered regularly. A tiny Javascript/CSS framework that helps you make forms on grids with ease.</p>
						</div-->
						<div data-widget-group="group1">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary " data-widget='{"id" : "wiget9", "draggable": "false"}'>
										<div class="panel-heading ">
											<h2>Access Time : PCR </h2>
											<!-- <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div> -->
											<div class="panel-ctrls button-icon-bg" 
												data-actions-container="" 
												data-action-collapse='{"target": ".panel-body"}'
												data-action-colorpicker='' >
											</div>
										</div>
										<div class="panel-body">
										<form class="grid-form" action="../ENG/Approve_access.php?pcr_number=<?php echo $pcr_num?>&number=<?php echo $data["seq"]?>" method="post" enctype="multipart/form-data" >
												
												<br>
												<fieldset>
												<?php echo Select_access_time($conn, $condbmc, $pcr_number) ?>
													
												</fieldset><br>
                                                <fieldset>
                                                <legend>Access Time</legend>
                                                <br>
                                                <div class="form-group">
                                                    <label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">Start-time</label>
                                                    <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                        <div class="input-group date in-bd" >
                                                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                                                            <input type="date" class="form-control" name="pcr_plan[]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label class="col-sm-4 col-xs-4 col-md-4 col-lg-4 control-label">End-time</label>
                                                    <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                        <div class="input-group date in-bd" >
                                                            <span class="input-group-addon"><i class="ti ti-calendar"></i></span>
                                                            <input type="date" class="form-control" name="pcr_plan[]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                </fieldset>
												<br><br><br>
												<div class="clearfix pt-md">
													<div class="pull-right">
														<button type="submit" class="btn-primary btn">Submit</button>
														<button  class="btn-default btn" onclick="window.location.href='../INT/request_approve.php'">Cancel</button>
														
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
	<!-- Load jQuery -->
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

<script type="text/javascript">
		$.validate({
			 modules: 'security, file',
			 onModulesLoaded: function () {
				$('input[name="password"]').displayPasswordStrength();
			 }
		 });
</script>


</body>
</html>
