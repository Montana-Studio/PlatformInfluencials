<?php
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
header('Location:registro.php');
die();
}
else{
//$mysqli->set_charset('utf8');
$query="SELECT * FROM campana AS c WHERE c.idpersona=".$_SESSION['id']." ORDER BY c.id DESC";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);

$id = $_SESSION['id'];
$query2="SELECT COUNT(DISTINCT(id)) FROM campana WHERE idpersona='$id'";
$result2= mysqli_query($mysqli,$query2)or die(mysqli_error());
$row2= mysqli_fetch_array($result2, MYSQLI_NUM);


}
?>
<html>
<head>
<meta charset="UTF-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<title>campa&ntildeas </title>
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
	</style>

</head>
<body>
	<div style="text-align:right;">
		<a href="logout.php">cerrar sesion</a> - <a href>ayuda</a>
	</div>
	<?php 
	if ((int)$row[0] != 0){ ?>
		<?php 
			echo '
	<h2>campa&ntildeas</h2>
	<a href="dashboard-agencia.php">volver a dashboard</a> -<a href="nueva-campana.php">crear campa&ntildea </a>


	<div id="creadas"><h2>campa&ntildeas creadas</h2>';
			 do{ 
					echo '<script>
					$(document).ready(function(){
				
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar").hide();
					$(".cambiarImagen").hide();
					
					$("#btneditar'.$row[0].'").click(function (){
					$("#btneliminar'.$row[0].'").show();
					$("#btnpausar'.$row[0].'").show();
					$("#btneditar'.$row[0].'").hide();
					$("#marca'.$row[0].'").show();
					$("#descripcion'.$row[0].'").show();
					$("#guardar'.$row[0].'").show();
					$("#formImagen'.$row[0].'").show();
					});
					
					
					$("#guardar'.$row[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});
					
					$("#btnpausar'.$row[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});
					
					$("#btneliminar'.$row[0].'").click(function (){
					$(".btneliminar").hide();
					$(".marca").hide();
					$(".descripcion").hide();
					$(".btnpausar").hide();
					$(".guardar").hide();
					$(".btneditar").show();
					$(".cambiarImagen").hide();
					});

					var info;
					var idCampana = "';?><?php echo $row[0];?><?php echo '";
					var idAgencia = ';?><?php echo $_SESSION["id"];?><?php echo';
					var correo ="';?><?php echo $_SESSION["correo"];?><?php echo'";
					var rsid ="';?><?php echo $_SESSION["rsid"];?><?php echo '";
					$("#campanaForm'.$row[0].'").on("submit",(function (e){
						e.preventDefault();
						info = new FormData(this);
						info.append("nombre",$("#nombre"+idCampana+" input").val());
						info.append("marca",$("#marca"+idCampana+" input").val());
						info.append("descripcion",$("#descripcion"+idCampana+" textarea").val());
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
							console.log(data)	
							}
						
						});
					
					}));
					
			
					$("#formImagen'.$row[0].'").on("submit",(function (e){
						console.log(rsid);
						e.preventDefault();
						info = new FormData(this);
						info.append("campana",idCampana);
						info.append("id",idAgencia);
						info.append("correo",correo);
						info.append("rsid",rsid);
						console.log(rsid);
							$.ajax({
								type: "POST",  
								url: "procesar_imagen-campana.php",  
								data: info,
								enctype: "multipart/form-data",
								contentType: false,      
								cache: false,             
								processData:false, 
							
							success: function(data){ 
								console.log(data);
								//window.location.reload();
							}
							});
					}));
					
					
					$("#btneliminar'.$row[0].'").click(function (){
						var idEliminar = '.$row[0].';
						console.log(idEliminar);
							$.ajax({
								type: "POST",  
								url: "procesar_eliminar-campana.php",  
								data: "id="+idEliminar,
							
							success: function(data){ 
								window.location.reload();
							}
							});
					});
				});</script>
			
		
		
			<div id="Campana">
				<form id="campanaForm'.$row[0].'">
					<img width="400" height="auto"  src="'.$row[3].'"/><br/>
					<button class="btneditar" id="btneditar'.$row[0].'">editar</button>
					
					<button class="btneliminar" id="btneliminar'.$row[0].'">eliminar</button>
					
					<button class="btnpausar" id="btnpausar'.$row[0].'">pausar</button>
						<div class="nombre" id="nombre'.$row[0].'">
							<input value="'.$row[1].'"></input>
						</div>
						<div class="marca" id="marca'.$row[0].'">
							<input  value="'.$row[4].'"></input>
						</div>
						<div class="descripcion" id="descripcion'.$row[0].'">
							<textarea placeholder="descripcion" rows=10 cols=40 >'.$row[2].'</textarea>
						</div>
					<button class="guardar" id="guardar'.$row[0].'">Guardar Cambios en '.$row[1].'</button>
			</form>
		</div>
		
		<form class="cambiarImagen" id="formImagen'.$row[0].'">
			<div  id="selectImage">
				<input type="file" name="file" id="file" required /></br>
				<button id="cambiarImagen'.$row[0].'">Cambiar</button>
			</div>
		</form>
					
					
		';}while($row = mysqli_fetch_row($result)); ?>
	<?php 
	}else{
	echo ' <div>
				<h2>no registra campa&ntildeas</h2>
				<div>
				<a href="dashboard-agencia.php">volver a dashboard</a> - <a href="nueva-campana.php">crear campa&ntildea </a>
			</div>';
	}
	?>	
	<div id="contacto">
		<h2>Contacto</h2>
			<input placeholder="asunto"></input>
		<div>
			<textarea  placeholder="descripcion" rows=10 cols=40></textarea>
		</div>
		<div>
			<button>Enviar</button>
		</div>
	</div>

</body>
</html>