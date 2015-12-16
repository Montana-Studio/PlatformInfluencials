<?php
include('rrss/rrss_keys.php');
$query_redes_sociales_campana="SELECT DISTINCT * FROM campana WHERE id=".$row[0]." AND idEstado='1'";
$result_redes_sociales_campana=mysqli_query($mysqli,$query_redes_sociales_campana)or die (mysqli_error());
$row_redes_sociales_campana= mysqli_fetch_array($result_redes_sociales_campana, MYSQLI_BOTH);
$redes_sociales=explode(',',$row_redes_sociales_campana['redes_sociales']);
for($i=0;$i<count($redes_sociales);$i++){
	echo '<ul>'.$redes_sociales[$i];
	
	if($redes_sociales[$i]=='facebook'){
		
		
		$query_facebook_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='facebook'";
		$result_facebook_asociado_campana=mysqli_query($mysqli,$query_facebook_asociado_campana)or die (mysqli_error());
		$row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana, MYSQLI_BOTH);
		$facebookKey =FACEBOOK_CONSUMER_KEY;
   		$facebookAppId = FACEBOOK_APP_ID;
   		$facebook_likes_total=0;
   		$facebook_comments_total=0;
   		$num_row_facebook_asociado_campana= mysqli_num_rows($result_facebook_asociado_campana);

		if($num_row_facebook_asociado_campana>0){
			echo '<ul>';
	   		do{
	   			$facebook_post_id=explode("/",$row_facebook_asociado_campana['url']);
				$json_user_url="https://graph.facebook.com/".end($facebook_post_id)."/likes?access_token=".$facebookAppId."|".$facebookKey."";
		        $json_user_url = str_replace(" ", "%20", $json_user_url);
		        $json_user= file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);
		        $json_user_url1="https://graph.facebook.com/".end($facebook_post_id)."/comments?access_token=".$facebookAppId."|".$facebookKey."";

		        $json_user_url1 = str_replace(" ", "%20", $json_user_url1);
		        $json_user1= file_get_contents($json_user_url1);
		        $links_user_url1= json_decode($json_user1);
		        echo $json_user_url1;
				$facebook_likes_total+=count($links_user_url->data);
				$facebook_comments_total+=count($links_user_url1->data);

	   		}while($row_facebook_asociado_campana = mysqli_fetch_array($result_facebook_asociado_campana));
	   		echo '<li> Likes :'.$facebook_likes_total.'</li>';
			echo '<li> Comments :'.$facebook_comments_total.'</li>';
			echo '</ul>';
		}
   		


	}
	if($redes_sociales[$i]=='instagram'){
		
		$query_instagram_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='instagram'";
		$result_instagram_asociado_campana=mysqli_query($mysqli,$query_instagram_asociado_campana)or die (mysqli_error());
		$row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana, MYSQLI_BOTH);
		$num_row_instagram_asociado_campana= mysqli_num_rows($result_instagram_asociado_campana);

		if($num_row_instagram_asociado_campana>0){
			echo '<ul>';
			$instagram_likes_total=0;
			$instagram_comments_total=0;
			do{
				
				$api = file_get_contents("http://api.instagram.com/oembed?url=".$row_instagram_asociado_campana['url']);      
				$apiObj = json_decode($api,true);  
				$media_id = $apiObj['media_id']; 
				$instagram_id = $row_instagram_asociado_campana['rrss_id'];
				$query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$instagram_id;

				$result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error());
				$row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
				$access_token = $row_instagram_rrss['access_token'];
				$instagram_post_query = file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
				$instagram_post_json = json_decode($instagram_post_query,true); 
				$instagram_post_comments = intval($instagram_post_json['data']['comments']['count']);
				$instagram_post_likes = intval($instagram_post_json['data']['likes']['count']);
				$instagram_comments_total+=$instagram_post_comments;
				$instagram_likes_total+=$instagram_post_likes;
			}while($row_instagram_asociado_campana = mysqli_fetch_array($result_instagram_asociado_campana));

			echo '<li> Likes :'.$instagram_likes_total.'</li>';
			echo '<li> Comments :'.$instagram_comments_total.'</li>';
			echo '</ul>';
		}
		
		
		  
		
	}
	if($redes_sociales[$i]=='twitter'){
		

		$query_twitter_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='twitter'";
		$result_twitter_asociado_campana=mysqli_query($mysqli,$query_twitter_asociado_campana)or die (mysqli_error());
		$row_twitter_asociado_campana= mysqli_fetch_array($result_twitter_asociado_campana, MYSQLI_BOTH);
		$num_row_twitter_asociado_campana= mysqli_num_rows($result_twitter_asociado_campana);

		if($num_row_twitter_asociado_campana>0){
			echo '<ul>';
			$twitter_retweet_total=0;
			$twitter_favorite_total=0;
			do{
				include_once("rrss/twitter/inc/twitteroauth.php");
				include_once('rrss/twitter/inc/TwitterAPIExchange.php');
				include_once('rrss/twitter/twitter_auth.php');
				//echo TWITTER_CONSUMER_KEY;
				$settings = array(
				'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
				'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
				'consumer_key' => TWITTER_CONSUMER_KEY,
				'consumer_secret' => TWITTER_CONSUMER_SECRET
				);
				$twitter_post_id_array= explode('/', $row_twitter_asociado_campana['url']);
				$string_post_id= end($twitter_post_id_array);
				$ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
				$requestMethod = 'GET';
				$usuario1 = $row_twitter_asociado_campana[2];
		        $getfield1 = '?id='.$usuario1;
		        $twitter1 = new TwitterAPIExchange($settings);
		        $follow_count1=$twitter1->setGetfield($getfield1)
		        ->buildOauth($ta_url, $requestMethod)
		        ->performRequest();
		        $data1 = json_decode($follow_count1, true);
		        $twitter_retweet=$data1["retweet_count"];
		        $twitter_favorite=$data1["favorite_count"];
		        $twitter_retweet_total+=$twitter_retweet;
		        $twitter_favorite_total+=$twitter_favorite;

				
				
			}while($row_twitter_asociado_campana = mysqli_fetch_array($result_twitter_asociado_campana));
			echo '<li> Likes :'.$twitter_favorite_total.'</li>';
			echo '<li> Retweets :'.$twitter_retweet_total.'</li>';
			echo '</ul>';
		}
		
	}
	if($redes_sociales[$i]=='youtube'){
		
		$query_youtube_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='youtube'";
		$result_youtube_asociado_campana=mysqli_query($mysqli,$query_youtube_asociado_campana)or die (mysqli_error());
		$row_youtube_asociado_campana= mysqli_fetch_array($result_youtube_asociado_campana, MYSQLI_BOTH);
		$num_row_youtube_asociado_campana= mysqli_num_rows($result_youtube_asociado_campana);

		if($num_row_youtube_asociado_campana>0){
			echo '<ul>';
			$youtube_videos_total=0;
			do{
				/*$query_youtube_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='youtube'";
				$result_youtube_asociado_campana=mysqli_query($mysqli,$query_youtube_asociado_campana)or die (mysqli_error());
				$row_youtube_asociado_campana= mysqli_fetch_array($result_youtube_asociado_campana, MYSQLI_BOTH);*/
				$youtube_video_id= explode("?v=",$row_youtube_asociado_campana['url']);
				$json_user_url ="https://www.googleapis.com/youtube/v3/videos?part=contentDetails,statistics&id=".$youtube_video_id[1]."&key=".GOOGLE_CONSUMER_KEY;
		        $json_user= file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);
		        $youtube_video_views = $links_user_url->items[0]->statistics->viewCount;
		        $youtube_video_likes = $links_user_url->items[0]->statistics->likeCount;
		        $youtube_video_comments = $links_user_url->items[0]->statistics->commentCount;
		        $youtube_video_views_total+=$youtube_video_views;
		        $youtube_video_likes_total+=$youtube_video_likes; 
		        $youtube_video_comments_total+=$youtube_video_comments;       
	    	}while($row_youtube_asociado_campana = mysqli_fetch_array($result_youtube_asociado_campana));
	    	echo '<li> Views :'.$youtube_video_views_total.'</li>';
			echo '<li> Likes :'.$youtube_video_likes_total.'</li>';
			echo '<li> Comments :'.$youtube_video_comments_total.'</li>';
			echo '</ul>';
		}
	}
	if($redes_sociales[$i]=='googleplus'){
		
		$query_googleplus_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='googleplus'";
		$result_googleplus_asociado_campana=mysqli_query($mysqli,$query_googleplus_asociado_campana)or die (mysqli_error());
		$row_googleplus_asociado_campana= mysqli_fetch_array($result_googleplus_asociado_campana, MYSQLI_BOTH);
		$googleplusKey =GOOGLE_CONSUMER_KEY;
        $googleplus_plusoners_total=0;
        $googleplus_resharers_total=0;
        $googleplus_replies=0;
        $num_row_googleplus_asociado_campana= mysqli_num_rows($result_googleplus_asociado_campana);

		if($num_row_googleplus_asociado_campana>0){
	        echo '<ul>';
	        do{
				$googleplus_user_id_array=explode('/',$row_googleplus_asociado_campana['url']);
		        $googleplus_user_id=$googleplus_user_id_array[3];
		        $googleplus_post_id=$googleplus_user_id_array[5];
		        $json_user_url="https://www.googleapis.com/plus/v1/people/".$googleplus_user_id."/activities/public?key=".$googleplusKey;
		        $json_user= file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);
	        	$googleplus_post_length = count($links_user_url->items);
		        for($j=0;$j<$googleplus_post_length;$j++){
		        	if($links_user_url->items[$j]->url == $row_googleplus_asociado_campana['url']){
		        		$activity_id=$links_user_url->items[$j]->id;
		        		$googleplus_plusoners_total += $links_user_url->items[$j]->object->plusoners->totalItems;
		        		$googleplus_resharers_total += $links_user_url->items[$j]->object->resharers->totalItems;
		        		$googleplus_replies += $links_user_url->items[$j]->object->replies->totalItems;
					}
		        }
			}while($row_googleplus_asociado_campana = mysqli_fetch_array($result_googleplus_asociado_campana));
			echo "<li>plusoners : ".$googleplus_plusoners_total."</li>";
			echo "<li>resharers : ".$googleplus_resharers_total."</li>";
			echo "<li>replies : ".$googleplus_replies."</li>";
			echo '</ul>';
		}
	}
	
	if($redes_sociales[$i]=='analytics'){
		
	}
	echo '</ul>';

}
?>