<?php

	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='nueva-campana.php'){
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
						<div>crear nueva campaña</div>
					</span>
				</a>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){

					var $animation_elements = $(".crear-campana");
					var $window = $(window);

					function check_if_in_view(){
					  var window_top_position = $window.scrollTop();

					  $.each($animation_elements, function(){

					    if(window_top_position > 99){
							$animation_elements.removeClass("pixelBorder").addClass("percentBorder");
					    }
					    if(window_top_position < 99){
							$animation_elements.removeClass("percentBorder").addClass("pixelBorder");
					    }

					  });

					}

					$window.on("scroll resize", check_if_in_view);
					$window.trigger("scroll");

					$(".recientes .content").hide();

					if(document.documentElement.clientWidth >= 1024){
						$(".ver-mas").find("i").addClass("fa-plus");
					}else{
						$(".ver-mas").find("i").addClass("fa-angle-down");
					}

					$(".ver-mas").on("click",function(event){

							$(this).siblings(".content").slideToggle();

							if(document.documentElement.clientWidth >= 1024){
								$(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
								$(".campanas").animate({backgroundColor:"#c7c7c7"},"slow");
							}else{
								$(this).find("i").toggleClass("fa-angle-up fa-angle-down");
								$("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);
							}

					});
					$(".btn_close").on("click",function(){
							$(this).closest(".content").fadeOut();

							if(document.documentElement.clientWidth >= 1024){
								$(".bg-campana, .ver-mas, .sub-titulo").fadeIn();
								$(".campanas").animate({backgroundColor:"#fff"},"slow");
								$(".ver-mas").find("i").addClass("fa-plus");
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
	<div class="alertElim">

		<main class="no-campana" id="boxElim">
			<div class="hrefCamp">
				<i class="fa"></i>
				<h2></h2>
				<p></p>

				<div class="btn_crearcamp noElim"></div>
				<div class="btn_crearcamp siElim"></div>

			</div>
		</main>

		<main class="no-campana" id="boxAlert">
			<div class="hrefCamp">
				<i class="fa"></i>
				<h2></h2>
				<p class="messageAlert"></p>
				<div class="btn_crearcamp" id="clearAlert">
					continuar
				</div>
			</div>
		</main>

	</div>
	<script type="text/javascript" src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
	<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
