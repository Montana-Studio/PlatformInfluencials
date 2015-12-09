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
<html lang="es" style="height:100%;">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#2c327c">
	<title>Power Influencer</title>
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
	<meta name="application-name" content="Power Influencer"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="img/mstile-144x144.png" />
	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script id="facebook-sdk" src="js/facebook-login.js"></script>
	<script src="../bower_components/vide/dist/jquery.vide.min.js"></script>

</head>

<body>
	<?php

	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		echo '';
	else
		echo '
		<div class="video-container" data-vide-bg="mp4: video/bg_app.mp4, webm: video/bg_app.webmv, ogv: video/bg_app.ogg" data-vide-options="posterType: none,loop: true, muted: true, position: 0% 0%"></div>';

	?>
	<main class="contAllPI" style="padding-top:30%;">
		<div style="display:none;" id="tipoCliente" value="2"></div>
		<div class="logo_pi"><a href="/" target="_top"></a></div>
		<main class="form_agencias">
		<div id="inicio">
				<div id="acceder" class="btns_accesos">ingresar</div>
				<div id="registrar" class="btns_accesos">registrarse</div>
			</div>
		<div id="nuevo">
			<h2>Registro</h2>
			<form class="registerForm registerFormAgencia">
				<form class='registerForm'>
					<div style="display:none;">
						<select id="perfil" >
							<option value="2" disabled selected>perfil de agencia </option>
						</select>
					</div>

					<div id="facebook-nuevo" class="fb_btn" value="registrarse con Facebook">
						<i class="fa fa-facebook"></i>registrarse con Facebook
					</div>
					<div id="linkedin-nuevo" class="lk_btn">
						<i class="fa fa-linkedin"></i>registrarse con Linkedin
					</div>

					<p>o rellena el formulario</p>

					<input placeholder="Nombre" name="username-nuevo" class="usernamenuevo" required>
					<input type="email" placeholder="Correo electrónico" class="correonuevo" required>
					<input placeholder="Empresa" name="empresa-nuevo" class="empresanuevo" required>
					<input type="password" onChange="checkPasswordMatch()" placeholder="Contraseña" id="contraseñanuevo" class="contraseñanuevo" required>
					<input type="password" onChange="checkPasswordMatch()" placeholder="Repetir Contraseña" id="ver-password" required>
					<div id="divCheckPasswordMatch" class="pass-no-equals"><i class="fa fa-times"></i> Las contraseñas no coinciden</div>
					<input class="telefonos telefono1nuevo" placeholder="Tel. Empresa" onkeypress="return valida(event)" name="telefono1-nuevo" id="telefono1nuevo" maxlength="11" required>
					<input class="telefonos telefono2nuevo" placeholder="Tel. Personal" onkeypress="return valida(event)" name="telefono2-nuevo" id="telefono2nuevo" maxlength="11" required>

					<div id="selectImage">
						<input type="file" name="file" id="file" required>
						<label for="file" class="btns" required>Sube una imágen</label>
						<button id="registrarse"  type="submit">Registrarse</button>
					</div>
				</form>
				<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
			</div>
			<div id="antiguo">
					<h2>Ingresa con tus datos</h2>
					<form class="form_ingreso">
						<div id="facebook-antiguo" class="fb_btn" value="ingresar con Facebook">
							<i class="fa fa-facebook"></i>ingresar con Facebook
						</div>
						<div id="linkedin-antiguo" class="lk_btn">
							<i class="fa fa-linkedin"></i>ingresar con Linkedin
						</div>
						<p>o ingresa con tu correo</p>
						<!--input placeholder="Nombre" name="username" id="username"/-->
						<input placeholder="Correo" name="correo" id="correo"/>
						<input type="password" placeholder="Contraseña" id="password" />
						<div id="ingresar">ingresar</div>
						<div id="alertRegistrado"></div>
						<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
					</form>
					<button id="volver">volver</button>
			</div>
		<a href="#" class="ayuda_pi">¿Necesitas ayuda?</a>
	</main>
	<div class="alertElim">

		<main class="no-campana" id="boxAlert">
			<div class="hrefCamp">
				<i class="fa"></i>
				<h2></h2>
				<p class="messageAlert"></p>
				<div class="btn_crearcamp" id="clearAlert">
					continuar
				</div>
			</div>
		</main>

	</div>

	<script type="text/javascript" async src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/form-data.js"></script>
	<script src="../bower_components/vide/dist/jquery.vide.min.js"></script>

</body>
</html>
