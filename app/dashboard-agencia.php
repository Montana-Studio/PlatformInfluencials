<!--hola-->
<?php include 'header.php'; ?>
<?php
if ((int)$row[0] > 0){ ?>
	<?php
		echo '
		<h2 class="sub-titulo">resumen de campañas</h2>
		<div class="creadas">
			<script type="text/javascript">

				$(document).ready(function(){

					$(".volver, .recientes .content").hide();

					$(".recientes .content").hide();

					$(".ver-mas").on("click",function(event){

							$(this).siblings(".content").slideToggle();
							if(document.documentElement.clientWidth > 1024){
								$(".bg-campana, .ver-mas, .sub-titulo").fadeOut();
								$(".dashboard-agencia").animate({backgroundColor:"#c7c7c7"},"slow");
							}
							if(document.documentElement.clientWidth < 1024){
								$(this).find("i").toggleClass("fa-angle-up fa-angle-down");
							}
							$("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);

					});

					$(".btn_close").on("click",function(){
							$(this).closest(".content").fadeOut();

							if(document.documentElement.clientWidth > 1024){
								$(".bg-campana, .ver-mas, .sub-titulo").fadeIn();
								$(".dashboard-agencia").animate({backgroundColor:"#fff"},"slow");
							}
					});

				});

			</script>';
			do{
				echo '<div class="recientes">
					<div class="cont-campana" id="imagen'.$row[0].'">

						<div class="bg-campana" style="background-image:url('.$row[3].');">

							<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>

						</div>

						<div class="ver-mas"><span><i class="fa fa-angle-down"></i><i class="fa fa-plus"></i></span></div>

						<div class="content">

							<div class="btn_close"><span><i class="fa fa-times-circle-o"></i></span></div>

							<div class="campana-data">
								<span class="campa-ico activada"><i class="fa fa-cog"></i>Publicada</span>
								<span class="campa-ico fecha-activada">
									<i class="fa fa-calendar"> Inicio </i><span>'.$row[7].'</span> al <span>'.$row[8].'</span>
								</span>
								<p id="campana'.$row[0].'">'.$row[2].'</p>
							</div>

							<div class="img-compana-deskt hide">
								<img src="'.$row[3].'"/>
							</div>
						</div>

					</div>

				 </div>

			'; }while($row = mysqli_fetch_row($result)); ?>

			</div>
<?php
}else{
	echo '<main class="no-campana"><a href="nueva-campana.php" class="hrefCamp"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes crear una nueva, creala aquí.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
}
?>
	<div id="contacto" class="hide">
		<h2>Contacto</h2>
		<div>
			<input placeholder="asunto">
		</div>
		<div>
			<textarea  placeholder="descripcion" rows="10" cols="40"></textarea>
		</div>
		<div>
			<button>Enviar</button>
		</div>
	</div>

	<?php include 'footer.php'; ?>
</body>
</html>
