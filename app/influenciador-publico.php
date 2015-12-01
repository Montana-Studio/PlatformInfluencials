<?php include 'header.php'; ?>

<?php
		if($_GET['campana']){
			echo '
					<div id="campanas-postulables">
						<select>a
							<option selected="selected" id="'.$_GET["id"].'" disabled>'.$_GET["campana"].'</option>
						</select>
					</div>';

		}else{
				//echo $hoyFormatted;
			echo '<button id="opc_cot"> Cotizar para campañas </button>';

				//mostrar campañas
			if ($num_rows2 > 0){
				echo '<div id="campanas-postulables" ><select>
						<option selected="selected" disabled>Seleccione campaña</option>';
			do{
				echo '<option>'.$row2[0].'</option>';
			}while($row2 = mysqli_fetch_row($result2));
				echo '</select></div>';
			}

			echo '	<script>$(document).ready(function(){
								$("#campanas-postulables").hide();
			   				})
					</script>';


		}
		
			//mostrar influenciadores
		if ($num_rows > 0){
			echo '<h2 class="sub-titulo">Influenciadores</h2><div class="influenciadores">';
			do{
				echo '<div>
						<form id="'.$row[0].'"class="contactarForm" name="'.$row[5].'">
							<div id='.$row[0].'>
							<p class="nombre">'.$row[5].'</p>
							<p class="ubicacion">'.$row[15].','.$row[16].'</p>
							<p class="tipo">'.$row[2].'</p>
							<img src="'.$row[12].'"/>
							<div class="checkbox-cotizar">
								<label for="cotizar-'.$row[0].'">Agregar</label><input class="influenciador" name="'.$row[5].'"  value="'.$row[0].'" type="checkbox"/>
							</div>
						</form>
						</div>';
			}while($row = mysqli_fetch_row($result));
		}

?>

<?php
		echo '
		<script>
			
			$(document).ready(function(){
				
				$("#opc_cot").click(function(){
					$("#campanas-postulables").show();
					$("#opc_cot").hide();
					$(".boton_cotizar").hide();
					$("#campanas-postulables").show();
				})

				$("#cotizar_influenciador").click(function(){
					var influenciadores_cotizados="";
					var influenciadores_cotizados_nombre ="";
					$("input:checked").each(function() {
						influenciadores_cotizados += this.value +",";
						influenciadores_cotizados_nombre += this.name +",";
					});
					var largo_string_influenciadores = influenciadores_cotizados.length - 1;
					var influenciadores_cotizados = influenciadores_cotizados.substring(0,largo_string_influenciadores);
					var array_id_influenciadores_seleccionados= influenciadores_cotizados.split(",");
					var array_nombre_influenciadores_seleccionados = influenciadores_cotizados_nombre.split(",");
					var agencia = "'.$_SESSION["nombre"].'";
					var correo_agencia = "'.$_SESSION["correo"].'";
					var influenciador = this.name;
					var campana = $("#campanas-postulables option:selected").val();
					var id_campana = $("#campanas-postulables option:selected").attr("id");
					if(campana =="Seleccione campaña") campana = "Sin especificar";
					for(var i=0; i<array_id_influenciadores_seleccionados.length; i++){
						var influenciador_id=array_id_influenciadores_seleccionados[i];
						var influenciador= array_nombre_influenciadores_seleccionados[i];
						$.ajax({
							type: "POST",
							url: "contactar.php",
							data: "agencia="+agencia+"&correo_agencia="+correo_agencia+"&influenciador="+influenciador+"&influenciador_id="+influenciador_id+"&campana="+campana+"&id_campana="+id_campana,
							success: function(data){
								$("#campanas-postulables").hide();
								$("#campanas-postulables").show();
								$("#opc_cot").show();
								$(".boton_cotizar").show();
								$("#campanas-postulables").hide();
								$("input:checkbox").removeAttr("checked");
							}
						});

					}
					if(array_id_influenciadores_seleccionados.length == 1 ){
						alert("Recibirá información del  influenciador proximamente");
					}
					if(array_id_influenciadores_seleccionados.length > 1 ){
						alert("Recibirá información de los influenciadores proximamente");
					}

					
				});
			});

		</script>';
?>
<?php include 'footer.php'; ?>

</body>
</html>