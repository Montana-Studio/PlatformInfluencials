<?php include 'header.php'; ?>
		<div id="tipo"> 
			<p><?php echo $_SESSION['id_tipo'];?></p>
		</div>
		<p class="info_form">por favor ingresar los siguientes datos para continuar</p>

		<form id="formulario_agencias_rs" class="">

			<div class="cont-inputs" id="inicio">

				<h2 class="sub-title">formulario de ingreso</h2>

				<div id="nombre">
					<input  value="<?php echo $_SESSION['nombre'];?>" required>
					<i class="fa fa-pencil"></i>
				</div>
				<div id="empresa">
					<input placeholder="Empresa a la que pertenece" required>
					<i class="fa fa-pencil"></i>
				</div>

			</div>

			<div class="cont-inputs" id="facturacion">

				<h2 class="sub-title">formulario de facturación</h2>

				<div id="correo">
					<input value="<?php echo $_SESSION['correo'];?>" required>
					<i class="fa fa-pencil"></i>
				</div>
				<div id="tel1">
					<input id="telefono1nuevo" placeholder="telefono 1" onkeypress="return valida(event)" type="text" maxlength="11" required>
					<i class="fa fa-pencil"></i>
				</div>
				<div id="tel2">
					<input id="telefono2nuevo" placeholder="telefono 2" onkeypress="return valida(event)" type="text" maxlength="11" required>
					<i class="fa fa-pencil"></i>
				</div>
				<button id="guardar" type="submit">guardar</button>
			</div>
		</form>
		<?php include 'footer.php'; ?>
	</body>
</html>
