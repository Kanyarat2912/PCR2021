<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
include("connectpcr.php");
// Priority Management Category
$sql_pmc = "SELECT * FROM pcr_form_priority WHERE fp_fm_id = '".$pcr_number."' AND fp_pri_id = 1";
$result_pmc = mysqli_query($conn, $sql_pmc);
$row_pmc = mysqli_fetch_array($result_pmc);

?>