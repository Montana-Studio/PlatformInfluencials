<?php include 'header.php'; ?>

<?php
	if($_GET['campana']){
		echo '

			<div id="campanas-postulables">
			<h2 class="sub-titulo">Selecciona una campaña</h2>
				<select>
					<option selected="selected" id="'.$_GET["id"].'" disabled>'.$_GET["campana"].'</option>
				</select>
				<i class="fa fa-chevron-down"></i>
			</div>';

	}else{
			//echo $hoyFormatted;
		echo '<!--button id="opc_cot">Campañas para cotizar</button-->';

			//mostrar campañas
		if ($num_rows2 > 0){
			echo '<div id="campanas-postulables">
					<h2 class="sub-titulo">Selecciona una campaña para cotizar</h2>
					<select>
					<option selected="selected" disabled>Seleccione campaña</option>';
		do{
			echo '<option>'.$row2[0].'</option>';
		}while($row2 = mysqli_fetch_row($result2));
			echo '</select>
				<i class="fa fa-chevron-down"></i>
				</div>';
		}

	}
	
	//mostrar influenciadores
	if ($num_rows > 0){
		echo '<h2 class="sub-titulo">Influenciadores</h2>
				<div class="influenciadores">';
		do{
			echo '<form id="'.$row[0].'"class="contactarForm" name="'.$row[5].'">
					<svg viewBox="0 0 140.341 133.52" class="mask-imguser">
						<defs>
							<polygon id="SVGID_1_" points="134,98.26 70.5,129.76 7,98.26 7,35.26 70.5,3.76 134,35.26 		"/>
						</defs>
						<clipPath id="SVGID_2_">
							<use xlink:href="#SVGID_1_"  overflow="visible"/>
						</clipPath>
						<g clip-path="url(#SVGID_2_)">
							<image overflow="visible" width="1280" height="720" xlink:href="'.$row[12].'" transform="matrix(0.2013 0 0 0.2013 -58.333 -5.7085)"></image>
						</g>
					</svg>
					<div class="info-influ">
						<h2 class="nombre">'.$row[5].'</h2>
						<small class="ubicacion"><i class="fa fa-map-marker"></i> '.$row[16].','.$row[15].'</small>
						<small class="tipo"><i class="fa fa-user"></i> '.$row[2].'</small>
					</div>
					
					<span></span>
					<div class="checkbox-cotizar">
						<input id="cotizar-'.$row[0].'" class="btndesactivar onoffswitch-checkbox" name="'.$row[5].'"  value="'.$row[0].'" type="checkbox"/>
						<label for="cotizar-'.$row[0].'" class="btndesactivar onoffswitch-label"></label>
					</div>
				</form>';
		}while($row = mysqli_fetch_row($result));
	}
?>

<?php
		echo '</div><button id="cotizar_influenciador">cotizar</button>
		<script>
			$(document).ready(function(){
				/*$("#opc_cot").click(function(){
					$("#campanas-postulables").show();
					$("#opc_cot").hide();
					$("#campanas-postulables").show();
				})*/

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
								//$("#campanas-postulables").hide();
								//$("#campanas-postulables").show();
								//$("#opc_cot").show();
								$(".boton_cotizar").show();
								//$("#campanas-postulables").hide();
								$("input:checkbox").removeAttr("checked");

								
							}
						});

					}
					if(array_id_influenciadores_seleccionados.length == 1 ){
						$(".alertElim").fadeIn("normal",function(){
							$("#boxElim .hrefCamp h2").text("Influenciador agregado");
							$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
							$("#boxElim .hrefCamp p").text("La cotizacion a sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");
							$(".siElim").text("Ir a campañas");
							$(".noElim").text("Ver Influenciadores");

							$("#boxElim").show().animate({
								top:"20%",
								opacity:1
							},{duration:1500,easing:"easeOutBounce"});

							$(".siElim").on("click",function(){

								window.location.href = "campana.php";
							});

							$(".noElim").on("click",function(){
								$("#boxElim").animate({
									top:"-100px",
									opacity:0
								},{duration:500,easing:"easeInOutQuint",complete:function(){
									$(".alertElim").fadeOut("fast");
									$(this).hide();
								}});
							});
						});
					}
					if(array_id_influenciadores_seleccionados.length > 1 ){
						$(".alertElim").fadeIn("normal",function(){
							$("#boxElim .hrefCamp h2").text("Influenciador agregado");
							$("#boxElim .hrefCamp i").addClass("fa-thumbs-o-up");
							$("#boxElim .hrefCamp p").text("La cotizacion a sido exitosa, puedes seguir creando mas campañas y cotizar Influenciadores.");
							$(".siElim").text("Ir a campañas");
							$(".noElim").text("Ver Influenciadores");

							$("#boxElim").show().animate({
								top:"20%",
								opacity:1
							},{duration:1500,easing:"easeOutBounce"});

							$(".siElim").on("click",function(){

								window.location.href = "campana.php";
							});

							$(".noElim").on("click",function(){
								$("#boxElim").animate({
									top:"-100px",
									opacity:0
								},{duration:500,easing:"easeInOutQuint",complete:function(){
									$(".alertElim").fadeOut("fast");
									$(this).hide();
								}});
							});
						});
					}
				});
			});
		</script>';
?>

<?php include 'footer.php'; ?>

</body>
</html>