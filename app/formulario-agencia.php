<?php include 'header.php'; ?>
		<p>favor ingresar los siguientes datos para continuar</p>
		<h2>formulario de ingreso</h2> 
		<form id="formulario_agencias_sin_rs">
			<div id="inicio">
				<div id="nombre">
					<input  value="<?php echo $_SESSION['nombre'];?>" required>
				</div>
				<div id="empresa">
					<input placeholder="Empresa a la que pertenece" required>
				</div>
			</div>
			<h2>datos de facturación</h2>
			<div id="facturacion">
				
					<div id="correo">
						<input value="<?php echo $_SESSION['correo'];?>" required>
					</div>
					<div id="tel1">
						<input id="telefono1nuevo" placeholder="telefono 1" onkeypress="return valida(event)" type="text" maxlength="11" required>
					</div>
					<div id="tel2">
						<input id="telefono2nuevo" placeholder="telefono 2" onkeypress="return valida(event)" type="text" maxlength="11" required>
					</div>
					<button id="guardar" type="submit">guardar</button>
			</div>
		</form>
		<?php include 'footer.php'; ?>
	</body>
</html>