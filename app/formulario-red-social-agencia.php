<?php include 'header-agencia.php'; ?>
		<p class="info_form">por favor ingresar los siguientes datos para continuar</p>

		<form id="formulario_agencias_rs" class="contFroms">

			<div class="cont-inputs" id="inicio">

				<h2 class="sub-title">formulario de ingreso</h2>

				<div id="nombre">
					<input  value="<?php echo $_SESSION['nombre'];?>" required>
					<i class="fa fa-pencil"></i>
				</div>
				<div >
					<input id="empresanueva" placeholder="<?php if($_SESSION['empresa']){ echo $_SESSION['empresa'];}else{echo 'Empresa a la que pertenece';}?>" required>
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
					<input id="telefono1nuevo" placeholder="<?php if($_SESSION['telefono1']){ echo $_SESSION['telefono1'];}else{echo 'telefono1';}?>" value="<?php if($_SESSION['telefono1']){ echo $_SESSION['telefono1'];} ?>" onkeypress="return valida(event)" type="text" maxlength="11" required>
					<i class="fa fa-pencil"></i>
				</div>
				<div id="tel2">
					<input id="telefono2nuevo" placeholder="<?php if($_SESSION['telefono2']){ echo $_SESSION['telefono2'];}else{echo 'telefono2';}?>" value="<?php if($_SESSION['telefono2']){ echo $_SESSION['telefono2'];} ?>" onkeypress="return valida(event)" type="text" maxlength="11" required>
					<i class="fa fa-pencil"></i>
				</div>
				<button id="guardar" type="submit">guardar</button>
			</div>
		</form>
		<?php include 'footer-agencia.php'; ?>
	</body>
</html>