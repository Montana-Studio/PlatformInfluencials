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

	<script>
		jQuery(document).ready(function(){
			$('body').addClass('dashboard-agencia');
		});
	</script>
</head>
<body>

	<?php include 'header.php'; ?>

	<?php 
		if ((int)$row[0] != 0){ ?>
			<?php 
				echo '
			
				<div id="creadas">

					<script type="text/javascript">

						$(document).ready(function(){

							//$(".volver").hide();
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
				echo '<main class="no-campana"><a href="nueva-campana.php"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Quisque posuere risus erat  at scelerisque felis pulvinar quis.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
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
	
	<?php include 'footer.php'; ?>
</body>
</html>