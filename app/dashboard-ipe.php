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

<?php
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
header('Location:index.php');
die();
}
else{
include_once("rrss/twitter/config.php");
include_once("rrss/twitter/inc/twitteroauth.php");
include_once('rrss/twitter/inc/TwitterAPIExchange.php');
$mysqli->set_charset('utf8');
$id=$_SESSION['id'];
}
    //$query3="SELECT rrss_id FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='twitter'";
/*	$query3="SELECT DISTINCT rrss_id FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='twitter'";
    $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
    $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
    $num_row3= mysqli_num_rows($result3);
    //	echo $row3;
    do{
      echo $row3['rrss_id'];
	  echo "<br />";
	  }while($row3 = $result3->fetch_array());
   
    if ($num_row3>0){
   	$settings = array(
        'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
        'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
        'consumer_key' => "57Ad64b6xTGNDDyIAAWvcKlGV",
        'consumer_secret' => "YHQUctM9IPL9UHrd0EfNv4MATF8Q1t1Zmqpn3OS12OhHOFF3tX"
    );
    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';
    $usuario1 = $row3[0];
    $getfield1 = '?id='.$usuario1;
    $twitter1 = new TwitterAPIExchange($settings);
    $follow_count1=$twitter1->setGetfield($getfield1)
    ->buildOauth($ta_url, $requestMethod)
    ->performRequest();
    $data1 = json_decode($follow_count1, true);
    $followers_count1=(int)$data1[0]['user']['followers_count'];
   /* echo "<script> $(document).ready(function(){
    	$('.twitter-div').removeAttr('href')});</script>";
    }*/
?>
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
		<h2>registra tus redes sociales</h2>  <h2>reach total <?php echo $suma; ?></h2>
		<div>
			<button id="facebook">Facebook</button><a></a>
		</div>
		<div>
			<a class="twitter-div" href="rrss/twitter/process.php">twitter</a>
			

			<!--div id="twitter-from-data-base" style="display:<?php //echo $displaydb;?>"-->
			        <?php 
			        	echo '<!--div id="twitter-from-data-base" style="display:<?php //echo $displaydb;?>"-->';
						$query3="SELECT DISTINCT rrss_id FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='twitter'";
					    $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
					    $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
					    $num_row3= mysqli_num_rows($result3);
					    if ($num_row3>0){
					    	echo " <br/> Perfiles Registrados <br/>";
					    }
					    $suma_twitter = 0;
					    $i=1;
					    do{
					    $usuario1 = $row3['rrss_id'];
					    echo $usuario1." aqui ";
					   	$settings = array(
					        'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
					        'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
					        'consumer_key' => "hV95sLlCLjKIQbsVx1uVIxgKQ",
					        'consumer_secret' => "FU3GBmbIldTUzJZJOJqrynhiiecmt2FPHAShlkGi3AH8jY7GrV"
					    );
					    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
					    $requestMethod = 'GET';
					    //$usuario1 = '3523857136';
					    // id argkont 80674227
					    $getfield1 = '?id='.$usuario1;
					    $twitter1 = new TwitterAPIExchange($settings);
					    $follow_count1=$twitter1->setGetfield($getfield1)
					    ->buildOauth($ta_url, $requestMethod)
					    ->performRequest();
					    $data1 = json_decode($follow_count1, true);
					    $followers_count1=(int)$data1[0]['user']['friends_count'];
					    $username=$data1[0]['user']['screen_name'];
						echo $username;
						echo "   -    ";
						echo (int)$followers_count1;
						echo "<br/>";					    
						$suma_twitter+=(int)$followers_count1;
						$all_rows[$i] = $row3;
						echo $all_rows[$i];
						$i++;
						}while($row3 = $result3->fetch_array());
						echo "reach twitter = ".$suma_twitter; 
						
				    ?>
			</div>
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

	<?php 
	$suma= $suma_twitter;
	echo $suma; 
	?>
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