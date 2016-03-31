
<?php
 
function month($mnt){
          if($mnt=='Jan') $mnt='01';
          if($mnt=='Feb') $mnt='02';
          if($mnt=='Mar') $mnt='03';
          if($mnt=='Apr') $mnt='04';
          if($mnt=='May') $mnt='05';
          if($mnt=='Jun') $mnt='06';
          if($mnt=='Jul') $mnt='07';
          if($mnt=='Aug') $mnt='08';
          if($mnt=='Sep') $mnt='09';
          if($mnt=='Oct') $mnt='10';
          if($mnt=='Nov') $mnt='11';
          if($mnt=='Dic') $mnt='12';
          return $mnt;
}
/*
if (!isset($_SESSION['started'])) {
    $_SESSION['started'] = $_SERVER['REQUEST_TIME'];
    $primera=1;
}

$actual_time= strtotime('now');

if($actual_time-$_SESSION['started']>60*60*12){
	$session_youtube="";
	$session_facebook="";
	$session_twitter="";
	$session_instagram="";
	$_SESSION['started']=$actual_time;
	$_SESSION['suma']="";
}
*/

// $_SESSION['suma'] = $_SESSION['suma_facebook'] + $_SESSION['suma_twitter']+ $_SESSION['suma_instagram'];
function html_facebook($mysqli, $persona_id, $red_social){

	$query_datos_rrss="SELECT DISTINCT * FROM rrss WHERE persona_id='".$persona_id."' AND descripcion_rrss='".$red_social."' AND cuenta='1'";
	$result_datos_rrss=mysqli_query($mysqli,$query_datos_rrss)or die (mysqli_error());
	$num_row_datos_rrss= mysqli_num_rows($result_datos_rrss);
	$row_datos_rrss= mysqli_fetch_array($result_datos_rrss);
	$session_facebook .="";
	do{
		$query_datos_core="SELECT DISTINCT * FROM core_redes_sociales WHERE rrss_id='".$row_datos_rrss[3]."' AND persona_id='".$persona_id."'";
		$result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
		$num_row_datos_core= mysqli_num_rows($result_datos_core);
		$row_datos_core= mysqli_fetch_array($result_datos_core);


		if ($row_datos_rrss[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }



		$session_facebook .="<div class='red-info'>
					            <h3>".$row_datos_core[2]."</h3>
					            <ul>
					            <li><img src='".$row_datos_core[3]."'/></li>
					            <li>Likes <br/><span>".formato_numeros_reachs($row_datos_core[5])."</span></li>
					            <li>Engagement <br/><span>".$row_datos_core[12]."</span></li>
					              <span class='txt-desactivar'>eliminar</span>
							      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
							      
							      <span name='".$row_datos_core[1]."' class='pi pi-trash elimina'></span>
					              <div class='onoffswitch'>
					                <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row_datos_core[1]."'>
					                <label class='btn".$estado_descripcion." switch-label' for='".$row_datos_core[1]."'></label>
					              </div>
				            </div>";
		$alcance_facebook+=$row_datos_core[5];
	}while($row_datos_rrss=mysqli_fetch_array($result_datos_rrss));


	return array($session_facebook,$alcance_facebook);
}


function html_instagram($mysqli, $persona_id, $red_social){

	$query_datos_rrss="SELECT DISTINCT * FROM rrss WHERE persona_id='".$persona_id."' AND descripcion_rrss='".$red_social."' AND cuenta='1'";
	$result_datos_rrss=mysqli_query($mysqli,$query_datos_rrss)or die (mysqli_error());
	$num_row_datos_rrss= mysqli_num_rows($result_datos_rrss);
	$row_datos_rrss= mysqli_fetch_array($result_datos_rrss);
	$session_instagram .="";
	do{
		$query_datos_core="SELECT DISTINCT * FROM core_redes_sociales WHERE rrss_id='".$row_datos_rrss[3]."' AND persona_id='".$persona_id."'";
		$result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
		$num_row_datos_core= mysqli_num_rows($result_datos_core);
		$row_datos_core= mysqli_fetch_array($result_datos_core);


		if ($row_datos_rrss[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }


	        
		$session_instagram .="<div class='red-info'>
							      <h3>".$row_datos_core[2]."</h3>
							      <ul>
							      <li><img src='".$row_datos_core[3]."'/></li>
							      <li>Followers<br><span>".formato_numeros_reachs($row_datos_core[8])."</span></li>
							      <li>Engagement<br><span>".$row_datos_core[12]."</span></li>
							      </ul>
							      <span class='txt-desactivar'>eliminar</span>
							      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
							      
							      <span name='".$row_datos_core[1]."' class='pi pi-trash elimina'></span>
							      
							      <div class='onoffswitch'>
							          <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row_datos_core[1]."'>
							          <label class='btn".$estado_descripcion." switch-label' for='".$row_datos_core[1]."'></label>
							      </div>
						      </div>";
		$alcance_instagram+=$row_datos_core[8];
	}while($row_datos_rrss=mysqli_fetch_array($result_datos_rrss));


	return array($session_instagram,$alcance_instagram);
}

function html_twitter($mysqli, $persona_id, $red_social){

	$query_datos_rrss="SELECT DISTINCT * FROM rrss WHERE persona_id='".$persona_id."' AND descripcion_rrss='".$red_social."' AND cuenta='1'";
	$result_datos_rrss=mysqli_query($mysqli,$query_datos_rrss)or die (mysqli_error());
	$num_row_datos_rrss= mysqli_num_rows($result_datos_rrss);
	$row_datos_rrss= mysqli_fetch_array($result_datos_rrss);
	$session_facebook .="";
	do{
		$query_datos_core="SELECT DISTINCT * FROM core_redes_sociales WHERE rrss_id='".$row_datos_rrss[3]."' AND persona_id='".$persona_id."'";
		$result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
		$num_row_datos_core= mysqli_num_rows($result_datos_core);
		$row_datos_core= mysqli_fetch_array($result_datos_core);


		if ($row_datos_rrss[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }


	        
		$session_twitter .="  <div class='red-info'>
					          <h3>".$row_datos_core[2]."</h3>
					          <ul>
					            <li><img src='".$row_datos_core[3]."'/></li>
					            <li>Followers<br><span>".formato_numeros_reachs($row_datos_core[8])."</span></li>
					            <li>Engagement<br><span>".$row_datos_core[12]."</span></li>
					          </ul>
					            <span class='txt-desactivar'>eliminar</span>
					            <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
					      
					            <span name='".$row_datos_core[1]."' class='pi pi-trash elimina'></span>
					          <div class='onoffswitch'>
					              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row_datos_core[1]."'>
					              <label class='btn".$estado_descripcion." switch-label' for='".$row_datos_core[1]."'></label>
					          </div>
					        </div>";
		$alcance_twitter+=$row_datos_core[8];
	}while($row_datos_rrss=mysqli_fetch_array($result_datos_rrss));


	return array($session_twitter,$alcance_twitter);
}

function html_youtube($mysqli, $persona_id, $red_social){

	$query_datos_rrss="SELECT DISTINCT * FROM rrss WHERE persona_id='".$persona_id."' AND descripcion_rrss='".$red_social."' AND cuenta='1'";
	$result_datos_rrss=mysqli_query($mysqli,$query_datos_rrss)or die (mysqli_error());
	$num_row_datos_rrss= mysqli_num_rows($result_datos_rrss);
	$row_datos_rrss= mysqli_fetch_array($result_datos_rrss);
	$session_facebook .="";
	do{
		$query_datos_core="SELECT DISTINCT * FROM core_redes_sociales WHERE rrss_id='".$row_datos_rrss[3]."' AND persona_id='".$persona_id."'";
		$result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
		$num_row_datos_core= mysqli_num_rows($result_datos_core);
		$row_datos_core= mysqli_fetch_array($result_datos_core);


		if ($row_datos_rrss[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }


			        
		$session_youtube .="<div class='red-info'>
					            <h3>".$row_datos_core[2]."</h3>
					            <ul>
					            <li><img src='".$row_datos_core[3]."'/></li>";
					            if($row_datos_core[11]>0){
						           $session_youtube.="<li>Reproducciones <br/><span>".formato_numeros_reachs($row_datos_core[11])."</span></li>
						          </ul>";
						        }else{
						          $session_youtube.="<li>Reproducciones <br/><span>0</span></li>
						          </ul>";
						        }
							      
		$session_youtube .="<span name='".$row_datos_core[1]."' class='pi pi-trash elimina'></span>
					              <div class='onoffswitch'>
					                <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row_datos_core[1]."'>
					                <label class='btn".$estado_descripcion." switch-label' for='".$row_datos_core[1]."'></label>
					              </div>
				            </div>";

		$alcance_youtube+=$row_datos_core[11];
	}while($row_datos_rrss=mysqli_fetch_array($result_datos_rrss));


	return array($session_youtube,$alcance_youtube);
}

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
	require('rrss/rrss_keys.php');
	$query6="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='facebook' AND cuenta='1'";
    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
    $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
    $num_row6=mysqli_num_rows($result6);
    $facebookKey =FACEBOOK_CONSUMER_KEY;
    $facebookAppId = FACEBOOK_APP_ID;
	    if($num_row6>0){
	      do{

	        include_once('rrss/facebook/facebook-auth.php');
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
	       // $facebook_history_likesCount=$links_user_url2->posts->data;

	        

	        $rrss_img = "https://graph.facebook.com/".$rrss_name."/picture?type=large";

	        if ($row6[5] == 1){
	          $suma_red_social+=(int)$facebook_likes;
	        }
	        if ($row6[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }
	        ingresa_registros($facebookPage, $persona_id, $rrss_name, $rrss_img, $facebook_history_likes, $facebook_history_comments, $facebook_history_shares, $facebook_likes, $retweet, $favorites, $reproducciones, number_format(($facebookHistoryInteractions/$facebook_likes),2), $mysqli);

		        if((int)$facebook_likes>0){
		          $session_facebook .="
		            <div class='red-info'>
		            <h3>".$rrss_name."</h3>
		            <ul>
		            <li><img src='".$rrss_img."'/></li>
		            <li>Likes <br/><span>".formato_numeros_reachs($facebook_likes)."</span></li>
		            <li>Engagement <br/><span>".number_format(($facebookHistoryInteractions/$facebook_likes),2)."</span></li>
		            <span class='txt-desactivar'>eliminar</span>
		      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
		      
		      <span name='".$row6[0]."' class='pi pi-trash elimina'></span>
		            <div class='onoffswitch'>
		                <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$facebookPage."'>
		                <label class='btn".$estado_descripcion." switch-label' for='".$facebookPage."'></label>
		            </div>
		            </div>";
		            
		        }
	    }
	      }while($row6 = $result6->fetch_array());
	      return array($session_facebook,$suma_red_social);
    }
}


function core_instagram($red_social, $mysqli, $persona_id){
	  require('rrss/rrss_keys.php');
	  $query3="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='instagram' AND cuenta='1'";
	  $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
	  $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
	  $num_row3= mysqli_num_rows($result3);
	  	if($num_row3>0){
		    do{
		      include_once('rrss/instagram/instagram.php');
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
		      $timestrap_inicio= $timestrap_fin-(30*86400);

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
		     //$_SESSION['instagram'] .=$username." ".(int)$followers_instagram." <button class='estado_rs' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button><br/></h3><img src='".$avatar."'/>";
		     ingresa_registros($row3[3], $persona_id, $rrss_name, $rrss_img, $instagram_history_likes, $instagram_history_comments, $shares, $followers_instagram, $retweet, $favorites, $reproducciones, number_format(($instagram_history_interactions/$followers_instagram),2), $mysqli);
		     $session_instagram .=
		      "<div class='red-info'>
		      <h3>".$rrss_name."</h3>
		      <ul>
		      <li><img src='".$rrss_img."'/></li>
		      <li>Followers<br><span>".formato_numeros_reachs($followers_instagram)."</span></li>
		      <li>Engagement<br><span>".number_format(($instagram_history_interactions/$followers_instagram),2)."</span></li>
		      </ul>
		      <span class='txt-desactivar'>eliminar</span>
		      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
		      
		      <span name='".$row3[0]."' class='pi pi-trash elimina'></span>
		      
		      <div class='onoffswitch'>
		          <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row3[3]."'>
		          <label class='btn".$estado_descripcion." switch-label' for='".$row3[3]."'></label>
		      </div>
		      </div>";

		      
		    }while($row3 = $result3->fetch_array());
		    return array($session_instagram,$suma_red_social);
		    //return $session_instagram;
		  }
}


function core_twitter($red_social, $mysqli, $persona_id){
	include_once('./rrss/twitter/inc/twitteroauth.php');
    include_once('./rrss/twitter/inc/TwitterAPIExchange.php');
    include_once('./rrss/twitter/twitter_auth.php');
    require('rrss/rrss_keys.php');
    $query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='twitter' AND cuenta='1'";
    $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
    $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
    $num_row4=mysqli_num_rows($result4);
    $settings = array(
      'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
      'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
      'consumer_key' => TWITTER_CONSUMER_KEY,
      'consumer_secret' => TWITTER_CONSUMER_SECRET
    );
		if($num_row4>0){
	      $timestamp_mes_anterior= strtotime(date('Y-m-d'))-(30*86400);      
	      do{
	          $twitter_history_interactions=0;
	          $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	          $requestMethod = 'GET';
	          $usuario = $row4['rrss_id'];
	          $getfield = '?count=200&id='.$usuario;
	          $twitter_api = new TwitterAPIExchange($settings);
	          $user_timeline_get=$twitter_api->setGetfield($getfield)
	          ->buildOauth($ta_url, $requestMethod)
	          ->performRequest();
	          $user_timeline = json_decode($user_timeline_get, true);
	          $twitter_followers=$user_timeline[0]['user']['followers_count'];
	          $rrss_name=$user_timeline[0]['user']['screen_name'];
	          $rrss_img= $user_timeline[0]['user']['profile_image_url'];
	          $contador_tweets=0;
	          $identifica_ultimo_tweet=0;
	          $tweet_favorites=0;
	          $tweet_retweets=0;
	          $tweet_replies=0;
	          

	          do{
	            $timestamp_tweet=strtotime($user_timeline[$contador_tweets]['created_at']);
	            if($user_timeline[$contador_tweets]['retweeted_status']){
	            }else{
	              $identifica_ultimo_tweet++;
	              if($identifica_ultimo_tweet==1){
	                $ultimo_tweet= $user_timeline[$contador_tweets]['id_str'];
	              }
	              $tweet_favorites+=$user_timeline[$contador_tweets]['favorite_count'];
	              $tweet_retweets+=$user_timeline[$contador_tweets]['retweet_count'];
	              $twitter_history_interactions=$tweet_favorites+$tweet_retweets;
	            }
	            $contador_tweets++;
	          }while($timestamp_mes_anterior<$timestamp_tweet);

	        if ($row4[5] == 1){
	           $suma_red_social+=$twitter_followers;
	        }
	        if ($row4[5] == 0){
	          $estado=0;
	          $estado_descripcion="activar";
	        }else{
	          $estado=1;
	          $estado_descripcion = "desactivar";
	        }
	        ingresa_registros($row4[3], $persona_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $twitter_followers, $tweet_retweets, $tweet_favorites, $reproducciones, number_format(($twitter_history_interactions/$twitter_followers),2), $mysqli);
	        $session_twitter .="
	        <div class='red-info'>
	          <h3>".$rrss_name."</h3>
	          <ul>
	            <li><img src='".$rrss_img."'/></li>
	            <li>Followers<br><span>".formato_numeros_reachs($twitter_followers)."</span></li>
	            <li>Engagement<br><span>".number_format(($twitter_history_interactions/$twitter_followers),2)."</span></li>
	          </ul>
	            <span class='txt-desactivar'>eliminar</span>
	            <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
	      
	            <span name='".$row4[0]."' class='pi pi-trash elimina'></span>
	          <div class='onoffswitch'>
	              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row4[3]."'>
	              <label class='btn".$estado_descripcion." switch-label' for='".$row4[3]."'></label>
	          </div>
	        </div>";
	        
	      }while($row4 = $result4->fetch_array());

	      return array($session_twitter,$suma_red_social);
	      //return $session_twitter;
	    }
}


function core_youtube($red_social, $mysqli, $persona_id){
	require('rrss/rrss_keys.php');
	$query5="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND descripcion_rrss='youtube' AND cuenta='1'";
    $result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
    $row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
    $num_row5=mysqli_num_rows($result5);
	    if($num_row5>0){
	      do{
	        include_once('rrss/youtube/auth.php');
	        $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row5[3]."&key=".GOOGLE_CONSUMER_KEY;
	        $json_user= file_get_contents($json_user_url);
	        $links_user_url= json_decode($json_user);
	        $rrss_name = $links_user_url->items[0]->snippet->title;
	        $rrss_img = $links_user_url->items[0]->snippet->thumbnails->high->url;
	        $youtube_video_views = $links_user_url->items[0]->statistics->viewCount;


	        if ($row5[5] == 1){
	           $suma_red_social+=(int)$youtubeSubscribers;
	        }
	        if ($row5[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }

	        ingresa_registros($row5[3], $persona_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $youtubeSubscribers, $retweet, $favorites, $youtube_video_views, $reach, $mysqli);
	        $session_youtube .="
	        <div class='red-info'>
	        <h3>".$rrss_name."</h3>
	        <ul>
	        <li><img src='".$rrss_img."'/></li>";
	        if($youtubeSubscribers){
	          $session_youtube.="<li>Suscriptores<br><span>".formato_numeros_reachs($youtubeSubscribers)."</span></li>";
	        }else{
	          $session_youtube.="<li>Suscriptores<br><span>0</span></li>";
	        }
	        if($youtubeSubscribers>0){
	           $session_youtube.="<li>Reproducciones <br/><span>".formato_numeros_reachs($youtube_video_views)."</span></li>
	          </ul>";
	        }else{
	          $session_youtube.="<li>Reproducciones <br/><span>0</span></li>
	          </ul>";
	        }

	        $session_youtube.="<!--button class='estado_rs' name='".$estado."' id='".$row5[3]."'>".$estado_descripcion."</button-->
	       <span class='txt-desactivar'>eliminar</span>
	      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
	      
	      <span name='".$row5[0]."' class='pi pi-trash elimina'></span>
	          <div class='onoffswitch'>
	              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row5[3]."'>
	              <label class='btn".$estado_descripcion." switch-label' for='".$row5[3]."'></label>
	          </div>
	        </div>";
	        
	      }while($row5 = $result5->fetch_array());
	      return array($session_youtube,$suma_red_social);
	      //return $session_youtube;
	    }
}

function elige_red_social($red_social, $mysqli, $persona_id){
	if($red_social=='facebook'){
		return core_facebook($red_social, $mysqli, $persona_id);
	} 
	if($red_social=='instagram'){
		return core_instagram($red_social, $mysqli, $persona_id);
	} 
	if($red_social=='twitter'){
		return core_twitter($red_social, $mysqli, $persona_id);
	} 
	if($red_social=='youtube'){
		return core_youtube($red_social, $mysqli, $persona_id);
	} 

}

function muestra_followers($red_social, $persona_id){
	$mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
	$mysqli->set_charset('utf8_bin');
	$query_no_laboral="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."' AND working_hours='0'";
	$result_no_laboral=mysqli_query($mysqli,$query_no_laboral)or die (mysqli_error());
	$row_no_laboral= mysqli_fetch_array($result_no_laboral, MYSQLI_BOTH);
	$num_row_no_laboral= mysqli_num_rows($result_no_laboral);

	//si estoy fuera del horario laboral entonces no se actualiza la información
	if($num_row_no_laboral>0){
		$red_social=$row_no_laboral['red_social'];
		$persona_id=$row_no_laboral['persona_id'];
		if($red_social=='facebook'){
			return html_facebook($mysqli, $persona_id, $red_social);
		}
		if($red_social=='instagram'){
			return html_instagram($mysqli, $persona_id, $red_social);
		}
		if($red_social=='twitter'){
			return html_twitter($mysqli, $persona_id, $red_social);
		}
		if($red_social=='youtube'){
			return html_youtube($mysqli, $persona_id, $red_social);
		}
		//return array(htmlspecialchars_decode($row_no_laboral['sesion_texto']),htmlspecialchars_decode($row_no_laboral['sesion_reach']));
	}else{
		$query_actualizado="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."' AND working_hours='1' AND renovado='1'";
		$result_actualizado=mysqli_query($mysqli,$query_actualizado)or die (mysqli_error());
		$row_actualizado= mysqli_fetch_array($result_actualizado, MYSQLI_BOTH);
		$num_row_actualizado= mysqli_num_rows($result_actualizado);
		//return array(htmlspecialchars_decode($row_actualizado['sesion_texto']),htmlspecialchars_decode($row_actualizado['sesion_reach']));
		//si se inició sesion durante el horario de actualización entonces no se actualiza la información
		if($num_row_actualizado>0){
			if($red_social=='facebook'){
				return html_facebook($mysqli, $persona_id, $red_social);
			}
			if($red_social=='instagram'){
				return html_instagram($mysqli, $persona_id, $red_social);
			}
			if($red_social=='twitter'){
				return html_twitter($mysqli, $persona_id, $red_social);
			}
			if($red_social=='youtube'){
				return html_youtube($mysqli, $persona_id, $red_social);
			}


			//return array(htmlspecialchars_decode($row_actualizado['sesion_texto']),htmlspecialchars_decode($row_actualizado['sesion_reach']));
		}else{
			$query_no_actualizado="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."' AND working_hours='1' AND renovado='0'";
			$result_no_actualizado=mysqli_query($mysqli,$query_no_actualizado)or die (mysqli_error());
			$row_no_actualizado= mysqli_fetch_array($result_no_actualizado, MYSQLI_BOTH);
			$num_row_no_actualizado= mysqli_num_rows($result_no_actualizado);
			//no ha actualizado su información
			if($row_no_actualizado>0){
				$actualiza_datos = elige_red_social($red_social, $mysqli, $persona_id);
				//actualizo datos
				$query_actualiza_datos='UPDATE session_table SET actual_inicio_sesion="'.date("Y-m-d H:i").'", sesion_reach="'.$actualiza_datos[1].'", sesion_texto="'.$actualiza_datos[0].'" , renovado=1 WHERE red_social="'.$red_social.'" AND persona_id='.$persona_id;
				$result_actualiza_datos=mysqli_query($mysqli,$query_actualiza_datos)or die (mysqli_error());
				//devuelvo datos actualizados
				$query_actualizado="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."' AND working_hours='1' AND renovado='1'";
				$result_actualizado=mysqli_query($mysqli,$query_actualizado)or die (mysqli_error());
				$row_actualizado= mysqli_fetch_array($result_actualizado, MYSQLI_BOTH);
				if($red_social=='facebook'){
					return html_facebook($mysqli, $persona_id, $red_social);
				}
				if($red_social=='instagram'){
					return html_instagram($mysqli, $persona_id, $red_social);
				}
				if($red_social=='twitter'){
					return html_twitter($mysqli, $persona_id, $red_social);
				}
				if($red_social=='youtube'){
					return html_youtube($mysqli, $persona_id, $red_social);
				}

				//return array(htmlspecialchars_decode($row_actualizado['sesion_texto']),htmlspecialchars_decode($row_actualizado['sesion_reach']));


			}else{
				$query_primera_vez="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."'";
				$result_primera_vez=mysqli_query($mysqli,$query_primera_vez)or die (mysqli_error());
				$row_primera_vez= mysqli_fetch_array($result_primera_vez, MYSQLI_BOTH);
				$num_row_primera_vez= mysqli_num_rows($result_primera_vez);
				if($num_row_primera_vez==0){
					$inserta_datos = elige_red_social($red_social, $mysqli, $persona_id);
					//echo (string)$inserta_datos;
					if(date('H')>8 && date('H')<22){
						$query_inserta_datos='INSERT INTO session_table (working_hours,renovado, primer_inicio_sesion, actual_inicio_sesion, red_social, persona_id, sesion_texto, sesion_reach) VALUES (1, 1, "'.date("Y-m-d H:i").'" ,"'.date("Y-m-d H:i").'", "'.$red_social.'", '.$persona_id.', "'.htmlspecialchars($inserta_datos[0]).'", "'.$inserta_datos[1].'")';
						$result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());

						//devuelvo datos insertados
						$query_inserta_datos="SELECT DISTINCT * FROM session_table WHERE red_social='".$red_social."' AND persona_id='".$persona_id."' AND working_hours='1' AND renovado='1'";
						$result_inserta_datos=mysqli_query($mysqli,$query_inserta_datos)or die (mysqli_error());
						$row_inserta_datos= mysqli_fetch_array($result_inserta_datos, MYSQLI_BOTH);
						if($red_social=='facebook'){
							return html_facebook($mysqli, $persona_id, $red_social);
						}
						if($red_social=='instagram'){
							return html_instagram($mysqli, $persona_id, $red_social);
						}
						if($red_social=='twitter'){
							return html_twitter($mysqli, $persona_id, $red_social);
						}
						if($red_social=='youtube'){
							return html_youtube($mysqli, $persona_id, $red_social);
						}



						//return array(htmlspecialchars_decode($row_inserta_datos['sesion_texto']),htmlspecialchars_decode($row_inserta_datos['sesion_reach']));
					}

				}
				
			}
			
		}
	}
}
?>