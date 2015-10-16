<?php

	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='nueva-campana.php'){
		echo '<div class="alertElim">
			<main class="no-campana" id="boxElim">
				<div class="hrefCamp">
					<i class="fa fa-thumbs-o-up"></i>
					<h2>Campaña creada con exito</h2>
					<p>
						Puedes ver o seguir creando más campañas.
					</p>
					<div class="btn_crearcamp noElim">
						crear otra campaña
					</div>
					<div class="btn_crearcamp siElim">
						ver campaña
					</div>
				</div>
			</main>

			<main class="no-campana" id="boxAlert">
				<div class="hrefCamp">
					<i class="fa fa-warning"></i>
					<h2>Algo anda mal</h2>
					<p>
						Tu imagen puede que supere el tamaño permitido, el formato no corresponde o no hay nada adjunto.
					</p>
					<div class="btn_crearcamp" id="clearAlert">
						continuar
					</div>
				</div>
			</main>

		</div>';
	}else if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='campana.php'){
		echo '

			<div class="alertElim">
				<main class="no-campana" id="boxElim">
					<div class="hrefCamp">
						<i class="fa fa-trash-o"></i>
						<h2>Estas a punto de eliminar la campaña</h2>
						<p>
							Si eliminas tu campaña, pederas tus datos sin posibilidad de recuperarlos.
						</p>
						<div class="btn_crearcamp noElim">
							cancelar
						</div>
						<div class="btn_crearcamp siElim">
							eliminar campaña
						</div>
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
								$(".ver-mas").find("i").toggleClass("fa-angle-up fa-plus");
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
