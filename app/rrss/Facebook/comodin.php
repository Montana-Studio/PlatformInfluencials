<?php 
/*
define('FACEBOOK_CONSUMER_KEY', 'd2a271bae27da31e11e8824903d4824a');
define('FACEBOOK_APP_ID', '932994110103491');
define('LOCAL', 'localhost');
define('USER', 'powerinf_user');
define('PASS', 'uho$}~1(1;nn');
define('BD', 'powerinf_luencers');

$mysqli = mysqli_connect(LOCAL,USER,PASS,BD) or die("Error " . mysqli_error($link)); 
    $mysqli->set_charset('utf8_bin');
$facebookPage="153150408072177";
$persona_id='17';
$facebookPage = '153150408072177';
$graph_token="CAANQjZA6Cn8MBAPMxFgFhsMTSFAK4p07DnZB5Rvh8ZBDkpokogZB7HgJspgs64RgVCVUTQzne09tid4y2JI54yWo9GCSCaptodxjEJn9EMKT1bkLfaD8A1xaipmsZBmCVVpp4awFCBtJoTTHDPlt7Utopr0rsl8ZBwbTUhfeDFcJZCmtbebWgb2OjDtNdktz3OE3uXg5HYo4gZDZD";
$json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$graph_token."&fields=likes,talking_about_count,username,website";
$json_user_url = str_replace(" ", "%20", $json_user_url1);
$json_user= @file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$date_three_months_ago=date('Y-m-d', time() - 30 *60 * 60 * 24 ); 
 $json_user_url2 ="https://graph.facebook.com/153150408072177?access_token=".$graph_token."&fields=posts.since(2016-03-12).limit(100).summary(true){likes.limit(0).summary(true),comments.limit(0).summary(true),shares}";
$json_user_url2 = str_replace(" ", "%20", $json_user_url2);
$json_user2= @file_get_contents($json_user_url2);
$links_user_url2= json_decode($json_user2);
var_dump($json_user);
if ($json_user) {
    $followers =$links_user_url->likes;
    $rrss_name =$links_user_url->username;
    $facebook_website =$links_user_url->website;
    $count_facebook_posts=count($links_user_url2->posts->data);
    $likes_posts=0;
    $contador_iteraciones_paginas=0;
    $comments=0;
    $shares=0;
    $i=0;
	do{
          $likes_posts+=$links_user_url2->posts->data[$i]->likes->summary->total_count;
          echo $likes_posts;
          $comments+=$links_user_url2->posts->data[$i]->comments->summary->total_count;
          echo $comments;
          $shares+=$links_user_url2->posts->data[$i]->shares->count;
          echo $shares;
          $i++;
		}while($i<100);
		$facebookHistoryInteractions=$shares+$comments+$likes_posts;
    	$reach= number_format($facebookHistoryInteractions/$followers,3);
	}
		
    
    //$rrss_img = "https://graph.facebook.com/".$rrss_name."/picture?type=large";

	$query_inserta_datos_core='INSERT INTO core_redes_sociales (rrss_id, rrss_name , persona_id, likes, comments, shares, followers, retweet, favorites, reproducciones, reach) VALUES ("'.$facebookPage.'", "'.$rrss_name.'","'.$persona_id.'", "'.$likes_posts.'", "'.$comments.'", "'.$shares.'", "'.$followers.'", "'.$retweet.'", "'.$favorites.'", "'.$reproducciones.'","'.$reach.'")';
	$result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
	*/


?>
