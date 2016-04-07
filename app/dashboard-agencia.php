<?php include 'header-agencia.php'; ?>
<?php

if ((int)$row[0] > 0){ ?>
	<?php
		echo '
		<div class="titles-cont"><h2 class="sub-titulo">resumen de campañas activas</h2><p class="bajadas-info">Revisa y monitorea  el movimiento de tus últimas campañas activas.</p></div>
		<div class="creadas">';
			do{
				echo '<div class="recientes">
					<div class="cont-campana" id="imagen'.$row[0].'">

						<div class="bg-campana" style="background-image:url('.$row[3].');">

							<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>

						</div>

						<div class="ver-mas">
                            <span>
                                <i class="pi pi-arrow-bottom"></i>
                                <i class="pi pi-plus"></i>
                            </span>
                        </div>
						
						<div class="btn_close"><span><i class="pi pi-close"></i></span></div>
						
						<div class="content">

							<div class="campana-data">
                            
								<span class="campa-ico activada"><i class="pi pi-tool"></i>Publicada</span>
								<span class="campa-ico fecha-activada">
									<i class="pi pi-calendar"></i>Inicio <span>'.$row[7].'</span> al <span>'.$row[8].'</span>
								</span>
								<p id="campana'.$row[0].'">'.$row[2].'</p>
							</div>

							<div class="img-compana-deskt hide">
								<img src="'.$row[3].'"/>
							</div>
                            
						</div>
                        <div id="redes_sociales_campana_'.$row[0].'" class="reach-campana">
                            <h2 class="sub-titulo">Metricas de la campaña</h2>';
                            //require('./controller/procesar-mostrar-reach-campana-agencia.php');
                            //echo $_SESSION['reach-campana'];
    				echo '</div>
					</div>

				 </div>

			'; }while($row = mysqli_fetch_row($result)); ?>

			</div>

<?php
}else{ ?>
		<script>
			
			jQuery(window).load(function($){
				sincampana();
			});

		</script>

		<main class="no-campana">
			<a href="crear-campana" class="hrefCamp">
				<div id="noCamp"></div>
				<h2>sin campañas para mostrar</h2>
				<p>Para empezar a administrar tus campañas, primero debes crear una nueva, creala aquí.</p>
				<div class="btn_crearcamp">crear campaña</div>
			</a>
		</main>
<?php } ?>
	<?php

	if ((int)$row2[0] > 0){ ?>
		<?php
			echo '
			<h2 class="sub-titulo">resumen de campañas finalizadas</h2>
			<div class="creadas">';
				do{
					echo '<div class="recientes">
						<div class="cont-campana" id="imagen'.$row2[0].'">

							<div class="bg-campana" style="background-image:url('.$row2[3].');">

								<h3>'.$row2[1].'<span>by '.$row2[4].'</span></h3>

							</div>

							<div class="ver-mas">
	                            <span>
	                                <i class="pi pi-arrow-bottom"></i>
	                                <i class="pi pi-plus"></i>
	                            </span>
	                        </div>

							<div class="content">

								<div class="btn_close"><span><i class="pi pi-close"></i></span></div>

								<div class="campana-data">
	                            
									<span class="campa-ico activada"><i class="pi pi-tool"></i>Publicada</span>
									<span class="campa-ico fecha-activada">
										<i class="pi pi-calendar"></i>Inicio <span>'.$row2[7].'</span> al <span>'.$row2[8].'</span>
									</span>
									<p id="campana'.$row2[0].'">'.$row2[2].'</p>
								</div>

								<div class="img-compana-deskt hide">
									<img src="'.$row2[3].'"/>
								</div>
	                            
							</div>
	                        <div id="redes_sociales_campana_'.$row2[0].'" class="reach-campana">
	                            <h2 class="sub-titulo">Metricas de la campaña</h2>';
	                            //require('./controller/procesar-mostrar-reach-campana-agencia.php');
	                            //echo $_SESSION['reach-campana'];

	    echo '              </div>
						</div>

					 </div>

				'; }while($row2 = mysqli_fetch_row($result2)); ?>

				</div>
<?php
	}/*

}else{
	echo '<main class="no-campana"><a href="crear-campana.php" class="hrefCamp"><i class="pi pi-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes crear una nueva, creala aquí.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
}*/
?>

	<?php include 'footer-agencia.php'; ?>
</body>
</html>