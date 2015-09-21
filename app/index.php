<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Power Influencer</title>

	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script type="text/javascript" async src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script id="facebook-sdk"src="js/facebook-login.js"></script>

</head>

<body>

	<main class="contAllPI">
		
		<div style="display:none;" id="tipoCliente" value="2"></div>

		<a href="#" class="ayuda_pi">¿Necesitas ayuda?</a>

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

				<div class="volverTipo">volver</div>
			</div>

			<div id="nuevo">

				<form id="agenciaform" class="registerForm">
					
					<div>
						<input placeholder="usuario" name="username-nuevo" id="usernamenuevo" required>
					</div>
					
					<div>
						<input type="email" placeholder="correo" id="correonuevo" required>
					</div>
					
					<div>
						<input placeholder="empresa" name='empresa-nuevo' id="empresanuevo" required>
					</div>
					
					<div>
						
						<input type="password" placeholder="contraseña-nuevo" id="contraseñanuevo" required> - 
						<input type="password" onChange="checkPasswordMatch();" placeholder="verificar contraseña-nuevo" id="ver-password"  required> 

						<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>

					</div>

					<div>
						<input placeholder="telefono1" onkeypress="return valida(event)" name="telefono1-nuevo" id="telefono1nuevo" maxlength="11" required>
					</div>

					<div>
						<input placeholder="telefono2" onkeypress="return valida(event)" name="telefono2-nuevo" id="telefono2nuevo" maxlength="11" required>
					</div>

					<div id="selectImage">
							
							<input type="file" name="file" id="file" required>
							
							<div>
								<button id="registrarse" disabled type="submit">registrar</button>
							</div>

					</div>
				</form>

				<button id="facebook-nuevo">registrar con Facebook</button>
				<button id="linkedin-nuevo">registrar con Linkedin</button>

			</div>

			<div id="antiguo">
				
				<h2 data-text='Ingresar'></h2>

				<form class="form_ingreso">

					<input placeholder="Usuario" name="username" id="username"/>

					<input type="password" placeholder="Contraseña" id="password"/>
					
					<div id="ingresar">ingresar</div>
					
					<p>o ingresa con</p>

					<div id="facebook-antiguo" value="ingresar con Facebook">
						<i class="fa fa-facebook"></i>ingresar con Facebook
					</div>
					<div id="linkedin-antiguo">
						<i class="fa fa-linkedin"></i>ingresar con Linkedin
					</div>

				</form>
				
				<a href="#">¿No recuerdas tu contraseña?</a>
				
				<div class="btn_close"><span>x</span></div>
			</div>

			<button id="volver">volver</button>

		</main>

		<!-- Formularios para perfiles IPE -->
		<main>
			<div id="ipe">	

				<div id="inicioIpe">
					<button id="accederIpe">acceder</button>
					<button id="registrarIpe">registrarse</button><br/>
					<button class="volverTipo">volver</button>
				</div>

				<div id="nuevoipe">
					<form class='registerForm' id='agenciaIpe'>
						<div>		
							<select id="perfil" required>
							<option value="" disabled selected>selecciona tu perfil </option>
							<option value="3">influenciador</option>
							<option value="4">publisher</option>
							<option value="5">editor</option>
							</select>
						</div>
						<div>
							<input placeholder="usuario" name='username-nuevo' id="usuarionuevoIpe" required>
						</div>
						<div>
							<input type="email" placeholder="correo" id="correonuevoIpe" required>
						</div>
						<div>
							<input placeholder="empresa" name='empresa-nuevo' id="empresanuevoIpe" required>
						</div>
						<div>
							<input type="password" placeholder="contraseña-nuevo" id="contraseñanuevoIpe" required> - <input type="password" onChange="checkPasswordMatchIpe();" placeholder="verificar contraseña-nuevo" id="ver-passwordIpe"  required> <div class="registrationFormAlert" id="divCheckPasswordMatchIpe"></div>
						</div>
						<div>
							<input placeholder="telefono1" onkeypress="return validaIpe(event)" id="telefono1nuevoIpe" maxlength="11" required>
						</div>
						<div>
							<input placeholder="telefono2" onkeypress="return validaIpe(event)" id="telefono2nuevoIpe" maxlength="11" required>
						</div>
						<div id="selectImage">
								<input type="file" name="file" id="fileIpe" required>
								<div>
									<button id="registrarseIpe" disabled type="submit">registrar</button>
								</div>
						</div>
					</form>
					<button id="facebook-nuevo-ipe">registrar con Facebook</button>
					<button id="linkedin-nuevo-Ipe">registrar con Linkedin</button>
				</div>

				<div id="antiguoIpe">
					<div>
						<input placeholder="usuario" name='username' id="antiguousuarioIpe"/>
					</div>
					<div>
						<input type="password" placeholder="contraseña" id="antiguocontraseñaIpe"/>
					</div>
					<div>
						<button id="ingresarIpe">ingresar</button>
						<button id="facebook-antiguo-Ipe" value="ingresar con Facebook">ingresar con Facebook</button>
						<button id="linkedin-antiguo-Ipe">ingresar con Linkedin</button>
					</div>
					<div>
						<button>recuperar contraseña</button>
					</div>
				</div>

				<div>
					<button id="volverIpe">volver</button>
				</div>
			</div>
		</main>		

	</main>
	
	<script type="text/javascript" async src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" async src="js/typewriter.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/form-data.js"></script>
</body>
</html>