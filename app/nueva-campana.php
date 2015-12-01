<?php include 'header.php'; ?>

	<h2 class="sub-titulo">nueva campaña</h2>

	<form id="campanaForm-nueva-campana">

		<div class="inputs-deskt">
			<div class="cont-input nombre">
				<input placeholder="Nombre de la Campaña" id="nombre-nueva-campana" required="required">
				<i class="fa fa-pencil"></i>
			</div>
			<div class="cont-input marca">
				<input placeholder="Marca" id="marca-nueva-campana" required>
				<i class="fa fa-pencil"></i>
			</div>
			<div class="cont-input descripcion">
				<textarea placeholder="Descripción" id="descripcion-nueva-campana" rows="10" cols="40" required></textarea>
				<i class="fa fa-pencil"></i>				
			</div>
			<div>
				<p>Fecha de término: <input class="fecha_termino" type="text" id="datepicker"></p>
			</div>
			<div>
				<div>
					<label for="facebook">facebook<input class="checkbox_rrss"  value="facebook" id="facebook" type="checkbox"/></label>
				</div>
				<div>
					<label for="twitter">twitter</label><input class="checkbox_rrss"  value="twitter" id="twitter" type="checkbox"/>
				</div>
				<div>
					<label for="instagram">instagram</label><input class="checkbox_rrss"  value="instagram" id="instagram" type="checkbox"/>
				</div>
				<div>
					<label for="youtube">youtube</label><input class="checkbox_rrss" value="youtube" id="youtube" type="checkbox"/>
				</div>
				<div>
					<label for="analytics">analytics</label><input  class="checkbox_rrss" value="analytics" id="analytics" type="checkbox"/>
				</div>
				<div>
					<label for="googleplus">googleplus</label><input class="checkbox_rrss"  value="googleplus" id="googleplus" type="checkbox"/>
				</div>
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
