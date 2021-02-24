<?php
session_start();
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
								<li class="active"><a href="PE_APP_USER.php">Requested Permission Menu</a></li>
                            </ol>
                            <div class="container-fluid">
                                


<div data-widget-group="group1">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Requested Permission Tables</h2>
					<div class="panel-ctrls"></div>
				</div>
				<div class="panel-body no-padding">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Employee ID</th>
								<th>Name - Surname</th>
								<th>Position</th>
								<th>Section code/Department</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								echo Select_Requested_Permission($conn, $condbmc, 3);
							?>
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