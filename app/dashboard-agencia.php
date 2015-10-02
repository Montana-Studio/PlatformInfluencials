<?php
	//holi
	require('conexion.php');
	if(isset($_SESSION['nombre'])==false){
		header('Location:./');
		die();
	}
	else{
		//$mysqli->set_charset('utf8');
		$id=$_SESSION['id'];
		$query="SELECT * FROM campana  WHERE idEstado=1 AND idpersona=".$id." ORDER BY id DESC LIMIT 3";
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
		if ((int)$row[0] > 0){ ?>
			<?php 
				echo '
			
				<div id="creadas">

					<script type="text/javascript">

						$(document).ready(function(){

							$(".volver, .recientes .content").hide();
							
							var contador=0;
							
							$(".recientes .cont-campana").on("click",function(){
								if (contador==0){
									$(".recientes .cont-campana").not(this).fadeOut(function(){
										$(".recientes .content, .volver").fadeIn(this);
									});
									contador=1;
								}
							});
							
							$(".volver").on("click",function(){
								if (contador==1){
								
								$(".recientes .content").fadeOut(function(){
									$(".recientes .cont-campana").fadeIn();
								});
									contador=0;
									$(".volver").fadeOut();
								}
							});
						});

					</script>
				
				';
					do{
					echo '
					<div class="recientes">
						<div class="cont-campana" id="imagen'.$row[0].'">
							
							<div class="bg-campana" style="background-image:url('.$row[3].');">
								
								<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>

								<ul class="redes-inline">
									<li><i class="fa fa-facebook"></i><span>0000</span></li>
									<li><i class="fa fa-instagram"></i><span>0000</span></li>
									<li><i class="fa fa-twitter"></i><span>0000</span></li>
								</ul>
								
								<div class="ver-mas"><span><i class="fa fa-angle-down"></i></span></div>

							</div>
							
							<div class="content">
								<span><i class="fa fa-cog"></i>Publicada</span><span><i class="fa fa-calendar"></i>02 Octubre 2015</span>
								<p id="campana'.$row[0].'">'.$row[2].'</p>
							</div>

						</div>

						

					 </div>
				 
					'; }while($row = mysqli_fetch_row($result)); ?>
					
					<?php echo '<div class="volver">cerrar</div>';?>
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