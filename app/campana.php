<?php include 'header.php'; ?>

<?php

	echo '<script>
			$(document).ready(function(){
				$(".activar-campana").click(function (){
						var idActualizar = this.id;
						var idEstado = this.type;
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

				$(".btneliminar").click(function (){
					var idEliminar = this.id;
					var tipo = "eliminar";

					if (confirm("realmente desea eliminar la campaña  :"+idEliminar)) {
						$.ajax({
							type: "POST",  
							url: "procesar_eliminar-campana.php",  
							data: "idEliminar="+idEliminar+"&tipo="+tipo,
						
							success: function(data){ 
								window.location.reload();
							}
						});  
					}
					return false; 
				
				});

				var foto;
				$(".file").click(function (){
					foto = "1";
				});


				var idAgencia = '.$_SESSION["id"].';
				var correo ="'.$_SESSION["correo"].'";
				var rsid ="'.$_SESSION["rsid"].'";
				var tipo ="imagen";
				$(".campanaForm").on("submit",(function (e){
					e.preventDefault();
					var info = new FormData(this);
					var id = this.id;
					var nombre = $("#"+id+" .nombre input").val();
					var marca = $("#"+id+" .marca input").val();
					var descripcion = $("#"+id+" .nombre textarea").val();
					info.append("nombre",nombre);
					info.append("marca",marca);
					info.append("descripcion",descripcion);
					info.append("idCampana",this.id);
					info.append("idpersona",idAgencia);	
					info.append("tipo",tipo);	
					info.append("campana",this.id);
					info.append("id",idAgencia);
					info.append("foto",foto);
					$.ajax({
							type: "POST",  
							url: "procesar_imagen.php",  
							data: info,
							enctype: "multipart/form-data",
							contentType: false,      
							cache: false,             
							processData:false,

						success: function(data){ 
								switch (data){
									case "nuevo": 	alert("registro actualizado");
													window.location.reload();
									break;
									default: alert("problema con el tamaño o formato de la imagen");
									break;
								}
						}
					
					});
				
				}));
			});	
		</script>';
	if ($num_rows > 0){
		echo '<h2 class="sub-titulo">campañas activas</h2><div class="creadas">';


	do{ 
		echo '
		<div class="recientes">
					
					<div class="cont-campana">
						
							<div class="bg-campana" style="background-image:url('.$row[3].');">
								
								<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>
								

								<div class="edit-campana" style="display:none;float:left;clear:both;"></div>

							</div>

							<div class="ver-mas"><span><i class="fa fa-angle-down"></i></span></div>
							
							<div class="content">
								<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
								<form class="campanaForm" id="'.$row[0].'">
									<ul class="tools-campana">
										<li class="activar-campana" type="1" id="'.$row[0].'" ><i class="tool-ico fa fa-remove"></i><span class="tool-txt"> desactivar</span></li>
									</ul>
									<div class="inputs-campana nombre nombre-campana" id="'.$row[0].'">
										<input placeholder="'.$row[1].'" disabled />
									</div>

									<div class="inputs-campana marca marca-campana" id="'.$row[0].'">
										<input  placeholder="by '.$row[4].'" disabled />
									</div>
									
									<span class="campa-ico"><i class="fa fa-cog"></i>Activada</span>
									<span class="campa-ico"><i class="fa fa-calendar"></i>02 Octubre 2015</span>
									
									<div class="inputs-campana descripcion descripcion-campana" id="'.$row[0].'">
										<textarea placeholder="descripcion" disabled>'.$row[2].'</textarea>
									</div>

									<!--button class="guardar-campana" type="submit" id="guardar-campana-'.$row[0].'">Guardar Cambios en '.$row[1].'</button-->
									
								</form>

								<div class="img-compana-deskt hide">
									<img src="'.$row[3].'"/>
								</div>
							</div>
						
					</div>

				</div>
		';
	}while($row = mysqli_fetch_row($result));
	echo '</div>';
	}
	if ($num_rows2 > 0){
		echo '<h2 class="sub-titulo">campañas inactivas</h2><div class="creadas">';

	do{ 
		echo '
			<div class="recientes">
				<div class="cont-campana">

					<div class="bg-campana" style="background-image:url('.$row2[3].');">
					
						<h3>'.$row2[1].'<span>by '.$row2[4].'</span></h3>

					</div>

					<div class="ver-mas"><span><i class="fa fa-angle-down"></i></span></div>

					<div class="content">
						<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
						<form class="campanaForm" id="'.$row2[0].'">

							<ul class="tools-campana">
								<li class="edit-campanas"><i class="tool-ico fa fa-pencil"></i><span class="tool-txt"> editar</span></li>
								<li class="activar-campana" id="'.$row2[0].'" name="0"><i class="tool-ico fa fa-check"></i><span class="tool-txt"> activar</span></li>
								<li class="btneliminar" id="'.$row2[0].'"><i class="tool-ico fa fa-trash-o"></i><span class="tool-txt"> eliminar</span></li>
							</ul>
							
							<div class="inputs-campana nombre" id="nombre-campana-'.$row2[0].'">
								<input placeholder="'.$row2[1].'" class="nombre-input" disabled></input>
								<i class="fa fa-pencil"></i>
							</div>

							<div class="inputs-campana marca" id="marca-campana-'.$row2[0].'">
								 <input placeholder="by '.$row2[4].'" disabled></input>
								 <i class="fa fa-pencil"></i>
							</div>
							
							<span class="campa-ico"><i class="fa fa-cog"></i>Desactivada</span>
							<span class="campa-ico"><i class="fa fa-calendar"></i>02 Octubre 2015</span>

							<div class="inputs-campana descripcion" id="descripcion-campana-'.$row2[0].'">
								<textarea placeholder="descripcion" disabled>'.$row2[2].'</textarea>
								<i class="fa fa-pencil"></i>
							</div>
							<script>
								$(window).load(function(){
									$("div.jfilestyle").hide();
								});
							</script>
							<input type="file" name="file" class="jfilestyle upload-img-campana file" data-input="false" id="file'.$row2[0].'" data-buttonText="subir archivo"/>
							
							<button class="guardar-campana" type="submit" id="guardar-campana-'.$row2[0].'">Guardar Campaña</button>
						
						</form>

						<div class="img-compana-deskt hide">
							<img src="'.$row2[3].'"/>
						</div>

					</div>

				</div>
			</div>

		
		';
	}while($row2 = mysqli_fetch_row($result2));
	echo '</div>';
	}
?>
</div>

<?php
	if($num_rows == 0 && $num_rows2 == 0){
		echo '<main class="no-campana"><a href="nueva-campana.php"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes crear una nueva, creala aquí.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
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