<?php
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
	header('Location:registro.php');
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
<html>
<head>
	<meta charset="UTF-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<title>crear campa&ntildea </title>
	<script>
	$(document).ready(function(){
		var aa= <?php echo (int)$row[0];?>;
		var idActual = aa+1;
		var info;
		$('#campanaForm').on('submit',(function (e){
			e.preventDefault;
			info = new FormData(this);	
			info.append('nombre',$('#nombre').val());
			info.append('marca',$('#marca').val());
			info.append('descripcion',$('#descripcion').val());
			info.append('campana',idActual);
			info.append('id',<?php echo $_SESSION["id"];?>);
			info.append('correo','<?php echo $_SESSION["correo"];?>');
			info.append('rsid','<?php echo $_SESSION["rsid"];?>');
			$.ajax({
					type: 'POST',  
					url: 'procesar_nueva-campana.php',  
					data: info,
					enctype: 'multipart/form-data',
					contentType: false,      
					cache: false,             
					processData:false, 
				
					success: function(data){ 
					}
				});
		}));

	});
	</script>
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
	<h2>crear campa&ntildea </h2>
	
	<a href="dashboard-agencia.php">volver a dashboard</a> <?php if ((int)$row2[0]>0){  echo ' - <a href="campana.php">volver a campa&ntildea </a>'; }?>
		<form id="campanaForm">
				<div class="nombre" >
					<input placeholder="nombre" id="nombre" required >
				</div>
				<div class="marca" >
					<input placeholder="marca" id="marca" required >
				</div>
				<div class="descripcion" >
					<textarea placeholder="descripcion" id="descripcion" rows="10" cols="40" required ></textarea>
				</div>
				<h3>subir imagen</h3>
				<div>
					<input type="file" name="file" id="file" required />
				</div>
				<div>
					<button class="guardar" id="guardar">subir campa&ntildea </button>
				</div>
		</form>
</body>
</html>

