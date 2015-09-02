<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script id="facebook-sdk"src="js/facebook-login.js"></script>
	<script>
	$(document).ready(function(){
		var info;
		$('#alertRegistrado').hide();
		$('#facebook-name').hide();
		$('#nuevo').hide();
		$('#antiguo').hide();
		
		$('#acceder'). click(function(){
		$('#acceder').hide();
		$("#antiguo").show();
		$('#nuevo').hide();
		$('#registrar').show();
		})
			
		$('#registrar'). click(function(){
		$('#registrar').hide();
		$("#nuevo").show();
		$('#antiguo').hide();
		$('#acceder').show();
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
		});
		
		$('#linkedin-antiguo').click(function(){
			var head = document.getElementsByTagName('head')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.id = 'linkedinId';
			script.src = '//platform.linkedin.com/in.js';
			script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
			head.appendChild(script);
		});
		
		$("#ver-password").keyup(checkPasswordMatch);
		$("#telefono1nuevo").keyup(phone1Length);
		$("#telefono2nuevo").keyup(phone2Length);	
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
			
				$.ajax({  
					type: "POST",  
					url: "procesar_linkedin.php",  
					data: "id="+id+"&nombre="+nombre+"&pictureUrl="+pictureUrl+"&email="+email, 
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
	<h4 align="right"><a href>ayuda</a><h4>
	<div style="width:90%;border:1px solid red;background-color:rose;;margin:0 auto;" id="alertRegistrado"></div>
	<h2>proceso de ingreso</h2>
	<div id="inicio">
		<button id="acceder">acceder</button>
		<button id="registrar">registrarse</button>
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
		<button class="linkedin_icon_20 linkedin_only" id="linkedin-nuevo" title="Sign in using LinkedIn account">registrar con Linkedin</button>
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
	</body>
</html>