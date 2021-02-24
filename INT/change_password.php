<!DOCTYPE html>
<?php
include "../ENG/connectpcr.php";
$sql_user = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$_GET["emp"]."';";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_array($result_user);
$PIN_Code = $row_user["code"];
if($PIN_Code == $_GET["confirm"]){
?>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>Process Change Report System.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="KaijuThemes">
	<link rel="shortcut icon" href="../images/Logo.png" />
    <link type='text/css' href="../assets/fonts/font.css" rel='stylesheet'>
    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="../assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">               <!-- Themify Icons -->
    <link type="text/css" href="../assets/css/styles.css" rel="stylesheet">

	<!-- Load validator -->
	<link href="../assets/validator/validator.css" rel="stylesheet" />
	<script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script> 	
	<script src="../assets/validator/jquery.form.validator.min.js"></script>
	<script src="../assets/validator/security.js"></script>
</head>

<body class="focused-form animated-content" style="background-image: url('../images/index/Engineer.jpg')">
        
        
	<div class="container" id="login-form">
		<a href="index.html" class="login-logo"><img src="../images/login/Logo_1.png"></a>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<form action="../ENG/change_password.php?Emp_ID=<?php echo $_GET["emp"]?>&confirm=<?phpecho $_GET["confirm"]?>" method="POST" class="form-horizontal" id="form-login">
							<div class="panel-heading">
								<h2>Change password</h2>
							</div>
							<div class="panel-body">
							
								<div class="form-group mb-md">
									<div class="col-xs-12">
										<div class="input-group">							
											<span class="input-group-addon">
												<i class="ti ti-user"></i>
											</span>
											<input type="text" name="username" class="form-control" value="<?php echo $_GET["emp"]?>" disabled placeholder="Username" data-parsley-minlength="10" placeholder="At least 10 characters" required>
										</div>
									</div>
								</div>

								<div class="form-group mb-md">
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon"> 
												<i class="ti ti-key"></i>
											</span>
											<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" pattern=".{8,}"  data-validation="required" data-validation-error-msg="Please enter password." />
										</div>
									</div>
								</div>
								
								<div class="form-group mb-md">
									<div class="col-xs-12">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="ti ti-key"></i>
											</span>
											<input type="password" name="con_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" pattern=".{8,}"  data-validation="confirmation" data-validation-confirm="password" data-validation-error-msg="Password did not match: Please try again..."/>
										</div>
									</div>
								</div>
								<div class="form-group mb-md">
									<div class="col-xs-12">
										<div class="input-group">
											<img src="../images/password/password.PNG" alt="Smiley face" height="200">	
										</div>
									</div>
								</div>

								<div class="form-group mb-n">
										<div class="col-xs-12">
										
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="clearfix">
									<button type="submit" class="btn btn-info pull-right">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>

	
		
		
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

	<script type="text/javascript" src="../assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

	<script type="text/javascript" src="../assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

	<script type="text/javascript" src="../assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

	<script type="text/javascript" src="../assets/js/application.js"></script>
	<script type="text/javascript" src="../assets/demo/demo.js"></script>
	<script type="text/javascript" src="../assets/demo/demo-switcher.js"></script>

	<!-- End loading site level scripts -->
    <!-- Load page level scripts-->
    <script type="text/javascript">
		$.validate({
			 modules: 'security, file',
			 onModulesLoaded: function () {
				$('input[name="password"]').displayPasswordStrength();
			 }
		 });
	</script>

    <!-- End loading page level scripts-->
</body>
</html>
<?php
}else{
	echo '<meta http-equiv=refresh content=0;URL=404.php>';
}
?>