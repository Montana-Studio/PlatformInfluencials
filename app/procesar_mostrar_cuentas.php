<?php
include_once("procesar_mostrar_followers.php");
	$query="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id'];
	
    $result=mysqli_query($mysqli,$query)or die (mysqli_error());
    $row= mysqli_fetch_array($result, MYSQLI_BOTH);
    $num_row=mysqli_num_rows($result);
    if($num_row < 1){
    	echo '<h2>No registra redes sociales actualmente</h2>';
    }else{
    	echo '<h2>Redes Registradas - reach actual '.(int)$suma.'</h2>';
    	if($num_row3 > 0){
			echo '<h3>instagram reach : '.(int)$suma_instagram.'</h3>';
			echo $_SESSION['instagram'];
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