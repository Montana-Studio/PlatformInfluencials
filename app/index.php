<?php
require('conexion.php');
if(isset($_SESSION['id'])){
	$query="SELECT * FROM persona WHERE id_estado = 1 AND id= ".$_SESSION['id'];
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$row= mysqli_fetch_array($result, MYSQLI_NUM);
	if ($row[1] == 2){
		header("Location: dashboard-agencia.php");
		die();
	}
}
?>


<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Power Influencer</title>

	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script id="facebook-sdk"src="js/facebook-login.js"></script>

</head>

<body>
	<main class="contAllPI" style="padding-top:30%;">
		
		<div style="display:none;" id="tipoCliente" value="2"></div>

		<!-- ALERTAS -->
		<div id="alertRegistrado"></div>
		
		<div class="logo_pi"><a href="/" target="_top"></a></div>
		
		<main class="ingreso_eleccion">
			
			<!-- ELECCION DE USUARIO -->

			<div id="tipo">
				<div id="agencia" class="btns_accesos">Enterprise</div>
				<div id="ipebtn" class="btns_accesos">Influencers</div>
			</div>

		</main>

		<main class="form_agencias">
			
			<!-- Formularios para perfil de Agencias -->

			<div id="inicio">
				<div id="acceder" class="btns_accesos">ingresar</div>
				<div id="registrar" class="btns_accesos">registrarse</div>

				<div class="volverTipo btns_accesos">cancelar</div>
			</div>

			<div id="nuevo">
				<h2>Registro</h2>

				<form id="agenciaform" class="registerForm">
					<form class='registerForm'>
						<div>		
							<select id="perfil" required>
							<option value="" disabled selected>selecciona tu perfil </option>
							<option value="3">influenciador</option>
							<option value="4">publisher</option>
							<option value="5">editor</option>
							</select>
						</div>
					
					<input placeholder="Nombre" name="username-nuevo" class="usernamenuevo" required>
			
					<input type="email" placeholder="Correo electrónico" class="correonuevo" required>
					
					<input placeholder="Empresa" name="empresa-nuevo" class="empresanuevo" required>
					
					<input type="password" placeholder="Contraseña" id="contraseñanuevo" class="contraseñanuevo" required>
					<input type="password" onChange="checkPasswordMatch();" placeholder="Repetir Contraseña" id="ver-password" required> 

					<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
					
					<input class="telefonos telefono1nuevo" placeholder="Tel. Empresa" onkeypress="return valida(event)" name="telefono1-nuevo" id="telefono1nuevo" maxlength="11" required>
					<input class="telefonos telefono2nuevo" placeholder="Tel. Personal" onkeypress="return valida(event)" name="telefono2-nuevo" id="telefono2nuevo" maxlength="11" required>
					
					<div id="selectImage">
							
						<input type="file" name="file" id="file" required>
						<label for="file" class="btns">Sube una imágen</label>
						
						<button id="registrarse" disabled type="submit">Registrarse</button>

					</div>
					
					<p>o registrate con</p>

					<div id="facebook-nuevo" class="fb_btn" value="registrarse con Facebook">
						<i class="fa fa-facebook"></i>registrarse con Facebook
					</div>
					<div id="linkedin-nuevo" class="lk_btn">
						<i class="fa fa-linkedin"></i>registrarse con Linkedin
					</div>
				</form>

				<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
			</div>

			<div id="antiguo">
				
				<h2>Ingresar</h2>

				<form class="form_ingreso">

					<input placeholder="Nombre" name="username" id="username"/>

					<input type="password" placeholder="Contraseña" id="password"/>
					
					<div id="ingresar">ingresar</div>
					
					<p>o ingresa con</p>

					<div id="facebook-antiguo" class="fb_btn" value="ingresar con Facebook">
						<i class="fa fa-facebook"></i>ingresar con Facebook
					</div>
					<div id="linkedin-antiguo" class="lk_btn">
						<i class="fa fa-linkedin"></i>ingresar con Linkedin
					</div>

				</form>
				
				<a href="#">¿No recuerdas tu contraseña?</a>
				
				<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>

			</div>

			<button id="volver">volver</button>

		</main>


		<a href="#" class="ayuda_pi">¿Necesitas ayuda?</a>	

	</main>
	
	<script type="text/javascript" async src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/form-data.js"></script>

</body>
</html>