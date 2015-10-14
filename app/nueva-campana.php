<?php include 'header.php'; ?>	

	<h2 class="sub-titulo">nueva campaña</h2>

	<form id="campanaForm-nueva-campana">
		
		<div class="inputs-deskt">
			<div class="cont-input nombre">
				<input placeholder="Nombre de la Campaña" id="nombre-nueva-campana" >
				<i class="fa fa-pencil"></i>
			</div>
			<div class="cont-input marca">
				<input placeholder="Marca" id="marca-nueva-campana" >
				<i class="fa fa-pencil"></i>
			</div>
			<div class="cont-input descripcion">
				<textarea placeholder="Descripción" id="descripcion-nueva-campana" rows="10" cols="40" ></textarea>
				<i class="fa fa-pencil"></i>
			</div>
		</div>
		
		<div class="upload-deskt">
			<h2 class="sub-titulo">subir imagen</h2>
			<p>Sube una imagen que represente la campaña y que no supere los 200kb en su peso.</p>
			
			<input type="file" name="file" class="jfilestyle" data-input="false" data-buttonText="subir archivo"/>
		</div>

		<button class="guardar" id="guardar" type="submit">subir campaña</button>
	</form>

	<?php include 'footer.php'; ?>
	
	<script>
		jQuery(document).ready(function(){
			$('body').addClass('crear-campanas');
		});
	</script>
</body>
</html>
