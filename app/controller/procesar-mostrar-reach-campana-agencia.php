<?php
include('rrss/rrss_keys.php');
$query_redes_sociales_campana="SELECT DISTINCT * FROM campana WHERE id=".$row[0]." AND idEstado='1'";
$result_redes_sociales_campana=mysqli_query($mysqli,$query_redes_sociales_campana)or die (mysqli_error());
$row_redes_sociales_campana= mysqli_fetch_array($result_redes_sociales_campana, MYSQLI_BOTH);
$redes_sociales=explode(',',$row_redes_sociales_campana['redes_sociales']);
$cuenta_likes_facebook=0;
$cuenta_comments_facebook=0;
for($i=0;$i<count($redes_sociales);$i++){
	echo '<ul class="redes-metrics"><span class="tit-red red-'.$redes_sociales[$i].'" title="'.$redes_sociales[$i].'"></span>';
	
	if($redes_sociales[$i]=='facebook'){
			
		$query_facebook_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='facebook'";
		$result_facebook_asociado_campana=mysqli_query($mysqli,$query_facebook_asociado_campana)or die (mysqli_error());
		$row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana, MYSQLI_BOTH);
		$facebookKey =FACEBOOK_CONSUMER_KEY;
   		$facebookAppId = FACEBOOK_APP_ID;
   		$facebook_likes_total=0;
   		$facebook_comments_total=0;
   		$num_row_facebook_asociado_campana= mysqli_num_rows($result_facebook_asociado_campana);
   		$facebookPage = $row_facebook_asociado_campana[2];

		if($num_row_facebook_asociado_campana>0){
			echo '<div class="data"><ul>';
	   		do{	
	   			$facebook_post_id=explode("/",$row_facebook_asociado_campana['url']);
				$json_user_url="https://graph.facebook.com/".$row_facebook_asociado_campana[2]."_".trim(end($facebook_post_id))."?fields=likes,comments,shares";
		        $json_user_url = str_replace(" ", "%20", $json_user_url);
		        $json_user= @file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);

		        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
		        $json_user_url1 = str_replace(" ", "%20", $json_user_url1);
		        $json_user1= @file_get_contents($json_user_url1);
		        $links_user_url1= json_decode($json_user1);

		        $json_user_url2 ="https://graph.facebook.com/296448387178344?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
		        $json_user_url2 = str_replace(" ", "%20", $json_user_url2);
		        $json_user2= @file_get_contents($json_user_url2);
		        $links_user_url2= json_decode($json_user2);
		        $followers_facebook += $links_user_url2->likes;

        if ($row6[5] == 1){
          $suma_facebook+=(int)$facebookLikes;
        }

		        //echo string gettype ($links_user_url->likes);
        		if (is_array($links_user_url->likes->data ) || is_object($links_user_url->likes->data))
				{
			        foreach ($links_user_url->likes->data as $valor){
			        	$cuenta_likes_facebook++;
			        	$cuenta_comments_facebook++;
			        }
		        	$cuenta_shares_facebook+=$links_user_url->shares->count;
		        }

	   		}while($row_facebook_asociado_campana = mysqli_fetch_array($result_facebook_asociado_campana));
	   		$formatted_reach_facebook = number_format((($cuenta_likes_facebook+$cuenta_comments_facebook+$cuenta_shares_facebook)*100)/$followers_facebook, 2, '.', ',');
	   		
			//echo '<li> Likes :'.$cuenta_likes_facebook.'</li>';
			//echo '<li> Comments :'.$cuenta_comments_facebook.'</li>';
			//echo '<li> Shares :'.$cuenta_shares_facebook.'</li>';
			//echo '<li> Followers :'.$followers_facebook.'</li>';
			//echo '<li> Reach :'.$formatted_reach_facebook.'%</li>';
			echo '<li><span>Reach</span><span>'.$formatted_reach_facebook.'%</span></li>';
			echo '</ul></div>';
		}
   		
	}
	if($redes_sociales[$i]=='instagram'){
		
		$query_instagram_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='instagram'";
		$result_instagram_asociado_campana=mysqli_query($mysqli,$query_instagram_asociado_campana)or die (mysqli_error());
		$row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana, MYSQLI_BOTH);
		$num_row_instagram_asociado_campana= mysqli_num_rows($result_instagram_asociado_campana);
		echo $num_row_instagram_asociado_campana;
		if($num_row_instagram_asociado_campana>0){

			echo '<div class="data"><ul>';
			$instagram_likes_total=0;
			$instagram_comments_total=0;
			do{
				//Get Followers
			  

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
				$json_user_url ="https://api.instagram.com/v1/users/".$instagram_id."?access_token=".$access_token;
				echo $json_user_url;
		        $json_user= file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);
		        $followers_instagram = $links_user_url->data->counts->followed_by;
		        $formatted_reach_instagram = number_format((($instagram_likes_total+$instagram_comments_total)*100)/$followers_instagram, 2, '.', ',');
			}while($row_instagram_asociado_campana = mysqli_fetch_array($result_instagram_asociado_campana));
			//echo '<li> Likes :'.$instagram_likes_total.'</li>';
			//echo '<li> Comments :'.$instagram_comments_total.'</li>';
			//echo '<li> Reach :'.$formatted_reach_instagram.'%</li>';
			echo '<li><span>Reach</span><span>'.$formatted_reach_instagram.'%</span></li>';
			echo '</ul></div>';
		}
		
	}
	if($redes_sociales[$i]=='twitter'){
		
		$query_twitter_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='twitter'";
		$result_twitter_asociado_campana=mysqli_query($mysqli,$query_twitter_asociado_campana)or die (mysqli_error());
		$row_twitter_asociado_campana= mysqli_fetch_array($result_twitter_asociado_campana, MYSQLI_BOTH);
		$num_row_twitter_asociado_campana= mysqli_num_rows($result_twitter_asociado_campana);
		if($num_row_twitter_asociado_campana>0){
			echo '<div class="data"><ul>';
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
		        $twitter_followers_total+=$data1["user"]["followers_count"];

				
				
			}while($row_twitter_asociado_campana = mysqli_fetch_array($result_twitter_asociado_campana));
			//echo '<li><span>Likes</span><span>'.$twitter_favorite_total.'</span></li>';
			//echo '<li><span>Retweets</span><span>'.$twitter_retweet_total.'</span></li>';
			$formatted_reach_twitter = number_format((($twitter_retweet_total+$twitter_favorite_total)*100)/$twitter_followers_total, 2, '.', ',');
			echo '<li><span>Reach</span><span>'.$formatted_reach_twitter.'%</span></li>';
			echo '</ul></div>';
		}
		
	}
	if($redes_sociales[$i]=='youtube'){
		
		$query_youtube_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='youtube'";
		$result_youtube_asociado_campana=mysqli_query($mysqli,$query_youtube_asociado_campana)or die (mysqli_error());
		$row_youtube_asociado_campana= mysqli_fetch_array($result_youtube_asociado_campana, MYSQLI_BOTH);
		$num_row_youtube_asociado_campana= mysqli_num_rows($result_youtube_asociado_campana);
		if($num_row_youtube_asociado_campana>0){
			echo '<div class="data"><ul>';
			$youtube_videos_total=0;
			do{
				/*$query_youtube_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='youtube'";
				$result_youtube_asociado_campana=mysqli_query($mysqli,$query_youtube_asociado_campana)or die (mysqli_error());
				$row_youtube_asociado_campana= mysqli_fetch_array($result_youtube_asociado_campana, MYSQLI_BOTH);*/
				$youtube_video_id= explode("?v=",$row_youtube_asociado_campana['url']);
				$json_user_url ="https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&id=".$youtube_video_id[1]."&key=".GOOGLE_CONSUMER_KEY;
		        $json_user= file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);
		        $youtube_video_views = $links_user_url->items[0]->statistics->viewCount;
		        $youtube_video_likes = $links_user_url->items[0]->statistics->likeCount;
		        $youtube_id = $links_user_url->items[0]->snippet->channelId;

		       /* $json_user_url1 ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$youtube_id."&key=".GOOGLE_CONSUMER_KEY;
		        $json_user1= file_get_contents($json_user_url1);
		        $links_user_url1= json_decode($json_user1);
		        $youtubeSubscribers = $links_user_url1->items[0]->statistics->subscriberCount;
		        //echo $json_user_url1;
				*/

		        $youtube_video_views_total+=$youtube_video_views;
		        //$youtube_video_likes_total+=$youtube_video_likes; 
		        //$youtube_video_comments_total+=$youtube_video_comments;
		        //$youtube_video_subscribers_total+=$youtubeSubscribers;

	    	}while($row_youtube_asociado_campana = mysqli_fetch_array($result_youtube_asociado_campana));
	    	//$formatted_reach_youtube = number_format((($youtube_video_views_total)*100)/$youtube_video_subscribers_total, 2, '.', ',');
	    	//echo '<li> Views :'.$youtube_video_views_total.'</li>';
            echo '<li><span>Reach</span><span>'.$youtube_video_views_total.'%</span></li>';
			/*echo '<li> Likes :'.$youtube_video_likes_total.'</li>';
			echo '<li> Comments :'.$youtube_video_comments_total.'</li>';
			echo '<li> Reach :'.$formatted_reach_youtube.'%</li>';*/
			echo '</ul></div>';
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
	        echo '<div class="data"><ul>';
	        do{
				$googleplus_user_id_array=explode('/',$row_googleplus_asociado_campana['url']);
		        $googleplus_user_id=$googleplus_user_id_array[3];
		        $googleplus_post_id=$googleplus_user_id_array[5];
		        $json_user_url="https://www.googleapis.com/plus/v1/people/".$googleplus_user_id."/activities/public?key=".$googleplusKey;
				$json_user= file_get_contents($json_user_url);
		        $links_user_url= json_decode($json_user);
	        	$googleplus_post_length = count($links_user_url->items);
	        	$json_user_url1 ="https://www.googleapis.com/plus/v1/people/".$googleplus_user_id."?key=".$googleplusKey;
		        $json_user1= file_get_contents($json_user_url1);
		        $links_user_url1= json_decode($json_user1);
		        

		        for($j=0;$j<$googleplus_post_length;$j++){
		        	if($links_user_url->items[$j]->url == $row_googleplus_asociado_campana['url']){
		        		$activity_id=$links_user_url->items[$j]->id;
		        		$googleplus_plusoners_total += $links_user_url->items[$j]->object->plusoners->totalItems;
		        		$googleplus_resharers_total += $links_user_url->items[$j]->object->resharers->totalItems;
		        		$googleplus_replies += $links_user_url->items[$j]->object->replies->totalItems;
		        		$googleplus_followers +=$links_user_url1->circledByCount;

					}
		        }
			}while($row_googleplus_asociado_campana = mysqli_fetch_array($result_googleplus_asociado_campana));

			$formatted_reach_googleplus = number_format((($googleplus_plusoners_total+$googleplus_resharers_total+$googleplus_replies)*100)/$googleplus_followers, 2, '.', ',');
			//echo "<li>plusoners : ".$googleplus_plusoners_total."</li>";
			//echo "<li>resharers : ".$googleplus_resharers_total."</li>";
			//echo "<li>replies : ".$googleplus_replies."</li>";
			//echo "<li>Reach : ".$formatted_reach_googleplus."%</li>";
            echo '<li><span>Reach</span><span>'.$formatted_reach_googleplus.'%</span></li>';
			echo '</ul></div>';
		}
	}
	
	if($redes_sociales[$i]=='analytics'){
		
	}

	echo '</ul>';

}
	unset($query_redes_sociales_campana);
	unset($result_redes_sociales_campana);
	unset($row_redes_sociales_campana);
	unset($redes_sociales);
	unset($query_facebook_asociado_campana);
	unset($result_facebook_asociado_campana);
	unset($row_facebook_asociado_campana);
	unset($facebookKey);
	unset($facebookAppId);
	unset($num_row_facebook_asociado_campana);
	unset($facebookPage);
	unset($facebook_post_id);
	unset($json_user_url);
    unset($json_user);
    unset($links_user_url);
    unset($json_user_url1);
    unset($json_user1);
    unset($links_user_url1);
    unset($json_user_url2);
    unset($json_user_url2);
    unset($json_user2);
    unset($links_user_url2);
    unset($followers_facebook);
	unset($query_instagram_asociado_campana);
	unset($result_instagram_asociado_campana);
	unset($row_instagram_asociado_campana);
	unset($num_row_instagram_asociado_campana);
	unset($api);
	unset($apiObj);
	unset($media_id);
	unset($instagram_id);
	unset($query_instagram_rrss);
	unset($result_instagram_rrss);
	unset($row_instagram_rrss);
	unset($access_token);
	unset($instagram_post_query);
	unset($instagram_post_json);
    unset($links_user_url);
    unset($followers_instagram);
    unset($query_twitter_asociado_campana);
	unset($result_twitter_asociado_campana);
	unset($row_twitter_asociado_campana);
	unset($num_row_twitter_asociado_campana);
	unset($settings);
	unset($twitter_post_id_array);
	unset($string_post_id);
	unset($ta_url);
	unset($requestMethod);
	unset($usuario1);
    unset($getfield1);
    unset($twitter1);
    unset($follow_count1);
    unset($data1);
	unset($query_youtube_asociado_campana);
	unset($result_youtube_asociado_campana);
	unset($row_youtube_asociado_campana);
	unset($num_row_youtube_asociado_campana);
	unset($youtube_video_id);
	unset($query_googleplus_asociado_campana);
	unset($result_googleplus_asociado_campana);
	unset($row_googleplus_asociado_campana);
	unset($googleplusKey);
    unset($num_row_googleplus_asociado_campana);
    unset($googleplus_user_id_array);
    unset($googleplus_user_id);
    unset($googleplus_post_id);


?>