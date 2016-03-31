
<?php
 require('rrss/rrss_keys.php');
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
	$_SESSION['youtube']="";
	$_SESSION['facebook']="";
	$_SESSION['twitter']="";
	$_SESSION['instagram']="";
	$_SESSION['started']=$actual_time;
	$_SESSION['suma']="";
}*/

	/****************************************************************************************************
	                GET INSTAGRAM REACH
	****************************************************************************************************/
  $query3="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='instagram' AND cuenta='1'";
  $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
  $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
  $num_row3= mysqli_num_rows($result3);
  	if($num_row3>0&&$_SESSION['instagram']==''){
	    do{
	      include_once('rrss/instagram/instagram.php');
	      $json_user_url ="https://api.instagram.com/v1/users/".$row3[3]."?access_token=".$row3[6];
	      $json_user= file_get_contents($json_user_url);
	      $links_user_url= json_decode($json_user);
	      $followers_instagram = $links_user_url->data->counts->followed_by;
	      $username = $links_user_url->data->username;
	      $avatar = $links_user_url->data->profile_picture;
	      if ($row3[5] == 1){
	         $_SESSION['suma_instagram']+=(int)$followers_instagram;
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
	     $_SESSION['instagram'] .=
	      "<div class='red-info'>
	      <h3>".$username."</h3>
	      <ul>
	      <li><img src='".$avatar."'/></li>
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
	  }

	/****************************************************************************************************
	                  TWITTER BUTTON AND GET REACH SUM
	****************************************************************************************************/
    include_once('./rrss/twitter/inc/twitteroauth.php');
    include_once('./rrss/twitter/inc/TwitterAPIExchange.php');
    include_once('./rrss/twitter/twitter_auth.php');
    $query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='twitter' AND cuenta='1'";
    $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
    $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
    $num_row4=mysqli_num_rows($result4);
    $settings = array(
      'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
      'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
      'consumer_key' => TWITTER_CONSUMER_KEY,
      'consumer_secret' => TWITTER_CONSUMER_SECRET
    );
		if($num_row4>0&&$_SESSION['twitter']==''){
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
	          $username=$user_timeline[0]['user']['screen_name'];
	          $avatar= $user_timeline[0]['user']['profile_image_url'];
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
	           $_SESSION['suma_twitter']+=$twitter_followers;
	        }
	        if ($row4[5] == 0){
	          $estado=0;
	          $estado_descripcion="activar";
	        }else{
	          $estado=1;
	          $estado_descripcion = "desactivar";
	        }
	        $_SESSION['twitter'] .="
	        <div class='red-info'>
	          <h3>".$username."</h3>
	          <ul>
	            <li><img src='".$avatar."'/></li>
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
	    }
	/****************************************************************************************************
	            YOUTUBE  GET REACH SUM
	****************************************************************************************************/
    $query5="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='youtube' AND cuenta='1'";
    $result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
    $row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
    $num_row5=mysqli_num_rows($result5);
	    if($num_row5>0&&$_SESSION['youtube']==''){
	      do{
	        include_once('rrss/youtube/auth.php');
	        $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row5[3]."&key=".GOOGLE_CONSUMER_KEY;
	        $json_user= file_get_contents($json_user_url);
	        $links_user_url= json_decode($json_user);
	        $youtubeSubscribers = $links_user_url->items[0]->statistics->subscriberCount;
	        $youtubeName = $links_user_url->items[0]->snippet->title;
	        $youtubeImgUrl = $links_user_url->items[0]->snippet->thumbnails->high->url;
	        $youtube_video_views = $links_user_url->items[0]->statistics->viewCount;


	        if ($row5[5] == 1){
	           $_SESSION['suma_youtube']+=(int)$youtubeSubscribers;
	        }
	        if ($row5[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }


	        $_SESSION['youtube'] .="
	        <div class='red-info'>
	        <h3>".$youtubeName."</h3>
	        <ul>
	        <li><img src='".$youtubeImgUrl."'/></li>";
	        if($youtubeSubscribers){
	          $_SESSION['youtube'].="<li>Suscriptores<br><span>".formato_numeros_reachs($youtubeSubscribers)."</span></li>";
	        }else{
	          $_SESSION['youtube'].="<li>Suscriptores<br><span>0</span></li>";
	        }
	        if($youtubeSubscribers>0){
	           $_SESSION['youtube'].="<li>Reproducciones <br/><span>".formato_numeros_reachs($youtube_video_views)."</span></li>
	          </ul>";
	        }else{
	          $_SESSION['youtube'].="<li>Reproducciones <br/><span>0</span></li>
	          </ul>";
	        }

	        $_SESSION['youtube'].="<!--button class='estado_rs' name='".$estado."' id='".$row5[3]."'>".$estado_descripcion."</button-->
	       <span class='txt-desactivar'>eliminar</span>
	      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
	      
	      <span name='".$row5[0]."' class='pi pi-trash elimina'></span>
	          <div class='onoffswitch'>
	              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row5[3]."'>
	              <label class='btn".$estado_descripcion." switch-label' for='".$row5[3]."'></label>
	          </div>
	        </div>";
	      }while($row5 = $result5->fetch_array());
	    }
	    //$reproducciones+=$suma_youtube;

	/****************************************************************************************************
	                FACEBOOK GET REACH SUM
	****************************************************************************************************/
    $query6="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='facebook' AND cuenta='1'";
    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
    $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
    $num_row6=mysqli_num_rows($result6);
    $facebookKey =FACEBOOK_CONSUMER_KEY;
    $facebookAppId = FACEBOOK_APP_ID;
	    if($num_row6>0&&$_SESSION['facebook']==''){
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
	          $facebook_username =$links_user_url->username;
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

	        

	        $facebookImgUrl = "https://graph.facebook.com/".$facebook_username."/picture?type=large";

	        if ($row6[5] == 1){
	          $_SESSION['suma_facebook']+=(int)$facebook_likes;
	        }
	        if ($row6[5] == 0){
	          $estado= 0;
	          $estado_descripcion="activar";
	        }else{
	          $estado= 1;
	          $estado_descripcion="desactivar";
	        }
		        if((int)$facebook_likes>0){
		          $_SESSION['facebook'] .="
		            <div class='red-info'>
		            <h3>".$facebook_username."</h3>
		            <ul>
		            <li><img src='".$facebookImgUrl."'/></li>
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
    }

    $_SESSION['suma'] = $_SESSION['suma_facebook'] + $_SESSION['suma_twitter']+ $_SESSION['suma_instagram'];
?>