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
<input placeholder="correo" id="correo-nuevo"></input><p>
<input placeholder="usuario" name='username' class="form-control" id="username-nuevo" ></input><p>
<input placeholder="contraseña" id="contraseña-nuevo"></input><p>
<button id="registrar">registrar</button>
<button id="facebook-nuevo">registrar con Facebook</button>

<!--script>
 // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
</script--> 

<button id="linkedin-nuevo">registrar con Linkedin</button>
</div>

<div id="antiguo">
<input placeholder="usuario" name='username' class="form-control" id="username"></input><p>
<input placeholder="contraseña" id="password"></input><p>
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