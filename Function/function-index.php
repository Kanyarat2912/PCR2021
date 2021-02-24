<?php
date_default_timezone_set("Asia/Bangkok");
function Select_Slideshow($conn){
	$sql_MAX_Slideshow = "SELECT MAX(id) AS MAX_Slideshow FROM pcr_slideshow;;";
	$result_MAX_Slideshow = mysqli_query($conn, $sql_MAX_Slideshow);
	$row_MAX_Slideshow = mysqli_fetch_array($result_MAX_Slideshow);
	$MAX_Slideshow = 1 ;
	$sql_Slideshow = "SELECT * FROM pcr_slideshow;";
	$result_Slideshow = mysqli_query($conn, $sql_Slideshow);
	WHILE($row_Slideshow = mysqli_fetch_array($result_Slideshow)){
		echo '<div class="mySlides fade">';
			echo '<div class="numbertext">'.$MAX_Slideshow .'/'. $row_MAX_Slideshow["MAX_Slideshow"].'</div>';
				echo '<img src="images/slideshow/'.$row_Slideshow["name"].'" style="width:100%">';
			//echo '<div class="text">Caption Text</div>';
		echo '</div>';
		$MAX_Slideshow++;
	}
}


function Select_user($conn, $Emp_ID){
	$sql_user = "SELECT * FROM pcr_user WHERE usr_emp_code = '".$Emp_ID."';";
	$result_user = mysqli_query($conn, $sql_user);
	$row_user = mysqli_fetch_array($result_user);
	$PIN_Code = $row_user["code"];
}



?>