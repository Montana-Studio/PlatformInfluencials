<?php
//holi
require('conexion.php');
include_once("RRSS/twitter/sign-in-with-twitter/config.php");
include_once("RRSS/twitter/sign-in-with-twitter/inc/twitteroauth.php");
include_once('RRSS/twitter/sign-in-with-twitter/inc/TwitterAPIExchange.php');

if(isset($_SESSION['nombre'])==false){
header('Location:registro.php');
die();
}
else{
//$mysqli->set_charset('utf8');
$id=$_SESSION['id'];
$query="SELECT * FROM campana  WHERE idpersona=".$id." ORDER BY id DESC LIMIT 3";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);


$query2="SELECT * FROM persona WHERE id=".$id;
$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
$row2= mysqli_fetch_array($result2, MYSQLI_NUM);

}

?>


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

			//campañas creadas 
			$('#editaCampaña').hide();
			$('#creadas #guardar').hide();
			//editar
			$('#creadas #editar').click (function (){
				$('#editaCampaña').show();
				$('#creadas #guardar').show();
				$('#creadas #editar').hide();
			});
			//guardar cambios
			$('#creadas #guardar').click (function (){
				$('#editaCampaña').hide();
				$('#creadas #guardar').hide();
				$('#creadas #editar').show();
			});
			$('#guardar').hide();
			$('#editar').show();

			$('#linkedin').click(function(){
				var head = document.getElementsByTagName('head')[0];
				var script = document.createElement('script');
				script.type = 'text/javascript';
				script.id = 'linkedinId';
				script.src = '//platform.linkedin.com/in.js';
				script.text ='\n api_key:	7718vpksg6gvwg\nauthorize:	false\nonLoad: onLinkedInLoad\n';
				head.appendChild(script);
		});
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

	<script type="text/javascript">
	function getProfileData() {
		IN.API.Raw("/people/~:(id,email-address,formatted-name,num-connections,picture-url,positions:(company:(name)))").result(onSuccess).error(onError);
	}
	function onSuccess(data) {
			var idLinkedin = data ['id'];
			var conn = data['numConnections'];
			console.log (conn);
			var linkedinConnections = document.getElementById('linCon');
			linkedinConnections.value = conn ;
			var linkedin_id = document.getElementById('idlinkedin');
			linkedin_id.value = idLinkedin ;
		 

		 var suma;
		 var linkedin_con = parseInt(conn);
		 suma += linkedin_con;
		 var reach = document.getElementById('reach');
		 reach.value = suma;
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

	<div id="twtfrm">
		<?php
		if(isset($_SESSION['status']) && $_SESSION['status']=='verified') 
		{	//Success, redirected back from process.php with varified status.
			//retrive variables
			$screenname 		= $_SESSION['request_vars']['screen_name'];
			$twitterid 			= $_SESSION['request_vars']['user_id'];
			$oauth_token 		= $_SESSION['request_vars']['oauth_token'];
			$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
		    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

			   $settings = array(
		        'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
		        'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
		        'consumer_key' => "57Ad64b6xTGNDDyIAAWvcKlGV",
		        'consumer_secret' => "YHQUctM9IPL9UHrd0EfNv4MATF8Q1t1Zmqpn3OS12OhHOFF3tX"
		    );
			//echo '<script language="javascript">alert("tus followers son demasiado pocos");</script>'; 

			//Get followers
			$usuario = $_SESSION['request_vars']['user_id'];
			$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$getfield = '?id='.$_SESSION['request_vars']['user_id'];
		    $requestMethod = 'GET';
		    $twitter = new TwitterAPIExchange($settings);
		    $follow_count=$twitter->setGetfield($getfield)
		    ->buildOauth($ta_url, $requestMethod)
		    ->performRequest();
		    $data = json_decode($follow_count, true);
		     $followers_count=(int)$data[0]['user']['followers_count'];
		     if ($followers_count == 0){
		     	//alert("tú numero de seguidores es muy bajo");
		     	$display = "none";

		     	$query3="INSERT INTO rrss (persona_id,rrss,descripcion_rrss) VALUES (".$id.",".$usuario.",'twitter')";
				$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
		     	echo $query3;
		     	echo '<script language="javascript">alert("tus followers son demasiado pocos");</script>'; 
		        session_destroy();
		     }else{
		     	$query3="INSERT INTO rrss (persona_id,rrss,descripcion_rrss) VALUES (".$id.",".$usuario.",'twitter')";
				$result3= mysqli_query($mysqli,$query3)or die(mysqli_error());
		         $display = "block";
		         session_destroy();
		     }	
		}else{
			$display = "none";
		}

		?>
	</div>
</head>
<body>
<?php echo $_SESSION['id']." - ";?>
<?php echo $row2[14];?>

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
		<h2>registra tus redes sociales  -  alcance actual <input id="reach"/></h2>
		<div>
			<button id="facebook">Facebook</button><a></a>
		</div>
		<div>
			<a href="RRSS/twitter/sign-in-with-twitter/process.php">twitter</a>	
		</div>
		<div>
			<button id="instagram">Instagram</button><a></a>
		</div>
		<div>
			<button id="youtube">Youtube</button><a></a>
		</div>
		<div>
			<button id="linkedin">Linkedin</button><input id="linCon" disabled>
		</div>
		<div>
			<button id="analytics">Analytics</button><a></a>
		</div>
		<div>
			<button id="googleplus">Google+</button><a></a>
		</div>
		<div>
			<button id="pinterest">Pinterest</button><a></a>
		</div>
	</div>

	<div id="twitter" style="display:<?php echo $display;?>">
				<h2>Usuario = <?php echo $usuario;?></h2>
				<h3>Followers = <?php echo $followers_count;?></h3>	
	</div>
	<div id="contacto">
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
	</div>

</body>
</html>