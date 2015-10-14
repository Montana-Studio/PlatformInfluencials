<?php 

	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='crear-campanas.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
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
					
					var $animation_elements = $(".crear-campana");
					var $window = $(window);

					function check_if_in_view(){
					  var window_height = $window.height();
					  var window_top_position = $window.scrollTop();
					  var window_bottom_position = (window_top_position + window_height);
					 
					  $.each($animation_elements, function() {
					    var $element = $(this);
					    var element_height = $element.outerHeight();
					    var element_top_position = $element.offset().top;
					    var element_bottom_position = (element_top_position + element_height);
					 
					    //check to see if this current container is within viewport
					    if ((element_bottom_position >= window_top_position) &&
					        (element_top_position <= window_bottom_position)) {
					      $(".crear-campana").animate({
								//backgroundColor: "#f90"
					      });
					    } else {
					      $(".crear-campana").animate({
								backgroundColor: "#fff"
					      });
					    }
					  });
					}

					$window.on("scroll resize", check_if_in_view);
					$window.trigger("scroll");


					$(".recientes .content").hide();

					$(".ver-mas").on("click",function(event){
							
							$(this).siblings(".content").slideToggle();
							
							if(document.documentElement.clientWidth > 1024){
								$(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
								$(".campanas").animate({backgroundColor:"#c7c7c7"},"slow");
							}

							$(this).find("i").toggleClass("fa-angle-up fa-angle-down");
							$("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);

					});
					$(".btn_close").on("click",function(){
							$(this).closest(".content").fadeOut();

							if(document.documentElement.clientWidth > 1024){
								$(".bg-campana, .ver-mas, .sub-titulo").fadeIn();
								$(".campanas").animate({backgroundColor:"#fff"},"slow");
							}
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