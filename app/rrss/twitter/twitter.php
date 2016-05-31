<?php
session_start();
include_once("inc/twitteroauth.php");
include_once('inc/TwitterAPIExchange.php');
//include_once('../rrss_keys.php'); //llamada de keys desde nuevo archivo
require("../../controller/master_key.php");

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


function core_twitter($red_social, $mysqli, $persona_id){
    include_once('twitter_auth.php');
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
          }while($row4 = $result4->fetch_array());
        }
}



 $mysqli = mysqli_connect(LOCAL,USER,PASS,BD) or die("Error " . mysqli_error($link)); 
 $mysqli->set_charset('utf8');
 $persona_id=$_SESSION['id'];
    /****************************************************************
    Ask if the persona_id exist on table rrss twitter data
    ****************************************************************/
    $query2="SELECT rrss_id FROM rrss WHERE persona_id='".$persona_id."' AND descripcion_rrss='twitter'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error($mysqli));
    $row= mysqli_fetch_array($result2, MYSQLI_NUM);
    $num_rows= mysqli_num_rows($result2);
    $settings = array(
          'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
          'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
          'consumer_key' => TWITTER_CONSUMER_KEY,
          'consumer_secret' => TWITTER_CONSUMER_SECRET
    );
    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';
    $usuario1 = $row[0];
    $getfield1 = '?id='.$usuario1;
    $twitter1 = new TwitterAPIExchange($settings);
    $follow_count1=$twitter1->setGetfield($getfield1)
    ->buildOauth($ta_url, $requestMethod)
    ->performRequest();
    $data1 = json_decode($follow_count1, true);
    $followers_count1=(int)$data1[0]['user']['followers_count'];
        /****************************************************************
        Check if the user already has a twitter account registered
        and show followers and ID
        ****************************************************************/
    $query2="SELECT rrss_id FROM rrss WHERE persona_id='".$persona_id."' AND descripcion_rrss='twitter' AND rrss_id='".$_SESSION['request_vars']['user_id']."'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error($mysqli));
    $num_row2= mysqli_num_rows($result2);
    /****************************************************************
    If the user has 3 registered accounts
    /****************************************************************
      if((int)$num_row > 2){
        $displaydb = "none";
         $_SESSION["data"]='existe';
         echo '<script>window.location.href="../../inicio-influencer"</script>';
       // header('Location: ../../dashboard-ipe.php');


    /****************************************************************
    Success, redirected back from process.php with varified status.
    retrive variables
    ****************************************************************/
      /*}else */if(isset($_SESSION['status']) && $_SESSION['status']=='verified'){
        /****************************************************************
        If the Twitter id already exist then it is going to redirect
        to dashboard page
        /****************************************************************/
          if((int)$num_row2 > 0){
            echo '<script> alert("La cuenta ya está asociada, intente con una cuenta diferente");</script>';
             $displaydb = "block";
             //header('Location: ../../dashboard-ipe.php');
             $_SESSION["data"]='existe';
             echo '<script>window.location.href="../../inicio-influencer"</script>';
            }else{
                 //  header('Location: ../../dashboard-ipe.php');
                $oauth_token        = $_SESSION['request_vars']['oauth_token'];
                $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
                /****************************************************************
                Get followers
                ****************************************************************/
                $usuario = $_SESSION['request_vars']['user_id'];
                $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                $getfield = '?id='.$_SESSION['request_vars']['user_id'];
                $requestMethod = 'GET';
                $twitter = new TwitterAPIExchange($settings);
                $follow_count=$twitter->setGetfield($getfield)
                ->buildOauth($ta_url, $requestMethod)
                ->performRequest();
                $data = json_decode($follow_count, true);
                $followers_count=(int)$data[0]['user']['followers_count'];

                $query="INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id,cuenta) VALUES('twitter',".$usuario.",".$persona_id.",'1')";
                $result= mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));
                core_twitter('twitter', $mysqli, $persona_id);
                $_SESSION["data"]='exito';
                echo '<script>window.location.href="../../inicio-influencer"</script>';
            }

        }
