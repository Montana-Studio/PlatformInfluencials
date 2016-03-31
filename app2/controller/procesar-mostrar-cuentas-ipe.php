<div id="redesociales">
	<?php
		//include_once("controller/procesar-mostrar-followers-ipe.php");
		include_once("controller/procesar-mostrar-followers-ipe2.php");
		$query="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id'];
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);
		$facebook_followers = muestra_followers('facebook',$_SESSION['id']);
		$twitter_followers = muestra_followers('twitter',$_SESSION['id']);
		$instagram_followers = muestra_followers('instagram',$_SESSION['id']);
		$suma=(int)($facebook_followers[1]+$twitter_followers[1]+$instagram_followers[1]);

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
			echo '<div class="total_reach"><span><h2>Reach actual</h2><small>Alcance total de tus redes sociales</small></span><div class="total-number">'.formato_numeros_reachs($suma).'</div>';
			echo '<small>Alcance total de tus redes sociales</small></span><div class="total-number">'.formato_numeros_reachs($suma).'</div></div>';
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
			//if($num_row6 > 0){
				
				echo '<div class="reach-total">facebook reach <span>'.formato_numeros_reachs($facebook_followers[1]).'</span></div>';
				//echo $_SESSION['facebook'];
				
				echo $facebook_followers[0];
			//}
		?>
		<div id="facebook-inscription" onclick="checkAuthFacebookPages()" class="btns">Conectar Facebook</div>
	</div>

	<div class="red-title"><i class="pi pi-instagram"></i> <span class="red-name">Instagram</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		<?php
			//if($num_row3 > 0){
				
				echo '<div class="reach-total">instagram reach <span>'.formato_numeros_reachs($instagram_followers[1]).'</span></div>';
				//echo $_SESSION['instagram'];
				
				echo $instagram_followers[0];
	  		//}
		?>
		<div id="instagram-inscription" onclick="login()" class="btns">Conectar Instagram</div>
	</div>
	
	<div class="red-title"><i class="pi pi-twitter"></i> <span class="red-name">Twitter</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			//if($num_row4 > 0){
				
				echo '<div class="reach-total">twitter reach <span>'.formato_numeros_reachs($twitter_followers[1]).'</span></div>';
				//echo $_SESSION['twitter'];
				
				echo $twitter_followers[0];
			//}
		?>
		<a id="twitter-inscription" href="./rrss/twitter/process.php" value="<?php echo $num_row3;?>" class="btns">Conectar Twitter</a>
		<script id="mensaje">$(document).ready(function() {
		   var referrer =  document.referrer;
		   
		   if(referrer=='http://powerinfluencer.com/app/rrss/twitter/twitter.php'){
		   		<?php 	inscripcion_twitter();?>
		   }
		});
		 </script>
	</div>

	<div class="red-title"><i class="pi pi-youtube"></i> <span class="red-name">Youtube</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			//if($num_row5 > 0){
				$youtube_followers = muestra_followers('youtube',$_SESSION['id']);
				echo '<div class="reach-total">youtube reach <span>'.formato_numeros_reachs($youtube_followers[1]).'</span></div>';
				//echo $_SESSION['youtube'];
				
				echo $youtube_followers[0];
			//}
		?>
		<div id="youtube-inscription" onclick="googleApiClientYoutubeReady()" class="btns">Conectar Youtube</div>
	</div>

<?php
	unset($mysqli);
?>
</div>