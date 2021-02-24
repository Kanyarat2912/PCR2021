<?php  
session_start();
include "../ENG/connectpcr.php";
date_default_timezone_set("Asia/Bangkok");

	// Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
	// output : select edit section annual plan
function Edit_select_section($conn, $anp_anp_number){
		echo '<option value="">Please Select</option>';

		$sql_se = "SELECT * From pcr_section_anp "; // select  pcr_section_anp all 
		$result_et_se = mysqli_query($conn, $sql_se);
		
		$select_chack = "SELECT anp_sec_id  FROM `pcr_annual_plan` 
		LEFT JOIN pcr_section_anp on pcr_annual_plan.`anp_sec_id` = pcr_section_anp.sec_id   
		WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  sec_id  for check
		$select_chack = mysqli_query($conn, $select_chack);
		$row_select_chack = mysqli_fetch_array($select_chack);


		WHILE($row_et_se = mysqli_fetch_array($result_et_se)){
            if($row_et_se['sec_id'] == $row_select_chack["anp_sec_id"]) // check value section form database
            { 
				$selected = "selected";
			}else{
				$selected = "";
			  }
			  echo '<option value="'.$row_et_se['sec_id'].'" '.$selected.'>'.$row_et_se['sec_name'].'</option>';	
		}
	
    }	
    
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
	// output : select edit change_type annual plan

function Edit_select_change_type($conn, $anp_anp_number){
    echo '<option value="">Please Select</option>';

    $sql_se = "SELECT * From pcr_change_type "; // select  pcr_section_anp all 
    $result_et_se = mysqli_query($conn, $sql_se);
    

    $select_chack = "SELECT anp_ct_id  FROM `pcr_annual_plan` 
    LEFT JOIN pcr_change_type on pcr_annual_plan.`anp_ct_id` = pcr_change_type.ct_id  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_ct_id  for check
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);


    WHILE($row_et_se = mysqli_fetch_array($result_et_se)){
        if($row_et_se['ct_id'] == $row_select_chack["anp_ct_id"]) // check value section form database
        { 
            $selected = "selected";
        }else{
            $selected = "";
          }
          echo '<option value="'.$row_et_se['ct_id'].'" '.$selected.'>'.$row_et_se['ct_name'].'</option>';	
    }

}



    //*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit rank annual plan
    //*****************************
function Edit_select_rank($conn, $anp_anp_number){
    echo '<option value="">Please Select</option>';

    $sql_se = "SELECT * From pcr_rank "; // select  pcr_section_anp all 
    $result_et_se = mysqli_query($conn, $sql_se);
    

    $select_chack = "SELECT anp_rk_id  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_rk_id  for check
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);


    WHILE($row_et_se = mysqli_fetch_array($result_et_se)){
        if($row_et_se['rk_id'] == $row_select_chack["anp_rk_id"]) // check value section form database
        { 
            $selected = "selected";
        }else{
            $selected = "";
          }
          echo '<option value="'.$row_et_se['rk_id'].'" '.$selected.'>'.$row_et_se['rk_name'].'</option>';	
    }

}
    //*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit product annual plan
    //*****************************
function Edit_select_product($conn, $anp_anp_number){
    echo '<option value="">Please Select</option>';

    $sql_se = "SELECT * From pcr_product "; // select  pcr_section_anp all 
    $result_et_se = mysqli_query($conn, $sql_se);
    

    $select_chack = "SELECT anp_pro_id  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_rk_id  for check
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);


    WHILE($row_et_se = mysqli_fetch_array($result_et_se)){
        if($row_et_se['pro_id'] == $row_select_chack["anp_pro_id"]) // check value section form database
        { 
            $selected = "selected";
        }else{
            $selected = "";
          }
          echo '<option value="'.$row_et_se['pro_id'].'" '.$selected.'>'.$row_et_se['pro_name'].'</option>';	
    }

}
    //*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit change_point annual plan
    //*****************************
function Edit_select_change_point($conn, $anp_anp_number){
    echo '<option value="">Please Select</option>';

    $sql_se = "SELECT * From pcr_change_point "; // select  pcr_section_anp all 
    $result_et_se = mysqli_query($conn, $sql_se);

    $select_chack = "SELECT anp_cp_id  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_cp_id  for check
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);


    WHILE($row_et_se = mysqli_fetch_array($result_et_se)){
        if($row_et_se['cp_id'] == $row_select_chack["anp_cp_id"]) // check value section form database
        { 
            $selected = "selected";
        }else{
            $selected = "";
          }
          echo '<option value="'.$row_et_se['cp_id'].'" '.$selected.'>'.$row_et_se['cp_name'].'</option>';	
    }

}
    //*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit titel annual plan
    //*****************************
    function Edit_select_titel($conn, $anp_anp_number){
        $select_chack = "SELECT anp_title  FROM `pcr_annual_plan`  
        WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_cp_id  for 
        $select_chack = mysqli_query($conn, $select_chack);
        $row_select_chack = mysqli_fetch_array($select_chack);

        echo $row_select_chack['anp_title'];	
    }

//*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit part_name annual plan
//*****************************
    function Edit_select_part_name($conn, $anp_anp_number){
        $select_chack = "SELECT anp_part_name  FROM `pcr_annual_plan`  
        WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_part_name  
        $select_chack = mysqli_query($conn, $select_chack);
        $row_select_chack = mysqli_fetch_array($select_chack);

        echo $row_select_chack['anp_part_name'];	
    }

    //*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit line annual plan
    //*****************************
    function Edit_select_line($conn, $anp_anp_number){
        $select_chack = "SELECT anp_line  FROM `pcr_annual_plan`  
        WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_line 
        $select_chack = mysqli_query($conn, $select_chack);
        $row_select_chack = mysqli_fetch_array($select_chack);

        echo $row_select_chack['anp_line'];	
    }

    
    //*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit output annual plan
    //*****************************
    function Edit_select_output($conn, $anp_anp_number){
        $select_chack = "SELECT anp_output  FROM `pcr_annual_plan`  
        WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_output 
        $select_chack = mysqli_query($conn, $select_chack);
        $row_select_chack = mysqli_fetch_array($select_chack);

        echo $row_select_chack['anp_output'];	
    }
//*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit customer_submission annual plan
//*****************************
    function Edit_select_customer_submission($conn, $anp_anp_number){
        $select_chack = "SELECT anp_cus_sub  FROM `pcr_annual_plan`  
        WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_cus_sub 
        $select_chack = mysqli_query($conn, $select_chack);
        $row_select_chack = mysqli_fetch_array($select_chack);

        echo $row_select_chack['anp_cus_sub'];	
    }

//*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit process annual plan
//*****************************
function Edit_select_process($conn, $anp_anp_number){
    $select_chack = "SELECT anp_process_name  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_process_name  
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);

    echo $row_select_chack['anp_process_name'];	
}

//*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit concer annual plan
//*****************************
function Edit_select_concer($conn, $anp_anp_number){
    $select_chack = "SELECT anp_concern  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_concern  
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);

    echo $row_select_chack['anp_concern'];	
}

//*****************************
    // Supatchai Gamaporn
	// 25/01/2021 
	// input : number annual plan 
    // output : select edit registant annual plan
//*****************************
function Edit_select_registant($conn, $anp_anp_number){
    $select_chack = "SELECT anp_issue  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_issue 
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);

    echo $row_select_chack['anp_issue'];	
}




//*****************************
    // Supatchai Gamaporn
	// 25/01/2021 
	// input : number annual plan 
    // output : select edit date annual plan
//*****************************
function Edit_select_date($conn, $anp_anp_number){
    $select_chack = "SELECT anp_create_date  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_create_date 
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);

    echo date("d-M-y", strtotime($row_select_chack['anp_create_date']));;	
}


//*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit planning review annual plan
//*****************************
function Edit_select_planning_review($conn, $anp_anp_number){
    $select_chack = "SELECT anp_plan_review  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_plan_review  for check
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);

    // echo $row_select_chack['anp_concern'];	

         echo ' <div data-field-span="1"> ';
            echo ' <label><font color="#CC0000">PLANNING REVIEW *</font></label>';

            if($row_select_chack['anp_plan_review'] == 1){
                echo ' <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">' ;  
                echo '<label class="radio-inline icheck">';       
                echo '<input type="radio" id="inlineradio1" value="1" name="planning_edit"  checked> Yes </label>'; 
                echo ' </div>';   	
                echo ' <div class="col-sm-10 col-xs-10 col-md-10 col-lg-10">';   
                            echo '<label class="radio-inline icheck">';        
                            echo '<input type="radio" id="inlineradio2" value="0" name="planning_edit" > No </label>';
                echo '</div>';

            }elseif($row_select_chack['anp_plan_review'] == 0){
                echo ' <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">' ;  
                echo '<label class="radio-inline icheck">';       
                echo '<input type="radio" id="inlineradio1" value="1" name="planning_edit"  > Yes </label>'; 
                echo ' </div>';   	
                echo ' <div class="col-sm-10 col-xs-10 col-md-10 col-lg-10">';   
                            echo '<label class="radio-inline icheck">';        
                            echo '<input type="radio" id="inlineradio2" value="0" name="planning_edit" checked> No </label>';
                echo '</div>';

            }else{
                echo ' <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">' ;  
                echo '<label class="radio-inline icheck">';       
                echo '<input type="radio" id="inlineradio1" value="1" name="planning_edit"> Yes </label>'; 
                echo ' </div>';   	
                echo ' <div class="col-sm-10 col-xs-10 col-md-10 col-lg-10">';   
                            echo '<label class="radio-inline icheck">';        
                            echo '<input type="radio" id="inlineradio2" value="0" name="planning_edit"> No </label>';
                echo '</div>';

            }
        
        echo '</div>';
}



//*****************************
    // Supatchai Gamaporn
	// 24/01/2021 
	// input : number annual plan 
    // output : select edit adition item annual plan
//*****************************
function Edit_select_adition_item($conn, $anp_anp_number){
    $select_chack = "SELECT anp_add_item  FROM `pcr_annual_plan`  
    WHERE `anp_anp_number` LIKE '".$anp_anp_number."' "; // select  anp_plan_review  for check
    $select_chack = mysqli_query($conn, $select_chack);
    $row_select_chack = mysqli_fetch_array($select_chack);

    // echo $row_select_chack['anp_concern'];	

         echo ' <div data-field-span="1"> ';
            echo ' <label><font color="#CC0000">ADDITION ITEM *</font></label>';
            if($row_select_chack['anp_add_item'] == 1){
                echo ' <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">' ;  
                echo '<label class="radio-inline icheck">';       
                echo '<input type="radio" id="inlineradio1" value="1" name="addition_edit"  checked> Yes </label>'; 
                echo ' </div>';   	
                echo ' <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';   
                            echo '<label class="radio-inline icheck">';        
                            echo '<input type="radio" id="inlineradio2" value="0" name="addition_edit" > No </label>';
                echo '</div>';

            }elseif($row_select_chack['anp_add_item'] == 0){
                echo ' <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">' ;  
                echo '<label class="radio-inline icheck">';       
                echo '<input type="radio" id="inlineradio1" value="1" name="addition_edit"  > Yes </label>'; 
                echo ' </div>';   	
                echo ' <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';   
                            echo '<label class="radio-inline icheck">';        
                            echo '<input type="radio" id="inlineradio2" value="0" name="addition_edit" checked> No </label>';
                echo '</div>';

            }else{
                echo ' <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">' ;  
                echo '<label class="radio-inline icheck">';       
                echo '<input type="radio" id="inlineradio1" value="1" name="addition_edit"> Yes </label>'; 
                echo ' </div>';   	
                echo ' <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">';   
                            echo '<label class="radio-inline icheck">';        
                            echo '<input type="radio" id="inlineradio2" value="0" name="addition_edit"> No </label>';
                echo '</div>';

            }
        
        echo '</div>';
}


?>