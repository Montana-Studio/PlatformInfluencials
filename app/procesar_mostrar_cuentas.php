<div id="redesociales">
	<?php
		include_once("procesar_mostrar_followers.php");
		$query="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id'];
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);

		if($num_row < 1){
			echo '<h2 class="no-rrss">
					<svg style="display:none;">
						<symbol id="poly-gon" viewBox="0 0 140.341 133.52">
							<polygon points="134,98.26 70.5,129.76 7,98.26 7,35.26 70.5,3.76 134,35.26"/>
						</symbol>
					</svg>

					<div class="gph-alert">
						<svg class="poly-gon" viewBox="0 0 140.341 133.52">
							<use xlink:href="#poly-gon"/>
						</svg>
					</div>
				</h2>';
		}else{
			echo '<div class="total_reach"><span><h2>Reach actual</h2><small>Alcance total de tus redes sociales</small></span><div class="total-number">'.formato_numeros_reachs($suma).'</div></div>';
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
			if($num_row6 > 0){
				echo '<div class="reach-total">facebook reach <span>'.formato_numeros_reachs($suma_facebook).'</span></div>';
				echo $_SESSION['facebook'];
			}
		?>
		<div id="facebook-inscription" onclick="checkAuthFacebookPages()" class="btns">Conectar Facebook</div>
		<?php if(strlen($_SESSION['facebook'])>0){
		 	echo "<div id='facebook-unsubscribe' class='btns'>Desvincular Facebook</div>";
		 	}?>
	</div>

	<div class="red-title"><i class="pi pi-instagram"></i> <span class="red-name">Instagram</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		<?php
			if($num_row3 > 0){
				echo '<div class="reach-total">instagram reach <span>'.formato_numeros_reachs($suma_instagram).'</span></div>';
				echo $_SESSION['instagram'];
	  		}
		?>
		<div id="instagram-inscription" onclick="login()" class="btns">Conectar Instagram</div>
		 <?php if(strlen($_SESSION['instagram'])>0){
		 	echo "<div id='instagram-unsubscribe' class='btns'>Desvincular Instagram</div>";
		 	}?>

	</div>
	
	<div class="red-title"><i class="pi pi-twitter"></i> <span class="red-name">Twitter</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			if($num_row4 > 0){
				echo '<div class="reach-total">twitter reach <span>'.formato_numeros_reachs($suma_twitter).'</span></div>';
				echo $_SESSION['twitter'];
			}
		?>
		<a id="twitter-inscription" href="./rrss/twitter/process.php" value="<?php echo $num_row3;?>" class="btns">Conectar Twitter</a>
		<?php if(strlen($_SESSION['twitter'])>0){
		 	echo "<div id='twitter-unsubscribe' class='btns'>Desvincular Twitter</div>";
		 	}?>
	</div>

	<div class="red-title"><i class="pi pi-analytics"></i> <span class="red-name">Analytics</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">

		<?php
			if($num_row9 > 0){
				echo '<div class="reach-total">
					analytics reach 
					<span>'.formato_numeros_reachs($suma_analytics).'</span>
				</div>';
				echo $_SESSION['analytics'];

			}
		?>
		<div id="analytics-inscription" onclick="authorize()" class="btns">Conectar Analytics</div>
		<?php if(strlen($_SESSION['analytics'])>0){
		 	echo "<div id='analytics-unsubscribe' class='btns'>Desvincular Analytics</div>";
		 	}?>
	</div>

	<div class="red-title"><i class="pi pi-youtube"></i> <span class="red-name">Youtube</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			if($num_row5 > 0){
				echo '<div class="reach-total">youtube reach <span>'.formato_numeros_reachs($suma_youtube).'</span></div>';
				echo $_SESSION['youtube'];
			}
		?>
		<div id="youtube-inscription" onclick="googleApiClientYoutubeReady()" class="btns">Conectar Youtube</div>
		<?php if(strlen($_SESSION['youtube'])>0){
		 	echo "<div id='youtube-unsubscribe' class='btns'>Desvincular Youtube</div>";
		 	}?>
	</div>

	<div class="red-title"><i class="pi pi-googleplus"></i> <span class="red-name">Google Plus</span> <i class="pi pi-arrow-bottom"></i></div>
	<div class="rs-inscription">
		
		<?php
			if($num_row7 > 0){
				echo '<div class="reach-total">google plus reach <span>'.formato_numeros_reachs($suma_googleplus).'</span></div>';
				echo $_SESSION['googleplus'];
			}
		?>
		<div id="googleplus-inscription" onclick="googleApiClientReadyGooglePlus()" class="btns">Conectar Google+</div>
		<?php if(strlen($_SESSION['googleplus'])>0){
		 	echo "<div id='googleplus-unsubscribe' class='btns'>Desvincular Google+</div>";
		 	}?>
	</div>

</div>