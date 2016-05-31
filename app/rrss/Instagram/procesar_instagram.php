<?php

require('../../controller/conexion.php');

function ingresa_registros($cuenta, $persona_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $followers, $retweet, $favorites, $reproducciones, $reach, $mysqli){
	$query_datos_core="SELECT DISTINCT * FROM core_redes_sociales WHERE rrss_id='".$cuenta."'";
    $result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
    $num_row_datos_core= mysqli_num_rows($result_datos_core);

	if($num_row_datos_core>0){
		$query_inserta_datos_core='UPDATE core_redes_sociales SET  likes="'.$likes.'", comments="'.$comments.'",shares="'.$shares.'",followers="'.$followers.'",retweet="'.$retweet.'",favorites="'.$favorites.'",reproducciones="'.$reproducciones.'",reach="'.$reach.'" WHERE rrss_id="'.$cuenta.'"';
		$result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
	}else{
		$query_inserta_datos_core='INSERT INTO core_redes_sociales (rrss_id, rrss_name, rrss_img , persona_id, likes, comments, shares, followers, retweet, favorites, reproducciones, reach) VALUES ("'.$cuenta.'", "'.$rrss_name.'","'.$rrss_img.'","'.$persona_id.'", "'.$likes.'", "'.$comments.'", "'.$shares.'", "'.$followers.'", "'.$retweet.'", "'.$favorites.'", "'.$reproducciones.'", "'.$reach.'")';
		$result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
	}
}

function core_instagram($red_social, $mysqli, $persona_id){
	
	  $query3="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='instagram' AND cuenta='1'";
	  $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
	  $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
	  $num_row3= mysqli_num_rows($result3);
	  	if($num_row3>0){
		    do{
		      $json_user_url ="https://api.instagram.com/v1/users/".$row3[3]."?access_token=".$row3[6];
		      $json_user= file_get_contents($json_user_url);
		      $links_user_url= json_decode($json_user);
		      $followers_instagram = $links_user_url->data->counts->followed_by;
		      $rrss_name = $links_user_url->data->username;
		      $rrss_img = $links_user_url->data->profile_picture;
		      if ($row3[5] == 1){
		         $suma_red_social+=(int)$followers_instagram;
		      }
		      if ($row3[5] == 0){
		        $estado= 0;
		        $estado_descripcion="activar";
		      }else{
		        $estado= 1;
		        $estado_descripcion="desactivar";
		        }

		      $timestrap_fin=strtotime(date('Y-m-d'));
		      $timestrap_inicio= $timestrap_fin-(30*24*60*60);

		      $json_user_url2 ="https://api.instagram.com/v1/users/".$row3[3]."/media/recent?access_token=".$row3[6]."&min_timestamp=".$timestrap_inicio."&max_timestamp=".$timestrap_fin;
		      $json_user2= file_get_contents($json_user_url2);
		      $links_user_url2= json_decode($json_user2);
		      $count_media_recent= count($links_user_url2->data);
		      $instagram_history_likes=0;
		      $instagram_history_comments=0;
		      $i=0;
		   	do{
		          $instagram_history_likes+=$links_user_url2->data[$i]->likes->count;
		          $instagram_history_comments+=$comments=$links_user_url2->data[$i]->comments->count;
		          $i++;
		     }while($i<$count_media_recent);
		     $instagram_history_interactions=$instagram_history_likes+$instagram_history_comments;
		     ingresa_registros($row3[3], $persona_id, $rrss_name, $rrss_img, $instagram_history_likes, $instagram_history_comments, $shares, $followers_instagram, $retweet, $favorites, $reproducciones, number_format(($instagram_history_interactions/$followers_instagram),2), $mysqli);
		    }while($row3 = $result3->fetch_array());
		  }
}


$instagramId =$_POST['instagramId'];
$accessToken = $_POST['accessToken'];
$persona_id = $_SESSION['id'];
$json_user_url ="https://api.instagram.com/v1/users/".$instagramId."?access_token=".$accessToken;
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$followers_instagram = $links_user_url->data->counts->followed_by;

$query_existe_otro_perfil="SELECT rrss_id FROM rrss WHERE rrss_id=".$instagramId." AND descripcion_rrss='instagram'";
$results_existe_otro_prefil = $mysqli->query($query_existe_otro_perfil);
$num_row_existe_otro_perfil=mysqli_num_rows($results_existe_otro_prefil);
//echo '<script>alert('.$num_row_existe_otro_perfil.')</script>';

if(intval($num_row_existe_otro_perfil) > 1){
	echo 'existe';
}else{
	$query="SELECT rrss_id FROM rrss WHERE rrss_id='".$instagramId."' AND persona_id='".$persona_id."'  AND descripcion_rrss='instagram'";
	$results1 = $mysqli->query($query);
	$num_row1=mysqli_num_rows($results1);
	if(intval($num_row1) < 1){
			$query2="INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id,access_token,cuenta) VALUES ('instagram','".$instagramId."','".$persona_id."','".$accessToken."','1')";
			$results2 = $mysqli->query($query2);
		    core_instagram($red_social, $mysqli, $persona_id);
			echo 'exito';
	}else{
			$results2 = $mysqli->query("SELECT * FROM rrss WHERE rrss_id='".$instagramId."' AND descripcion_rrss='instagram' AND persona_id='".$persona_id."'");
			$num_row2=mysqli_num_rows($results2);
			if($num_row2>0)echo 'existe';
			else echo 'otro';
	}

}




?>