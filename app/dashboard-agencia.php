<?php include 'header.php'; ?>
<?php 
if ((int)$row[0] > 0){ ?>
	<?php 
		echo '
		<div class="creadas">
			<script type="text/javascript">

				$(document).ready(function(){

					$(".volver, .recientes .content").hide();
					
					$(".recientes .content").hide();

					$(".ver-mas").on("click",function(event){
							
							$(this).siblings(".content").slideToggle();
							$(this).find("i").toggleClass("fa-angle-up fa-angle-down");
							$("html,body").animate({scrollTop : $(this).siblings(".bg-campana").offset().top},1000);

					});

				});

			</script>';
			do{
				echo '<div class="recientes">
					<div class="cont-campana" id="imagen'.$row[0].'">
						
						<div class="bg-campana" style="background-image:url('.$row[3].');">
							
							<h3>'.$row[1].'<span>by '.$row[4].'</span></h3>
							
						</div>

						<div class="ver-mas"><span><i class="fa fa-angle-down"></i></span></div>
						
						<div class="content">
							<span class="campa-ico"><i class="fa fa-cog"></i>Publicada</span>
							<span class="campa-ico"><i class="fa fa-calendar"></i>02 Octubre 2015</span>
							<p id="campana'.$row[0].'">'.$row[2].'</p>
						</div>

					</div>

				 </div>
		 
			'; }while($row = mysqli_fetch_row($result)); ?>
			
			</div>
<?php 
}else{
	echo '<main class="no-campana"><a href="nueva-campana.php"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes crear una nueva, creala aquí.</p><div class="btn_crearcamp">crear campaña</div></a></main>';
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