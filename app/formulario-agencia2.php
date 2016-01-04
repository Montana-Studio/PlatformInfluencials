<?php include 'header.php';?>
	<form class="contFroms">

		<div id="inicio" class="cont-inputs" disabled>
			<h2 class="sub-title">formulario de ingreso</h2>
			<div id="nombre">
				<input  placeholder="nombre" value="<?php echo $_SESSION['nombre'];?>" disabled required>
			</div>
			<div id="empresa">
				<input placeholder="empresa a la que pertenece"  required>
			</div>

		</div>

		<div id="facturacion" class="cont-inputs">

			<h2 class="sub-title">datos de facturación</h2>

			<div id="correo">
				<input placeholder="correo" value="<?php echo $_SESSION['emailAddress'];?>"  disabled required>
			</div>
			<div>
				<input placeholder="telefono1" onkeypress="return valida(event)" name='telefono1-nuevo' id="telefono1nuevo" maxlength="11" required>
			</div>
			<div>
				<input placeholder="telefono2" onkeypress="return valida(event)" name='telefono2-nuevo' id="telefono2nuevo" maxlength="11" required>
			</div>
			<button id="guardar" disabled>guardar</button>
		</div>
	</form>
	<?php include 'footer.php'; ?>
</body>
</html>
