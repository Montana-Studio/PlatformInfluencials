<div id="redesociales">
	<?php
		include_once("procesar_mostrar_followers.php");
		$query="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id'];
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);

		if($num_row < 1){
			echo '<h2>No registra redes sociales actualmente</h2>';
		}else{
			echo '<div class="total_reach"><span><h2>Reach actual</h2><small>Alcance total de tus redes sociales</small></span><div class="total-number">'.(int)$suma.'</div></div>';
	?>

	<!--div id="analytics-inscription" class="rs-inscription">Analytics</div-->

	<div  class="rs-inscription">
		<div class="red-title"><i class="fa fa-instagram"></i> <span>Instagram</span> <i class="fa fa-chevron-down"></i></div>
		<?php
			if($num_row3 > 0){
				echo '
						<span>'.(int)$suma_instagram.''.$_SESSION['instagram'].'</span>';
	  	}
		?>
		<div id="instagram-inscription" onclick="login()" class="btns">Conectar Instagram</div>
	</div>

	<div class="rs-inscription">
		<div class="red-title"><i class="fa fa-twitter"></i> <span>Twitter</span> <i class="fa fa-chevron-down"></i></div>
		<?php
			if($num_row4 > 0){
				echo '<h3>twitter reach : '.(int)$suma_twitter.'</h3>';
			}
			echo $_SESSION['twitter'];
		?>
		<a id="twitter-inscription" href="./rrss/twitter/process.php" value="<?php echo $num_row3;?>" class="btns">Conectar Twitter</a>
	</div>
	<div class="rs-inscription">
		<div class="red-title"><i class="fa fa-youtube"></i> <span>Youtube</span> <i class="fa fa-chevron-down"></i></div>
		<?php
			if($num_row5 > 0){
				echo '<h3>youtube reach : '.(int)$suma_youtube.'</h3>';
				echo $_SESSION['youtube'];
			}
		?>
		<div id="youtube-inscription" onclick="googleApiClientReady()" class="btns">Conectar Youtube</div>
	</div>
	<div class="rs-inscription">
		<div class="red-title"><i class="fa fa-facebook"></i> <span>Facebook</span> <i class="fa fa-chevron-down"></i></div>
		<?php
			if($num_row6 > 0){
				echo '<div >Facebook</div><h3>facebook reach : '.(int)$suma_facebook.'</h3>';
				echo $_SESSION['facebook'];
			}
		?>
		<div id="facebook-inscription" onclick="checkAuthFacebookPages()" class="btns">Conectar Facebook</div>
	</div>
	<div class="rs-inscription">
		<div class="red-title"><i class="fa fa-google-plus"></i> <span>Google Plus</span> <i class="fa fa-chevron-down"></i></div>
		<?php
				if($num_row7 > 0){
					echo '<h3>googleplus reach : '.(int)$suma_googleplus.'</h3>';
					echo $_SESSION['googleplus'];
				}
	    }
		?>
		<div id="googleplus-inscription" onclick="googleApiClientReadyGooglePlus()" class="btns">Conectar Google+</div>
	</div>

</div>
