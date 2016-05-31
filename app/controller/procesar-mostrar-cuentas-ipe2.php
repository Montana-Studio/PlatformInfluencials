<div id="redesociales">
	<?php
		include_once("procesar-mostrar-followers-ipe2.php");
		$query="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id'];
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);
		$redes_sociales= muestra_followers($_SESSION['id']);
		$html_redes_sociales=explode(';', $redes_sociales);

		$facebook=explode("!",$html_redes_sociales[0]);
		$html_facebook= $facebook[0];
		$reach_facebook = $facebook[1];

		$instagram=explode("!",$html_redes_sociales[1]);
		$html_instagram= $instagram[0];
		$reach_instagram = $instagram[1];

		$twitter=explode("!",$html_redes_sociales[2]);
		$html_twitter= $twitter[0];
		$reach_twitter = $twitter[1];

		$youtube=explode("!",$html_redes_sociales[3]);
		$html_youtube= $youtube[0];
		$reach_youtube = $youtube[1];

		$suma=(int)($reach_facebook+$reach_instagram+$reach_twitter);

		$query_facebook="SELECT DISTINCT * FROM rrss WHERE persona_id='".$_SESSION['id']."' AND descripcion_rrss='facebook' AND cuenta='1'";
		$result_facebook=mysqli_query($mysqli,$query_facebook)or die (mysqli_error());
		$num_row_facebook= mysqli_num_rows($result_facebook);

		$query_instagram="SELECT DISTINCT * FROM rrss WHERE persona_id='".$_SESSION['id']."' AND descripcion_rrss='instagram' AND cuenta='1'";
		$result_instagram=mysqli_query($mysqli,$query_instagram)or die (mysqli_error());
		$num_row_instagram= mysqli_num_rows($result_instagram);

		$query_twitter="SELECT DISTINCT * FROM rrss WHERE persona_id='".$_SESSION['id']."' AND descripcion_rrss='twitter' AND cuenta='1'";
		$result_twitter=mysqli_query($mysqli,$query_twitter)or die (mysqli_error());
		$num_row_twitter= mysqli_num_rows($result_twitter);

		$query_youtube="SELECT DISTINCT * FROM rrss WHERE persona_id='".$_SESSION['id']."' AND descripcion_rrss='youtube' AND cuenta='1'";
		$result_youtube=mysqli_query($mysqli,$query_youtube)or die (mysqli_error());
		$num_row_youtube= mysqli_num_rows($result_youtube);
		
		if($num_row < 1){
			echo '<h2 class="no-rrss">
					<svg style="display:none;">
						<symbol id="poly-gon" viewBox="0 0 140.341 133.52">
							<polygon points="134,98.26 70.5,129.76 7,98.26 7,35.26 70.5,3.76 134,35.26"/>
						</symbol>
					</svg>

					<div class="gph-alert pi pi-warning">
						<svg class="poly-gon" viewBox="0 0 140.341 133.52">
							<use xlink:href="#poly-gon"/>
						</svg>
					</div>
				</h2>';
		}else{
			echo '<div class="total_reach"><span><h2>Alcance social </h2><small>Alcance total de tus redes sociales</small></span><div class="total-number">'.formato_numeros_reachs($suma).'</div></div>';
		}
	?>
	
	<script type="text/javascript">
        $(window).load(function(){
        	var total = '<?php echo $suma;?>';
        	if (total == '0'){
        		$('.total-numbers').prepend(total+'<br/>');
        	}else{
        		$('.total-numbers').prepend('<?php echo formato_numeros_reachs($suma);?><br/>');
        	}
        });
    </script>
	
	<div class="red-title"><i class="pi pi-facebook"></i> <span class="red-name">Facebook</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			if($num_row_facebook>0){
				$query_likes_facebook="SELECT DISTINCT core.followers FROM rrss as red, core_redes_sociales as core WHERE red.persona_id='".$_SESSION['id']."' AND red.rrss_id = core.rrss_id and descripcion_rrss='facebook' and id_estado='1'";
				$result_likes_facebook=mysqli_query($mysqli,$query_likes_facebook)or die (mysqli_error());
				$likes_facebook=0;
				do{
					$row_likes_facebook= mysqli_fetch_array($result_likes_facebook, MYSQLI_BOTH);
					$likes_facebook += $row_likes_facebook[0];

				}while($row_likes_instagram = mysqli_fetch_array($result_likes_facebook));

				echo '<div class="reach-total">alcance social <span>'.formato_numeros_reachs($likes_facebook).'</span></div>';
				echo $html_facebook;
			}	
		?>
		<div id="facebook-inscription" onclick="checkAuthFacebookPages()" class="btns">Conectar Facebook</div>
	</div>

	<div class="red-title"><i class="pi pi-instagram"></i> <span class="red-name">Instagram</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		<?php
			if($num_row_instagram>0){
				echo '<div class="reach-total">alcance social <span>'.formato_numeros_reachs($reach_instagram).'</span></div>';
				echo $html_instagram;
				
	  		}
		?>
		<div id="instagram-inscription" onclick="login()" class="btns">Conectar Instagram</div>
	</div>
	
	<div class="red-title"><i class="pi pi-twitter"></i> <span class="red-name">Twitter</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			if($num_row_twitter>0){
				echo '<div class="reach-total">alcance social <span>'.formato_numeros_reachs($reach_twitter).'</span></div>';
				echo $html_twitter;
			}
		?>
		<a id="twitter-inscription" href="./rrss/twitter/process.php" value="<?php //echo $num_row3;?>" class="btns">Conectar Twitter</a>
		<script id="mensaje">$(document).ready(function() {
		   var referrer =  document.referrer;
		   
		   if(referrer=='http://powerinfluencer.com/mt_prod/rrss/twitter/twitter.php'){
		   		<?php 	inscripcion_twitter();?>
		   }
		});
		 </script>
	</div>

	<div class="red-title"><i class="pi pi-youtube"></i> <span class="red-name">Youtube</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			if($num_row_youtube>0){
				
				echo '<div class="reach-total">reproducciones<span>'.$reach_youtube.'</span></div>';
				echo $html_youtube;
			}	
		?>
		<div id="youtube-inscription" onclick="googleApiClientYoutubeReady()" class="btns">Conectar Youtube</div>
	</div>

<?php
	unset($mysqli);
?>
</div>