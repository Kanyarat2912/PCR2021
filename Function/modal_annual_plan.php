<?php
include "../ENG/connectpcr.php";

function Select_nnual_modal(){
        $number_annual = $_GET['id'];
			// '<!-- Start Modal confirm  -->';
	echo '<div id="Cancel_Modal" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';	
	// '<!-- dialog -->';	
	echo '<div class="modal-dialog">';	

	// '<!-- content -->';	
		echo '<div class="modal-content">';

			// '<!-- header -->';
			echo '<div class="modal-header">';
			echo '<h1 id="myModalLabel"';
				echo 'class="modal-title">';
				echo 'Message';
			echo '</h1>';
			echo '</div>';
			// '<!-- header -->';
			
			// body
			echo '<form class="grid-form" action="../ENG/cancel_annual.php" method="post" enctype="multipart/form-data">';
			echo '<div class="modal-body">';
			echo '<div class="row">';
				echo '<div class="col-md-12">';
					echo '<div class="panel panel-transparent" data-widget="{"draggable": "false"}">';
						echo '<div class="panel-body">';
							echo '<div id="carousel-example-captions" class="carousel slide">';
								echo '<!-- <ol class="carousel-indicators">';
									echo '<li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>';
									echo '<li data-target="#carousel-example-captions" data-slide-to="1" class=""></li>';
									echo '<li data-target="#carousel-example-captions" data-slide-to="2" class=""></li>';
								echo '</ol> -->';
							
								echo '<a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">';
									echo '<i class="fa fa-prev icon-prev"></i>';
								echo '</a>';
								echo '<a class="right carousel-control" href="#carousel-example-captions" data-slide="next">';
									echo '<i class="fa fa-next icon-next"></i>';
								echo '</a>';
							echo '</div>';
							echo '<input type="hidden" name="anp_anp_number" value="'.$number_annual["anp_anp_number"].'">';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '</div>';
			// body

			//<!-- footer -->
			echo '<div class="modal-footer" >';
			echo '<button class="btn btn-primary" type="submit"> SUNMIT </button>';
			echo '<button class="btn btn-secondary" data-dismiss="modal"> CANCEL </button>';
			echo '</form>';
			echo '</div>';
			//<!-- footer -->

		echo '</div>';
		//<!-- content -->

		echo '</div>';
		//<!-- dialog -->

		echo '</div>';
//<!-- End Modal confirm -->



}



?>