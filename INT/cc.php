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
}
$sql_emp = "SELECT * FROM employee WHERE Emp_ID = '".$_GET["Emp_ID"]."'";
$result_emp = mysqli_query($condbmc, $sql_emp);
$row_emp = mysqli_fetch_array($result_emp);
$sql_p = "SELECT * FROM sectioncode WHERE Sectioncode = '".$row_emp["Sectioncode_ID"]."'";
$result_p = mysqli_query($condbmc, $sql_p);
$row_p = mysqli_fetch_array($result_p);

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
	<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="ti ti-menu"></i>
				</span>
			</a>
		</span>
		
		<a class="navbar-brand" href="homepage.php">PCR</a>
	</div><!-- logo-area -->
	</header>
	<!-- End header -->

<div id="wrapper">
    <div id="layout-static">
		<!-- Menu -->
		<div class="static-sidebar-wrapper sidebar-default">
		<div class="static-sidebar">
			<div class="sidebar">
				<div class="widget">
					<div class="widget-body">
						<div class="userinfo">
							<div class="avatar">
								<img src="http://10.73.148.5/DBMC/IMG/emp120/<?phpecho $_GET["Emp_ID"]?>.jpg" class="img-responsive img-circle"> 
							</div>
							<div class="info">
								<span class="username"><?phpecho $row_emp["Empname_eng"]." ".substr($row_emp["Empname_eng"],0,1)."."; ?></span>
								<br>
								<span class="useremail"><?phpecho $row_p["Department"] ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="widget stay-on-collapse" id="widget-sidebar">
					<nav role="navigation" class="widget-body">
						<ul class="acc-menu">
							<li class="nav-separator"><span>Menu</span></li>
							<li><a href="#"><i class="ti ti-bookmark-alt"></i><span>PCR Detail</span></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
		<!-- End Menu -->
	<div class="static-content-wrapper">
		 <div class="static-content">
			<div class="page-content">
				<ol class="breadcrumb">
					
				</ol>
				<div class="container-fluid">          
				<div data-widget-group="group1">
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-primary" data-widget='{"draggable": "false"}'>
								<div class="panel-heading">
									<h2>View : Process Change Report System</h2>
									<div class="options">
										<ul class="nav nav-tabs">
										  <li class="active"><a href="#form" data-toggle="tab">PCR Form</a></li>
										 
										</ul>
									</div>
								</div>
								<div class="panel-body">
								
									<form class="grid-form">
										<div class="tab-content">
											<div class="tab-pane active" id="form">
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
												<fieldset>
													<?php echo Select_file_cc($conn, $pcr_number, $_GET["Emp_ID"]); ?>
												</fieldset>
												<br>
												<fieldset>
													<?php echo Select_implementation($conn, $pcr_number); ?>
												</fieldset>
												<br>
												<fieldset>
													<?php echo Select_attach_doc($conn, $pcr_number); ?>
												</fieldset>	
												<br>
												<?php 
												if($QAP == 1){
													echo '<fieldset>';
														echo Select_QAP($conn, $condbmc, $pcr_number, 1); 
													echo '</fieldset>';	
													echo '<br>';
												}
												?>
												<fieldset>
													<?php echo Select_BKD($conn, $condbmc, $pcr_number); ?>
												</fieldset>	
												<br>
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

</body>
</html>