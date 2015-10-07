<?php 
	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='crear-campanas.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='campana.php'){
		echo '
			<div class="crear-campana">
				<a href="nueva-campana.php" target="_top">
					<span>
						<i class="fa fa-plus"></i>
						crear nueva campaña
					</span>
				</a>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					
					$(".recientes .content").hide();

					$(".ver-mas").on("click",function(event){
							
							$(this).siblings(".content").slideToggle();
							$(this).find("i").toggleClass("fa-angle-up fa-angle-down");

					});

				});

			</script>';
	}else{
		echo '<div class="crear-campana">
		<a href="nueva-campana.php" target="_top">
			<span>
				<i class="fa fa-plus"></i>
				crear nueva campaña
			</span>
		</a>
	</div>';
	}
?>

	<script type="text/javascript" src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
	<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>