<?php
session_start();
include "../ENG/connectpcr.php";
$sql_name = "SELECT * From employee WHERE Emp_ID = '".$_GET["Emp_ID"]."'";
$result_name = mysqli_query($condbmc, $sql_name);
$row_name = mysqli_fetch_array($result_name);
$sql_gc = "SELECT * From sectioncode WHERE Sectioncode = '".$row_name["Sectioncode_ID"]."'";
$result_gc = mysqli_query($condbmc, $sql_gc);
$row_gc = mysqli_fetch_array($result_gc);
$sql_p = "SELECT * From position WHERE Position_ID = '".$row_name["Position_ID"]."'";
$result_p = mysqli_query($condbmc, $sql_p);
$row_p = mysqli_fetch_array($result_p);
$Name = $row_name["Empname_eng"] . ' ' . substr($row_name["Empsurname_eng"],0,1).".";
$SP = $row_gc["Department"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Process Change Report System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="KaijuThemes">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

    <link type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="../assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="../assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link type="text/css" href="../assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->

    
	<link type="text/css" href="../assets/plugins/form-fseditor/fseditor.css" rel="stylesheet">                      		<!-- FullScreen Editor -->

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
<li class="active"><a href="profile.php?Emp_ID=<?phpecho $_GET["Emp_ID"]?>">Profile</a></li>

                            </ol>
                            <div class="container-fluid">
                                 
<div data-widget-group="group1">
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-profile">
			  <div class="panel-body">
			    <img src="http://10.73.148.5/DBMC/IMG/emp120/<?phpecho $_GET["Emp_ID"]?>.jpg" class="img-circle">
			    <div class="name"><?phpecho $Name?></div>
			    <div class="info"><?phpecho $SP?></div>
			  </div>
			</div><!-- panel -->
		</div><!-- col-sm-3 -->
		<div class="col-sm-9">
			<div class="tab-content">
				<div class="tab-pane active" id="tab-about">
					<div class="panel panel-default">
					    <div class="panel-heading">
					    	<h2>Profile</h2>
					    </div>
						<div class="panel-body">
							<div class="about-area">
						      	<h4>Information</h4>
								    <div class="table-responsive">
								      <table class="table about-table">
								        <tbody>
								          <tr>
								            <th>Full Name</th>
								            <td><?phpecho $row_name["Empname_engTitle"].' '.$row_name["Empname_eng"].'  '.$row_name["Empsurname_eng"]?></td>
								          </tr>
								          <tr>
								            <th>Position</th>
								            <td><?phpecho $row_p["Position_name"]?></td>
								          </tr>
								          <tr>
								            <th>Department</th>
								            <td><?phpecho $row_gc["Department"]?></td>
								          </tr>
								          <tr>
								            <th>Section</th>
								            <td><?phpecho $row_gc["Sec_desc"]?></td>
								          </tr>
								          <tr>
								            <th>Section Code</th>
								            <td><?phpecho $row_gc["Sectioncode"]?></td>
								          </tr>
								        </tbody>
								      </table>
								    </div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .tab-content -->
		</div><!-- col-sm-8 -->
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
    
<script type="text/javascript" src="../assets/plugins/form-fseditor/jquery.fseditor-min.js"></script>            			<!-- Fullscreen Editor -->
<script type="text/javascript" src="../assets/plugins/bootbox/bootbox.js"></script> 	<!-- Bootbox -->

<script type="text/javascript" src="assets/demo/demo-profile.js"></script>

    <!-- End loading page level scripts-->

    </body>
</html>