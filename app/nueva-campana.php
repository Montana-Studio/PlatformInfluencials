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
			<div class="cont-input">
				<input class="fecha_termino" type="text" id="datepicker" placeholder="Fecha de termino">
				<i class="fa fa-pencil"></i>
			</div>
			
		</div>

		<div class="redes-select">
			<h2 class="sub-titulo">Medios</h2>
			<p>Selecciona los medios en donde quieres invertir para luego elejir los Influenciadores que necesites.</p>
			
			<div class="red-cont">
				<div class="name-red">
					<i class="fa fa-facebook"></i>
					facebook
				</div>
				<div class="check-red">
					<input class="switch-checkbox checkbox_rrss"  value="facebook" id="facebook" type="checkbox" checked/>
					<label for="facebook" class="switch-label"></label>
				</div>
			</div>

			<div class="red-cont">
				<div class="name-red">
					<i class="fa fa-twitter"></i>
					twitter
				</div>
				<div class="check-red">
					<input class="switch-checkbox checkbox_rrss"  value="twitter" id="twitter" type="checkbox" checked/>
					<label for="twitter" class="switch-label"></label>
				</div>
			</div>
			<div class="red-cont">
				<div class="name-red">
					<i class="fa fa-instagram"></i>
					instagram
				</div>
				<div class="check-red">
					<input class="switch-checkbox checkbox_rrss"  value="instagram" id="instagram" type="checkbox" checked/>
					<label for="instagram" class="switch-label"></label>
				</div>
			</div>
			<div class="red-cont">
				<div class="name-red">
					<i class="fa fa-youtube-play"></i>
					youtube
				</div>
				<div class="check-red">
					<input class="switch-checkbox checkbox_rrss" value="youtube" id="youtube" type="checkbox" checked/>
					<label for="youtube" class="switch-label"></label>
				</div>
			</div>
			<div class="red-cont">
				<div class="name-red">
					<i class="fa fa-google"></i>
					analytics
				</div>
				<div class="check-red">
					<input  class="switch-checkbox checkbox_rrss" value="analytics" id="analytics" type="checkbox" checked/>
					<label for="analytics" class="switch-label"></label>
				</div>
			</div>
			<div class="red-cont">
				<div class="name-red">
					<i class="fa fa-google-plus"></i>
					google plus
				</div>
				<div class="check-red">
					<input class="switch-checkbox checkbox_rrss"  value="googleplus" id="googleplus" type="checkbox" checked/>
					<label for="googleplus" class="switch-label"></label>
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
</body>
</html>
