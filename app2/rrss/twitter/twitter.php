<?php
session_start();
include_once("inc/twitteroauth.php");
include_once('inc/TwitterAPIExchange.php');
include_once('../rrss_keys.php'); //llamada de keys desde nuevo archivo

 $mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
 $mysqli->set_charset('utf8');
    /****************************************************************
    Ask if the persona_id exist on table rrss twitter data
    ****************************************************************/
    $query2="SELECT rrss_id FROM rrss WHERE persona_id='".$_SESSION['id']."' AND descripcion_rrss='twitter'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error($mysqli));
    $row= mysqli_fetch_array($result2, MYSQLI_NUM);
    $num_rows= mysqli_num_rows($result2);
    $settings = array(
        'oauth_access_token' => "4557583582-gXqKvmBxk3m1yWotVZMuVIGR5E3sVsFa8VfEb4r",
        'oauth_access_token_secret' => "I4S13VpbnxArceqaZxSFLUfwvZvhjIi9BND6dIlV3NVbS",
        'consumer_key' => "RHwBcRYX2yuaXWkAPwJ6fPTqi",
        'consumer_secret' => "EMfnAuVxgv2oTzX3CHVcsRDD94PrGgzjnnCcvch77VxFI9xccP"
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
    $query2="SELECT rrss_id FROM rrss WHERE persona_id='".$_SESSION['id']."' AND descripcion_rrss='twitter' AND rrss_id='".$_SESSION['request_vars']['user_id']."'";
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
                $query="INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id,cuenta) VALUES('twitter',".$usuario.",".$_SESSION['id'].",'1')";
                $result= mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));
                $_SESSION["data"]='exito';
                echo '<script>window.location.href="../../inicio-influencer"</script>';
            }

        }
    ?>