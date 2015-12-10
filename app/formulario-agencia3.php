<?php include 'header.php';?>
	<form class="cont_formRegistro">
		<div class="cont-inputs">
			<h2 class="sub-title">formulario de ingreso</h2>
			<div class="selects">
				<select id="perfil" required>
					<option value="" disabled selected>selecciona tu perfil </option>
					<option value="3">influenciador</option>
					<option value="4">publisher</option>
					<option value="5">editor</option>
				</select>
				<i class="fa fa-chevron-down"></i>
			</div>
		</div>

		<div id="inicio" class="cont-inputs" disabled>
			<div id="nombre">
				<input  placeholder="nombre" value="<?php echo $_SESSION['nombre'];?>" disabled required>
			</div>
			<div id="empresa">
				<input placeholder="empresa a la que pertenece" disabled required>
			</div>
		</div>
		<div id="facturacion" class="cont-inputs">
			<h2 class="sub-title">datos de facturación</h2>
			<div id="correo">
				<input placeholder="correo" value="<?php echo $_SESSION['correo'];?>"  disabled required>
			<div>
			<div>
				<input placeholder="telefono1" onkeypress="return valida(event)" name='telefono1-nuevo' id="telefono1nuevo" maxlength="11" required>
			</div>
			<div>
				<input placeholder="telefono2" onkeypress="return valida(event)" name='telefono2-nuevo' id="telefono2nuevo" maxlength="11" required>
			<div>

			<button id="guardar" disabled>guardar</button>
		</div>
	</form>
	<?php include 'footer.php'; ?>
</body>
</html>