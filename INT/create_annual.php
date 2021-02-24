<?php  
include "../ENG/auto_anp.php";
include "../Function/function_form.php";
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
							<li class="active"><a href="#">Create annual plan</a></li>
						</ol>
                        <div class="container-fluid">
						<!--div class="alert alert-info">
							<h3>Grid Forms</h3>
							<p>Grid forms are dense forms designed for use in applications that require lots of data to be entered regularly. A tiny Javascript/CSS framework that helps you make forms on grids with ease.</p>
						</div-->
						<div data-widget-group="group1">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary" data-widget='{"id" : "wiget9", "draggable": "false"}'>
										<div class="panel-heading ">
											<h2>Create Annual Plan : Process Change Report System</h2>
											<div class="panel-ctrls button-icon-bg" 
												data-actions-container="" 
												data-action-collapse='{"target": ".panel-body"}'
												data-action-colorpicker='' >
											</div>
											<!-- <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div> -->
										</div>
										<div class="panel-body">
											<form class="grid-form" action="../ENG/Insert_ann_plan.php?ann_number=<?php  echo $an_num?>&number=<?php  echo $data["seq"]?>" method="post" enctype="multipart/form-data">
												<fieldset>
													<legend>Annual Plan Data</legend>
													<div data-row-span="4">
														<div data-field-span="1">
															<label>No.</label>
															<input type="text" value="<?php  echo $an_num?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Date</label>
															<input type="text" value="<?php  echo date("d-M-y")?>" disabled>
														</div>
														<div data-field-span="1">
															<label>Registant</label>
															<input type="text" value="<?php  echo $_SESSION["empname_pcr"]." ".substr($_SESSION["emplast_pcr"],0,1)."."; ?>" disabled>
														</div>
														<div data-field-span="1">
															<label><font color="#CC0000">Section *</font></label>
															<select class="form-control" name="section" required>
																<?php   echo Select_annual_section($conn)?>
															</select>
														</div>
													</div>
												</fieldset>
												
												<fieldset>
												<div data-row-span="1">
													<div data-field-span="1">
														<label><font color="#CC0000">ADDITION ITEM *</font></label>
														<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
															<label class="radio-inline icheck">
																<input type="radio" id="inlineradio1" value="1" name="Addition" > Yes
															</label>
														</div>	
														<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
															<label class="radio-inline icheck">
																<input type="radio" id="inlineradio2" value="0" name="Addition" > No
															</label>
														</div>
													</div>
												</div>
												</fieldset>
												<fieldset>
													<div data-row-span="1">
														<div data-field-span="1">
															<label><font color="#CC0000">Title *</font></label>
															<input type="text" name="title_pcr" id="title_pcr" required>
														</div>
													</div>
													<div data-row-span="4">
														<div data-field-span="1">
															<label><font color="#CC0000">Change Type *</font></label>
															<select class="form-control" name="ct" required>
																<?php   echo Select_annual_Change_Type($conn)?>
															</select>
														</div>
														<div data-field-span="1">
															<label><font color="#CC0000">Rank *</font></label>
															<select class="form-control" name="r" required>
															<?php   echo Select_annual_Rank($conn)?>
															</select>
														</div>
														<div data-field-span="1">
															<label><font color="#CC0000">Product *</font></label>
															<select class="form-control" name="pd" required>
															<?php   echo Select_annual_Product($conn)?>
															</select>
														</div>
														<div data-field-span="1">
															<label><font color="#CC0000">Change Point *</font></label>
															<select class="form-control" name="cp" required>
															<?php   echo Select_annual_Change_Point($conn)?>
															</select>
														</div>
													</div>
													<div data-row-span="4">
														<div data-field-span="1">
															<label><font color="#CC0000">Part name *</font></label>
															<input type="text" name="part_number" required>
														</div>
														<div data-field-span="1">
															<label><font color="#CC0000">Output *</font></label>
															<input type="text" name="output" required>
														</div>
														<div data-field-span="1">
															<label><font color="#CC0000">Line *</font></label>
															<input type="text" name="line"  required>
														</div>
														<div data-field-span="1">
															<label>Focus point for planning review</label>
															<input type="text" name="concern" >
														</div>
														
													</div>
													<div data-row-span="4">
														<div data-field-span="1">
															<label>Customer Submission</label>
															<input type="text" name="customer_s" >
														</div>
														<div data-field-span="3">
															<label><font color="#CC0000">Process *</font></label>
															<input type="text" name="process"  required>
														</div>
													</div>
												</fieldset>
												
												<fieldset>
													<div data-row-span="1">
														<div data-field-span="1">
															<label><font color="#CC0000">PLANNING REVIEW *</font></label>
															<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
																<label class="radio-inline icheck">
																	<input type="radio" id="inlineradio1" value="1" name="Planning" > Yes
																</label>
															</div>	
															<div class="col-sm-10 col-xs-10 col-md-10 col-lg-10">
																<label class="radio-inline icheck">
																	<input type="radio" id="inlineradio2" value="0" name="Planning" > No
																</label>
															</div>
														</div>
													<br>
													</div>
												</fieldset>
												<br>
												<div class="clearfix pt-md">
													<div class="pull-right">
														<button type="submit" class="btn-primary btn">Submit Form</button>
														<!-- <button class="btn-default btn">Cancel</button> -->
														<a href="annual.php"  class="btn-default btn" >Cancel</a>
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
		$('#anuual_Plan_No').on('change',function(){
		var anuual_ID = $(this).val();
		console.log(anuual_ID);
		
			$.ajax({
                type: 'POST',
                data: {anuual_ID: anuual_ID},
                url: '../ENG/Ajax_Anuual_Plan.php',
				dataType: "JSON",
                success: function(data) {
					console.log(data);
						if(data == "NO"){
							document.getElementById("anuual_Plan_No").value = null;
							alert("This Anuual Plan has already been used.");
						}else{
							document.getElementById("title_pcr").value = data.Title;
							document.getElementById("addition_item").value = data.Add_item;
							document.getElementById("change_type").value = data.Change_type;
							document.getElementById("rank").value = data.Rank;
							document.getElementById("customer_submission").value = data.Customer_sub;
							document.getElementById("planning_review").value = data.Plan_review;
							document.getElementById("product").value = data.Product;
							document.getElementById("part_name").value = data.P_name;
							document.getElementById("change_point").value = data.Cp;
						}
					
                }
            });
                    return false;
	});
});	
</script>
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
					if(data2 != null){
						document.getElementById('appdepart_Position0').value = data2.position_ap;
						document.getElementById('appdepart_department0').value = data2.section_ap;
						document.getElementById('appdepart_name1').disabled = false;
					}else{
						document.getElementById('appdepart_name0').value = "";
					}
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
					document.getElementById('appdepart_name2').disabled = false;
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
					document.getElementById('appdepart_name3').disabled = false;
					
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
					document.getElementById('appdepart_name4').disabled = false;
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
                if (file >= 9730) { 
                    alert("File too large for upload, Maximum file size 9.5mb");
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