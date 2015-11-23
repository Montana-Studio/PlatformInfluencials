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
			echo '<div class="total_reach"><h2>Reach actual</h2><small>Alcance total de tus redes sociales</small><div class="total-number">'.(int)$suma.'</div></div>';
	?>

	<div id="facebook-inscription" class="rs-inscription" onclick="checkAuthFacebookPages()">Facebook</div>

	<a id="twitter-inscription" class="rs-inscription" href="./rrss/twitter/process.php" value="<?php echo $num_row3;?>" >twitter</a>

	<div id="youtube-inscription" class="rs-inscription" onclick="googleApiClientReady()">Youtube</div>

	<div id="analytics-inscription" class="rs-inscription">Analytics</div>

	<div id="googleplus-inscription" class="rs-inscription" onclick="googleApiClientReadyGooglePlus()">Google+</div>

	<?php
			if($num_row3 > 0){
				echo '
					<div id="instagram-inscription" class="rs-inscription" onclick="login()">
						<div class="red-title"><i class="fa fa-instagram"></i> Instagram</div>
						<span>'.(int)$suma_instagram.''.$_SESSION['instagram'].'</span>

						<div class="btns">Conectar Instagram</div>
					</div>
				';
    	}

			if($num_row4 > 0){
				echo '<h3>twitter reach : '.(int)$suma_twitter.'</h3>';
			}

			echo $_SESSION['twitter'];

			if($num_row5 > 0){
				echo '<h3>youtube reach : '.(int)$suma_youtube.'</h3>';
				echo $_SESSION['youtube'];
			}
			if($num_row6 > 0){
				echo '<h3>facebook reach : '.(int)$suma_facebook.'</h3>';
				echo $_SESSION['facebook'];
			}
			if($num_row7 > 0){
				echo '<h3>googleplus reach : '.(int)$suma_googleplus.'</h3>';
				echo $_SESSION['googleplus'];
			}
    }
	?>
</div>
