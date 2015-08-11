<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/facebook-login.js"></script>
<!-- ahora el script de linkedin -->
<script id="lala" ></script>

<script>
$(document).ready(function(){
		
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
		
		
		$('#registrarse').click(function(){

		usernamenuevo=$('#usernamenuevo').val();
		contraseñanuevo=$('#contraseñanuevo').val();
		empresanuevo=$('#empresanuevo').val();
		correonuevo=$('#correonuevo').val();
		telefono1nuevo=$('#telefono1nuevo').val();
		telefono2nuevo=$('#telefono2nuevo').val();
		console.log(contraseñanuevo,empresanuevo,correonuevo);
		 $.ajax({  
            type: "POST",  
            url: "procesar_login_nuevo.php",  
            data: "nuuser="+usernamenuevo+"&nupass="+contraseñanuevo+"&nuempresa="+empresanuevo+"&nucorreo="+correonuevo+"&nutel1="+telefono1nuevo+"&nutel2="+telefono2nuevo, 
			
            success: function(html){ 
				switch (html){
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
		});

		
		
		
		
		});

</script>

</style>
<title>Login</title>
</head>
<body>
<h4 align="right"><a href>ayuda</a><h4>
<h2>proceso de ingreso</h2>
<br/>
<div id="inicio">
<button id="acceder">acceder</button>
<button id="registrar">registrarse</button>
</div>
<br/>
<div id="nuevo">


<input placeholder="usuario" name='username-nuevo' id="usernamenuevo" /><br/>
<input type="email" placeholder="correo" id="correonuevo"/><br/>
<input placeholder="empresa" name='empresa-nuevo' id="empresanuevo" /><br/>
<input type="password" placeholder="contraseña-nuevo" id="contraseñanuevo"/> - <input type="password" placeholder="verificar contraseña-nuevo" id="ver-password"/><br/>
<input placeholder="telefono1" name='telefono1-nuevo' id="telefono1nuevo"/><br/>
<input placeholder="telefono2" name='telefono2-nuevo' id="telefono2nuevo"/><br/>
<button id="registrarse">registrar</button>
<button id="facebook-nuevo">registrar con Facebook</button>
<button id="linkedin-nuevo">registrar con Linkedin</button>

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