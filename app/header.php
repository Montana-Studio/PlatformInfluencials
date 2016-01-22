<?php
	require('conexion.php');
	if(isset($_SESSION['id'])==false){
	header('Location:./');
			die();
	}else if($_SESSION['id_tipo']>'2'){
				header('Location: dashboard-ipe');
				die();
	}
	function muestra_header(){
		echo '<!DOCTYPE html>
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
			<link rel="stylesheet" href="css/font-awesome.min.css">

			<script type="text/javascript" src="js/jquery.min.js"></script>
			<script type="text/javascript" src="js/jquery-ui.min.js"></script>
			<script async src="https://www.google.com/jsapi"></script>
            <script>
              (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
              })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

              ga("create", "UA-45276685-8", "auto");
              ga("send", "pageview");

            </script>
		</head>
		<body>';
    }
	if(basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
		if(isset($_SESSION['telefono1'])==false){
			header('Location: logout');
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
				header('Location: logout');
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
						$('html').css({'background-color':'#fff','background-image':'none','height':'100%'});
						$('body').addClass('crear-campanas');
					});
				</script>";
	}
	if(basename($_SERVER['PHP_SELF'])=='campana.php'){
			if(isset($_SESSION['telefono1'])==false){
				header('Location: logout');
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
						$('html').css({'background-color':'#fff','background-image':'none','height':'100%'});
						$('body').addClass('campanas');
					});
				</script>";
	}
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		if(isset($_SESSION['id'])==false){
				header('Location: logout');
				die();
			}else if($_SESSION['id_tipo']>'2'){
				header('Location: dashboard-ipe');
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
		require('rrss/twitter/inc/twitteroauth.php');
		require('rrss/twitter/inc/TwitterAPIExchange.php');
		require('rrss/rrss_keys.php');
		if(isset($_SESSION['telefono1'])==false){
			header('Location: logout');
			die();
		}
		else{
			$id=$_SESSION['id'];
			$query='SELECT * FROM persona WHERE id_estado=1 AND id_tipo>2 ORDER BY fecha_ingreso ASC';
			$result= mysqli_query($mysqli,$query)or die(mysqli_error());
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			$num_rows= mysqli_num_rows($result);
			//$query2='SELECT nombre FROM campana WHERE idpersona="'.$id.'" AND idEstado=1'; //Para cotizar solo en caso de estar activa la campaña
			$query2='SELECT * FROM campana WHERE idpersona="'.$id.'"';
			$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
			$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
			$num_rows2= mysqli_num_rows($result2);
			muestra_header();
			echo "<script>
					jQuery(document).ready(function(){
						$('title').append('Power Influencer - ".$_SESSION['nombre']."');
						$('html').css({'background-color':'#fff','background-image':'none','height':'100%'});
						$('body').addClass('influenciador-publico');
						$('.perfil_influenciador').click(function(){
                            var id_influenciador=this.id;
                            var campana_seleccionada=$('#campana_seleccionada option:selected').attr('value');
                            //console.log(campana_seleccionada);
                            window.location.replace('perfil_influenciador_publico?id='+id_influenciador+'&campana='+campana_seleccionada);
                        });
                    });
				</script>";
		}
	}
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia2.php'){
		if(isset($_SESSION['nombre'])==false){
			header('Location:./');
			die();
		}else if($_SESSION['id_tipo']>'2'){
				header('Location: dashboard-ipe');
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
	if(basename($_SERVER['PHP_SELF'])=='perfil_influenciador_publico.php'){
		if(isset($_SESSION['telefono1'])==false){
			header('Location: logout');
			die();
		}
		else{
			$id=$_GET['id'];
			$query='SELECT * FROM persona  WHERE id_estado="1" AND id_tipo>"2" AND id="'.$id.'"';
			$result= mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));
			$row= mysqli_fetch_array($result, MYSQLI_NUM);
			$num_rows= mysqli_num_rows($result);
			muestra_header();
            echo "<script>
                    jQuery(document).ready(function(){
						$('title').append('Power Influencer - ".$_SESSION['nombre']."');
						$('html').css({'background-color':'#fff','background-image':'none','height':'100%'});
						$('body').addClass('dashboard-ipe perfil-publico');
                    });
                </script>";
		
		}
	}
	/*if(basename($_SERVER['PHP_SELF'])=='influenciador-publico.php'){
		muestra_header();
		//echo "<script src='https://apis.google.com/js/client.js?onload=googleApiClientReady'></script>";


		if(isset($_SESSION['nombre'])==false){
			header('Location:index.php');
			die();
		}
		echo '
			<script>
				jQuery(document).ready(function(){
					$(".perfil_influenciador").click(function(){
						var id_influenciador=this.id;
						window.location.replace("perfil_influenciador_publico.php?id="+id_influenciador);
						//console.log(id_influenciador);
						//console.log("holi");
					});
				});
			</script>
		</head>
		<body>';
	}*/
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia3.php'){
		if(isset($_SESSION['id'])==false){
				header('Location: logout');
				die();
			}else if($_SESSION['id_tipo']>'2'){
				header('Location: dashboard-ipe');
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

	<div class="logo"><a href="./dashboard-agencia" target="_top"></a></div>
	<div class="menu" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);"></div>
	
	<a href="#" class="notes" ><i class="pi pi-bell"></i></a>
	<a href="#" class="ayuda_pi"><i class="pi pi-help"></i></a>
</header>

<?php
	if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		echo '';
	}else if(basename($_SERVER['PHP_SELF'])=='formulario-agencia2.php'){
		echo '';
	}else{
		echo '<nav>
				<ul>
					<li><i onClick="backHistory()" class="pi pi-arrow-left"></i></li>
					<li><a href="campana"><i class="pi pi-suitcase"></i> campañas</a></li>
					<li id="nuevaCampain"><a href="nueva-campana"><i class="pi pi-plus"></i> crear campañas</a></li>
					<li><a href="influenciador-publico"><i class="pi pi-user"></i> influencers</a></li>
				</ul>
			</nav>';
	}
?>
<form id="imagenform">

	<div class="fle-top"></div>

	<div class="misdatos">

		<div class="imagen" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);">

			<input type="file" name="file" id="file" class="hide"/>
			<label class="selectFile" for="file"><i class="pi pi-pencil"></i></label>

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
						<i class="pi pi-pencil"></i>
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
						<i class="pi pi-pencil"></i>
					</div>
					<div id="tel1">
						<small>tel. empresa</small>
						<input type="text"  onkeypress="return valida(event)" maxlength="11" value="<?php echo $_SESSION['telefono1']; ?>" disabled>
						<i class="pi pi-pencil"></i>
					</div>
					<div id="tel2">
						<small>tel. personal</small>
						<input type="text"  onkeypress="return valida(event)" maxlength="11" value="<?php echo $_SESSION['telefono2']; ?>" disabled>
						<i class="pi pi-pencil"></i>
					</div>

				</div>

			</div>

		</div>

		<div class="cancel-data">Cancelar</div>

		<button id="guardarFacturacion" type="submit">Guardar cambios</button>

		<a href="logout" class="logout"><i class="pi pi-singout"></i> cerrar sesion</a>
	</div>

	<div class="btn_close"><span><i class="pi pi-close"></i></span></div>
</form>