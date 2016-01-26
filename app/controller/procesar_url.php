<?php
require('../controller/conexion.php');
require('../rrss/rrss_keys.php');
$rrss_id = $_POST['rrss_id'];
$campana_id = $_POST['campana_id'];
$url = $_POST['url'];
$descripcion_rrss = $_POST['descripcion_rrss'];
$result_url = $mysqli->query('SELECT DISTINCT * FROM campanarrss WHERE url="'.$url.'"');
$num_rows_url= mysqli_num_rows($result_url);
if($num_rows_url>0){
	echo 'existe';
}else{
	if($descripcion_rrss=='youtube'){
	$youtube_video_id= explode("?v=",$url);
	$json_user_url ="https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$youtube_video_id[1]."&key=".GOOGLE_CONSUMER_KEY;
	$json_user= @file_get_contents($json_user_url);
		if($json_user){
			$links_user_url= json_decode($json_user);
			$youtube_video_id_owner = $links_user_url->items[0]->snippet->channelId;
				if($youtube_video_id_owner==$rrss_id){
					$result_url = $mysqli->query('INSERT INTO campanarrss SET campana_id="'.$campana_id.'", rrss_id="'.$rrss_id.'", url="'.$url.'", descripcion_rrss="'.$descripcion_rrss.'", persona_id="'.$_SESSION["id"].'"');
					$resultado ='exito';
				}else{
					$resultado ='false';
				}
		}
	}

	if($descripcion_rrss=='instagram'){
		$api = @file_get_contents("http://api.instagram.com/oembed?url=".$url);
		if($api){
			$apiObj = json_decode($api,true);  
			$media_id = $apiObj['media_id']; 
			$query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$rrss_id;
			$result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error());
			$row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
			$access_token = $row_instagram_rrss['access_token'];
			$instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
			if($instagram_post_query){
				$instagram_post_json = json_decode($instagram_post_query,true); 
				$instagram_id = intval($instagram_post_json['data']['user']['id']);
				if($instagram_id==$rrss_id){
					$result_url = $mysqli->query('INSERT INTO campanarrss SET campana_id="'.$campana_id.'", rrss_id="'.$rrss_id.'", url="'.$url.'", descripcion_rrss="'.$descripcion_rrss.'", persona_id="'.$_SESSION["id"].'"');
					$resultado ='exito';
				}else{
					$resultado ='false';
				}

			}
			
		}else{
				$resultado = 'false';
		}   
		
	}
	//if($descripcion_rrss=='googleplus'||$descripcion_rrss='twitter'){
		if($descripcion_rrss=='twitter'){
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
				$twitter_post_id_array= explode('/', $url);
				$string_post_id= end($twitter_post_id_array);
				$ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
				$requestMethod = 'GET';
				$getfield1 = '?id='.$rrss_id;
		        $twitter1 = new TwitterAPIExchange($settings);
		        $twitter_post_id_query=$twitter1->setGetfield($getfield1)
		        ->buildOauth($ta_url, $requestMethod)
		        ->performRequest();
		        $data1 = json_decode($twitter_post_id_query, true);
		        $twitter_post_id=$data1["user"]["id"];
				if($rrss_id==$twitter_post_id){
					$result_url = $mysqli->query('INSERT INTO campanarrss SET campana_id="'.$campana_id.'", rrss_id="'.$rrss_id.'", url="'.$url.'", descripcion_rrss="'.$descripcion_rrss.'", persona_id="'.$_SESSION["id"].'"');
					$resultado = 'exito';	
				}else{
					$resultado= 'false';
				}
		}

		if($descripcion_rrss=='googleplus'){
			$json_user_url ="https://www.googleapis.com/plus/v1/people/".$rrss_id."/activities/public?key=".GOOGLE_CONSUMER_KEY;
			//echo $json_user_url;
			$json_user= @file_get_contents($json_user_url);
			$links_user_url= json_decode($json_user);
			//if($links_user_url){
				$cantidad_de_posts_googleplus = count($links_user_url->items);
				$valida_url=0;
				for($i=0;$i<$cantidad_de_posts_googleplus-1;$i++){
					if($links_user_url->items[$i]->url==$url){
						$valida_url=1;
					}
				}
				if($valida_url==1){
					$result_compare_rrss_id_with_url= $mysqli->query('SELECT * FROM rrss WHERE rrss_id="'.$rrss_id.'"');
					$num_row_compare_rrss_id_with_url=mysqli_num_rows($result_compare_rrss_id_with_url);
					//$result_url = $mysqli->query('INSERT INTO campanarrss SET campana_id="'.$campana_id.'", rrss_id="'.$rrss_id.'", url="'.$url.'", descripcion_rrss="'.$descripcion_rrss.'", persona_id="'.$_SESSION["id"].'"');
					$resultado = 'exito';
				}else{
					$resultado= 'false';
				}
				
			/*}else{
				$resultado = 'false';
			}*/
				
		}

		if($descripcion_rrss=='facebook'){
			$facebook_post_id_array= explode('/', $url);
			$string_facebook_post_id= end($facebook_post_id_array);
			$json_user_url1 ="https://graph.facebook.com/".$rrss_id."_".$string_facebook_post_id."?fields=from{id}";
            $json_user_url = str_replace(" ", "%20", $json_user_url1);
            $json_user= @file_get_contents($json_user_url);
            $links_user_url= json_decode($json_user);
            if($links_user_url){
	            $facebook_post_owner =$links_user_url->from->id;
	            if($facebook_post_owner==$rrss_id){ 
					$result_url = $mysqli->query('INSERT INTO campanarrss SET campana_id="'.$campana_id.'", rrss_id="'.$rrss_id.'", url="'.$url.'", descripcion_rrss="'.$descripcion_rrss.'", persona_id="'.$_SESSION["id"].'"');
					$resultado = 'exito';
				}else{
					$resultado = 'false';
				}

            }else{
            	$resultado = 'false';
            }   
		}
		echo $resultado;
}



?>
