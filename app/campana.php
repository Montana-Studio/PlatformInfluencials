<?php include 'header.php'; ?>	
<?php 
if ($num_rows > 0){
	echo '
		<div id="creadas"><h2>campa&ntildeas activas</h2>';
	do{ 
		echo '
			<script>
				$(document).ready(function(){
					var foto;
					$("#file'.$row[0].'").click(function (){
						foto = "1";
					});

					var info;
					var idCampana = "'.$row[0].'";
					var idAgencia = '.$_SESSION["id"].';
					var correo ="'.$_SESSION["correo"].'";
					var rsid ="'.$_SESSION["rsid"].'";
					var tipo ="imagen";
					$("#campanaForm'.$row[0].'").on("submit",(function (e){
						e.preventDefault();
						info = new FormData(this);
						info.append("nombre",$("#nombre-campana-"+idCampana+" input").val());
						info.append("marca",$("#marca-campana-"+idCampana+" input").val());
						info.append("descripcion",$("#descripcion-campana-"+idCampana+" textarea").val());
						info.append("idCampana",idCampana);
						info.append("idpersona",idAgencia);	
						info.append("tipo",tipo);	
						info.append("campana",idCampana);
						info.append("id",idAgencia);
						info.append("foto",foto);
						console.log(foto);
						$.ajax({
								type: "POST",  
								url: "procesar_imagen.php",  
								data: info,
								enctype: "multipart/form-data",
								contentType: false,      
								cache: false,             
								processData:false,

							success: function(data){ 
							window.location.reload();
							}
						
						});
					}));
					
					$("#activar-campana-'.$row[0].'").click(function (){
						var idActualizar = '.$row[0].';
						var idEstado = 0;
						var tipo = "activar";
							$.ajax({
								type: "POST",  
								url: "procesar_eliminar-campana.php",  
								data: "idActualizar="+idActualizar+"&idEstado="+idEstado+"&tipo="+tipo,
								success: function(data){ 
									window.location.reload();
								}
							});  
						});
				});
			</script>
	
			<div id="Campana" class="recientes">

				<div>
				<button id="activar-campana-'.$row[0].'">desactivar campaña - '.$row[1].'</button>
				</div>
				<div class="bg-campana" style="background-image:url('.$row[3].');">
					
				</div>
				<form id="campanaForm'.$row[0].'">
										
					<div class="nombre" id="nombre-campana-'.$row[0].'">
						<input value="'.$row[1].'"></input>
					</div>

					<div class="marca" id="marca-campana-'.$row[0].'">
						by<input  value="'.$row[4].'"></input>
					</div>

					<div class="descripcion" id="descripcion-campana-'.$row[0].'">
						<textarea placeholder="descripcion" rows=10 cols=40 >'.$row[2].'</textarea>
					</div>

					<input type="file" name="file" class="jfilestyle" data-input="false" id="file'.$row[0].'" data-buttonText="subir archivo"/>

					<button class="guardar-campana" type="submit" id="guardar-campana-'.$row[0].'">Guardar Cambios en '.$row[1].'</button>
				</form>
			</div>	
			
		';}while($row = mysqli_fetch_row($result));
	}

if ($num_rows2 > 0){
		echo '
			<div id="creadas"><h2>campa&ntildeas inactivas</h2>';
		 do{ 
				echo '
				
				<script>
					$(document).ready(function(){
						var foto;

						$("#file'.$row2[0].'").click(function (){
							foto = "1";
						});

						var info;
						var idCampana = "'.$row2[0].'";
						var idAgencia = '.$_SESSION["id"].';
						var correo ="'.$_SESSION["correo"].'";
						var rsid ="'.$_SESSION["rsid"].'";
						var tipo ="imagen";
						$("#campanaForm'.$row2[0].'").on("submit",(function (e){
							e.preventDefault();
							info = new FormData(this);
							info.append("nombre",$("#nombre-campana-"+idCampana+" input").val());
							info.append("marca",$("#marca-campana-"+idCampana+" input").val());
							info.append("descripcion",$("#descripcion-campana-"+idCampana+" textarea").val());
							info.append("idCampana",idCampana);
							info.append("idpersona",idAgencia);	
							info.append("tipo",tipo);	
							info.append("campana",idCampana);
							info.append("id",idAgencia);
							info.append("foto",foto);
							console.log(foto);
							$.ajax({
									type: "POST",  
									url: "procesar_imagen.php",  
									data: info,
									enctype: "multipart/form-data",
									contentType: false,      
									cache: false,             
									processData:false,

								success: function(data){ 
									window.location.reload();
								}
							
							});
						
						}));					
				
						$("#btneliminar'.$row2[0].'").click(function (){
							var idEliminar = '.$row2[0].';
							var tipo = "eliminar";

							if (confirm("realmente desea eliminar la campaña  :  '.$row2[1].'")) {
								$.ajax({
									type: "POST",  
									url: "procesar_eliminar-campana.php",  
									data: "idEliminar="+idEliminar+"&tipo="+tipo,
								
									success: function(data){ 
										alert(data);
										//window.location.reload();
									}
								});  
								} 
						
						});

						$("#activar-campana-'.$row2[0].'").click(function (){
							var idActualizar = '.$row2[0].';
							var idEstado = 1;
							var tipo = "activar";
								$.ajax({
									type: "POST",  
									url: "procesar_eliminar-campana.php",  
									data: "idActualizar="+idActualizar+"&idEstado="+idEstado+"&tipo="+tipo,
									success: function(data){ 
										window.location.reload();
									}
								});  
							});

						});
				</script>
		
		<div id="Campana">
			<form id="campanaForm'.$row2[0].'">
				<div>
					<button id="activar-campana-'.$row2[0].'">activar campaña - '.$row2[1].'</button>
				</div>
				<img width="400" height="auto"  src="'.$row2[3].'"/><br/>
				<button class="btneliminar" id="btneliminar'.$row2[0].'">eliminar</button>
					<div class="nombre" id="nombre-campana-'.$row2[0].'">
						<input value="'.$row2[1].'"></input>
					</div>
					<div class="marca" id="marca-campana-'.$row2[0].'">
						<input  value="'.$row2[4].'"></input>
					</div>
					<div class="descripcion" id="descripcion-campana-'.$row2[0].'">
						<textarea placeholder="descripcion" rows=10 cols=40 >'.$row2[2].'</textarea>
					</div>
					<div>
						<input type="file" name="file" class="jfilestyle" data-input="false" id="file'.$row2[0].'" data-buttonText="subir archivo"/>
					</div>
				<button class="guardar-campana" type="submit" id="guardar-campana-'.$row2[0].'">Guardar Cambios en '.$row2[1].'</button>
			</form>
		</div>
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