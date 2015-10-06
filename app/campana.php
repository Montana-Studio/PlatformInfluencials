<?php include 'header.php'; ?>

<div id="creadas">
<?php 
	if ($num_rows > 0){
		echo '<h2 class="sub-titulo">campañas activas</h2>';

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

			
			<div class="recientes">
				
				<div class="cont-campana">
					
					<div class="bg-campana" style="background-image:url('.$row[3].');">
						
						<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>
						
						<div class="ver-mas"><span><i class="fa fa-angle-down"></i></span></div>

					</div>

					<div class="content">
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
							
							<div id="activar-campana-'.$row[0].'">desactivar campaña - '.$row[1].'</div>
							
						</form>
					</div>
				</div>

			</div>
			
		';
	}while($row = mysqli_fetch_row($result));
		 //echo '<div class="volver-campana">cerrar</div>';
	}
	if ($num_rows2 > 0){
		echo '<h2 class="sub-titulo">campañas inactivas</h2>';

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

		<div class="recientes">
			<div class="cont-campana">

				<div class="bg-campana" style="background-image:url('.$row2[3].');">
				
					<h3>'.$row2[1].'<span>by '.$row2[4].'</span></h3>

					<div class="ver-mas"><span><i class="fa fa-angle-down"></i></span></div>

				</div>

				<div class="content">
					<form id="campanaForm'.$row2[0].'">
						<div>
							<button id="activar-campana-'.$row2[0].'">activar campaña - '.$row2[1].'</button>
						</div>
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

			</div>
		</div>

		';
	}while($row2 = mysqli_fetch_row($result2));

		echo '<div class="volver-campana">cerrar</div>';
	}
?>

</div>

<?php
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

	<script type="text/javascript" async>
		$(document).ready(function(){
			
			$(".volver-campana, .recientes .content").hide();
					
			$(".recientes .cont-campana").on("click",function(){
				$(".recientes .cont-campana, .recientes .content, .volver-campana").slideDown(this);
			});
			
			var contador=0;
			
			$(".recientes .cont-campana").on("click",function(){
				if (contador==0){
					$(".recientes .cont-campana").not(this).slideUp(function(){
						$(".sub-titulo").slideUp();
						$(".recientes .content, .volver-campana").slideDown(this);
					});
					contador=1;
				}
			});
			
			$(".volver-campana").on("click",function(){
				if (contador==1){
				
					$(".recientes .content").slideUp(function(){
						$(".sub-titulo").slideDown();
						$(".recientes .cont-campana").slideDown();
					});
					contador=0;
					console.log("fin");
					$(".volver-campana").hide();
					
				}
			});

		});
	</script>
</body>
</html>