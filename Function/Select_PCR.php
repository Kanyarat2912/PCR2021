<?php
$sql_pcr = "SELECT * FROM pcr_form WHERE fm_pcr_number = '".$pcr_number."'";
$result_pcr = mysqli_query($conn, $sql_pcr);
$row_pcr = mysqli_fetch_array($result_pcr);
$sql_flow = "SELECT * FROM pcr_flow_approve WHERE ap_fm_id = '".$row_pcr["fm_anp_id"]."' AND fm_state_app = '".$row_pcr["ap_step"]."'";
$result_flow = mysqli_query($conn, $sql_flow);
$row_flow = mysqli_fetch_array($result_flow);
?>