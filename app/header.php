<?php
	require('conexion.php');
	if(isset($_SESSION['id'])==false){
	header('Location:./');
			die();
	}
	function muestra_header(){
		echo 	'<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="theme-color" content="#2c327c">
			<title></title>
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
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
				
		</head>
		<body>';
		}
	if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		if(isset($_SESSION['telefono1'])==false){
			header('Location: logout.php');
			die();
		}
		else{
			$id=$_SESSION['id'];
			$query="SELECT * FROM campana  WHERE idEstado=1 AND idpersona=".$id." ORDER BY id DESC LIMIT 3";
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
				//}
			muestra_header();
			echo "<script>
					jQuery(document).ready(function(){
						$('title').append('Power Influencer - ".$_SESSION['nombre']."');
						$('html').css({'background-color':'#fff','background-image':'none'});
						$('body').addClass('dashboard-agencia');
					})
				</script>";
		}
	}
	if(basename($_SERVER['PHP_SELF'])=='nueva-campana.php'){
			if(isset($_SESSION['telefono1'])==false){
				header('Location: logout.php');
				die();
			}
			else{
			$query="SELECT id FROM campana ORDER BY id DESC LIMIT 1";
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			$id = $_SESSION['id'];
			$query2="SELECT * FROM campana WHERE idpersona='$id'";
			$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
			$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
			}
			muestra_header();
			echo "<script>
					jQuery(document).ready(function(){
						$('title').append('Power Influencer - Crear Campaña');
						$('html').css({'background-color':'#fff','background-image':'none'});
						$('body').addClass('crear-campanas');
					});
				</script>";
	}
	if(basename($_SERVER['PHP_SELF'])=='campana.php'){
			if(isset($_SESSION['telefono1'])==false){
				header('Location: logout.php');
				die();
			}else{
			$query="SELECT * FROM campana WHERE idEstado=1 AND idpersona=".$_SESSION['id']." ORDER BY id DESC";
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			$num_rows= mysqli_num_rows($result);
			$query2="SELECT * FROM campana WHERE idEstado=0 AND idpersona=".$_SESSION['id']." ORDER BY id DESC";
			$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
			$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
			$num_rows2= mysqli_num_rows($result2);
			}
			muestra_header();
			echo "<script>
					jQuery(document).ready(function(){
						$('title').append('Power Influencer - Campañas');
						$('html').css({'background-color':'#fff','background-image':'none'});
						$('body').addClass('campanas');
					});
				</script>";
	}
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		if(isset($_SESSION['id'])==false){
				header('Location: logout.php');
				die();
			}
			else{
				muestra_header();
				echo "<script>
							jQuery(document).ready(function(){
								$('title').append('Power Influencer - Completa tus datos');
								$('html').css({'background-color':'#fff','background-image':'none'});
								$('body').addClass('formularios-registro');
							});
						</script>";
			}
	}
	if(basename($_SERVER['PHP_SELF'])=='influenciador-publico.php'){
		if(isset($_SESSION['telefono1'])==false){
			header('Location: logout.php');
			die();
		}
		else{
			//$id=$_SESSION['id'];
			//$query="SELECT * FROM campana  WHERE idEstado=1 AND idpersona=".$id." ORDER BY id DESC LIMIT 3";
			$id=$_SESSION['id'];
			$query="SELECT * FROM persona WHERE id_estado=1 AND id_tipo>2 ORDER BY fecha_ingreso ASC";
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			$num_rows= mysqli_num_rows($result);
			//$id=$_SESSION['id'];
			$query2="SELECT nombre FROM campana WHERE idpersona=".$id;
			$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
			$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
			$num_rows2= mysqli_num_rows($result2);
		
			//$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			//$row= mysqli_fetch_array($result, MYSQLI_NUM);
				//}
			muestra_header();
			echo "<script>
					jQuery(document).ready(function(){
						$('title').append('Power Influencer - ".$_SESSION['nombre']."');
						$('html').css({'background-color':'#fff','background-image':'none'});
						$('body').addClass('influenciador-publico');
					})
				</script>";
		}
	}
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia2.php'){
		if(isset($_SESSION['nombre'])==false){
			header('Location:./');
			die();
		}else{
				muestra_header();
				echo "<script>
							jQuery(document).ready(function(){
								$('title').append('Power Influencer - Completa tus datos');
								$('html').css({'background-color':'#fff','background-image':'none'});
								$('body').addClass('formularios-registro');
								var envnom=0;
								var nombre;
								var correo;
								var telefono1;
								var telefono2;
								$('#telefono1nuevo').keyup(phone1Length);
								$('#telefono2nuevo').keyup(phone2Length);
								$('#nombre').click(function(){
									$('#nombre input').removeAttr('disabled','disabled').css({'background-image':'none','background-color':'#ccc'}).attr('placeholder','por favor escriba');
									envnom=1;
									if (envnom == 1){
										$('#nombre input').keypress(function (e) {
											if (e.which == 13) {
												$('#nombre input')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
										});
									}
								});
								$('#empresa').click(function(){
									$('#empresa input')	.removeAttr('disabled','disabled').css({'background-image':'none','background-color':'#ccc'}).attr('placeholder','por favor escriba');;
									envnom=1;
									if (envnom == 1){
										$('#empresa input').keypress(function (e) {
											if (e.which == 13) {
												$('#empresa input')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
											});
										}
								});
								$('#correo').click(function(){
									$('#correo input').removeAttr('disabled','disabled').css({'background-image':'none','background-color':'#ccc'}).attr('placeholder','por favor escriba');
									envnom=1;
									if (envnom == 1){
										$('#correo input').keypress(function (e) {
											if (e.which == 13) {
												$('#correo input').attr('disabled','disabled').css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
										});
									}
								});
								$('#telefono1nuevo').click(function(){
									$('#telefono1nuevo').removeAttr('disabled','disabled').css({'background-image':'none','background-color':'#ccc'}).attr('placeholder','por favor escriba');
									envnom=1;
									if (envnom == 1){
										$('#telefono1nuevo').keypress(function(e){
											if (e.which == 13) {
												$('#telefono1nuevo')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
										});
									}
								});
								$('#telefono2nuevo').click(function(){
									$('#tel2 input').removeAttr('disabled','disabled').css({'background-image':'none','background-color':'#ccc'}).attr('placeholder','por favor escriba');
									envnom=1;
									if(envnom == 1){
										$('#telefono2nuevo').keypress(function(e){
											if (e.which == 13) {
												$('#telefono2nuevo').attr('disabled','disabled').css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
										});
									}
								});
								$('#guardar').click(function(){
									nombre=$('#nombre input').val();
									empresa=$('#empresa input').val();
									correo=$('#correo input').val();
									telefono1=$('#telefono1nuevo').val();
									telefono2=$('#telefono2nuevo').val();
									$.ajax({
											type: 'POST',
											url: 'procesar_formulario.php',
											data: 'nombre='+nombre+'&empresa='+empresa+'&correo='+correo+'&tel1='+telefono1+'&tel2='+telefono2,
											success: function(html){
												alert('Registro de datos completo, nos contactaremos con usted');
												window.location.href= './';
											}
									});
								});
							});
							function phone1Length(){
								var tel1 = $('#telefono1nuevo').val();
								var tel2 = $('#telefono2nuevo').val();
								if (tel1.length > 7 && tel2.length > 7)
									$('#guardar').removeAttr('disabled');
							}
							function phone2Length(){
								var tel1 = $('#telefono1nuevo').val();
								var tel2 = $('#telefono2nuevo').val();
								if (tel1.length > 7 && tel2.length > 7)
									$('#guardar').removeAttr('disabled');
							}
							function valida(e){
								tecla = (document.all) ? e.keyCode : e.which;
								if (tecla==8){
									return true;
								};
								patron =/[0-9]/;
								tecla_final = String.fromCharCode(tecla);
								return patron.test(tecla_final);
							};
					</script>";
			}
	}
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia3.php'){
		if(isset($_SESSION['id'])==false){
				header('Location: logout.php');
				die();
			}
			else{
				muestra_header();
				echo "<script>
							jQuery(document).ready(function(){
								$('title').append('Power Influencer - Completa tus datos');
								$('html').css({'background-color':'#fff','background-image':'none'});
								$('body').addClass('formularios-registro');
								var envnom=0;
								var nombre;
								var correo;
								var telefono1;
								var telefono2;
								$('#telefono1nuevo').keyup(phone1Length);
								$('#telefono2nuevo').keyup(phone2Length);
								$('#nombre'). click(function(){
									$('#nombre input')	.removeAttr('disabled','disabled')
														.css({'background-image':'none','background-color':'#ccc'})
														.attr('placeholder','por favor escriba');
									envnom=1;
									if (envnom == 1){ 	
										$('#nombre input').keypress(function (e) {
											if (e.which == 13) {
												$('#nombre input')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
										});
									}
								});
								
								$('#empresa'). click(function(){
									$('#empresa input')	.removeAttr('disabled','disabled')
														.css({'background-image':'none','background-color':'#ccc'})
														.attr('placeholder','por favor escriba');;
									envnom=1;
									if (envnom == 1){
										$('#empresa input').keypress(function (e) {
											if (e.which == 13) {
												$('#empresa input')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
											});
										}
								});
								
								$('#correo'). click(function(){
									$('#correo input')	.removeAttr('disabled','disabled')
														.css({'background-image':'none','background-color':'#ccc'})
														.attr('placeholder','por favor escriba');
									envnom=1;
									
									if (envnom == 1){
										$('#correo input').keypress(function (e) {
											if (e.which == 13) {
												$('#correo input')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
											});
									}
								});
								
								$('#telefono1nuevo'). click(function(){
									$('#telefono1nuevo')	.removeAttr('disabled','disabled')
														.css({'background-image':'none','background-color':'#ccc'})
														.attr('placeholder','por favor escriba');
									envnom=1;
									
									if (envnom == 1){
										$('#telefono1nuevo').keypress(function (e) {
											if (e.which == 13) {
												$('#telefono1nuevo')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
											});
									}
								});
								
								$('#telefono2nuevo'). click(function(){
									$('#tel2 input')	.removeAttr('disabled','disabled')
														.css({'background-image':'none','background-color':'#ccc'})
														.attr('placeholder','por favor escriba');
									envnom=1;
									
									if (envnom == 1){
										$('#telefono2nuevo').keypress(function (e) {
											if (e.which == 13) {
												$('#telefono2nuevo')	.attr('disabled','disabled')
																	.css({'background-image':'none','background-color':'transparent'});
												envnom=0;
											}
										});
									}
								});
								
								$('#guardar').click(function(){
									nombre=$('#nombre input').val();
									empresa=$('#empresa input').val();
									correo=$('#correo input').val();
									telefono1=$('#telefono1nuevo').val();
									telefono2=$('#telefono2nuevo').val();
									tipo=$('#perfil option').val();
									var e = document.getElementById('perfil');
									var perfil = e.options[e.selectedIndex].value;
									$.ajax({  
										type: 'POST',  
										url: 'procesar_formulario.php',  
										data: 'nombre='+nombre+'&empresa='+empresa+'&correo='+correo+'&tel1='+telefono1+'&tel2='+telefono2+'&tipo='+perfil, 
										
										success: function(html){ 
											alert('Registro de datos completo, nos contactaremos con usted');
											window.location.href= './';
										}
									});
								});	
							});
							function phone1Length(){
								var tel1 = $('#telefono1nuevo').val();
								var tel2 = $('#telefono2nuevo').val();
								if (tel1.length > 7 && tel2.length > 7)
								$('#guardar').removeAttr('disabled');
							}
							function phone2Length(){
								var tel1 = $('#telefono1nuevo').val();
								var tel2 = $('#telefono2nuevo').val();
								if (tel1.length > 7 && tel2.length > 7)
								$('#guardar').removeAttr('disabled');
							}
							function valida(e){
								tecla = (document.all) ? e.keyCode : e.which;
								if (tecla==8){
									return true;
								};
								patron =/[0-9]/;
								tecla_final = String.fromCharCode(tecla);
								return patron.test(tecla_final);
							};	
						</script>";
			}
	}
?>

<header>

	<div class="logo"><a href="./dashboard-agencia.php" target="_top"></a></div>
	<a href="#" class="ayuda_pi"><i class="fa fa-life-ring"></i></a>
	<a href="#" class="notes" ><i class="fa fa-bell-o"></i></a>
	<div class="menu" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);"></div>
</header>

<?php
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia2.php'){
		echo '';
	}else{
		echo '
			<nav>
				<ul>
					<li><i onClick="backHistory()" class="fa fa-chevron-left"></i></li>
					<li><a href="campana.php"><i class="fa fa-suitcase"></i> campañas</a></li>
					<li id="nuevaCampain"><a href="nueva-campana.php"><i class="fa fa-plus"></i> crear campañas</a></li>
					<li><a href="influenciador-publico.php"><i class="fa fa-user"></i> influencers</a></li>
				</ul>
			</nav>
		';
	}
?>
<form id="imagenform">

	<div class="fle-top"></div>

	<div class="misdatos">

		<div class="imagen" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);">

			<input type="file" name="file" id="file" class="hide"/>
			<label class="selectFile" for="file"><i class="fa fa-pencil"></i></label>

		</div>

		<div class="datos">

			<h2><?php echo $_SESSION['nombre']; ?></h2>
			<h3><?php echo $_SESSION['empresa']; ?></h3>

			<div class="editar"><span>editar perfil</span></div>

		</div>

		<div class="alert-uploadready" style="display:none;"><i class="fa fa-cloud-upload"></i>Imagen seleccionada con exito!</div>

	</div>

	<div id="inicio">

		<div id="tabContainer">

			<ul id="tabs">
				<li id="tabHeader_1" class="clickTab">Perfil Personales</li>
				<li id="tabHeader_2" class="clickTab">Datos Empresa</li>
			</ul>

			<div id="tabscontent">

				<div class="tabpage tab-hide" id="tabpage_1">

					<div id="nombre">
						<small>nombre</small>
						<input value="<?php echo $_SESSION['nombre']; ?>" disabled>
						<i class="fa fa-pencil"></i>
					</div>
					<div id="correo">
						<small>correo</small>
						<input value="<?php echo $_SESSION['correo']; ?>" disabled>
					</div>

				</div>

				<div class="tabpage tab-hide" id="tabpage_2">

					<div id="empresa">
						<small>empresa</small>
						<input value="<?php echo $_SESSION['empresa']; ?>" disabled>
						<i class="fa fa-pencil"></i>
					</div>
					<div id="tel1">
						<small>tel. empresa</small>
						<input type="text"  onkeypress="return valida(event)" maxlength="11" value="<?php echo $_SESSION['telefono1']; ?>" disabled>
						<i class="fa fa-pencil"></i>
					</div>
					<div id="tel2">
						<small>tel. personal</small>
						<input type="text"  onkeypress="return valida(event)" maxlength="11" value="<?php echo $_SESSION['telefono2']; ?>" disabled>
						<i class="fa fa-pencil"></i>
					</div>

				</div>

			</div>

		</div>

		<div class="cancel-data">Cancelar</div>

		<button id="guardarFacturacion" type="submit">Guardar cambios</button>

		<a href="logout.php" class="logout"><i class="fa fa-times-circle-o"></i> cerrar sesion</a>
	</div>

	<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
</form>