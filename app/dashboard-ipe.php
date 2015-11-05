<html>
<head>
	<meta  charset="UTF-8" >
	<title>dashboard - <?php echo $_SESSION['nombre']; ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			//variables globales
			var correo,nombre,correo,tel1,tel2,empresa;
			var rsid = $('#RsId').val();
			if (rsid != ''){
			$('#correo input').removeAttr('disabled');
			}
			var foto=0;
				$('#file').click(function(){
				  foto=1; 
			});
				
			$('#imagenform').on('submit',(function (e){
				e.preventDefault;
				info = new FormData(this);
				info.append('correo',$('#correo input').val());
				info.append('rsid',$('#RsId').val());
				info.append('nombre',$('#nombre input').val());
				info.append('tel1',$('#tel1 input').val());
				info.append('tel2',$('#tel2 input').val());
				info.append('empresa',$('#empresa input').val());
				info.append('picture_url', '<?php echo $_SESSION['pictureUrl'];?>');
			
				if(foto==1) {
				$.ajax({
						type: "POST",  
						url: "procesar_imagen.php",  
						data: info,
						enctype: 'multipart/form-data',
						contentType: false,      
						cache: false,             
						processData:false, 
					
					success: function(data){ 
						window.location.reload();
					}
					});
				}
				else{
					$.ajax({  
					
							type: "POST",  
							url: "procesar-dashboard-agencia.php",  
							data: info,
							enctype: 'multipart/form-data',
							contentType: false,      
							cache: false,             
							processData:false,
						success: function(data){ 
							//console.log(data);
							window.location.reload();
						}
					});
				};
			}));	
	
	/*	$('#youtube').click(function (){
			$('#youtube-script').attr('src','rrss/youtube/auth.js');
			//youtubeLogin();
		});
*/
		


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
	<!--script type="text/javascript" id="youtube-script" src="rrss/youtube/auth.js" ></script>
    <!--script type="text/javascript" src="my_uploads.js"></script-->
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>

<?php
	require('conexion.php');
	if(isset($_SESSION['nombre'])==false){
	header('Location:index.php');
	die();
	}
	//else{
	//include_once('procesar_mostrar_followers.php');

	//}
?>
<script id="facebook-sdk" src="js/facebook-login.js"></script>
</head>
<body>
<input id="idlinkedin"/>
	<div style="text-align:right;">
		<a href="logout.php">cerrar sesion</a>
		-
		<a href>ayuda</a>
	</div>
	<h2>dashboard</h2>
	<form id='imagenform'>
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
			<textarea placeholder="describe tu perfil a las agencias (NO  FUNCIONA)" rows="10" cols="40"></textarea>
		</div>
	<h2>datos de facturaci&oacuten </h2>
			<div id="correo">
				<input value="<?php echo $_SESSION['correo']; ?>" disabled>
			</div>
			<div id="tel1">
				<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono1']; ?>">
			</div>
			<div id="tel2">
				<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono2']; ?>">
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
		
			<!--button id="pinterest-inscription">Pinterest</button-->
		
	</div>
			
		<?php 
		require("rrss/twitter/inc/twitteroauth.php");
		require('rrss/twitter/inc/TwitterAPIExchange.php');
		require('rrss/instagram/instagram.php');
		require('rrss/Facebook/facebook-auth.php');
		require('rrss/googleplus/auth.php');
		include_once('procesar_mostrar_cuentas.php');?>
	<!--div id="contacto">
		<h2>contacto</h2>
		<div>
			<input placeholder="asunto">
		</div>
		<div>
			<textarea  placeholder="descripcion" rows="10" cols="40"></textarea>
		</div>
		<div>
			<button>enviar</button>
		</div>
	</div-->

</body>
</html>	