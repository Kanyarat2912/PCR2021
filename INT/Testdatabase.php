<?php
$empid ="60160183";
$pass = "60160183";
date_default_timezone_set('asia/bangkok');
session_start();
include "../ENG/connectpcr.php";
$sql = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$empid."' AND usr_password = '".$pass."' ";
$query = $conn->query($sql);
print_r($query);
?>
<html>
<br>
<br>
</html>
<?php
$sql = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$empid."' AND usr_password = '".$pass."' ";
$query = $conn->query($sql);
$row2 = $query->fetch_assoc();
print_r($row2);
?>
<html>
<br>
<br>
</html>
<?php
// $sql_MY_PCR = "SELECT * FROM pcr_form WHERE fm_usr_emp_code = 60160183 AND is_delete = 1 ORDER BY fm_id DESC";
// $result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
// $result_MY_PC = $result_MY_PCR->fetch_assoc();
// print_r($result_MY_PC);

function Select_MY_PCR($conn){
	$i=1;
	$sql_MY_PCR = "SELECT * FROM pcr_form WHERE fm_usr_emp_code = '".$_SESSION["empid_pcr"]."' AND is_delete = 1 ORDER BY fm_id DESC";
    $result_MY_PCR = mysqli_query($conn, $sql_MY_PCR);
  
	WHILE($row_MY_PCR = mysqli_fetch_array($result_MY_PCR)){
		$sql_ANN = "SELECT * FROM pcr_annual_plan WHERE anp_anp_number = '".$row_MY_PCR["fm_anp_id"]."'";
		$result_ANN = mysqli_query($conn, $sql_ANN);
		$row_ANN = mysqli_fetch_array($result_ANN);
		$sql_PD = "SELECT * FROM pcr_product WHERE pro_id = '".$row_ANN["anp_pro_id"]."'";
		$result_PD = mysqli_query($conn, $sql_PD);
		$row_PD = mysqli_fetch_array($result_PD);
		$title = substr($row_ANN["anp_title"],0,20)."...";
		if($row_MY_PCR["fm_state_app"] == 1){
			$Delete = '<li><a href="../INT/cancel.php?id='.$row_MY_PCR["fm_pcr_number"].'"  class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li>';
		}else{
			$Delete = '';
		}
		if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 0 ){
			$status = "Plan";
			$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;'.$Delete.'</ul>';
		}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 0){
			$status = "Result";
			$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-primary-alt"><i class="ti ti-search"></i></a></li>&nbsp;'.$Delete.'</ul>';
		}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 1 ){
			$status = "Plan";
			$Action = '<ul class="demo-btns"><li><a href="../INT/result.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-warning-alt">Result</a></li></ul>';
		}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 3){
			$status = "Complete";
			$Action = '<ul class="demo-btns"><li><a href="../INT/view_pcr.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-success-alt"><i class="ti ti-search"></i></li></ul>';
		}else if($row_MY_PCR["fm_phase"] == 1 AND $row_MY_PCR["checkk"] == 2 ){
			$status = "Plan";
			$Action = '<ul class="demo-btns"><li><a href="../INT/RJ_Plan.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt">Reject</a></li>&nbsp;<li><a href="../INT/cancel.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></ul>';
		}else if($row_MY_PCR["fm_phase"] == 2 AND $row_MY_PCR["checkk"] == 2){
			$status = "Result";
			$Action = '<ul class="demo-btns"><li><a href="../INT/RJ_Result.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt">Reject</a>&nbsp;<li><a href="../INT/cancel.php?id='.$row_MY_PCR["fm_pcr_number"].'" class="btn btn-danger-alt"><i class="ti ti-close"></i></a></li></li></ul>';
		}
		
			
		echo '<tr class="odd gradeX">';
			echo '<td class="center"><center>'.$i.'</center></td>';
			echo '<td>'.$row_MY_PCR["fm_pcr_number"].'</td>';
			echo '<td>'.$title.'</td>';
			echo '<td class="center">'.$row_PD["pro_name"].'</td>';
			echo '<td class="center">'.date("d-M-y", strtotime($row_MY_PCR["fm_create_date"])).'</td>';
			echo '<td class="center">'.$status.'</td>';
			echo '<td class="center">'.$Action.'</td>';
		echo '</tr>';
		$i++;
	}
}

echo Select_MY_PCR($conn);
?>