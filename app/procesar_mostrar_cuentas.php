<?php
//include("procesar_mostrar_followers.php");
echo'
<h2>Redes Registradas - reach actual '.(int)$suma.'</h2>
	<h3>instagram reach : '.(int)$suma_instagram.'</h3>';

		/****************************************************************************************************
												PHP TO SHOW INSTAGRAM FOLLOWERS
		****************************************************************************************************/
		echo $_SESSION['instagram'];

echo '

 <h3>twitter reach : '.(int)$suma_twitter.'</h3>';
	
echo $_SESSION['twitter'];

?>