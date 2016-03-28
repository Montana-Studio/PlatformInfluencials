<?php
include('rrss/rrss_keys.php');
//include('rrss/facebook/facebook-auth.php');

function muestra_reach_campana(){
	$_SESSION['reach-campana']='';
	for($i=0;$i<count($redes_sociales);$i++){
		$_SESSION['reach-campana'].= '<ul class="redes-metrics"><span class="tit-red red-'.$redes_sociales[$i].'" title="'.$redes_sociales[$i].'"></span>';
		
		if($redes_sociales[$i]=='facebook'){
			
			$query_facebook_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='facebook'";
			$result_facebook_asociado_campana=mysqli_query($mysqli,$query_facebook_asociado_campana)or die (mysqli_error());
			$row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana, MYSQLI_BOTH);
			$num_row_facebook_asociado_campana= mysqli_num_rows($result_facebook_asociado_campana);
			$facebookKey =FACEBOOK_CONSUMER_KEY;
	   		$facebookAppId = FACEBOOK_APP_ID;
			if($num_row_facebook_asociado_campana>0){
				$query_facebook_asociado_campana2= "SELECT DISTINCT rrss_id FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='facebook'";
				$result_facebook_asociado_campana2=mysqli_query($mysqli,$query_facebook_asociado_campana2)or die (mysqli_error());
				$row_facebook_asociado_campana2= mysqli_fetch_array($result_facebook_asociado_campana2, MYSQLI_BOTH);
				$paginas='';

				//encuentro los medios asociados a la campaña

				do{
					$paginas.= $row_facebook_asociado_campana2['rrss_id'].",";
				}while($row_facebook_asociado_campana2 = mysqli_fetch_array($result_facebook_asociado_campana2));
				$paginas_asociadas = explode(",", $paginas);
				$reach_total_facebook=0;

				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				//recorro los medios indicando el reach en cada uno por separado
				for($k=0;$k<count($paginas_asociadas)-1;$k++){
					$query_facebook_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='facebook' AND rrss_id='".$paginas_asociadas[$k]."'";
					$result_facebook_asociado_campana=mysqli_query($mysqli,$query_facebook_asociado_campana)or die (mysqli_error());
					$row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana, MYSQLI_BOTH);
					$cuenta_likes_facebook=0;
			   		$cuenta_comments_facebook=0;
			   		$cuenta_shares_facebook=0;
			   		

			   		//acumulo resultados por cada medio
					do{
						
				   		//do{	
				   			$facebookPage = $row_facebook_asociado_campana[2];
				   			$facebook_post_id=explode("/",$row_facebook_asociado_campana['url']);
							$json_user_url="https://graph.facebook.com/".$row_facebook_asociado_campana[2]."_".trim(end($facebook_post_id))."?fields=likes.limit(0).summary(true),comments.limit(0).summary(true),shares";
					        $json_user_url = str_replace(" ", "%20", $json_user_url);
					        $json_user= @file_get_contents($json_user_url);
					        $links_user_url= json_decode($json_user);

					        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,name";
					        $json_user_url1 = str_replace(" ", "%20", $json_user_url1);
					        $json_user1= @file_get_contents($json_user_url1);
					        $links_user_url1= json_decode($json_user1);

					        if ($row6[5] == 1){
					          $suma_facebook+=(int)$facebookLikes;
					        }

					        $cuenta_likes_facebook+= $links_user_url->likes->summary->total_count;
					        $cuenta_comments_facebook += $links_user_url->comments->summary->total_count;
					        $cuenta_shares_facebook+= $links_user_url->shares->count;		        
			   		}while($row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana));
			   		$followers_facebook = $links_user_url1->likes;
				   	$reach_facebook = (($cuenta_likes_facebook+$cuenta_comments_facebook+$cuenta_shares_facebook)/$followers_facebook);
			   		/*$_SESSION['reach-campana'].= '<li><span>Reach ['.$links_user_url1->name.']</span><span>'.$reach_facebook.'</span></li>';
			        $_SESSION['reach-campana'].= '<li><span>Likes '.$cuenta_likes_facebook.'</span></li>';
			        $_SESSION['reach-campana'].= '<li><span>Comments '.$cuenta_comments_facebook.'</span></li>';
			        $_SESSION['reach-campana'].= '<li><span>Shares '.$cuenta_shares_facebook.'</span></li>';
			        $_SESSION['reach-campana'].= '<li><span>Followers '.$followers_facebook.'</span></li>';
					$_SESSION['reach-campana'].= '</ul></div>';*/
					$reach_total_facebook += $reach_facebook;
				}
		   			$_SESSION['reach-campana'].= '<li><span>Reach</span><span>'.number_format($reach_total_facebook,2,".",",").'</span></li>';
		   			$_SESSION['reach-campana'].= '</ul></div>';
			}else{
				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				$_SESSION['reach-campana'].= '<li><span>Reach</span><span>0</span></li>';
		   		$_SESSION['reach-campana'].= '</ul></div>';
			}
	   		
		}
		
		if($redes_sociales[$i]=='instagram'){
			
			$query_instagram_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='instagram'";
			$result_instagram_asociado_campana=mysqli_query($mysqli,$query_instagram_asociado_campana)or die (mysqli_error());
			$row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana, MYSQLI_BOTH);
			$num_row_instagram_asociado_campana= mysqli_num_rows($result_instagram_asociado_campana);
			if($num_row_instagram_asociado_campana>0){
				$paginas='';

				//encuentro los medios asociados a la campaña
				do{
					$paginas.= $row_instagram_asociado_campana['rrss_id'].",";
				}while($row_instagram_asociado_campana = mysqli_fetch_array($result_instagram_asociado_campana));
				$paginas_asociadas = explode(",", $paginas);
				$reach_total_instagram=0;

				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				for($l=0;$l<count($paginas_asociadas)-1;$l++){
					$query_instagram_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='instagram' AND rrss_id='".$paginas_asociadas[$l]."'";
					$result_instagram_asociado_campana=mysqli_query($mysqli,$query_instagram_asociado_campana)or die (mysqli_error());
					$row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana, MYSQLI_BOTH);
					$cuenta_likes_instagram=0;
			   		$cuenta_comments_instagram=0;
			   		//acumulo resultados por cada medio
					do{
						$api = @file_get_contents("http://api.instagram.com/oembed?url=".$row_instagram_asociado_campana['url']);      
						$apiObj = json_decode($api,true);  
						$media_id = $apiObj['media_id']; 
						$instagram_id = $row_instagram_asociado_campana['rrss_id'];
						$query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$instagram_id;
						$result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error());
						$row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
						$access_token = $row_instagram_rrss['access_token'];
						$instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
						$instagram_post_json = json_decode($instagram_post_query,true); 
						$cuenta_comments_instagram += intval($instagram_post_json['data']['comments']['count']);
						$cuenta_likes_instagram += intval($instagram_post_json['data']['likes']['count']);
						
					//}while($row_instagram_asociado_campana = mysqli_fetch_array($result_instagram_asociado_campana));
				    }while($row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana));
				    $json_user_url ="https://api.instagram.com/v1/users/".$instagram_id."?access_token=".$access_token;
			        $json_user= @file_get_contents($json_user_url);
			        $links_user_url= json_decode($json_user);
			   		$followers_instagram = $links_user_url->data->counts->followed_by;
				   	$reach_instagram = (($cuenta_likes_instagram+$cuenta_comments_instagram+$cuenta_shares_instagram)/$followers_instagram);
				   	$reach_total_instagram += $reach_instagram;
				   	/*$_SESSION['reach-campana'].= '<li> Likes :'.$cuenta_likes_instagram.'</li>';
					$_SESSION['reach-campana'].= '<li> Comments :'.$cuenta_comments_instagram.'</li>';
					$_SESSION['reach-campana'].= '<li> Followers :'.$followers_instagram.'</li>';
					$_SESSION['reach-campana'].= '<li> Reach :'.$reach_instagram.'</li>';*/				
				}
				$_SESSION['reach-campana'].= '<li><span>Reach</span><span>'.number_format($reach_total_instagram,2,".",",").'</span></li>';
				$_SESSION['reach-campana'].= '</ul></div>';
			}else{
				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				$_SESSION['reach-campana'].= '<li><span>Reach</span><span>0</span></li>';
		   		$_SESSION['reach-campana'].= '</ul></div>';
			}
			
		}
		if($redes_sociales[$i]=='twitter'){
			
			$query_twitter_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='twitter'";
			$result_twitter_asociado_campana=mysqli_query($mysqli,$query_twitter_asociado_campana)or die (mysqli_error());
			$row_twitter_asociado_campana= mysqli_fetch_array($result_twitter_asociado_campana, MYSQLI_BOTH);
			$num_row_twitter_asociado_campana= mysqli_num_rows($result_twitter_asociado_campana);
			if($num_row_twitter_asociado_campana>0){
				$paginas='';

				//encuentro los medios asociados a la campaña
				do{
					$paginas.= $row_twitter_asociado_campana['rrss_id'].",";
				}while($row_twitter_asociado_campana = mysqli_fetch_array($result_twitter_asociado_campana));
				$paginas_asociadas = explode(",", $paginas);
				$reach_total_twitter=0;

				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				
				for($m=0;$m<count($paginas_asociadas)-1;$m++){
					$query_twitter_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='twitter' AND rrss_id='".$paginas_asociadas[$m]."'";
					$result_twitter_asociado_campana=mysqli_query($mysqli,$query_twitter_asociado_campana)or die (mysqli_error());
					$row_twitter_asociado_campana= mysqli_fetch_array($result_twitter_asociado_campana, MYSQLI_BOTH);
					$cuenta_favorite_twitter=0;
			   		$cuenta_retweet_twitter=0;
			   		$cuenta_replies_twitter=0;

					do{
						include_once("rrss/twitter/inc/twitteroauth.php");
						include_once('rrss/twitter/inc/TwitterAPIExchange.php');
						include_once('rrss/twitter/twitter_auth.php');
						//$_SESSION['reach-campana'].= TWITTER_CONSUMER_KEY;
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
				        $ta_url3 = 'https://api.twitter.com/1.1/search/tweets.json';
	                	$getfield3 = '?q=@'.$username;
		                $requestMethod = 'GET';
		                $replies_query=$twitter1->setGetfield($getfield3)
		                ->buildOauth($ta_url3, $requestMethod)
		                ->performRequest();
		                $data3 = json_decode($replies_query);
		                $reply_array_length = count($data3->statuses);
		                $l=0;
		                $twitter_replies=0;
		               
		                do{
		                  $reply_user_id_str=$data3->statuses[0]->in_reply_to_status_id_str;
		                  $twitter_replies++;
		                  $k++;
		                }while($k<$reply_array_length);

		                $cuenta_replies_twitter+=$twitter_replies;
				        $cuenta_retweet_twitter+=$data1["retweet_count"];
				        $cuenta_favorite_twitter+=$data1["favorite_count"];
				        $username=$data1[0]['user']['screen_name'];
				        	        
					}while($row_twitter_asociado_campana = mysqli_fetch_array($result_twitter_asociado_campana));
					
					$followers_twitter=$data1["user"]["followers_count"];
					$reach_twitter = (($cuenta_retweet_twitter+$cuenta_favorite_twitter)/$followers_twitter);
				   	$reach_total_twitter += $reach_twitter;	
					//$_SESSION['reach-campana'].= '<li><span>Likes</span><span>'.$twitter_favorite_total.'</span></li>';
					//$_SESSION['reach-campana'].= '<li><span>Retweets</span><span>'.$twitter_retweet_total.'</span></li>';
					//$formatted_reach_twitter = ($twitter_retweet_total+$twitter_favorite_total)/$twitter_followers_total;*/
				}
					$_SESSION['reach-campana'].= '<li><span>Reach</span><span>'.number_format($reach_total_twitter,2,".",",").'</span></li>';
					$_SESSION['reach-campana'].= '</ul></div>';
			}else{
				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				$_SESSION['reach-campana'].= '<li><span>Reach</span><span>0</span></li>';
		   		$_SESSION['reach-campana'].= '</ul></div>';
			}
			
		}
		if($redes_sociales[$i]=='youtube'){
			
			$query_youtube_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$row[0]." AND descripcion_rrss='youtube'";
			$result_youtube_asociado_campana=mysqli_query($mysqli,$query_youtube_asociado_campana)or die (mysqli_error());
			$row_youtube_asociado_campana= mysqli_fetch_array($result_youtube_asociado_campana, MYSQLI_BOTH);
			$num_row_youtube_asociado_campana= mysqli_num_rows($result_youtube_asociado_campana);
			if($num_row_youtube_asociado_campana>0){
				$_SESSION['reach-campana'].= '<div class="data"><ul>';
				$youtube_videos_total=0;
				do{
					$youtube_video_id= explode("?v=",$row_youtube_asociado_campana['url']);
					$json_user_url ="https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&id=".$youtube_video_id[1]."&key=".GOOGLE_CONSUMER_KEY;
			        $json_user= @file_get_contents($json_user_url);
			        $links_user_url= json_decode($json_user);
			        $youtube_video_views = $links_user_url->items[0]->statistics->viewCount;
			        $youtube_video_likes = $links_user_url->items[0]->statistics->likeCount;
			        $youtube_id = $links_user_url->items[0]->snippet->channelId;

			        $json_user_url1 ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$youtube_id."&key=".GOOGLE_CONSUMER_KEY;
			        $json_user1= @file_get_contents($json_user_url1);
			        $links_user_url1= json_decode($json_user1);
			        $youtubeSubscribers = $links_user_url1->items[0]->statistics->subscriberCount;
			        //$_SESSION['reach-campana'].= $json_user_url1;
					

			        $youtube_video_views_total+=$youtube_video_views;
			        //$youtube_video_likes_total+=$youtube_video_likes; 
			        //$youtube_video_comments_total+=$youtube_video_comments;
			        //$youtube_video_subscribers_total+=$youtubeSubscribers;

		    	}while($row_youtube_asociado_campana = mysqli_fetch_array($result_youtube_asociado_campana));
		    	//$formatted_reach_youtube = number_format((($youtube_video_views_total)*100)/$youtube_video_subscribers_total, 2, '.', ',');
		    	//$_SESSION['reach-campana'].= '<li> Views :'.$youtube_video_views_total.'</li>';
	            $_SESSION['reach-campana'].= '<li><span>Reach</span><span>'.$youtube_video_views_total.'%</span></li>';
				$_SESSION['reach-campana'].= '<li> Likes :'.$youtube_video_likes_total.'</li>';
				$_SESSION['reach-campana'].= '<li> Comments :'.$youtube_video_comments_total.'</li>';
				$_SESSION['reach-campana'].= '<li> Reach :'.$formatted_reach_youtube.'%</li>';
				$_SESSION['reach-campana'].= '</ul></div>';
			}
		}
		$_SESSION['reach-campana'].= '</ul>';

	}
		/*unset($query_redes_sociales_campana);
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
	    unset($googleplus_post_id);	*/
	
}

//    echo '<div id="facebook-insights" onclick="getFacebookInsigths()" class="btns">Conectar Facebook</div>';
if(basename($_SERVER['PHP_SELF'])=='campanas-agencia.php'||basename($_SERVER['PHP_SELF'])=='dashboard-agencia.php'){
	$query_redes_sociales_campana="SELECT DISTINCT * FROM campana WHERE id=".$row[0]." AND idEstado='1'";
	$result_redes_sociales_campana=mysqli_query($mysqli,$query_redes_sociales_campana)or die (mysqli_error());
	$row_redes_sociales_campana= mysqli_fetch_array($result_redes_sociales_campana, MYSQLI_BOTH);
	$redes_sociales=explode(',',$row_redes_sociales_campana['redes_sociales']);
	$cuenta_likes_facebook=0;
	$cuenta_comments_facebook=0;
	muestra_reach_campana();
}

?>