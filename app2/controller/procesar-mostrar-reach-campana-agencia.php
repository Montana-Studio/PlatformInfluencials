<?php
function core_metricas_redes_sociales($campana_id, $mysqli){
	include('rrss/rrss_keys.php');
	$metricas_campana='';
	$query_redes_sociales_campana="SELECT DISTINCT * FROM campana WHERE id=".$campana_id." AND idEstado='1'";
	$result_redes_sociales_campana=mysqli_query($mysqli,$query_redes_sociales_campana)or die (mysqli_error());
	$row_redes_sociales_campana= mysqli_fetch_array($result_redes_sociales_campana, MYSQLI_BOTH);
	$redes_sociales=explode(',',$row_redes_sociales_campana['redes_sociales']);
	for($i=0;$i<count($redes_sociales);$i++){
		$metricas_campana.= '<ul class="redes-metrics"><span class="tit-red red-'.$redes_sociales[$i].'" title="'.$redes_sociales[$i].'"></span>';
		if($redes_sociales[$i]=='facebook'){
			
			$query_facebook_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='facebook'";
			$result_facebook_asociado_campana=mysqli_query($mysqli,$query_facebook_asociado_campana)or die (mysqli_error());
			$row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana, MYSQLI_BOTH);
			$num_row_facebook_asociado_campana= mysqli_num_rows($result_facebook_asociado_campana);
			$facebookKey =FACEBOOK_CONSUMER_KEY;
	   		$facebookAppId = FACEBOOK_APP_ID;
			if($num_row_facebook_asociado_campana>0){
				$query_facebook_asociado_campana2= "SELECT DISTINCT rrss_id FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='facebook'";
				$result_facebook_asociado_campana2=mysqli_query($mysqli,$query_facebook_asociado_campana2)or die (mysqli_error());
				$row_facebook_asociado_campana2= mysqli_fetch_array($result_facebook_asociado_campana2, MYSQLI_BOTH);
				$paginas='';
				do{
					$paginas.= $row_facebook_asociado_campana2['rrss_id'].",";
				}while($row_facebook_asociado_campana2 = mysqli_fetch_array($result_facebook_asociado_campana2));
				$paginas_asociadas = explode(",", $paginas);
				$reach_total_facebook=0;
				$metricas_campana.= '<div class="data"><ul>';
				for($k=0;$k<count($paginas_asociadas)-1;$k++){
					$query_facebook_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='facebook' AND rrss_id='".$paginas_asociadas[$k]."'";
					$result_facebook_asociado_campana=mysqli_query($mysqli,$query_facebook_asociado_campana)or die (mysqli_error());
					$row_facebook_asociado_campana= mysqli_fetch_array($result_facebook_asociado_campana, MYSQLI_BOTH);
					$cuenta_likes_facebook=0;
			   		$cuenta_comments_facebook=0;
			   		$cuenta_shares_facebook=0;
					do{
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
					$reach_total_facebook += $reach_facebook;
				}
		   			$metricas_campana.= '<li><span>Reach</span><span>'.number_format($reach_total_facebook,2,".",",").'</span></li>';
		   			$metricas_campana.= '</ul></div>';
			}else{
				$metricas_campana.= '<div class="data"><ul>';
				$metricas_campana.= '<li><span>Reach</span><span>0</span></li>';
		   		$metricas_campana.= '</ul></div>';
			}
		}
		if($redes_sociales[$i]=='instagram'){
			
			$query_instagram_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='instagram'";
			$result_instagram_asociado_campana=mysqli_query($mysqli,$query_instagram_asociado_campana)or die (mysqli_error());
			$row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana, MYSQLI_BOTH);
			$num_row_instagram_asociado_campana= mysqli_num_rows($result_instagram_asociado_campana);
			if($num_row_instagram_asociado_campana>0){
				$paginas='';
				do{
					$paginas.= $row_instagram_asociado_campana['rrss_id'].",";
				}while($row_instagram_asociado_campana = mysqli_fetch_array($result_instagram_asociado_campana));
				$paginas_asociadas = explode(",", $paginas);
				$reach_total_instagram=0;

				$metricas_campana.= '<div class="data"><ul>';
				for($l=0;$l<count($paginas_asociadas)-1;$l++){
					$query_instagram_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='instagram' AND rrss_id='".$paginas_asociadas[$l]."'";
					$result_instagram_asociado_campana=mysqli_query($mysqli,$query_instagram_asociado_campana)or die (mysqli_error());
					$row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana, MYSQLI_BOTH);
					$cuenta_likes_instagram=0;
			   		$cuenta_comments_instagram=0;
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
						
				    }while($row_instagram_asociado_campana= mysqli_fetch_array($result_instagram_asociado_campana));
				    $json_user_url ="https://api.instagram.com/v1/users/".$instagram_id."?access_token=".$access_token;
			        $json_user= @file_get_contents($json_user_url);
			        $links_user_url= json_decode($json_user);
			   		$followers_instagram = $links_user_url->data->counts->followed_by;
				   	$reach_instagram = (($cuenta_likes_instagram+$cuenta_comments_instagram+$cuenta_shares_instagram)/$followers_instagram);
				   	$reach_total_instagram += $reach_instagram;		
				}
				$metricas_campana.= '<li><span>Reach</span><span>'.number_format($reach_total_instagram,2,".",",").'</span></li>';
				$metricas_campana.= '</ul></div>';
			}else{
				$metricas_campana.= '<div class="data"><ul>';
				$metricas_campana.= '<li><span>Reach</span><span>0</span></li>';
		   		$metricas_campana.= '</ul></div>';
			}
		}
		if($redes_sociales[$i]=='twitter'){
			
			$query_twitter_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='twitter'";
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

				$metricas_campana.= '<div class="data"><ul>';
				
				for($m=0;$m<count($paginas_asociadas)-1;$m++){
					$query_twitter_asociado_campana= "SELECT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='twitter' AND rrss_id='".$paginas_asociadas[$m]."'";
					$result_twitter_asociado_campana=mysqli_query($mysqli,$query_twitter_asociado_campana)or die (mysqli_error());
					$row_twitter_asociado_campana= mysqli_fetch_array($result_twitter_asociado_campana, MYSQLI_BOTH);
					$cuenta_favorite_twitter=0;
			   		$cuenta_retweet_twitter=0;
			   		$cuenta_replies_twitter=0;

					do{
						include_once("rrss/twitter/inc/twitteroauth.php");
						include_once('rrss/twitter/inc/TwitterAPIExchange.php');
						include_once('rrss/twitter/twitter_auth.php');
						//$metricas_campana.= TWITTER_CONSUMER_KEY;
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
				}
					$metricas_campana.= '<li><span>Reach</span><span>'.number_format($reach_total_twitter,2,".",",").'</span></li>';
					$metricas_campana.= '</ul></div>';
			}else{
				$metricas_campana.= '<div class="data"><ul>';
				$metricas_campana.= '<li><span>Reach</span><span>0</span></li>';
		   		$metricas_campana.= '</ul></div>';
			}				
		}
		if($redes_sociales[$i]=='youtube'){
			
			$query_youtube_asociado_campana= "SELECT DISTINCT * FROM campanarrss WHERE campana_id=".$campana_id." AND descripcion_rrss='youtube'";
			$result_youtube_asociado_campana=mysqli_query($mysqli,$query_youtube_asociado_campana)or die (mysqli_error());
			$row_youtube_asociado_campana= mysqli_fetch_array($result_youtube_asociado_campana, MYSQLI_BOTH);
			$num_row_youtube_asociado_campana= mysqli_num_rows($result_youtube_asociado_campana);
			if($num_row_youtube_asociado_campana>0){
				$metricas_campana.= '<div class="data"><ul>';
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
			        $youtube_video_views_total+=$youtube_video_views;

		    	}while($row_youtube_asociado_campana = mysqli_fetch_array($result_youtube_asociado_campana));
	            $metricas_campana.= '<li><span>Reach</span><span>'.$youtube_video_views_total.'</span></li>';
				$metricas_campana.= '</ul></div>';
			}else{
				$metricas_campana.= '<div class="data"><ul>';
				$metricas_campana.= '<li><span>Reach</span><span>0</span></li>';
		   		$metricas_campana.= '</ul></div>';
			}
		}
		$metricas_campana.= '</ul>';
	}

	return $metricas_campana;	
}

function muestra_reach_campana($campana_id){
	$mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
	$mysqli->set_charset('utf8_bin');
	$query_no_laboral="SELECT DISTINCT * FROM session_table WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."' AND working_hours='0'";
	$result_no_laboral=mysqli_query($mysqli,$query_no_laboral)or die (mysqli_error());
	$row_no_laboral= mysqli_fetch_array($result_no_laboral, MYSQLI_BOTH);
	$num_row_no_laboral= mysqli_num_rows($result_no_laboral);
	
	//si estoy fuera del horario laboral entonces no se actualiza la información
	if($num_row_no_laboral>0){
		return htmlspecialchars_decode($row_actualizado['sesion_texto']);
	}else{
		$query_actualizado="SELECT DISTINCT * FROM session_table WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."' AND working_hours='1' AND renovado='1'";
		$result_actualizado=mysqli_query($mysqli,$query_actualizado)or die (mysqli_error());
		$row_actualizado= mysqli_fetch_array($result_actualizado, MYSQLI_BOTH);
		$num_row_actualizado= mysqli_num_rows($result_actualizado);
		//si se inició sesion durante el horario de actualización entonces no se actualiza la información
		if($num_row_actualizado>0){
			return htmlspecialchars_decode($row_actualizado['sesion_texto']);
		}else{
			$query_no_actualizado="SELECT DISTINCT * FROM session_table WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."' AND working_hours='1' AND renovado='0'";
			$result_no_actualizado=mysqli_query($mysqli,$query_no_actualizado)or die (mysqli_error());
			$row_no_actualizado= mysqli_fetch_array($result_no_actualizado, MYSQLI_BOTH);
			$num_row_no_actualizado= mysqli_num_rows($result_no_actualizado);
			//no ha actualizado su información
			if($row_no_actualizado>0){
				$actualiza_datos = core_metricas_redes_sociales($campana_id, $mysqli);
				//actualizo datos
				$query_actualiza_datos="UPDATE session_table SET actual_inicio_sesion='".date("Y-m-d H:i")."', sesion_texto='".$actualiza_datos."' , renovado='1' WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."'";
				$result_actualiza_datos=mysqli_query($mysqli,$query_actualiza_datos)or die (mysqli_error());
				//devuelvo datos actualizados
				$query_actualizado="SELECT DISTINCT * FROM session_table WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."' AND working_hours='1' AND renovado='1'";
				$result_actualizado=mysqli_query($mysqli,$query_actualizado)or die (mysqli_error());
				$row_actualizado= mysqli_fetch_array($result_actualizado, MYSQLI_BOTH);
				return htmlspecialchars_decode($row_actualizado['sesion_texto']);


			}else{
				$query_primera_vez="SELECT DISTINCT * FROM session_table WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."'";
				$result_primera_vez=mysqli_query($mysqli,$query_primera_vez)or die (mysqli_error());
				$row_primera_vez= mysqli_fetch_array($result_primera_vez, MYSQLI_BOTH);
				$num_row_primera_vez= mysqli_num_rows($result_primera_vez);
				if($num_row_primera_vez==0){
					$inserta_datos = core_metricas_redes_sociales($campana_id,$mysqli);
					//echo (string)$inserta_datos;
					if(date('H')>8 && date('H')<22){
						
						//return $inserta_datos;
						//inserto datos
						$query_inserta_datos="INSERT INTO session_table (working_hours,renovado, primer_inicio_sesion, actual_inicio_sesion, campana_id, persona_id, sesion_texto) VALUES ('1', '1', '".date("Y-m-d H:i")."' ,'".date("Y-m-d H:i")."', ".$campana_id.", ".$_SESSION['id'].", '".htmlspecialchars($inserta_datos)."')";
						$result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());
						//devuelvo datos insertados
						$query_inserta_datos="SELECT DISTINCT * FROM session_table WHERE campana_id=".$campana_id." AND persona_id='".$_SESSION['id']."' AND working_hours='1' AND renovado='1'";
						$result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());
						$row_inserta_datos= mysqli_fetch_array($result_inserta_datos, MYSQLI_BOTH);
						return htmlspecialchars_decode($row_inserta_datos['sesion_texto']);
					}

				}
				
			}
			
		}
	}
}

?>