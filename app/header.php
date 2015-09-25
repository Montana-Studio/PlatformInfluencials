<header>
	
	<div class="logo"><a href="./dashboard-agencia.php" target="_top"></a></div>
	<a href="#" class="ayuda_pi"><i class="fa fa-life-ring"></i></a>
	<a href="#" class="notes" ><i class="fa fa-bell-o"></i></a>
	<div class="menu" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);"></div>

</header>

<nav>
	
	<ul>
		<li><a href="campana.php"><i class="fa fa-suitcase"></i> campañas</a></li>
		<li><a href="nueva-campana.php"><i class="fa fa-pencil"></i> crear campaña</a></li>
	</ul>

</nav>


<form id="imagenform">
	
	<div class="fle-top"></div>
	
	<div class="misdatos">
		
		<div class="imagen" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);">
		
			<input type="file" name="file" id="file" class="hide"/>
			<label class="selectFile" for="file"><i class="fa fa-pencil"></i></label>

		</div>
		
		<div class="datos">
			
			<h2><?php echo $_SESSION['nombre']; ?></h2>
			<h3><?php echo $_SESSION['empresa']; ?></h3>
			
			<div class="editar"><span>editar perfil</span></div>

		</div>

	</div>
	
	<div id="inicio" disabled>
	
		<div id="tabContainer">
			
			<ul id="tabs">
				<li id="tabHeader_1" class="clickTab">Perfil Personales</li>
				<li id="tabHeader_2" class="clickTab">Datos Empresa</li>
			</ul>

			<div id="tabscontent">
				
				<div class="tabpage tab-hide" id="tabpage_1">
					
					<div id="nombre">
						<small>nombre</small>
						<input value="<?php echo $_SESSION['nombre']; ?>">
					</div>
					<div id="correo">
						<small>correo</small>
						<input value="<?php echo $_SESSION['correo']; ?>" disabled>
					</div>

				</div>

				<div class="tabpage tab-hide" id="tabpage_2">
					
					<div id="empresa">
						<small>empresa</small>
						<input value="<?php echo $_SESSION['empresa']; ?>">
					</div>
					<div id="tel1">
						<small>tel. empresa</small>
						<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono1']; ?>">
					</div>
					<div id="tel2">
						<small>tel. personal</small>
						<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono2']; ?>">
					</div>

				</div>

			</div>

		</div>
		
		<button id="guardarFacturacion" type="submit">Actualizar</button>

		<input id="RsId" style="display:none" value="<?php echo $_SESSION['rsid']; ?>">

		<a href="logout.php" class="logout"><i class="fa fa-times-circle-o"></i> cerrar sesion</a>
	</div>
	
	<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>
</form>