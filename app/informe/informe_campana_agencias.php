<?php
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=Reporte.xlsx");
header("Cache-Control: max-age=0");

$mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8_bin');
$query_datos_campana="SELECT DISTINCT *  FROM campana WHERE id='".$_GET['id']."'";
$result_datos_campana=mysqli_query($mysqli,$query_datos_campana)or die (mysqli_error());
$row_datos_campana= mysqli_fetch_array($result_datos_campana, MYSQLI_BOTH);

$query_urls="SELECT * FROM  `campanarrss` WHERE campana_id='".$_GET['id']."' ORDER BY persona_id DESC , descripcion_rrss";
$result_urls=mysqli_query($mysqli,$query_urls)or die (mysqli_error());
$row_urls= mysqli_fetch_array($result_urls, MYSQLI_BOTH);

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
	<title></title>
</head>
<body>
	<table id="campana">
		<tr>
			<td colspan="4"><h3>Campaña</h3></td> <!--> Colspan de acuerdo a cantidad de columnas <-->
		</tr>
		<tr>
			<td><b>Marca</b></td>
			<td><b>Descripción</b></td>
			<td><b>Fecha Inicio</b></td>
			<td><b>Fecha Termino</b></td>
		</tr> <!-->un tr por cada campo<-->
		<?php
		do{
				$campana = $row_datos_campana['nombre'];
				$descripcion = $row_datos_campana['descripcion'];
				$fecha_inicio_server= $row_datos_campana['fecha_inicio_server'];
				$fecha_termino_server= $row_datos_campana['fecha_termino_server'];?>
		<tr>
			<td><?php echo $campana ?></td>
			<td><?php echo $descripcion ?></td>
			<td><?php echo $fecha_inicio_server ?></td>
			<td><?php echo $fecha_termino_server ?></td>
		</tr>
		<?php }while($row_datos_campana = mysqli_fetch_array($result_datos_campana));?>
	</table>
	<table>
		<tr>
			<td colspan="1"></td>
		</tr>
	</table>
	

	<table id="influenciadores">
		<tr>
			<td colspan="11"><h3>Informe de Influenciadores</h3></td> <!--> Colspan de acuerdo a cantidad de columnas <-->
		</tr>
		<tr>
			<td><b>Nombre</b></td>
			<td><b>Red</b> Social</td>
			<td><b>Cuenta</b></td>
			<td><b>URL</b></td>
			<td><b>Likes</b></td>
			<td><b>Comments</b></td>
			<td><b>Shares</b></td>
			<td><b>Followers</b></td>
			<td><b>Favorites</b></td>
			<td><b>Retweet</b></td>
			<td><b>Reproducciones</b></td>
			<td><b>Reach</b></td>

		</tr> <!-->un tr por cada campo<-->
		<?php
		include('../rrss/rrss_keys.php');
		while($row_urls = mysqli_fetch_array($result_urls)){
				$id_campana= $row_urls['campana_id'];
				$id_influenciador = $row_urls['persona_id'];
				$descripcion_rrss= $row_urls['descripcion_rrss'];
				$rrss_id= $row_urls['rrss_id'];
				$url= $row_urls['url'];
				$query_influenciadores="SELECT nombre FROM  `persona` WHERE id='$id_influenciador'";
				$result_influenciadores=mysqli_query($mysqli,$query_influenciadores)or die (mysqli_error());
				$row_influenciadores= mysqli_fetch_array($result_influenciadores, MYSQLI_BOTH);
				$nombre=$row_influenciadores['nombre'];
				$cuenta='';
				$likes=0;
				$comments=0;
				$shares=0;
				$followers=0;
				$reach=0;
				$favorites=0;
				$retweet=0;
				$reproducciones=0;

				if($descripcion_rrss=='facebook'){

					//encuentro el nombre de usuario
					$facebookPage=$rrss_id;
                    $facebookKey =FACEBOOK_CONSUMER_KEY;
                    $facebookAppId = FACEBOOK_APP_ID;
                    $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=name,likes,talking_about_count,username,website";
                    $json_user_url = str_replace(" ", "%20", $json_user_url1);
                    $json_user= @file_get_contents($json_user_url);
                    $links_user_url= json_decode($json_user);
                    $cuenta =$links_user_url->name;
                    $followers = $links_user_url->likes;


                    //encuentro los likes de su paginas
                    $facebook_post_id=explode("/",$url);
                    $json_user_url2="https://graph.facebook.com/".$rrss_id."_".trim(end($facebook_post_id))."?fields=likes.limit(0).summary(true),comments.limit(0).summary(true),shares";
                    $json_user_url2 = str_replace(" ", "%20", $json_user_url2);
                    $json_user2= @file_get_contents($json_user_url2);
                    $links_user_url2= json_decode($json_user2);
                    $likes+= $links_user_url2->likes->summary->total_count;
                    $comments += $links_user_url2->comments->summary->total_count;
                    $shares+= $links_user_url2->shares->count; 
                    $reach = ($likes+$comments+$shares)/$followers; 
				}
				if($descripcion_rrss=='instagram'){
				  $query_access_token="SELECT access_token FROM  `rrss` WHERE rrss_id='$rrss_id'";
				  $result_access_token=mysqli_query($mysqli,$query_access_token)or die (mysqli_error());
				  $row_access_token= mysqli_fetch_array($result_access_token, MYSQLI_BOTH);
				  $json_user_url ="https://api.instagram.com/v1/users/".$rrss_id."?access_token=".$row_access_token['access_token'];
                  $json_user= @file_get_contents($json_user_url);
                  $links_user_url= json_decode($json_user);
                  $cuenta = $links_user_url->data->username;
                  $followers = $links_user_url->data->counts->followed_by;
                  $api = @file_get_contents("http://api.instagram.com/oembed?url=".$url);  
	              $apiObj = json_decode($api,true);  
	              $media_id = $apiObj['media_id']; 
	              //$instagram_id = $row_url_instagram['rrss_id'];
	              $query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$rrss_id;
	              $result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error($link));
	              $row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
	              $access_token = $row_instagram_rrss['access_token'];
	              $instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
	              $instagram_post_json = json_decode($instagram_post_query,true); 
	              $comments = intval($instagram_post_json['data']['comments']['count']);
	              $likes = intval($instagram_post_json['data']['likes']['count']);
	              $reach = (($likes+$comments)/$followers);
				}

				if($descripcion_rrss=='twitter'){
					include_once("../rrss/twitter/inc/twitteroauth.php");
                    include_once('../rrss/twitter/inc/TwitterAPIExchange.php');
					$settings = array(
                    'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
                    'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
                    'consumer_key' => TWITTER_CONSUMER_KEY,
                    'consumer_secret' => TWITTER_CONSUMER_SECRET
                    );
                    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                    $requestMethod = 'GET';
                    $usuario1 = $rrss_id;
                    $getfield1 = '?id='.$usuario1;
                    $twitter1 = new TwitterAPIExchange($settings);
                    $follow_count1=$twitter1->setGetfield($getfield1)
                    ->buildOauth($ta_url, $requestMethod)
                    ->performRequest();
                    $data1 = json_decode($follow_count1, true);
                    $cuenta=$data1[0]['user']['screen_name'];
                    

                    $twitter_post_id_array= explode('/', $url);
                    $string_post_id= end($twitter_post_id_array);                   
                    $ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
                    $twitter2 = new TwitterAPIExchange($settings);
                    $twitter_show=$twitter2->setGetfield($getfield1)
                    ->buildOauth($ta_url, $requestMethod)
                    ->performRequest();
                    $data_url = json_decode($twitter_show, true);
                    $followers=$data_url["user"]["followers_count"];
                    $retweet=$data_url["retweet_count"];
                    $favorites+=$data_url["favorite_count"];
                    $reach = (($retweet+$favorites)/$followers);
				}
				if($descripcion_rrss=='youtube'){
					$googleplusKey =GOOGLE_CONSUMER_KEY;
                    $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$rrss_id."&key=".$googleplusKey;
                    $json_user= file_get_contents($json_user_url);
                    $links_user_url= json_decode($json_user);
                    $cuenta = $links_user_url->items[0]->snippet->title;
                    $reproducciones = $links_user_url->items[0]->statistics->viewCount;

				}

				
				/*$red_social = $row_urls['descripcion_rrss'];
				$url = $row_urls['descripcion_rrss'];
				$telefono = $row_datos_campana['telefono1'];
				$fecha_inicio_server= $row_datos_campana['fecha_inicio_server'];
				$fecha_termino_server= $row_datos_campana['fecha_termino_server'];*/?>
		<tr>
			<td><?php echo $nombre ?></td>
			<td><?php echo $descripcion_rrss ?></td>
			<td><?php echo $cuenta ?></td>
			<td><?php echo $url ?></td>
			<td><?php echo $likes ?></td>
			<td><?php echo $comments ?></td>
			<td><?php echo $shares ?></td>
			<td><?php echo $followers ?></td>
			<td><?php echo $favorites ?></td>
			<td><?php echo $retweet ?></td>
			<td><?php echo $reproducciones ?></td>
			<td><?php echo number_format($reach,2)?></td>
			
		</tr>
		<?php }?>
	</table>




</body>
</html>
