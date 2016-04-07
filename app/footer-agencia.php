<?php
	function scriptsCampana(){
		echo '
		<div class="crear-campana">
			<a href="nueva-campana-agencia.php" target="_top">
				<span>
					<i class="pi pi-plus"></i>
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

				$(".volver, .recientes .content").hide();

				$(".recientes .content").hide();

				if(document.documentElement.clientWidth >= 1024){
					$(".ver-mas").on("click",function(event){
						$(this).siblings(".btn_close").fadeIn();
					    $(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
					    $(".dashboard-agencia").animate({backgroundColor:"#eeeef0"},{duration:1000, 
					        complete:function(){

					            $(".recientes, .cont-campana").css("width","100%");
					        }
					    });

					    $(this).siblings(".content").slideDown();
					    $(this).siblings(".reach-campana").delay(1010).slideDown(function(){
					    	$(".reach-campana .sub-titulo").fadeIn();
					    });
					});
				}else{
					$(".ver-mas").on("click",function(event){
					    $(this).siblings(".content").slideDown();
					    //$(this).find("i").toggleClass("pi-arrow-top pi-arrow-bottom");
					    $("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);
					    
					    $(this).siblings(".reach-campana").delay(1010).slideDown(function(){
					    	$(".reach-campana .sub-titulo").fadeIn();
					    });

					    $(this).siblings(".btn_close").fadeIn();
					    $(this).fadeOut();
					});
				}

				$(".btn_close").on("click",function(){
					$(this).siblings(".content").slideUp();
				    $(this).siblings(".reach-campana").delay(100).slideUp(function(){
				    	$(".reach-campana .sub-titulo").fadeOut();
				    });
					if(document.documentElement.clientWidth >= 1024){
						$(".dashboard-agencia").animate({backgroundColor:"#fff"},{duration:1000,complete:function(){
				        
				            $(".recientes, .cont-campana").removeAttr("style","");
						    $(".bg-campana, .ver-mas, .sub-titulo").delay(800).fadeIn();
				        }});

						$(".ver-mas").find("i").addClass("pi-plus");
					}
					$(this).fadeOut();
					$(this).siblings(".ver-mas").fadeIn();
				});
			});

		</script>';
	}

	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='nueva-campana-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		scriptsCampana();
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-red-social-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia2.php'){
        echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-ipe.php'){
        echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='influenciador-publico-agencia.php'){
        echo '';
    }else if(basename($_SERVER['PHP_SELF'])=='perfil-influenciador-publico-agencia.php'){
        echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='campana-agencia.php'){
		scriptsCampana();
	}else{
		echo '<div class="crear-campana">
		<a href="nueva-campana-agencia.php" target="_top">
			<span>
				<i class="pi pi-plus"></i>
				crear nueva campaña
			</span>
		</a> 
	</div>';
	}
?>
	<div class="alertElim">
		<main class="no-campana" id="boxAlert">
			<div class="hrefCamp">
				<h2></h2>
				<p class="messageAlert"></p>
			</div>
		</main>

	</div>
	<?php 
	if(basename($_SERVER['PHP_SELF'])=='perfil-influenciador-publico-agencia.php'){
		echo '	<script type="text/javascript" src="../../js/platform_influencials.min.js"></script>
				<script async type="text/javascript" src="../../js/animas.js"></script>
				<script async type="text/javascript" src="../../js/form-passes.js"></script>
				<script type="text/javascript" src="../../js/tabs.js"></script>
				<script async type="text/javascript" src="../../js/jquery-filestyle.min.js"></script>

				<script type="text/javascript" src="../../js/svg.min.js"></script>
				<script async type="text/javascript" src="../../js/svg.easing.min.js"></script>';
	}else if(basename($_SERVER['PHP_SELF'])=='influenciador-publico-agencia.php'){
		echo '	<script type="text/javascript" src="../../js/platform_influencials.min.js"></script>
				<script async type="text/javascript" src="../../js/animas.js"></script>
				<script async type="text/javascript" src="../../js/form-passes.js"></script>
				<script type="text/javascript" src="../../js/tabs.js"></script>
				<script async type="text/javascript" src="../../js/jquery-filestyle.min.js"></script>

				<script type="text/javascript" src="../../js/svg.min.js"></script>
				<script async type="text/javascript" src="../../js/svg.easing.min.js"></script>';
	}else{
	?>
	<script type="text/javascript" src="./js/platform_influencials.min.js"></script>
	<script async type="text/javascript" src="./js/animas.js"></script>
	<script async type="text/javascript" src="./js/form-passes.js"></script>
	<script type="text/javascript" src="./js/tabs.js"></script>
	<script async type="text/javascript" src="./js/jquery-filestyle.min.js"></script>

	<script type="text/javascript" src="./js/svg.min.js"></script>
	<script async type="text/javascript" src="./js/svg.easing.min.js"></script>

	<?php } ?>