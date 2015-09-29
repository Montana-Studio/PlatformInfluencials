<?php
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
	header('Location:./');
	die();
}	
$query="SELECT * FROM campana WHERE idEstado = 1 AND idpersona=".$_SESSION['id']."  ORDER BY id DESC";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);
$num_rows = mysqli_num_rows($result);

$query2="SELECT * FROM campana WHERE idEstado = 0 AND idpersona=".$_SESSION['id']."  ORDER BY id DESC";
$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
$num_rows2 = mysqli_num_rows($result2);
/*
$id = $_SESSION['id'];
$query2="SELECT COUNT(DISTINCT(id)) FROM campana WHERE idpersona='$id'";
$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
$row2= mysqli_fetch_array($result2, MYSQLI_NUM);
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Power Influencer - Campañas</title>

	<link rel="stylesheet" href="css/platform_influencials.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script>
		jQuery(document).ready(function(){
			$('body').addClass('campanas');
		});
	</script>
</head>
<body>
<?php include 'header.php'; ?>
	<?php 

	if ($num_rows>0){
		echo '
		<a href="dashboard-agencia.php">volver a dashboard</a> -<a href="nueva-campana.php">crear campa&ntildea </a>


		<div id="activas"><h2>campa&ntildeas activas</h2>';
				do{ 
					
					echo '<script>
					$(document).ready(function(){
				
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".cambiarImagen").hide();
					
					$("#btneditar'.$row[0].'").click(function (){
					$("#btneliminar'.$row[0].'").show();
					$("#btnpausar'.$row[0].'").show();
					$("#btneditar'.$row[0].'").hide();
					$("#marca-campana-'.$row[0].'").show();
					$("#descripcion-campana-'.$row[0].'").show();
					$("#guardar-campana-'.$row[0].'").show();
					$("#formImagen-campana-'.$row[0].'").show();
					});
					
					
					$("#guardar'.$row[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca-campana-").hide();
					$(".descripcion-campana-").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});
					
					$("#btnpausar'.$row[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});
					
					$("#btneliminar'.$row[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});

					var info;
					var idCampana = "'.$row[0].'";
					var idAgencia = '.$_SESSION["id"].';
					var correo ="'.$_SESSION["correo"].'";
					var rsid ="'.$_SESSION["rsid"].'";
					$("#campanaForm'.$row[0].'").on("submit",(function (e){
						e.preventDefault();
						info = new FormData(this);
						info.append("nombre",$("#nombre-campana-"+idCampana+" input").val());
						info.append("marca",$("#marca-campana-"+idCampana+" input").val());
						info.append("descripcion",$("#descripcion-campana-"+idCampana+" textarea").val());
						info.append("id",idCampana);
						info.append("idpersona",idAgencia);	
						$.ajax({
								type: "POST",  
								url: "procesar-campana-agencia.php",  
								data: info,
								enctype: "multipart/form-data",
								contentType: false,      
								cache: false,             
								processData:false,

							success: function(data){ 
							console.log(data);
							}
						
						});
					
					}));
					
			
					$("#formImagen-campana-'.$row[0].'").on("submit",(function (e){
					
						e.preventDefault();
						info = new FormData(this);
						info.append("campana",idCampana);
						info.append("id",idAgencia);
						info.append("correo",correo);
						info.append("rsid",rsid);
						info.append("tipo","imagen");
							$.ajax({
								type: "POST",  
								url: "procesar_imagen.php",  
								data: info,
								enctype: "multipart/form-data",
								contentType: false,      
								cache: false,             
								processData:false, 

							
							success: function(info){
								switch (info){
								case "error": 	alert("arhivo con daños");				
								break;
								case "nuevo":	alert("imagen cambiada");
								break;
								case "invalido": alert("el tamaño o formato no es aceptado");
								break;
								}
							}
							});
					}));
					
					
					$("#btneliminar'.$row[0].'").click(function (){
						var idEliminar = '.$row[0].';
						if (confirm("realmente desea eliminar la campaña  :  '.$row[1].'")) {
							$.ajax({
								type: "POST",  
								url: "procesar_eliminar-campana.php",  
								data: "id="+idEliminar,
							
							success: function(data){ 
								window.location.reload();
							}
							});  
						} 


					});
					});</script>
			
		
			
					<div id="Campana">
						<form id="campanaForm'.$row[0].'">
							<img width="400" height="auto"  src="'.$row[3].'"/><br/>
							<button class="btneditar" id="btneditar'.$row[0].'">editar</button>
							
							<button class="btneliminar" id="btneliminar'.$row[0].'">eliminar</button>
							
							<button class="btnpausar" id="btnpausar'.$row[0].'">pausar</button>
								<div class="nombre" id="nombre-campana-'.$row[0].'">
									<input value="'.$row[1].'"></input>
								</div>
								<div class="marca" id="marca-campana-'.$row[0].'">
									<input  value="'.$row[4].'"></input>
								</div>
								<div class="descripcion" id="descripcion-campana-'.$row[0].'">
									<textarea placeholder="descripcion" rows=10 cols=40 >'.$row[2].'</textarea>
								</div>
							<button class="guardar-campana" type="submit" id="guardar-campana-'.$row[0].'">Guardar Cambios en '.$row[1].'</button>
					</form>
				</div>
				
				<form class="cambiarImagen" id="formImagen-campana-'.$row[0].'">
					<div  id="selectImage">
						<input type="file" name="file" required /></br>
						<button id="cambiarImagen'.$row[0].'">Cambiar</button>
					</div>
				</form>
							
						
			';}while($row = mysqli_fetch_row($result));

	}
	if ($num_rows2>0){
			
			echo '
			<a href="dashboard-agencia.php">volver a dashboard</a> -<a href="nueva-campana.php">crear campa&ntildea </a>


			<div id="inactivas"><h2>campa&ntildeas inactivas</h2>';
				do{ 
					echo '
					<script>
					$(document).ready(function(){
				
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".cambiarImagen").hide();
					
					$("#btneditar'.$row2[0].'").click(function (){
					$("#btneliminar'.$row2[0].'").show();
					$("#btnpausar'.$row2[0].'").show();
					$("#btneditar'.$row2[0].'").hide();
					$("#marca-campana-'.$row2[0].'").show();
					$("#descripcion-campana-'.$row2[0].'").show();
					$("#guardar-campana-'.$row2[0].'").show();
					$("#formImagen-campana-'.$row2[0].'").show();
					});
					
					
					$("#guardar'.$row2[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca-campana-").hide();
					$(".descripcion-campana-").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});
					
					$("#btnpausar'.$row2[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});
					
					$("#btneliminar'.$row2[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar-campana").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});

					var info;
					var idCampana = "'.$row2[0].'";
					var idAgencia = '.$_SESSION["id"].';
					var correo ="'.$_SESSION["correo"].'";
					var rsid ="'.$_SESSION["rsid"].'";
					$("#campanaForm'.$row2[0].'").on("submit",(function (e){
						e.preventDefault();
						info = new FormData(this);
						info.append("nombre",$("#nombre-campana-"+idCampana+" input").val());
						info.append("marca",$("#marca-campana-"+idCampana+" input").val());
						info.append("descripcion",$("#descripcion-campana-"+idCampana+" textarea").val());
						info.append("id",idCampana);
						info.append("idpersona",idAgencia);	
						$.ajax({
								type: "POST",  
								url: "procesar-campana-agencia.php",  
								data: info,
								enctype: "multipart/form-data",
								contentType: false,      
								cache: false,             
								processData:false,

							success: function(data){ 
							console.log(data);
							}
						
						});
					
					}));
					
			
					$("#formImagen-campana-'.$row2[0].'").on("submit",(function (e){
					
						e.preventDefault();
						info = new FormData(this);
						info.append("campana",idCampana);
						info.append("id",idAgencia);
						info.append("correo",correo);
						info.append("rsid",rsid);
						info.append("tipo","imagen");
							$.ajax({
								type: "POST",  
								url: "procesar_imagen.php",  
								data: info,
								enctype: "multipart/form-data",
								contentType: false,      
								cache: false,             
								processData:false, 

							
							success: function(info){
								switch (info){
								case "error": 	alert("arhivo con daños");				
								break;
								case "nuevo":	alert("imagen cambiada");
								break;
								case "invalido": alert("el tamaño o formato no es aceptado");
								break;
								}
							}
							});
					}));
					
					
					$("#btneliminar'.$row2[0].'").click(function (){
						var idEliminar = '.$row2[0].';
						if (confirm("realmente desea eliminar la campaña  :  '.$row2[1].'")) {
							$.ajax({
								type: "POST",  
								url: "procesar_eliminar-campana.php",  
								data: "id="+idEliminar,
							
							success: function(data){ 
								window.location.reload();
							}
							});  
						} 


					});
					});</script>
			
		
		
					<div id="Campana">
						<form id="campanaForm'.$row2[0].'">
							<img width="400" height="auto"  src="'.$row2[3].'"/><br/>
							<button class="btneditar" id="btneditar'.$row2[0].'">editar</button>
							
							<button class="btneliminar" id="btneliminar'.$row2[0].'">eliminar</button>
							
							<button class="btnpausar" id="btnpausar'.$row2[0].'">pausar</button>
								<div class="nombre" id="nombre-campana-'.$row2[0].'">
									<input value="'.$row2[1].'"></input>
								</div>
								<div class="marca" id="marca-campana-'.$row2[0].'">
									<input  value="'.$row2[4].'"></input>
								</div>
								<div class="descripcion" id="descripcion-campana-'.$row2[0].'">
									<textarea placeholder="descripcion" rows=10 cols=40 >'.$row2[2].'</textarea>
								</div>
							<button class="guardar-campana" type="submit" id="guardar-campana-'.$row2[0].'">Guardar Cambios en '.$row[1].'</button>
					</form>
				</div>
			
				<form class="cambiarImagen" id="formImagen-campana-'.$row2[0].'">
					<div  id="selectImage">
						<input type="file" name="file" required /></br>
						<button id="cambiarImagen'.$row2[0].'">Cambiar</button>
					</div>
				</form>
							
							
				';}while($row2 = mysqli_fetch_row($result2));

	} 
	if($num_rows == 0 && $num_rows2 == 0){
		echo '<main class="no-campana"><a href="nueva-campana.php"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Quisque posuere risus erat  at scelerisque felis pulvinar quis.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
	}
	?>	
	
	<div id="contacto" class="hide">
		<h2>Contacto</h2>
			<input placeholder="asunto"></input>
		<div>
			<textarea  placeholder="descripcion" rows=10 cols=40></textarea>
		</div>
		<div>
			<button>Enviar</button>
		</div>
	</div>
	
	<?php include 'footer.php'; ?>
</body>
</html>