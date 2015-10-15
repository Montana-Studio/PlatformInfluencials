<?php include 'header.php'; ?>

	<h2 class="sub-titulo">nueva campaña</h2>

	<form id="campanaForm-nueva-campana">

		<div class="inputs-deskt">
			<div class="cont-input nombre">
				<input placeholder="Nombre de la Campaña" id="nombre-nueva-campana" required>
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
		</div>

		<div class="upload-deskt">
			<h2 class="sub-titulo">subir imagen</h2>
			<p>Sube una imagen que represente la campaña y que no supere los 200kb en su peso.</p>

			<input type="file" name="file" class="jfilestyle" data-input="false" data-buttonText="subir archivo"/>
		</div>

		<button class="guardar" id="guardar" type="submit">subir campaña</button>
	</form>

	<div class="alertElim">
		<main class="no-campana boxElim">
			<div class="hrefCamp">
				<i class="fa fa-thumbs-o-up"></i>
				<h2>Campaña creada con exito</h2>
				<p>
					Puedes ver o seguir creando más campañas.
				</p>
				<div class="btn_crearcamp noElim">
					crear otra campaña
				</div>
				<div class="btn_crearcamp siElim">
					ver campaña
				</div>
			</div>
		</main>
		<main class="no-campana" id="boxAlert">
			<div class="hrefCamp">
				<i class="fa fa-warning"></i>
				<h2>Algo anda mal</h2>
				<p>
					Tu imagen puede que supere el tamaño permitido o el formato no corresponde.
				</p>
				<div class="btn_crearcamp" id="clearAlert">
					continuar
				</div>
			</div>
		</main>
	</div>

	<?php include 'footer.php'; ?>

	<script>
		jQuery(document).ready(function(){
			$('body').addClass('crear-campanas');
		});
	</script>
</body>
</html>
