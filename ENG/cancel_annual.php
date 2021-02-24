<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");
$number_pcr = $_POST["annual_number"];
// $number_pcr = "";
// echo $number_pcr;
// echo "55555555";

$sql_cancel = "UPDATE pcr_annual_plan SET anp_is_delete = '0' WHERE anp_anp_number = '".$number_pcr."'";


if(mysqli_query($conn,$sql_cancel)){
    					echo "<script language=\"JavaScript\">";
						echo "alert('Delete Success.');";
						echo "</script>";
						echo '<meta http-equiv=refresh content=0;URL=../INT/annual.php>';
}else{
						echo "<script language=\"JavaScript\">";
						echo "alert('Can not Delete.');";
						echo "</script>";
						echo '<meta http-equiv=refresh content=0;URL=../INT/annual.php>';
}
?>