<?php
include "../Function/function-datatables.php";
if ($_SESSION["empid_pcr"] == "") {
	echo '<meta http-equiv=refresh content=0;URL=../index.php>';
} else {
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
		<link type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Font Awesome -->
		<link type="text/css" href="../assets/fonts/themify-icons/themify-icons.css" rel="stylesheet"> <!-- Themify Icons -->
		<link type="text/css" href="../assets/css/styles.css" rel="stylesheet"> <!-- Core CSS with all styles -->

		<link type="text/css" href="../assets/plugins/codeprettifier/prettify.css" rel="stylesheet"> <!-- Code Prettifier -->
		<link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet"> <!-- iCheck -->

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
								<li class="active"><a href="#">PCR All</a></li>
							</ol>

							<div class="container-fluid">
								<div data-widget-group="group1">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h2>PCR ALL</h2>
													<div class="panel-ctrls"></div>
												</div>
												<div class="panel-body no-padding">
													<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
														<thead>
															<tr>
																<th>
																	<center>No.</center>
																</th>
																<th>PCR Number.</th>
																<th>Title</th>
																<th>Product Name</th>
																<th>Date</th>
																<th>P.I.C</th>
																<th>Status</th>
																<th>PCR level</th>
																<th>
																	<center>Action</center>
																</th>

															</tr>
														</thead>
														<tbody>
															<?php echo Select_ALL_PCR($conn, $condbmc); ?>
														</tbody>
													</table>
												</div>
												<!-- panel footer -->
												<?php
												include "panel-footer.php";
												?>
												<!-- END panel footer -->
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

		<!-- Start Modal confirm request PCR -->
		<div id="formModal" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- dialog -->
			<div class="modal-dialog">

				<!-- content -->
				<div class="modal-content">

					<!-- header -->
					<div class="modal-header">
						<h1 id="myModalLabel" class="modal-title">
							Message
						</h1>
					</div>
					<!-- header -->

					<!-- body -->
					<form class="grid-form" action="../INT/request_approve.php" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-transparent" data-widget="{" draggable": "false" }">
										<div class="panel-body">
											<div id="carousel-example-captions" class="carousel slide">
											</div>
											<h1 class="modal-title">
												<center>Would you like to request PCR?</center>
											</h1>
											<input type="hidden" value="" id="modal_body" name="pcr_number">
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- body -->

						<!-- footer -->
						<div class="modal-footer">
							<button class="btn btn-primary" id="pcr_number_submit"> SUBMIT </button>
							<button class="btn btn-secondary" data-dismiss="modal"> CANCEL </button>
						</div>
					</form>
					<!-- footer -->
					
					<form action="../INT/Request_controller.php" method="post" class="request" ></form>
						

				</div>
				<!-- content -->

			</div>
			<!-- dialog -->

		</div>
		<!-- modal -->
		<!-- End Modal confirm -->

		

		<!-- Switcher -->
		<?php
		include "Switcher.php";
		?>
		<!-- /Switcher -->
		<!-- Load site level scripts -->

		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

		<script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script> <!-- Load jQuery -->
		<script type="text/javascript" src="../assets/js/jqueryui-1.10.3.min.js"></script> <!-- Load jQueryUI -->
		<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script> <!-- Load Bootstrap -->
		<script type="text/javascript" src="../assets/js/enquire.min.js"></script> <!-- Load Enquire -->

		<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.min.js"></script> <!-- Load Velocity for Animated Content -->
		<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.ui.min.js"></script>

		<script type="text/javascript" src="../assets/plugins/wijets/wijets.js"></script> <!-- Wijet -->

		<script type="text/javascript" src="../assets/plugins/codeprettifier/prettify.js"></script> <!-- Code Prettifier  -->
		<script type="text/javascript" src="../assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> <!-- Swith/Toggle Button -->

		<script type="text/javascript" src="../assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script> <!-- Bootstrap Tabdrop -->

		<script type="text/javascript" src="../assets/plugins/iCheck/icheck.min.js"></script> <!-- iCheck -->

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

	<script type="text/javascript">
		$(function() {
			var pcr_number
			$('.request').click(function(e) {
				pcr_number = $(e.currentTarget).attr('pcr_number');
				console.log(pcr_number);
			});

			function addHidden(theForm, key, value) {
				// Create a hidden input element, and append it to the form:
				var input = document.createElement('input');
				input.type = 'hidden';
				input.name = key; // 'the key/name of the attribute/field that is sent to the server
				input.value = value;
				theForm.appendChild(input);
			}
			$("#pcr_number_submit").click(function(e) {
				e.preventDefault();
				// Form reference:
				var theForm = document.forms['pcr_number_form'];

				// Add data:
				addHidden(theForm, 'condition', 'insert_request_pcr');
				addHidden(theForm, 'pcr_number', pcr_number);

				// Submit the form:
				theForm.submit();
			});
		});
	</script>

	</html>
<?php
}
?>