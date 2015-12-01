<?php
	include('conexion.php');

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
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		';
	}

	if(basename($_SERVER['PHP_SELF'])=='dashboard-ipe.php'){
		muestra_header();

		echo "
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
		";
		require('conexion.php');
		require('rrss/twitter/inc/twitteroauth.php');
		require('rrss/twitter/inc/TwitterAPIExchange.php');
		require('rrss/instagram/instagram.php');
		require('rrss/Facebook/facebook-auth.php');
		require('rrss/googleplus/auth.php');
		require('rrss/youtube/auth.php');
		require('rrss/analytics/procesar_analytics.php');

		if(isset($_SESSION['nombre'])==false){
			header('Location:index.php');
			die();
		}

		echo "<script id='facebook-sdk' src='js/facebook-login.js'></script>
			
		</head>
		<body>";
	}

	if(basename($_SERVER['PHP_SELF'])=='campanas-ipe.php'){
		muestra_header();
		echo "
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
			});
		</script>
		<script src='https://apis.google.com/js/client.js?onload=googleApiClientReady'></script>
		";


		if(isset($_SESSION['nombre'])==false){
			header('Location:index.php');
			die();
		}
		echo "<script id='facebook-sdk' src='js/facebook-login.js'></script>
			<script>
				jQuery(document).ready(function(){
					$('title').append('Dashboard - ".$_SESSION['nombre']."');
					$('html').css({'background-color':'#fff','background-image':'none'});
					$('body').addClass('dashboard-ipe');
				})
			</script>

		</head>
		<body>";
	}


?>
<nav class="nav-ipe">
	<ul>
		<li><i onClick="backHistory()" class="fa fa-chevron-left"></i></li>
		<li><h1><?php echo $_SESSION['descripcion_tipo']?></h1></li>
		<li><a href="logout.php" class="fa fa-close"></a></li>
	</ul>
</nav>