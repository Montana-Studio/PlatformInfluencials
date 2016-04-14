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
		$query_inserta_datos_core='INSERT INTO core_redes_sociales (rrss_id, rrss_name, rrss_img , persona_id, likes, comments, shares, followers, retweet, favorites, reproducciones) VALUES ("'.$cuenta.'", "'.$rrss_name.'","'.$rrss_img.'","'.$persona_id.'", "'.$likes.'", "'.$comments.'", "'.$shares.'", "'.$followers.'", "'.$retweet.'", "'.$favorites.'", "'.$reproducciones.'")';
		$result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
	}
}

function core_facebook($red_social, $mysqli, $persona_id){
	$query6="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='facebook' AND cuenta='1'";
    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
    $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
    $num_row6=mysqli_num_rows($result6);
    $facebookKey =FACEBOOK_CONSUMER_KEY;
    $facebookAppId = FACEBOOK_APP_ID;
	    if($num_row6>0){
	      do{
	        //include_once('facebook-auth.php');
	        $facebookPage = $row6[3];
	        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
	        $json_user_url = str_replace(" ", "%20", $json_user_url1);
	        $json_user= @file_get_contents($json_user_url);
	        $links_user_url= json_decode($json_user);
	        $date_three_months_ago=date('Y-m-d', time() - 30 *60 * 60 * 24 ); 
	         $json_user_url2 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=posts.since(".$date_three_months_ago.").limit(100).summary(true){likes.limit(0).summary(true),comments.limit(0).summary(true),shares}";
	        $json_user_url2 = str_replace(" ", "%20", $json_user_url2);
	        $json_user2= @file_get_contents($json_user_url2);
	        $links_user_url2= json_decode($json_user2);

	        if ($json_user) {
		        $facebook_likes =$links_user_url->likes;
		        $facebook_talking_about =$links_user_url->talking_about_count;
		        $rrss_name =$links_user_url->username;
		        $facebook_website =$links_user_url->website;
		        $count_facebook_posts=count($links_user_url2->posts->data);
		        $facebook_history_likes=0;
		        $contador_iteraciones_paginas=0;
		        $facebook_history_comments=0;
		        $facebook_history_shares=0;
		        $i=0;
            	do{
	                  $facebook_history_likes+=$links_user_url2->posts->data[$i]->likes->summary->total_count;
	                  $facebook_history_comments+=$links_user_url2->posts->data[$i]->comments->summary->total_count;
	                  $facebook_history_shares+=$links_user_url2->posts->data[$i]->shares->count;
	                  $i++;
           		}while($i<100);
		        $facebookHistoryInteractions=$facebook_history_shares+$facebook_history_comments+$facebook_history_likes;
		        $rrss_img = "https://graph.facebook.com/".$rrss_name."/picture?type=large";

		        if ($row6[5] == 1){
		          $suma_red_social+=(int)$facebook_likes;
		        }
	        	ingresa_registros($facebookPage, $persona_id, $rrss_name, $rrss_img, $facebook_history_likes, $facebook_history_comments, $facebook_history_shares, $facebook_likes, $retweet, $favorites, $reproducciones, number_format(($facebookHistoryInteractions/$facebook_likes),2), $mysqli);
	    	}	
	      }while($row6 = $result6->fetch_array());
    }
}

$facebook_page_id = $_POST['facebook_page_id'];
$faceuser = $_POST['faceuser'];
$persona_id = $_SESSION['id'];

$results1 = $mysqli->query('SELECT rrss_id FROM rrss WHERE rrss_id="'.$facebook_page_id.'" AND descripcion_rrss="facebook"');
$num_row1=mysqli_num_rows($results1);
if($num_row1 < 1){
	$results2 = $mysqli->query('INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id,cuenta) VALUES ("facebook","'.$facebook_page_id.'","'.$persona_id.'","1")');
	core_facebook('facebook', $mysqli, $persona_id);
	echo 'exito';
}else{
	$results2 = $mysqli->query('SELECT * FROM rrss WHERE rrss_id="'.$facebook_page_id.'" AND descripcion_rrss="facebook" AND persona_id="'.$persona_id.'"');
	$num_row2=mysqli_num_rows($results2);
	if($num_row2>0)echo 'existe';
	else echo 'otro';
}
?>