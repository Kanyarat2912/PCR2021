<?php
include "../Function/function-datatables.php";
if($_SESSION["empid_pcr"] == ""){
	echo '<meta http-equiv=refresh content=0;URL=../index.php>';
}else{	
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
    <link type="text/css" href="../assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
	<link type="text/css" href="../assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
	<link type="text/css" href="../assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
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
						<li class="active"><a href="app_bkd.php">QA Audit</a></li>
					</ol>
				
				<div class="container-fluid">
				<div data-widget-group="group1">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2>QA Audit</h2>
									<div class="panel-ctrls"></div>
								</div>
								<div class="panel-body no-padding">
									<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th><center>No.</center></th>
												<th>PCR Number.</th>
												<th>Title</th>
												<th>Product Name</th>
												<th>Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php echo Select_BKD_PCR($conn); ?>
										</tbody>
									</table>
									
								</div>
								<!-- panel footer -->
									<?php
										include "panel-footer2.php";
									?>
								<!-- END panel footer -->
							</div>
						</div>
					</div>
				</div>
                </div> <!-- .container-fluid -->
                </div> <!-- #page-content -->
				<?php
				$sql_MY_PCR = "SELECT * FROM pcr_form";
				$result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
				WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
					$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_MY_PCR["fm_pcr_number"]."' AND ap_step = '".$row_MY_PCR["fm_state_app"]."'";
					$result_flow = mysqli_query($conn, $sql_flow);
					$row_flow = mysqli_fetch_array($result_flow);
					if($row_flow["ap_emp_code"] == $_SESSION["empid_pcr"] AND $row_flow["ap_apr_id"] <= 2){
						echo '<form action="../ENG/Approver_department.php?step='.$row_MY_PCR["fm_state_app"].'&PCR='.$row_MY_PCR["fm_pcr_number"].'" method="post">';
						echo '<div class="modal fade" id="Approve'.$row_MY_PCR["fm_pcr_number"].'" tabindex="-1" role="dialog" aria-hidden="true">';
							echo '<div class="modal-dialog">';
								echo '<div class="modal-content" >';
									echo '<div class="modal-header" style="background-color:#83b747;">';
										echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
										echo '<h3 class="modal-title" id="myModalLabel"><b style="color:#ffffff;">APPROVAL</b></h3>';
									echo '</div>';
									echo '<div class="modal-body" >';
										echo '<div class="row">';
											echo '<div class="col-sm-12 col-xs-12 col-md-812col-lg-12">';
												echo '<p>Confirm Approve ?</p>';
												echo '<p>Please specify the approval </p>';
												echo '<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';
														echo '<textarea name="Comment_myapprover" style="resize: none;" id="txtarea1" cols="50" rows="3" class="form-control"></textarea>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="modal-footer" >';
										echo '<div class="col-sm-12 col-xs-12 col-md-812col-lg-12" align="right">';
											echo '<button type="submit" name="submit" value="1" class="btn btn-success-alt"><i class="ti ti-check"></i></button>';
											echo '<a href="#" class="btn btn-danger-alt" data-dismiss="modal" aria-label="Close"><i class="ti ti-close"></i></a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="modal fade" id="Reject'.$row_MY_PCR["fm_pcr_number"].'" tabindex="-1" role="dialog" aria-hidden="true">';
							echo '<div class="modal-dialog">';
								echo '<div class="modal-content">';
									echo '<div class="modal-header" style="background-color:#d6181d;">';
										echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
										echo '<h4 class="modal-title" id="myModalLabel"><b style="color:#ffffff;">REJECT</b></h4>';
									echo '</div>';
									echo '<div class="modal-body">';
										echo '<div class="row">';
											echo '<div class="col-sm-12 col-xs-12 col-md-812col-lg-12">';
												echo '<p>Confirm Reject ?</p>';
												echo '<p>Please specify the approval </p>';
												echo '<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';
													echo '<textarea name="Comment_No_myapprover" style="resize: none;" id="txtarea1" cols="50" rows="4" class="form-control"></textarea>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="modal-footer" >';
										echo '<div class="col-sm-12 col-xs-12 col-md-812col-lg-12" align="right">';
											echo '<button type="submit" name="submit" value="0" class="btn btn-success-alt"><i class="ti ti-check"></i></button>';
											echo '<a href="#" class="btn btn-danger-alt" data-dismiss="modal" aria-label="Close"><i class="ti ti-close"></i></a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '</form>';
					}
				}
				?>
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

<script type="text/javascript" src="../assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="../assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="../assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="../assets/js/application.js"></script>
<script type="text/javascript" src="../assets/demo/demo.js"></script>
<script type="text/javascript" src="../assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    
<script type="text/javascript" src="../assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="../assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="../assets/demo/demo-datatables.js"></script>

    <!-- End loading page level scripts-->

</body>
</html>
<?php
}
?>