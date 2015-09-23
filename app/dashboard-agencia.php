<?php
	//holi
	require('conexion.php');
	if(isset($_SESSION['nombre'])==false){
		header('Location:/');
		die();
	}
	else{
		//$mysqli->set_charset('utf8');
		$id=$_SESSION['id'];
		$query="SELECT * FROM campana  WHERE idpersona=".$id." ORDER BY id DESC LIMIT 3";
		$result= mysqli_query($mysqli,$query)or die(mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_NUM);
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Power Influencer - <?php echo $_SESSION['nombre']; ?></title>

	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>

	<header>
		
		<div class="logo"></div>
		<i class="notes fa fa-bell-o"></i>
		<div class="menu" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);"></div>

	</header>

	<a href="#" class="ayuda_pi">¿Necesitas ayuda?</a>

	<form id="imagenform">
		
		<div class="fle-top"></div>
		
		<div class="misdatos">
			
			<div class="imagen" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);">
			
				<input type="file" name="file" id="file" class="hide">
				<div id="searchImg" class="changeImg"><i class="fa fa-pencil"></i></div>

			</div>
			
			<div class="datos">
				
				<h2><?php echo $_SESSION['nombre']; ?></h2>
				<h3><?php echo $_SESSION['empresa']; ?></h3>
				
				<div class="editar">editar perfil</div>

			</div>

		</div>
		
		<div id="inicio" disabled>
		
			<div id="tabContainer">
				
				<div id="tabs">
					<h2 id="tabHeader_1" class="clickTab">Perfil Personales</h2>
					<h2 id="tabHeader_2" class="clickTab">Datos Empresa</h2>
				</div>

				<div id="tabscontent">
					
					<div class="tabpage tab-hide" id="tabpage_1">
						
						<div id="nombre">
							<small>nombre</small>
							<input value="<?php echo $_SESSION['nombre']; ?>">
						</div>
						<div id="correo">
							<small>correo</small>
							<input value="<?php echo $_SESSION['correo']; ?>" disabled>
						</div>

					</div>

					<div class="tabpage tab-hide" id="tabpage_2">
						
						<div id="empresa">
							<small>empresa</small>
							<input value="<?php echo $_SESSION['empresa']; ?>">
						</div>
						<div id="tel1">
							<small>tel. empresa</small>
							<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono1']; ?>">
						</div>
						<div id="tel2">
							<small>tel. personal</small>
							<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono2']; ?>">
						</div>

					</div>

				</div>

			</div>
			
			<button id="guardarFacturacion" type="submit">Actualizar</button>

			<input id="RsId" style="display:none" value="<?php echo $_SESSION['rsid']; ?>">

			<a href="logout.php" class="logout"><i class="fa fa-times-circle-o"></i> cerrar sesion</a>
		</div>

	</form>

	<?php 
		if ((int)$row[0] != 0){ ?>
			<?php 
				echo '
				<a href="campana.php">ir a campa&ntildeas</a>
			
				<div id="creadas">
					<h2>&uacutetlimas campa&ntildeas creadas</h2>
					<script type="text/javascript">
						$(document).ready(function(){
							$(".volver").hide();
							var contador=0;
							$("#recientes .content_all").click(function(){
								if (contador==0){
								$("#recientes .content_all").not(this).hide();
								$("#recientes .content, .volver").show(this);
									//console.log(clicked_id);
									contador=1;
								}
							});
							
							$(".volver").click(function(){
								if (contador==1){
								$("#recientes .content_all").show();
								$("#recientes .content").hide();
									//console.log(clicked_id);
									contador=0;
									$(".volver").hide();
								}
							});
						});
					</script>
				
				';
					do{
					echo '
					<div id="recientes">
						<div class="content_all">
						<img id="imagen'.$row[0].'"width="100" height="auto"  src="'.$row[3].'"/>
							<div class="content" >
								<p class="campana'.$row[0].'" ">'.$row[2].'</p>
								<p>'.$row[4].'</p>
								
							</div>
						</div>
					 </div>
				 
					'; }while($row = mysqli_fetch_row($result)); ?>
					
					<?php echo '<button class="volver">Volver</button>';?>
				</div>
		<?php 
			}else{
				echo '<a href="nueva-campana.php"><h2>crear campa&ntildea</h2></a>';
			}
		?>	
	
	<div id="contacto" class="hide">
		<h2>Contacto</h2>
		<div>
			<input placeholder="asunto">
		</div>
		<div>
			<textarea  placeholder="descripcion" rows="10" cols="40"></textarea>
		</div>
		<div>
			<button>Enviar</button>
		</div>
	</div>
	
	<script type="text/javascript" async src="js/platform_influencials.min.js"></script>
	<script type="text/javascript" src="js/form-passes.js"></script>
	<script type="text/javascript" src="js/tabs.js"></script>
</body>
</html>