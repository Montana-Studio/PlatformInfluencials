<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script id="facebook-sdk"src="js/facebook-login.js"></script>
	<script>
	$(document).ready(function(){
		var info;
		$('#inicio').hide();
		$('#alertRegistrado').hide();
		$('#facebook-name').hide();
		$('#nuevo').hide();
		$('#antiguo').hide();
		$('#volver').hide();
		$('#ipe').hide();

		$('#ipebtn'). click(function(){
			$('#ipe').show();
			$('#ipebtn').hide();
			$('#agencia').hide();
			$('#nuevoipe').hide();
			$('#antiguoIpe').hide();
			$('.volverTipo').hide();
		});

		$('#accederIpe'). click(function(){
			$('#antiguoIpe').show();
			$('#nuevoipe').hide();
			$('.volverTipo').hide();
		});


		$('#registrarIpe'). click(function(){
			$('#antiguoIpe').hide();
			$('#nuevoipe').show();
			$('.volverTipo').hide();
		});



		$('#volverIpe'). click(function(){
			$('#ipe').hide();
			$('#ipebtn').show();
			$('#agencia').show();
		});

		$('#agencia'). click(function(){
			$('#inicio').show();
			$("#tipo").hide();
			$(".volverTipo").show();	
		})

		$('.volverTipo'). click(function(){
			$('#inicio').hide();
			$("#tipo").show();	
			$(".volverTipo").hide();	
		})

		$('#volver'). click(function(){
			$('#inicio').hide();
			$('#registrar').show();
			$('#acceder').show();
			$("#tipo").show();	
			$("#volver").hide();	
			$('#antiguo').hide();
			$('#nuevo').hide();
		})
		
		$('#acceder'). click(function(){
			$('#acceder').hide();
			$('#nuevo').hide();
			$('#registrar').show();
			$("#antiguo").show();
			$(".volverTipo").hide();
			$('#volver').show();
		})
			
		$('#registrar'). click(function(){
			$('#registrar').hide();
			$("#nuevo").show();
			$('#antiguo').hide();
			$('#acceder').show();
			$(".volverTipo").hide();
			$('#volver').show();
		})
		
		$('#ingresar').click(function(){
			username=$('#username').val();
			password=$('#password').val();
			$.ajax({  
				type: "POST",  
				url: "procesar_login.php",  
				data: "name="+username+"&pwd="+password, 
				success: function(html){ 
					switch (html){
					case "admin": window.location.href= "dashboard-admin.php";
					break;
					case "agencia": window.location.href = "dashboard-agencia.php";
					break;
					case "inactivo": 	$('#alertRegistrado').show();
										document.getElementById('alertRegistrado').innerHTML ="usuario inactivo";	
											
					break;
					case "false": 		$('#alertRegistrado').show();
										document.getElementById('alertRegistrado').innerHTML ="usuario o password no existen";					
					break;
					}
					}
			});
		});

		
		$('#agenciaform').on('submit',(function(e){
			e.preventDefault();
			info = new FormData(this);
			info.append('nuuser',$('#usernamenuevo').val());
			info.append('nupass',$('#contraseñanuevo').val());
			info.append('nuempresa',$('#empresanuevo').val());
			info.append('nucorreo',$('#correonuevo').val());
			info.append('nutel1',$('#telefono1nuevo').val());
			info.append('nutel2',$('#telefono2nuevo').val());
			$.ajax({  
				type: "POST",  
				url: "procesar_login_nuevo.php",  
				data: info,
				enctype: 'multipart/form-data',
				contentType: false,      
				cache: false,             
				processData:false, 
				success: function(data){
					switch (data){
					case "nuevo": 	$('#alertRegistrado').show();
									document.getElementById('alertRegistrado').innerHTML ="Registro completo, nos contactaremos con usted";					
									$('#usernamenuevo, #contraseñanuevo,#ver-password,#empresanuevo,#correonuevo,#telefono1nuevo,#telefono2nuevo').val('');
					break;
					case "false":	$('#alertRegistrado').show();
									document.getElementById('alertRegistrado').innerHTML ="El correo ingresado ya tiene una cuenta asociada";					 
									$('#correonuevo').val('');
									;$('#correonuevo').focus();
					break;
					case "invalido":
						console.log('formato invalido');
					}
					}
			});

		}));
		
		$('#linkedin-nuevo').click(function(){

			var head = document.getElementsByTagName('head')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.id = 'linkedinId';
			script.src = '//platform.linkedin.com/in.js';
			script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
			head.appendChild(script);
			$("#tipoCliente").attr("value", "2");
		});
		
		$('#linkedin-antiguo').click(function(){
			
			var head = document.getElementsByTagName('head')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.id = 'linkedinId';
			script.src = '//platform.linkedin.com/in.js';
			script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
			head.appendChild(script);
			$("#tipoCliente").attr("value", "2");
			console.log('api load linked');
		});


		$('#linkedin-nuevo-Ipe').click(function(){
			var head = document.getElementsByTagName('head')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.id = 'linkedinId';
			script.src = '//platform.linkedin.com/in.js';
			script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
			head.appendChild(script);
			$("#tipoCliente").attr("value", "3");
		});
		
		$('#linkedin-antiguo-Ipe').click(function(){
			var head = document.getElementsByTagName('head')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.id = 'linkedinId';
			script.src = '//platform.linkedin.com/in.js';
			script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
			head.appendChild(script);
			$("#tipoCliente").attr("value", "3");
			console.log('api load linked');
		});


		
		$("#ver-password").keyup(checkPasswordMatch);
		$("#telefono1nuevo").keyup(phone1Length);
		$("#telefono2nuevo").keyup(phone2Length);	

		$("#ver-passwordIpe").keyup(checkPasswordMatchIpe);
		$("#telefono1nuevoIpe").keyup(phone1LengthIpe);
		$("#telefono2nuevoIpe").keyup(phone2LengthIpe);	
	});

	function valida(e){
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8){
			return true;
		};
		patron =/[0-9]/;
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
	};		
	function checkPasswordMatch() {
		var password = $('#contraseñanuevo').val();
		var confirmPassword = $('#ver-password').val();
		$('#registrarse').attr('disabled', 'disabled');
		if (password != confirmPassword || password == ''|| confirmPassword ==''){
			$('#divCheckPasswordMatch').html('las contraseñas no coinciden');
		}
		else{
			$('#divCheckPasswordMatch').html('');
			$('#registrarse').removeAttr('disabled');
		}
	}
	function phone1Length(){
		var tel1 = $('#telefono1nuevo').val();
		var tel2 = $('#telefono2nuevo').val();
		$('#registrarse').attr('disabled','disabled');
		if (tel1.length > 7 && tel2.length > 7)
			$('#registrarse').removeAttr('disabled');
		else
			$('#registrarse').attr('disabled','disabled');
	}
	function phone2Length(){
		var tel1 = $('#telefono1nuevo').val();
		var tel2 = $('#telefono2nuevo').val();
		$('#registrarse').attr('disabled','disabled');
		if (tel1.length > 7 && tel2.length > 7)
			$('#registrarse').removeAttr('disabled');
		else
			$('#registrarse').attr('disabled','disabled');
	}

	function validaIpe(e){
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla==8){
			return true;
		};
		patron =/[0-9]/;
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
	};
	function checkPasswordMatchIpe() {
		var password = $('#contraseñanuevoIpe').val();
		var confirmPassword = $('#ver-passwordIpe').val();
		$('#registrarseIpe').attr('disabled', 'disabled');
		if (password != confirmPassword || password == ''|| confirmPassword ==''){
			$('#divCheckPasswordMatchIpe').html('las contraseñas no coinciden');
		}
		else{
			$('#divCheckPasswordMatchIpe').html('');
			$('#registrarse').removeAttr('disabled');
		}
	}
	function phone1LengthIpe(){
		var tel1 = $('#telefono1nuevoIpe').val();
		var tel2 = $('#telefono2nuevoIpe').val();
		$('#registrarseIpe').attr('disabled','disabled');
		if (tel1.length > 7 && tel2.length > 7)
			$('#registrarseIpe').removeAttr('disabled');
		else
			$('#registrarseIpe').attr('disabled','disabled');
	}
	function phone2LengthIpe(){
		var tel1 = $('#telefono1nuevoIpe').val();
		var tel2 = $('#telefono2nuevoIpe').val();
		$('#registrarseIpe').attr('disabled','disabled');
		if (tel1.length > 7 && tel2.length > 7)
			$('#registrarseIpe').removeAttr('disabled');
		else
			$('#registrarseIpe').attr('disabled','disabled');
	}


	</script>

	<script type="text/javascript">
		function getProfileData() {
			IN.API.Raw("/people/~:(id,email-address,formatted-name,num-connections,picture-url,positions:(company:(name)))").result(onSuccess).error(onError);
		}
		function onSuccess(data) {
				var id= data ['id'];
				var nombre = data['formattedName'];
				var pictureUrl = data['pictureUrl'];
				var email = data['emailAddress'];
				var conn = data['numConnections'];
				$.ajax({  
					type: "POST",  
					url: "procesar_linkedin.php",  
					data: "id="+id+"&nombre="+nombre+"&pictureUrl="+pictureUrl+"&email="+email+"&conn="+conn+"&tipo="+document.getElementById('tipoCliente').getAttribute('value'), 
					success: function(html){ 
						switch (html){
						case "dashboard": window.location.href="dashboard-agencia.php";
						break;
						case "false": 	$('#alertRegistrado').show();
										document.getElementById('alertRegistrado').innerHTML = "Estimado(a) "+nombre+" ya se encuentra registrado nos contactaremos con usted a la brevedad";
						break;
						case "primera": document.getElementById('alertRegistrado').innerHTML = "Por favor ingrese sus datos en el formulario";	    
										window.location.href="formulario-agencia2.php";			
						break;
						case "primera-ipe": document.getElementById('alertRegistrado').innerHTML = "Por favor ingrese sus datos en el formulario";	    
										window.location.href="formulario-agencia3.php";			
						break;
						case "dashboard-ipe": window.location.href="dashboard-ipe.php";
						break;
						}
					}
				});
				
		}
		function onError(error) {
			console.log(error);
		}	
		function LinkedINAuth(){
			IN.UI.Authorize().place();
		}
		function onLinkedInLoad() {
			LinkedINAuth();
			IN.Event.on(IN, "auth", function () { getProfileData(); });
			IN.Event.on(IN, "logout", function () { onLinkedInLogout(); });
		}
	</script>
<title>Login</title>
</head>
<body>
	<div style display = "none" id="tipoCliente" value="2"></div>
	<h4 align="right"><a href>ayuda</a><h4>
	<div style="width:90%;border:1px solid red;background-color:rose;;margin:0 auto;" id="alertRegistrado"></div>
	<h2>proceso de ingreso</h2>
	<div id="tipo">
		<button id="agencia">agencia</button>
		<button id="ipebtn">ipe</button>
	</div>

	<!-- Formularios para perfil de Agencias -->
	<div id="inicio">
		<button id="acceder">acceder</button>
		<button id="registrar">registrarse</button><br/>
		<button class="volverTipo">volver</button>
	</div>
	<div id="nuevo">
		<form id='agenciaform'>
			<div>
				<input placeholder="usuario" name='username-nuevo' id="usernamenuevo" required>
			</div>
			<div>
				<input type="email" placeholder="correo" id="correonuevo" required>
			</div>
			<div>
				<input placeholder="empresa" name='empresa-nuevo' id="empresanuevo" required>
			</div>
			<div>
				<input type="password" placeholder="contraseña-nuevo" id="contraseñanuevo" required> - <input type="password" onChange="checkPasswordMatch();" placeholder="verificar contraseña-nuevo" id="ver-password"  required> <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
			</div>
			<div>
				<input placeholder="telefono1" onkeypress="return valida(event)" name='telefono1-nuevo' id="telefono1nuevo" maxlength="11" required>
			</div>
			<div>
				<input placeholder="telefono2" onkeypress="return valida(event)" name='telefono2-nuevo' id="telefono2nuevo" maxlength="11" required>
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
		<div>
			<input placeholder="usuario" name='username' id="username"/>
		</div>
		<div>
			<input type="password" placeholder="contraseña" id="password"/>
		</div>
		<div>
			<button id="ingresar">ingresar</button>
			<button id="facebook-antiguo" value="ingresar con Facebook">ingresar con Facebook</button>
			<button id="linkedin-antiguo">ingresar con Linkedin</button>
		</div>
		<div>
			<button>recuperar contraseña</button>
		</div>
	</div>

	<div>
		<button id="volver">volver</button>
	</div>

<!-- Formularios para perfiles IPE -->
	<div id="ipe">	

	<div id="inicioIpe">
		<button id="accederIpe">acceder</button>
		<button id="registrarIpe">registrarse</button><br/>
		<button class="volverTipo">volver</button>
	</div>

		<div id="nuevoipe">
			<form id='agenciaIpe'>
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
					<input placeholder="empresa" name='empresa-nuevo' id="empresanuevo" required>
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
</body>
</html>