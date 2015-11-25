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
	if ($num_rows > 0){
		echo '<h2 class="sub-titulo">Influenciadores</h2><div class="influenciadores">';
		do{
			echo '<div>
					<form class="contactarForm" name="'.$row[5].'">
						<div id='.$row[0].'>
						<p class="nombre">'.$row[5].'</p>
						<p class="ubicacion">'.$row[15].','.$row[16].'</p>
						<p class="tipo">'.$row[2].'</p>
						<img src="'.$row[12].'"/>
						<div>
							<button id="contactar-a-'.$row[0].'">contactar</button>
						</div>
					</form>
					</div>';
		}while($row = mysqli_fetch_row($result));
	}
?>
<?php include 'footer.php'; ?>

</body>
</html>