<?php

	if(basename($_SERVER['PHP_SELF'])=='index.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='nueva-campana.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia2.php'){
			echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia3.php'){
			echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='influenciador-publico.php'){
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


                    if(document.documentElement.clientWidth >= 1024){
                        $(".ver-mas").on("click",function(event){
                            $(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
                            $(".campanas").animate({backgroundColor:"#eeeef0"},{duration:1000, 
                                complete:function(){

                                    $(".recientes, .cont-campana").css("width","100%");
                                }
                            });

                            $(this).siblings(".content").delay(1005).slideToggle();
                            $(this).siblings(".reach-campana, .reach-campana .sub-titulo").delay(1010).fadeIn();
                        });
                    }else{
                        $(".ver-mas").on("click",function(event){
                            $(this).siblings(".content").slideToggle();
                            $(this).find("i").toggleClass("fa-angle-up fa-angle-down");
                            $("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);
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
				<div id="ico-trash"></div>
				<!--i class="fa"></i-->
				<h2></h2>
				<p></p>

				<div class="btn_crearcamp noElim"></div>
				<div class="btn_crearcamp siElim"></div>

			</div>
		</main>

		<main class="no-campana" id="boxAlert">
			<div class="hrefCamp">
				<div id="ico-handLike"></div>
				<!--i class="fa"></i-->
				<h2></h2>
				<p class="messageAlert"></p>
				<div class="btn_crearcamp" id="clearAlert">
					continuar
				</div>
			</div>
		</main>

	</div>

	<script type="text/javascript" src="js/platform_influencials.min.js"></script>
	<script async type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
	<script async type="text/javascript" src="js/jquery-filestyle.min.js"></script>

	<script type="text/javascript" src="js/svg.min.js"></script>
	<script async type="text/javascript" src="js/svg.easing.min.js"></script>
	<script async>
		//Animate SVG's
		var icoHandLike = SVG('ico-handLike').size('100%','100%').viewbox(0, 0, 150, 150).addClass('likeHand')
		var icoTrash = SVG('ico-trash').size('100%','100%').viewbox(50, 10.468, 29.875, 30.032).addClass('trash');
		
		//PI-Like
		var muneca = icoHandLike.group().hide().front().addClass('grupoMune')

		var mune = muneca.path('M40.401,133.314c0,1.332-0.218,1.55-1.564,1.55H13.761c-1.534,0-1.668-0.253-1.668-1.55V76.338c0-0.896,0.188-1.277,0.262-1.346c0.074-0.069,0.435-0.233,1.301-0.203c0.035,0,0.069,0,0.109,0h25.077c0.04,0,0.074,0,0.114,0c0.787-0.025,1.91,0.124,1.974,0.183c0.074,0.069,0.267,0.455,0.267,1.366l-0.792,55.157v1.821h-0.004V133.314z').addClass('coloGreen')
		var somMune = muneca.path('M13.785,135.289h25.423c1.361,0,1.583-0.035,1.583-1.366l0.792-1.728l-0.792-29.524c-4.508,2.86-10.559,3.325-15.789,3.325h3.241c-10.663,1.361-14.617-5.066-16.2-13.033v41.145C12.044,135.398,12.232,135.289,13.785,135.289z').addClass('coloGreen-sombra')
		var muneSolo = muneca.path('M40.401,133.314c0,1.332-0.218,1.55-1.564,1.55H13.761c-1.534,0-1.668-0.253-1.668-1.55V76.338c0-0.896,0.188-1.277,0.262-1.346c0.074-0.069,0.435-0.233,1.301-0.203c0.035,0,0.069,0,0.109,0h25.077c0.04,0,0.074,0,0.114,0c0.787-0.025,1.91,0.124,1.974,0.183c0.074,0.069,0.267,0.455,0.267,1.366l-0.792,55.157v1.821h-0.004V133.314z').fill('none').stroke({ color: '#134A78', opacity: 1, width: 7, linecap:'round' })
		
		function animaMune(){
			
			muneca.show()

			muneca
				.scale(1, 0.1)
				.opacity(0)
				.animate(1000,SVG.easing.elastic)
				.scale(1, 1)
				.opacity(1)
				.after(function(){
					this
						.animate(300)
						.opacity(0)
				})
		}
		
		var mano = icoHandLike.group().hide().back().addClass('grupoHand')

		var hand = mano.path('M52.079,74.997c-1.677,1.213-4.409,2.312-5.992,3.267v51.55c3.959,2.51,9.337,3.864,14.79,4.656H119.6c0.01,0.001,0.021,0.003,0.03,0.004h1.084c1.634,0,2.854-0.554,4.077-1.781l0.51-0.52c0.752-0.99,1.158-2.197,1.242-3.662c-0.016-1.594-0.544-2.801-1.752-4.008c-1.732-1.732-2.514-2.36-2.736-2.524c-1.371-0.698-2.062-2.315-1.563-3.819c0.524-1.578,2.167-2.465,3.756-2.078c0.241-0.06,0.489-0.094,0.747-0.094c1.439,0,2.688-0.49,3.811-1.49l0.4-0.479c0.016-0.015,0.025-0.03,0.04-0.045c0.815-0.944,1.267-2.128,1.366-3.612c-0.1-1.603-0.629-2.811-1.672-3.785c-0.069-0.063-0.14-0.134-0.198-0.207c-0.485-0.55-1.029-0.931-1.707-1.203c-1.455-0.584-2.267-2.143-1.905-3.666c0.361-1.524,1.781-2.559,3.346-2.431l1.143,0.095c1.554-0.025,2.746-0.534,3.855-1.644l0.029-0.03c1.084-1.257,1.613-2.548,1.613-3.943c0-1.608-0.51-2.836-1.643-3.979c-0.882-0.881-1.936-1.371-3.094-1.583c-1.499-0.282-2.73-1.588-2.73-3.112v-0.43c0-1.655,1.426-3.032,3.08-3.151l1.564-0.108c0.074-0.005,0.188-0.01,0.262-0.01c1.479,0,2.682-0.455,3.633-1.391c0.939-1.019,1.449-2.191,1.568-3.662c-0.084-0.811-0.089-2.25-0.089-5.933c-0.233-1.084-0.673-1.821-1.425-2.573c-0.866-0.865-2.643-1.231-5.146-1.231H88.146c-1.283,0-2.435-0.866-2.924-2.05c-0.49-1.182-0.219-2.592,0.688-3.497c2.646-2.647,4.211-5.884,4.66-9.585c0.08-0.866,0.193-5.205,0.199-13.79l-2.736-18.536c-0.203-0.96-0.653-1.776-1.371-2.494c-1.004-1.004-1.955-1.391-3.286-1.326c-0.099,0.006-0.203,0.006-0.302,0c-1.336-0.068-2.355,0.332-3.206,1.247c-0.025,0.024-0.05,0.054-0.074,0.079c-1.004,1.004-1.346,1.959-1.282,3.286c0,0.049,0.049,0.104,0.049,0.153v0.108c0,0.193-0.063,0.386-0.099,0.574l-3.667,19.812c-0.025,0.144-0.074,0.287-0.119,0.426c-5.191,15.666-12.781,27.127-22.588,34.211').addClass('coloGrey')
		var handSom = mano.path('M66.671,118.268c-10.228-9.471-16.814-29.08-14.592-43.242c-1.677,1.212-4.409,2.311-5.992,3.266v51.55c3.959,2.51,9.337,3.864,14.79,4.656h58.744c-6.66-0.792-13.617-2.078-19.694-3.137c-11.084-2.375-24.543-5.176-33.251-13.094H66.671z').addClass('coloGrey-sombra')
		var handSolo = mano.path('M82.789,15.1c0.094,0,0.188,0.002,0.285,0.007c0.049,0.003,0.1,0.004,0.15,0.004s0.102-0.001,0.151-0.004c0.095-0.004,0.187-0.007,0.277-0.007c1.188,0,2.076,0.4,3.009,1.333c0.718,0.718,1.168,1.534,1.371,2.494l2.736,18.536c-0.006,8.585-0.119,12.924-0.199,13.79c-0.449,3.701-2.014,6.938-4.66,9.585c-0.907,0.905-1.178,2.315-0.688,3.497c0.488,1.184,1.641,2.05,2.924,2.05h42.949c2.504,0,4.28,0.366,5.146,1.231c0.752,0.752,1.191,1.489,1.425,2.573c0,3.683,0.005,5.122,0.089,5.933c-0.119,1.471-0.629,2.644-1.568,3.662c-0.951,0.936-2.153,1.391-3.633,1.391c-0.074,0-0.188,0.005-0.262,0.011l-1.564,0.107c-1.653,0.119-3.08,1.496-3.08,3.15v0.431c0,1.524,1.231,2.83,2.73,3.112c1.158,0.212,2.212,0.701,3.094,1.582c1.133,1.144,1.644,2.371,1.644,3.979c0,1.396-0.529,2.687-1.613,3.943l-0.028,0.03c-1.109,1.109-2.302,1.619-3.855,1.644l-1.143-0.095c-0.088-0.007-0.176-0.011-0.263-0.011c-1.459,0-2.743,1.003-3.084,2.441c-0.362,1.522,0.45,3.082,1.905,3.666c0.678,0.272,1.222,0.653,1.707,1.203c0.058,0.073,0.129,0.144,0.197,0.207c1.043,0.974,1.572,2.182,1.672,3.784c-0.098,1.484-0.551,2.668-1.365,3.613c-0.016,0.015-0.023,0.029-0.04,0.045l-0.399,0.479c-1.123,1-2.373,1.49-3.812,1.49c-0.259,0-0.507,0.033-0.747,0.094c-0.25-0.061-0.502-0.09-0.75-0.09c-1.329,0-2.564,0.839-3.006,2.168c-0.499,1.504,0.191,3.121,1.562,3.818c0.223,0.164,1.004,0.793,2.736,2.524c1.208,1.207,1.736,2.414,1.752,4.008c-0.084,1.466-0.49,2.673-1.242,3.662l-0.51,0.521c-1.223,1.227-2.443,1.781-4.077,1.781h-1.084c-0.009-0.002-0.021-0.004-0.03-0.005H60.877c-5.453-0.792-10.831-2.146-14.79-4.655V78.264c1.583-0.955,6.001-3.261,6.001-3.261c7.613-5.5,16.464-15.73,22.588-34.211c0.045-0.139,0.094-0.282,0.119-0.426l3.667-19.812c0.036-0.188,0.099-0.381,0.099-0.574v-0.108c0-0.049-0.049-0.104-0.049-0.153c-0.063-1.327,0.278-2.282,1.282-3.286c0.024-0.025,0.049-0.055,0.074-0.079C80.657,15.505,81.592,15.1,82.789,15.1 M82.789,8.1c-3.109,0-5.867,1.181-7.979,3.416c-0.027,0.028-0.053,0.056-0.08,0.084c-2.196,2.25-3.279,4.962-3.223,8.069L67.972,38.77c-5.715,17.159-13.731,25.916-19.596,30.275c-1.253,0.658-4.456,2.351-5.905,3.225l-3.384,2.042v3.952v51.551v3.851l3.252,2.062c4.302,2.727,10.037,4.582,17.532,5.671l0.5,0.072h0.506h57.971l0.022,0.005h0.76h1.084c3.455,0,6.495-1.292,9.035-3.84l0.021-0.021l0.021-0.022l0.51-0.521l0.307-0.312l0.266-0.349c1.599-2.104,2.493-4.627,2.657-7.498l0.014-0.234l-0.002-0.234c-0.026-2.636-0.796-5.021-2.293-7.116c0.776-0.447,1.517-0.981,2.212-1.601l0.387-0.344l0.332-0.398l0.13-0.156l0.049-0.045l0.237-0.293c1.794-2.107,2.804-4.687,2.999-7.669l0.03-0.446l-0.028-0.447c-0.128-2.061-0.655-3.915-1.573-5.548c0.851-0.522,1.65-1.158,2.4-1.908l0.083-0.083l0.08-0.085l0.096-0.104l0.12-0.136c2.198-2.549,3.312-5.414,3.312-8.516c0-2.838-0.835-5.368-2.486-7.545c0.516-0.365,1.005-0.775,1.466-1.229l0.122-0.119l0.115-0.125c2.011-2.181,3.155-4.819,3.4-7.843l0.052-0.644l-0.066-0.643c-0.052-0.501-0.052-2.79-0.052-5.212v-0.745l-0.157-0.729c-0.504-2.342-1.589-4.32-3.318-6.049c-2.944-2.942-7.172-3.282-10.096-3.282H95.406c1.087-2.269,1.801-4.718,2.113-7.289l0.012-0.099l0.01-0.1c0.136-1.473,0.224-7.002,0.229-14.43v-0.517l-0.075-0.511l-2.736-18.536l-0.031-0.214l-0.045-0.212c-0.485-2.293-1.586-4.31-3.27-5.995C89.368,9.239,86.69,8.1,83.653,8.1c-0.14,0-0.282,0.002-0.426,0.007C83.08,8.102,82.934,8.1,82.789,8.1L82.789,8.1z').addClass('coloBlue-lines')

		function animaMano(){
			
			mano.show()

			mano
				.opacity(0)
				.rotate(45, 100, 50)
				.animate(800, SVG.easing.elastic,'.2s')
				.opacity(1)
				.rotate(45, 50, 50)
				.after(function(){
					this
						.animate(300)
						.opacity(0)
				})
		}
		//PI-Trash
		var tapa = icoTrash.group().addClass('grupoTapa');
		var tarr = icoTrash.group().addClass('grupoTarr');
		var trashis = icoTrash.group().back();
			//Manga
			var manga1 = tapa.path('M59.495,15.308v-1.401c0-1.533,0.745-2.278,2.278-2.278h6.18c0.595,0,1.097,0.127,1.493,0.378c0.538,0.383,0.785,0.998,0.785,1.9v1.401H59.495z').addClass('coloGrey');
			var manga2 = tapa.path('M62.548,12.228c0.004,0,0.007,0.001,0.01,0.001h5.396c0.479,0,0.874,0.096,1.173,0.285c0.34,0.243,0.506,0.698,0.506,1.393v0.801h-9.537v-0.801c0-1.192,0.486-1.678,1.679-1.678h0.762c0.004,0,0.009,0,0.011-0.001C62.547,12.228,62.548,12.228,62.548,12.228 M62.548,11.028h-0.151l-0.005,0.001h-0.618c-1.856,0-2.879,1.022-2.879,2.878v0.801v1.2h1.2h9.537h1.2v-1.2v-0.801c0-1.094-0.34-1.891-1.009-2.369l-0.027-0.02L69.768,11.5c-0.494-0.312-1.104-0.471-1.814-0.471h-5.278l-0.003,0L62.548,11.028L62.548,11.028z').addClass('coloBlue-lines');
			var radio = tapa.line(52.738, 15.468, 76.988, 15.468).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10});

			//Tarro
			var tarro = tarr.path('M56.711,39.479c-0.456,0-1.516-0.162-1.516-1.671V15.605h19.336V37.8c-0.035,1.464-0.965,1.68-1.516,1.68H56.711z').addClass('coloGrey');
			var tarro2 = tarr.path('M73.932,16.205V37.8c-0.017,0.675-0.248,1.08-0.916,1.08H56.711c-0.685,0-0.916-0.403-0.916-1.071V16.205H73.932 M75.132,15.005h-1.2H55.795h-1.2v1.2v21.604c0,1.675,1.093,2.271,2.116,2.271h16.305c0.996,0,2.075-0.592,2.115-2.251l0.001-21.624V15.005L75.132,15.005z').addClass('coloBlue-lines');
			var tarroSom = tarr.path('M57.268,36.542V16.205h-1.473v21.793c0,0.681,0.073,0.882,0.768,0.882h16.511c0.677,0,0.858-0.202,0.858-0.89v-0.551H58.184C57.489,37.439,57.268,37.225,57.268,36.542z').addClass('coloGrey-sombra');

			var lineTarr = tarr.line(60.363, 34.668, 60.363, 19.668).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10});
			var lineTarr2 = tarr.line(69.363, 34.668, 69.363, 19.668).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10});
			var lineTarr3 = tarr.line(64.863, 34.668, 64.863, 19.668).fill('none').stroke({color:'#134A78',width:1.2, linecap:'round',miterlimit:10});
			
			//Basurita
			var trashisMove = trashis.rect(6,6).cx(50).cy(5).addClass('coloGreen');

		function animaTrash(){

			tapa
				.rotate(0,76.988,15.468)
				.animate(300,'>')
				.rotate(45,76.988,15.468)
				.after(function(){
					tarr
						.rotate(0,150,50)
						.animate(600,SVG.easing.bounce,'.6s')
						.rotate(-2,150,50).after(function(){
							this
								.animate(300,'>')
								.rotate(-2,150,50);
							tapa
								.animate(300,'>')
								.rotate(45,76.988,15.468);
						});
				});

			trashisMove
				.opacity(0)
				.rotate(0,30,40)
				.animate(800,'<','.4s')
				.opacity(1)
				.rotate(35,100,30);
		}
	</script>
