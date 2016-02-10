<?php
	require('./controller/conexion.php');

	if(isset($_SESSION['nombre'])==false){
		header('Location:index.php');
		die();
	}

	function muestra_header(){
		echo '<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="theme-color" content="#2c327c">
			<title></title>
			<link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
			<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
			<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
			<link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
			<link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
			<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
			<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
			<meta name="application-name" content="Power Influencer"/>
			<meta name="msapplication-TileColor" content="#FFFFFF" />
			<meta name="msapplication-TileImage" content="img/mstile-144x144.png" />

			<link rel="stylesheet" href="css/platform_influencials.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
            
            <script>
              (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

              ga("create", "UA-45276685-8", "auto");
              ga("send", "pageview");

            </script>
            
			<script type="text/javascript" src="js/jquery.min.js"></script>
			<script type="text/javascript" src="js/jquery-ui.min.js"></script>
            
            <script>
                $(document).ready(function(){
                    $(window).load(function(){
                        $("#imagenform-ipe").fadeIn();
                    });
                });
            </script>
		';
	}

	function inscripcion_error(){
		echo 'if(data == "existe"){
        	$(".alertElim").fadeIn("normal",function(){
				$("#boxElim .hrefCamp h2").text("La cuenta ya existe");
				$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
				$("#boxElim .hrefCamp p").text("Este perfil ya se encuentra asociado a una cuenta");
				$(".siElim").text("Ir a perfil");
				$(".noElim").text("Continuar en Redes Sociales");

				$("#boxElim").show().animate({
					top:"20%",
					opacity:1
				},{duration:1500,easing:"easeOutBounce"});

				$(".siElim").on("click",function(){

					window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
					window.location.reload();
					
				});

				$(".noElim").on("click",function(){
					$("#boxElim").animate({
						top:"-100px",
						opacity:0
					},{duration:500,easing:"easeInOutQuint",complete:function(){
						$(".alertElim").fadeOut("fast");
						$(this).hide();
						window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
						
					}});
				});
			});
        }else if(data == "otro"){
        	$(".alertElim").fadeIn("normal",function(){
				$("#boxElim .hrefCamp h2").text("La cuenta ya existe");
				$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
				$("#boxElim .hrefCamp p").text("Este perfil ya se encuentra asociado a una cuenta");
				$(".siElim").text("Ir a perfil");
				$(".noElim").text("Continuar en Redes Sociales");

				$("#boxElim").show().animate({
					top:"20%",
					opacity:1
				},{duration:1500,easing:"easeOutBounce"});

				$(".siElim").on("click",function(){

					window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
					window.location.reload();
					
				});

				$(".noElim").on("click",function(){
					$("#boxElim").animate({
						top:"-100px",
						opacity:0
					},{duration:500,easing:"easeInOutQuint",complete:function(){
						$(".alertElim").fadeOut("fast");
						$(this).hide();
						window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
						
					}});
					
				});
			});
        } ';
	}
	function inscripcion_facebook(){
		echo ' if(data == "exito"){
				$(".alertElim").fadeIn("normal",function(){
					$("#boxElim .hrefCamp h2").text("Red Social agregada");
					$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
					$("#boxElim .hrefCamp p").text("Las páginas asociadas a esta cuenta han sido agregadas");
					$(".siElim").text("Ir a perfil");
					$(".noElim").text("Continuar en Redes Sociales");

					$("#boxElim").show().animate({
						top:"20%",
						opacity:1
					},{duration:1500,easing:"easeOutBounce"});

					$(".siElim").on("click",function(){

						window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
						window.location.reload();
						
					});

					$(".noElim").on("click",function(){
						$("#boxElim").animate({
							top:"-100px",
							opacity:0
						},{duration:500,easing:"easeInOutQuint",complete:function(){
							$(".alertElim").fadeOut("fast");
							$(this).hide();
							window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
							
						}});
					});
				});
            }';
            inscripcion_error();

	}
	function inscripcion_twitter(){
		echo 'var data= "'.$_SESSION["data"].'";
			if(data == "exito"){
				$(".alertElim").fadeIn("normal",function(){
					$("#boxElim .hrefCamp h2").text("Red Social agregada");
					$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
					$("#boxElim .hrefCamp p").text("Las páginas asociadas a esta cuenta han sido agregadas");
					$(".siElim").text("Ir a perfil");
					$(".noElim").text("Continuar en Redes Sociales");

					$("#boxElim").show().animate({
						top:"20%",
						opacity:1
					},{duration:1500,easing:"easeOutBounce"});

					$(".siElim").on("click",function(){
						window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
						window.location.reload();
						
					});

					$(".noElim").on("click",function(){
						$("#boxElim").animate({
							top:"-100px",
							opacity:0
						},{duration:500,easing:"easeInOutQuint",complete:function(){
							$(".alertElim").fadeOut("fast");
							$(this).hide();
							window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
							
						}});
					});
				});
            }';
            inscripcion_error();
            unset($_SESSION['data']);

	}
	function inscripcion_instagram(){
		echo ' if(data == "exito"){
				$(".alertElim").fadeIn("normal",function(){
					$("#boxElim .hrefCamp h2").text("Red Social agregada");
					$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
					$("#boxElim .hrefCamp p").text("Las páginas asociadas a esta cuenta han sido agregadas");
					$(".siElim").text("Ir a perfil");
					$(".noElim").text("Continuar en Redes Sociales");

					$("#boxElim").show().animate({
						top:"20%",
						opacity:1
					},{duration:1500,easing:"easeOutBounce"});

					$(".siElim").on("click",function(){

						window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
						window.location.reload();
						
					});

					$(".noElim").on("click",function(){
						$("#boxElim").animate({
							top:"-100px",
							opacity:0
						},{duration:500,easing:"easeInOutQuint",complete:function(){
							$(".alertElim").fadeOut("fast");
							$(this).hide();
							window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
							
						}});
					});
				});
            }';
            inscripcion_error();

	}
	function inscripcion_analytics(){
		echo ' if(data == "exito"){
				$(".alertElim").fadeIn("normal",function(){
					$("#boxElim .hrefCamp h2").text("Red Social agregada");
					$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
					$("#boxElim .hrefCamp p").text("Las páginas asociadas a esta cuenta han sido agregadas");
					$(".siElim").text("Ir a perfil");
					$(".noElim").text("Continuar en Redes Sociales");

					$("#boxElim").show().animate({
						top:"20%",
						opacity:1
					},{duration:1500,easing:"easeOutBounce"});

					$(".siElim").on("click",function(){

						window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
						window.location.reload();
						
					});

					$(".noElim").on("click",function(){
						$("#boxElim").animate({
							top:"-100px",
							opacity:0
						},{duration:500,easing:"easeInOutQuint",complete:function(){
							$(".alertElim").fadeOut("fast");
							$(this).hide();
							window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
							
						}});
					});
				});
            }';
            inscripcion_error();

	}
    function inscripcion_youtube(){
		echo ' if(data == "exito"){
				$(".alertElim").fadeIn("normal",function(){
					$("#boxElim .hrefCamp h2").text("Red Social agregada");
					$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
					$("#boxElim .hrefCamp p").text("Las páginas asociadas a esta cuenta han sido agregadas");
					$(".siElim").text("Ir a perfil");
					$(".noElim").text("Continuar en Redes Sociales");

					$("#boxElim").show().animate({
						top:"20%",
						opacity:1
					},{duration:1500,easing:"easeOutBounce"});

					$(".siElim").on("click",function(){

						window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
						window.location.reload();
						
					});

					$(".noElim").on("click",function(){
						$("#boxElim").animate({
							top:"-100px",
							opacity:0
						},{duration:500,easing:"easeInOutQuint",complete:function(){
							$(".alertElim").fadeOut("fast");
							$(this).hide();
							window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
							
						}});
					});
				});
            }';
            inscripcion_error();

	}
	function inscripcion_googleplus(){
		echo ' if(data == "exito"){
				$(".alertElim").fadeIn("normal",function(){
					$("#boxElim .hrefCamp h2").text("Red Social agregada");
					$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
					$("#boxElim .hrefCamp p").text("Las páginas asociadas a esta cuenta han sido agregadas");
					$(".siElim").text("Ir a perfil");
					$(".noElim").text("Continuar en Redes Sociales");

					$("#boxElim").show().animate({
						top:"20%",
						opacity:1
					},{duration:1500,easing:"easeOutBounce"});

					$(".siElim").on("click",function(){

						window.location.assign("http://powerinfluencer.com/app/escritorio-influencer.php#fragment-1");
						window.location.reload();
						
					});

					$(".noElim").on("click",function(){
						$("#boxElim").animate({
							top:"-100px",
							opacity:0
						},{duration:500,easing:"easeInOutQuint",complete:function(){
							$(".alertElim").fadeOut("fast");
							$(this).hide();
							window.location.href = "http://powerinfluencer.com/app/escritorio-influencer.php#fragment-2";
							
						}});
					});
				});
            }';
          	inscripcion_error();

	}

	if(basename($_SERVER['PHP_SELF'])!='formulario-ipe.php'){
		if(isset($_SESSION['nombre'])==false ||isset($_SESSION['region'])==false ||isset($_SESSION['comuna'])==false){
			header('Location:index.php');
			die();
		} 
			if(basename($_SERVER['PHP_SELF'])=='dashboard-ipe.php'){
				require('rrss/twitter/inc/twitteroauth.php');
				require('rrss/twitter/inc/TwitterAPIExchange.php');
				require('rrss/rrss_keys.php');
				include('rrss/googleplus/auth.php');
				include('rrss/analytics/procesar_analytics.php');
				include('rrss/facebook/facebook-auth.php');
				include('rrss/instagram/instagram.php');
				include('rrss/youtube/auth.php');
				muestra_header();

				echo "
				<nav class='nav-ipe'>
					<ul class='nav-mobile'>
						<li><i onClick='backHistory()' class='pi pi-arrow-left'></i></li>
						<li><h1>".$_SESSION['descripcion_tipo']."</h1></li>
						<li><a href='./controller/logout' class='pi pi-singout'></a></li>
					</ul>
					<ul class='nav-deskt'>
					    <li></li>
					    <li><a href='./controller/logout' target='_self'><i class='pi pi-singout'></i> Cerrar sesión</a></li>
					    <li><i class='pi pi-help'></i> <i class='pi pi-bell'></i></li>
					</ul>
				</nav>
				<nav class='header-ipe'>
					<ul>
						<li><i onClick='backHistory()' class='pi pi-arrow-left'></i></li>
						<li><a href='escritorio-influencer'><i class='pi pi-pencil'></i> Escritorio</a></li>
						<li><a href='campanas-inscritas'><i class='pi pi-bullhorn'></i> campañas</a></li>
					</ul>
				</nav>
				<script>
					jQuery(document).ready(function(){
						$('title').append('Dashboard - ".$_SESSION['nombre']."');
						$('html').css({'background-color':'#fff','background-image':'none'});
						$('body').addClass('dashboard-ipe');
		                

						var correo,nombre,correo,tel1,tel2,empresa;
						var rsid = $('#RsId').val();
						if (rsid != ''){
						$('#correo input').removeAttr('disabled');
						}
						var foto=0;
							$('#file').click(function(){
								foto=1;
						});
					});
				</script>
				<script src='https://apis.google.com/js/client.js?onload=googleApiClientReady'></script>
				<script src='https://www.google.com/jsapi'></script>
				<script id='facebook-sdk' src='js/facebook-login.js'></script>
					
				</head>
				<body>";
			}

			if(basename($_SERVER['PHP_SELF'])=='campanas-ipe.php'){
				muestra_header();
				echo "
				<nav class='nav-ipe'>
					<ul class='nav-mobile'>
						<li><i onClick='backHistory()' class='pi pi-arrow-left'></i></li>
						<li><h1>".$_SESSION['descripcion_tipo']."</h1></li>
						<li><a href='./controller/logout' class='pi pi-singout'></a></li>
					</ul>
					<ul class='nav-deskt'>
					    <li></li>
					    <li><a href='./controller/logout' target='_self'><i class='pi pi-singout'></i> Cerrar sesión</a></li>
					    <li><i class='pi pi-help'></i> <i class='pi pi-bell'></i></li>
					</ul>
				</nav>
				<nav class='header-ipe'>
					<ul>
						<li><i onClick='backHistory()' class='pi pi-arrow-left'></i></li>
						<li><a href='escritorio-influencer'><i class='pi pi-pencil'></i> Escritorio</a></li>
						<li><a href='campanas-inscritas'><i class='pi pi-bullhorn'></i> campañas</a></li>
					</ul>
				</nav>
				<script>
					$(document).ready(function(){
						var correo,nombre,correo,tel1,tel2,empresa;
						var rsid = $('#RsId').val();
						if (rsid != ''){
						$('#correo input').removeAttr('disabled');
						}
						var foto=0;
							$('#file').click(function(){
								foto=1;
						});
		                $('.recientes .content').hide();

		                if(document.documentElement.clientWidth >= 1024){
		                    $('.ver-mas').find('i').addClass('pi-plus');
		                }else{
		                    $('.ver-mas').find('i').addClass('pi-arrow-bottom');
		                }


		                if(document.documentElement.clientWidth >= 1024){
		                    $('.ver-mas').on('click',function(event){
		                        $('.bg-campana, .ver-mas, .sub-titulo').fadeOut();
		                        $('.campanas-ipe').animate({backgroundColor:'#eeeef0'},{duration:1000, 
		                            complete:function(){

		                                $('.recientes, .cont-campana').css('width','100%');
		                            }
		                        });

		                        $(this).siblings('.content').delay(1005).slideToggle();
		                        $(this).siblings('.reach-campana, .reach-campana .sub-titulo').delay(1010).fadeIn();
		                    });
		                }else{
		                    $('.ver-mas').on('click',function(event){
		                        $(this).siblings('.content').slideToggle();
		                        $(this).find('i').toggleClass('pi-arrow-top pi-arrow-bottom');
		                        $('html,body').animate({scrollTop : $(this).siblings('.bg-campana').offset().top},1000);
		                        
		                        $(this).siblings('.reach-campana, .reach-campana .sub-titulo').delay(1010).fadeIn();
		                    });
		                }

		                $('.content .btn_close').on('click',function(){
		                    $(this).closest('.content').fadeOut();
		                    $('.reach-campana, .reach-campana .sub-titulo').delay(100).fadeOut();
		                    if(document.documentElement.clientWidth >= 1024){
		                        $('.campanas-ipe').animate({backgroundColor:'#fff'},{duration:1000,complete:function(){

		                            $('.recientes, .cont-campana').removeAttr('style','');
		                            $('.bg-campana, .ver-mas, .sub-titulo').delay(800).fadeIn();
		                        }});
		                        $('.ver-mas').find('i').addClass('pi-plus');
		                    }
		                });
					});
				</script>
				<script src='https://apis.google.com/js/client.js?onload=googleApiClientReady'></script>
				<script id='facebook-sdk' src='js/facebook-login.js'></script>
					<script>
						jQuery(document).ready(function(){
							$('title').append('Dashboard - ".$_SESSION['nombre']."');
							$('html').css({'background-color':'#fff','background-image':'none','height':'100%'});
							$('body').addClass('campanas-ipe');
						})
					</script>

				</head>
				<body>";
			}
	 }else{
			muestra_header();
			echo "<nav class='nav-ipe'>
					<ul class='nav-mobile'>
						<li><i onClick='backHistory()' class='pi pi-arrow-left'></i></li>
						<li><h1>".$_SESSION['descripcion_tipo']."</h1></li>
						<li><a href='./controller/logout' class='pi pi-singout'></a></li>
					</ul>
					<ul class='nav-deskt'>
					    <li></li>
					    <li><a href='./controller/logout' target='_self'><i class='pi pi-singout'></i> Cerrar sesión</a></li>
					    <li><i class='pi pi-help'></i> <i class='pi pi-bell'></i></li>
					</ul>
				</nav>
						<script id='facebook-sdk' src='js/facebook-login.js'></script>
							<script>
								jQuery(document).ready(function(){
									$('title').append('Dashboard - ".$_SESSION['nombre']."');
									$('html').css({'background-color':'#fff','background-image':'none'});
									$('body').addClass('campanas-ipe');
								})
							</script>
						</head>
						<body>";

	} ?>