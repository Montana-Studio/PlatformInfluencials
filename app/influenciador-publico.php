<?php include 'header.php'; ?>

<?php
	//echo $hoyFormatted;
	echo '<script>

			$(document).ready(function(){
			

			$(".contactarForm").on("submit",function(){
			var agencia = "'.$_SESSION["nombre"].'";
			var correo_agencia = "'.$_SESSION["correo"].'";
			var influenciador = this.name;
			var influenciador_id = $(".contactarForm div").attr("id");
			$("#contactar-a-"+influenciador_id).on("click",function(){
				alert(this.id);
			})

				$.ajax({
							type: "POST",
							url: "contactar.php",
							data: "agencia="+agencia+"&correo_agencia="+correo_agencia+"&influenciador="+influenciador+"&influenciador_id="+influenciador_id,
							success: function(data){
								alert("Recibirá información del influenciador proximamente");
							}
						});
					return
				});
			});

		</script>';


		//mostrar campañas
	if ($num_rows2 > 0){
		echo '<div id="campañas-activas" ><select>
				<option selected="selected" disabled>Seleccione campaña</option>';
	do{
		echo '<option>'.$row2[0].'</option>';
	}while($row2 = mysqli_fetch_row($result2));
		echo '</select></div>';
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

						<div>
							<button id="contactar-a-'.$row[0].'" hidden>cotizar</button>
							<label for="cotizar-'.$row[0].'">Agregar al carrito</label><input id="cotizar-'.$row[0].'" type="checkbox"/>
						</div>
					</form>
					</div>';
		}while($row = mysqli_fetch_row($result));
	}
?>
<?php include 'footer.php'; ?>

</body>
</html>