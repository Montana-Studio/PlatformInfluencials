<?php

	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='nueva-campana-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		echo '';
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

					$(".recientes .content").hide();

					if(document.documentElement.clientWidth >= 1024){
						$(".ver-mas").find("i").addClass("pi-plus");
					}else{
						$(".ver-mas").find("i").addClass("pi-arrow-bottom");
					}


                    if(document.documentElement.clientWidth >= 1024){
                        $(".ver-mas").on("click",function(event){
                            $(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
                            $(".campanas").animate({backgroundColor:"#eeeef0"},{duration:1000, 
                                complete:function(){

                                    $(".recientes, .cont-campana").css("width","100%");
                                }
                            });

                            $(this).siblings(".content").delay(1005).slideToggle();
                            $(this).siblings(".reach-campana, .reach-campana .sub-titulo").delay(1010).slideDown();
                        });
                    }else{
                        $(".ver-mas").on("click",function(event){
                            $(this).siblings(".content").slideToggle();
                            $(this).find("i").toggleClass("pi-arrow-top pi-arrow-bottom");
                            $("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);
                            
                            $(this).siblings(".reach-campana, .reach-campana .sub-titulo").delay(1010).fadeIn();
                        });
                    }
                            
					$(".content .btn_close").on("click",function(){
							$(this).closest(".content").fadeOut();
                            $(".reach-campana, .reach-campana .sub-titulo").delay(100).fadeOut();
							if(document.documentElement.clientWidth >= 1024){
								$(".campanas").animate({backgroundColor:"#fff"},{duration:1000,complete:function(){
                                
                                    $(".recientes, .cont-campana").removeAttr("style","");
								    $(".bg-campana, .ver-mas, .sub-titulo").delay(800).fadeIn();
                                }});
								$(".ver-mas").find("i").addClass("pi-plus");
							}
					});

				});

			</script>';
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
				<script async type="text/javascript" src="../../js/form-passes.js"></script>
				<script type="text/javascript" src="../../js/tabs.js"></script>
				<script async type="text/javascript" src="../../js/jquery-filestyle.min.js"></script>

				<script type="text/javascript" src="../../js/svg.min.js"></script>
				<script async type="text/javascript" src="../../js/svg.easing.min.js"></script>
				<script async>';
	}else if(basename($_SERVER['PHP_SELF'])=='influenciador-publico-agencia.php'){
		echo '	<script type="text/javascript" src="../../js/platform_influencials.min.js"></script>
				<script async type="text/javascript" src="../../js/form-passes.js"></script>
				<script type="text/javascript" src="../../js/tabs.js"></script>
				<script async type="text/javascript" src="../../js/jquery-filestyle.min.js"></script>

				<script type="text/javascript" src="../../js/svg.min.js"></script>
				<script async type="text/javascript" src="../../js/svg.easing.min.js"></script>
				<script async>';
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
	
