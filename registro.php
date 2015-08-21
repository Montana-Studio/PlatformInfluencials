<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script id="facebook-sdk"src="js/facebook-login.js"></script>
<script id="linkedinId"></script>



<script>
$(document).ready(function(){
		
		var info;
		$('#alertRegistrado').hide();
		$('#facebook-name').hide();
		$('#nuevo').hide();
		$('#antiguo').hide();
		$('#recuperar').hide();
		
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
		$('#recuperar').show();
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
				case "inactivo": alert('usuario inactivo');
				break;
				case "false": alert('usuario o password no existen');
				break;
				}
				}
		});
		});
		
		$('#agenciaform').on('submit',(function (e){
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
					case "nuevo": alert('Registro completo, nos contactaremos con usted');
									$('#usernamenuevo, #contraseñanuevo,#empresanuevo,#correonuevo,#telefono1nuevo,#telefono2nuevo').val('');
									window.location.href= "registro.php";
					break;
					case "false": alert('El correo ingresado ya tiene una cuenta asociada');
									$('#correonuevo').val('');
									;$('#correonuevo').focus();
									
					break;
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
});

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
		//console.log(nombre, pictureUrl, email);
	
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
							  //window.location.href="registro.php";	
				break;
				case "primera":     
								window.location.href="formulario-agencia2.php";
								document.getElementById('alertRegistrado').innerHTML = "Por favor ingrese sus datos en el formulario";					
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
<br/>
<div id="inicio">
<button id="acceder">acceder</button>
<button id="registrar">registrarse</button>
</div>
<br/>
<div id="nuevo">
<form id='agenciaform'>
<input placeholder="usuario" name='username-nuevo' id="usernamenuevo" required/><br/>
<input type="email" placeholder="correo" id="correonuevo" required/><br/>
<input placeholder="empresa" name='empresa-nuevo' id="empresanuevo" required/><br/>
<input type="password" placeholder="contraseña-nuevo" id="contraseñanuevo" required/> - <input type="password" placeholder="verificar contraseña-nuevo" id="ver-password" required/><br/>
<input placeholder="telefono1" name='telefono1-nuevo' id="telefono1nuevo" size="11" maxlength="11" required/><br/>
<input placeholder="telefono2" name='telefono2-nuevo' id="telefono2nuevo" size="11" maxlength="11"required/><br/>
<div id="selectImage">
<input type="file" name="file" id="file" required /></br>
<button type="submit" id="registrarse">registrar</button>
</div>
</form>

<button id="facebook-nuevo">registrar con Facebook</button>
<button class="linkedin_icon_20 linkedin_only" id="linkedin-nuevo" title="Sign in using LinkedIn account">registrar con Linkedin</button>

<!--a class="linkedin_icon_20 linkedin_only" id="linkedin-login-button" onclick="onLinkedInLoad()" title="Sign in using LinkedIn account">  </a-->
</div>

<div id="antiguo">
<input placeholder="usuario" name='username' id="username"/><br/>
<input type="password" placeholder="contraseña" id="password"/></br>
<button id="ingresar">ingresar</button>
<button id="facebook-antiguo" value="ingresar con Facebook">ingresar con Facebook</button>
<button id="linkedin-antiguo">ingresar con Linkedin</button>
</div>

<div id="mensaje"></div>
<div id="recuperar">
<input id="facebook-name"></input>
<button>recuperar contraseña</button>
</div>

</body>
</html>