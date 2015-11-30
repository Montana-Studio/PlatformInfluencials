<?php include 'header-ipe.php'; ?>
	<form id='imagenform-ipe'>

		<div class="header-ipe" style="background-image:url(<?php echo $_SESSION['pictureUrl'];?>);">

			<svg viewBox="0 0 140.341 133.52" class="mask-imguser">
				<defs>
					<polygon id="SVGID_1_" points="134,98.26 70.5,129.76 7,98.26 7,35.26 70.5,3.76 134,35.26 		"/>
				</defs>
				<clipPath id="SVGID_2_">
					<use xlink:href="#SVGID_1_"  overflow="visible"/>
				</clipPath>
				<g clip-path="url(#SVGID_2_)">
					<image overflow="visible" width="1280" height="720" xlink:href="<?php echo $_SESSION['pictureUrl'];?>" transform="matrix(0.2013 0 0 0.2013 -58.333 -5.7085)"></image>
				</g>
			</svg>

			<input type="file" name="file" id="file" class="input-file">
			<label for="file" class="change-img"><i class="fa fa-camera"></i></label>

			<input id="RsId" value="<?php echo $_SESSION['rsid']; ?>" type="hidden">

			<h2><?php echo $_SESSION['nombre']?></h2>
			<div class="geo"><i class="fa fa-map-marker"></i> <?php echo $_SESSION['comuna'].','.$_SESSION['region'];?></div>
			<p class="bio"><?php echo $_SESSION['descripcion']; ?></p>

			<nav class="nav-ipe2">
				<ul>
					<li><a href="dashboard-ipe.php">Perfil</a></li>
					<li  class="active" ><a href="campanas-ipe.php">Campañas</a></li>
				</ul>
			</nav>
<!--hola-->
		</div>
		<div id="tab-examp">
			<ul id="tabs">
				<li><a href="#fragment-1"><span>Activas</span></a></li>
				<li><a href="#fragment-2"><span>Historial</span></a></li>
			</ul>
			<div id="tabscontent">
				<div id="fragment-1" class="tabpage">
				<?php
					require("procesar_mostrar_campanas_en_ipe.php");
					echo $campanas_activas;
				?>
				</div>
				<div id="fragment-2" class="tabpage">
				<?php
					//echo $campanas_historial;
				?>
				</div>
			</div>
		</div>

	</form>

	<?php
		include ('footer-ipe.php');
	?>
</body>
</html>