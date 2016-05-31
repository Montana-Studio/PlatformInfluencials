	<?php
require('../../controller/conexion.php');
require('../../controller/master_key.php');


function ingresa_registros($cuenta, $persona_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $followers, $retweet, $favorites, $reproducciones, $reach, $mysqli){
	$query_datos_core="SELECT DISTINCT * FROM core_redes_sociales WHERE rrss_id='".$cuenta."'";
    $result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
    $num_row_datos_core= mysqli_num_rows($result_datos_core);

	if($num_row_datos_core>0){
		$query_inserta_datos_core='UPDATE core_redes_sociales SET  likes="'.$likes.'", comments="'.$comments.'",shares="'.$shares.'",followers="'.$followers.'",retweet="'.$retweet.'",favorites="'.$favorites.'",reproducciones="'.$reproducciones.'",reach="'.$reach.'" WHERE rrss_id="'.$cuenta.'"';
		$result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
	}else{
		$query_inserta_datos_core='INSERT INTO core_redes_sociales (rrss_id, rrss_name, rrss_img , persona_id, likes, comments, shares, followers, retweet, favorites, reproducciones) VALUES ("'.$cuenta.'", "'.$rrss_name.'","'.$rrss_img.'","'.$persona_id.'", "'.$likes.'", "'.$comments.'", "'.$shares.'", "'.$followers.'", "'.$retweet.'", "'.$favorites.'", "'.$reproducciones.'", "'.$reach.'")';
		$result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
	}
}

function core_youtube($red_social, $mysqli, $persona_id){
	$query5="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='youtube' AND cuenta='1'";
    $result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
    $row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
    $num_row5=mysqli_num_rows($result5);
	    if($num_row5>0){
	      do{
	        //include_once('rrss/youtube/auth.php');
	        $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row5[3]."&key=".GOOGLE_CONSUMER_KEY;
	        $json_user= file_get_contents($json_user_url);
	        $links_user_url= json_decode($json_user);
	        $rrss_name = $links_user_url->items[0]->snippet->title;
	        $rrss_img = $links_user_url->items[0]->snippet->thumbnails->high->url;
	        $youtube_video_views = $links_user_url->items[0]->statistics->viewCount;
	        ingresa_registros($row5[3], $persona_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $youtubeSubscribers, $retweet, $favorites, $youtube_video_views, $reach, $mysqli);        
	      }while($row5 = $result5->fetch_array());
	    }
}


$instagramId =$_POST['instagramId'];
$accessToken = $_POST['accessToken'];
$persona_id = $_SESSION['id'];
$json_user_url ="https://api.instagram.com/v1/users/".$instagramId."?access_token=".$accessToken;
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$followers_instagram = $links_user_url->data->counts->followed_by;

$query_existe_otro_perfil="SELECT rrss_id FROM rrss WHERE rrss_id=".$instagramId." AND descripcion_rrss='youtube'";
$results_existe_otro_prefil = $mysqli->query($query_existe_otro_perfil);
$num_row_existe_otro_perfil=mysqli_num_rows($results_existe_otro_prefil);

if(intval($num_row_existe_otro_perfil) > 1){
	echo 'existe';
}else{
	$query="SELECT rrss_id FROM rrss WHERE rrss_id=".$instagramId." AND persona_id=".$persona_id."  AND descripcion_rrss='youtube'";
	$results1 = $mysqli->query($query);
	$num_row1=mysqli_num_rows($results1);
	if(intval($num_row1) < 1){
		$results2 = $mysqli->query('INSERT INTO core_redes_sociales (rrss_id,persona_id) VALUES ("'.$facebook_page_id.'","'.$persona_id.'")');
	  $query2="INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id,cuenta) VALUES ('youtube','$instagramId','$persona_id','1')";
		$results2 = $mysqli->query($query2);
		core_youtube('youtube', $mysqli, $persona_id);
		echo 'exito';
	}else{
		$results2 = $mysqli->query("SELECT * FROM rrss WHERE rrss_id='$instagramId' AND descripcion_rrss='instagram' AND persona_id='$persona_id'");
		$num_row2=mysqli_num_rows($results2);
		if($num_row2>0)echo 'existe';
		else echo 'otro';
	}

}

?>