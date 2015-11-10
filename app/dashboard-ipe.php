<html>
<head>
	<meta  charset="UTF-8" >
	<title>dashboard - <?php echo $_SESSION['nombre']; ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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

	<style>
		input{
		border:none;
		background-color:#fff;
		color:#000;
		cursor:pointer;
		font-family: 'Impact',Courier,Sans-Serif;
		}
		.alert{
			color:red;
			background-color:rose;
			border:1px solid red;
		}
		.content{
			display:none;
		}
	</style>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
	<?php
		require('conexion.php');
		if(isset($_SESSION['nombre'])==false){
			header('Location:index.php');
			die();
		}
	?>
	<script id="facebook-sdk" src="js/facebook-login.js"></script>
	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	<div style="text-align:right;">
		<a href="logout.php">cerrar sesion</a>
		-
		<a href>ayuda</a>
	</div>
	<h2>dashboard</h2>
	<form id='imagenform-ipe'>
		<div id="inicio" disabled>
		<h2>datos personales</h2>
		<div id="nombre">
			<input value="<?php echo $_SESSION['nombre']; ?>">
		</div>
		<img src="<?php echo $_SESSION['pictureUrl'];?>" width="100" height="auto">
		<input type="file" name="file" id="file">
		<input id="RsId" style="display:none" value="<?php echo $_SESSION['rsid']; ?>">
		<div id="empresa">
			<input value="<?php echo $_SESSION['empresa']; ?>">
		</div>

		<div id="descripcion" >	
			<textarea rows="10" cols="40"><?php echo $_SESSION['descripcion']; ?></textarea>
		</div>
	<h2>datos de facturaci&oacuten </h2>
			<div id="correo">
				<input value="<?php echo $_SESSION['correo']; ?>" disabled>
			</div>
			<div id="tel1">
				<input type="text"  onkeypress="return valida(event)" maxlength="11" value="<?php echo $_SESSION['telefono1']; ?>">
			</div>
			<div id="tel2">
				<input type="text"  onkeypress="return valida(event)" maxlength="11" value="<?php echo $_SESSION['telefono2']; ?>">
			</div>
			<button id="guardarFacturacion" type="submit">guardar</button>
		</div>
	</form>
	<div id = "redes sociales">
		<h2>registra tus redes sociales</h2>  
			<button id="facebook-inscription" class="rs-inscription" onclick="checkAuthFacebookPages()">Facebook</button>
			<a id= "twitter-inscription" class="rs-inscription" href="./rrss/twitter/process.php" value="<?php echo $num_row3;?>" >twitter</a>
			<button class="rs-inscription" onclick="login()">Instagram</button>
			<button id="youtube-inscription" class="rs-inscription" onclick="checkAuthYoutube()">Youtube</button>	
			<button id="analytics-inscription" class="rs-inscription">Analytics</button>
			<button id="googleplus-inscription" class="rs-inscription" onclick="checkAuthGooglePlus()">Google+</button>
	</div>	
	<?php 
		require("rrss/twitter/inc/twitteroauth.php");
		require('rrss/twitter/inc/TwitterAPIExchange.php');
		require('rrss/instagram/instagram.php');
		require('rrss/Facebook/facebook-auth.php');
		require('rrss/googleplus/auth.php');
		include_once('procesar_mostrar_cuentas.php');
		include ('footer-ipe.php');
	?>
</body>
</html>	