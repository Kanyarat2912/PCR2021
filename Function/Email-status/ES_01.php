<?php
// es = email status
function email_status($conn, $status){ 
$sql_es = "SELECT * FROM pcr_email WHERE id = '".$id."'";
$result_es = mysqli_query($conn, $sql_es);
$row_es = mysqli_fetch_array($result_es);
	return $row_es["status"];
}
?>