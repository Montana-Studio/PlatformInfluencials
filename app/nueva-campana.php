<?php
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
	header('Location:./');
	die();
}
else{
	//$mysqli->set_charset('utf8');
	$query="SELECT id FROM campana ORDER BY id DESC LIMIT 1";
	$result= mysqli_query($mysqli,$query)or die(mysqli_error());
	$row= mysqli_fetch_array($result, MYSQLI_NUM);

	$id = $_SESSION['id'];
	$query2="SELECT * FROM campana WHERE idpersona='$id'";
	$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
	$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Power Influencer - Crear campaña</title>

	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script>
		jQuery(document).ready(function(){
			$('body').addClass('crear-campanas');
		});
	</script>
</head>
<body>
	
	<?php include 'header.php'; ?>

	<h2>nueva campaña</h2>

	<?php if ((int)$row2[0]>0){  echo ' - <a href="campana.php">volver a campa&ntildea </a>'; }?>
	
	<form id="campanaForm">

		<div class="cont-input nombre">
			<input placeholder="Nombre de la Campaña" id="nombre" required>
			<i class="fa fa-pencil"></i>
		</div>
		<div class="cont-input marca">
			<input placeholder="Marca" id="marca" required>
			<i class="fa fa-pencil"></i>
		</div>
		<div class="cont-input descripcion">
			<textarea placeholder="Descripción" id="descripcion" rows="10" cols="40" required></textarea>
			<i class="fa fa-pencil"></i>
		</div>
		
		<h2>subir imagen</h2>
		<p>Sube una imagen que represente la campaña y que no supere los 200kb en su peso.</p>

		<input type="file" name="file" id="file2" required />
		<div id="searchImg2" class="changeImg">seleccionar archivo</div>

		<button class="guardar" id="guardar" type="submit">subir campaña</button>
	</form>

	<?php include 'footer.php'; ?>
</body>
</html>

