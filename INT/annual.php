<?php  
// session_start();
include "../Function/function-datatables.php";
// include "../Function/modal_annual_plan.php";
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
							   
							</ol>
						
						<div class="container-fluid">
						<div data-widget-group="group1">
							<div class="row">
								<div class="col-md-12">
									<ul class="demo-btns">
										<li><a href="create_annual.php" class="btn btn-label btn-social btn-facebook"><i class="ti ti-plus"></i>Create Annual Plan</a></li>
									</ul>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h2>Annual plan</h2>
											<div class="panel-ctrls"></div>
										</div>
										<div class="panel-body no-padding">
											<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th><center>No.</center></th>
														<th>Annual Plan Number</th>
														<th>Title</th>
														<th>Product Name</th>
														<th>Section</th>
														<th>Rank</th>
														<th>Company</th>
														<th>Create Date</th>
														<th><center>Action</center></th>
													</tr>
												</thead>
												<tbody>
											<?php	

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
														echo '<td id="textarea">'.$row_MY_PCR["anp_anp_number"].'</td>';
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
																<li><a  class="btn btn-danger-alt" data-toggle="modal" data-target="#Cancel_Modal" id="submit">Cancel</a></li>
															</ul>
															</center></td>';
													echo '</tr>';
													$i++;

													
													
											}?>
													<?php //echo Select_Annual_list($conn)?>
												</tbody>
											</table>
										</div>
										<!-- panel footer -->
										<div class="panel-footer"></div>
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

	<!-- Start Modal confirm  -->
		<div id="Cancel_Modal" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<!-- dialog -->
		<div class="modal-dialog">
	
		<!-- content -->
		<div class="modal-content">
	
			<!-- header -->
			<div class="modal-header">
			<h1 id="myModalLabel"
				class="modal-title">
				Message
			</h1>
			</div>
			<!-- header -->
			
			<!-- body -->
		<form class="grid-form" action="../ENG/cancel_annual.php" method="post" enctype="multipart/form-data">
			<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-transparent" data-widget="{"draggable": "false"}">
						<div class="panel-body">
							<div id="carousel-example-captions" class="carousel slide">
								</div> 
							<h1 class="modal-title">
								<center>You would like to cancel annual plan ? </center>
							</h1>
							<input type="hidden" value="" id="modal_body" name="annual_number" >
						</div>
					</div>
				</div>
			</div>
	
			</div>
			<!-- body -->
	
			<!-- footer -->
			<div class="modal-footer" >
			<button class="btn btn-primary" type="submit"><a ></a> SUNMIT </button>
			<button class="btn btn-secondary" data-dismiss="modal"> CANCEL </button>
			</div>
		</form>
			<!-- footer -->
	
		</div>
		<!-- content -->
	
		</div>
		<!-- dialog -->
	
		</div>
		<!-- modal -->
	<!-- End Modal confirm -->

<script type="text/javascript"> 
        $("#submit").click(function () { 
			var text = $("#textarea").val(); 
			console.log(text);
            // $("#modal_body").html(text); 
        }); 
</script>


    
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
		<script type="text/javascript" src="../assets/js/enquire.min.js"></script> 		
		<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
		<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.ui.min.js"></script>
		<script type="text/javascript" src="../assets/plugins/wijets/wijets.js"></script>     		
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