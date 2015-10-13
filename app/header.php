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
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
			
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
						$('html').css({'background-color':'#fff','background-image':'none','padding-bottom':'40px'});
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
						$('html').css({'background-color':'#fff','background-image':'none','padding-bottom':'40px'});
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
	}else{
		echo '
			<nav>
				<ul>
					<li><a href="campana.php"><i class="fa fa-suitcase"></i> campañas</a></li>
					<li><a href="#"><i class="fa fa-user"></i> influencers</a></li>
					<li><i onClick="backHistory()" class="fa fa-mail-reply"></i></li>
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
						<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono1']; ?>" disabled>
						<i class="fa fa-pencil"></i>
					</div>
					<div id="tel2">
						<small>tel. personal</small>
						<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono2']; ?>" disabled>
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