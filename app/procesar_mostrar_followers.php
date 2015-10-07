<?php
	include("rrss/twitter/inc/twitteroauth.php");
	include('rrss/twitter/inc/TwitterAPIExchange.php');
	include('rrss/instagram/instagram.php');
	/****************************************************************************************************
									GET INSTAGRAM REACH
	****************************************************************************************************/
	$query3="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='instagram'";
    $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
    $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
    $num_row3= mysqli_num_rows($result3);
    $_SESSION['instagram']="";
	do{
		$json_user_url ="https://api.instagram.com/v1/users/".$row3[3]."?access_token=".$row3[6];
		$json_user= file_get_contents($json_user_url);
		$links_user_url= json_decode($json_user);
		$followers_instagram = $links_user_url->data->counts->followed_by;
		$username = $links_user_url->data->username;
		$avatar = $links_user_url->data->profile_picture;
	    if ($row3[5] == 1){
	  		$suma_instagram+=$followers_instagram;
	    }	
	    if ($row3[5] == 0){
		    $estado="activar";
		 }else{
		    $estado = "desactivar";
		 }
			$_SESSION['instagram'] .="<h3>".$username."   -    ".(int)$followers_instagram."<button>".$estado."</button><br/></h3><img src='".$avatar."'/>";
	}while($row3 = $result3->fetch_array());
	$suma += $suma_instagram;
	
	
	/****************************************************************************************************
										TWITTER BUTTON AND GET REACH SUM
	****************************************************************************************************/
	$query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='twitter'";
    $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
    $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
    $settings = array(
	    'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
	    'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
	    'consumer_key' => "hV95sLlCLjKIQbsVx1uVIxgKQ",
	    'consumer_secret' => "FU3GBmbIldTUzJZJOJqrynhiiecmt2FPHAShlkGi3AH8jY7GrV"
	    );
	    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	    $requestMethod = 'GET';
	    $_SESSION['twitter']="";
	do{
	    $usuario1 = $row4['rrss_id'];
	    $getfield1 = '?id='.$usuario1;
	    $twitter1 = new TwitterAPIExchange($settings);
	    $follow_count1=$twitter1->setGetfield($getfield1)
	    ->buildOauth($ta_url, $requestMethod)
	    ->performRequest();
	    $data1 = json_decode($follow_count1, true);
	    $followers_count1=$data1[0]['user']['followers_count'];	
	    $username=$data1[0]['user']['screen_name'];	
	    $avatar= $data1[0]['user']['profile_image_url'];
	     	
	    if($row4[5] == 1 ){
	   		$suma_twitter+=	$followers_count1;
	    }
	    if ($row4[5] == 0){
	    	$estado="activar";
	    }else{
	    	$estado = "desactivar";
	    }

	   $_SESSION['twitter'] .="<h3>".$username."   -    ".(int)$followers_count1."  <button>".$estado."</button> </h3><img src='".$avatar."'/>
	   <br/><b>últimos tweets</b>";

	   for($i = 0; $i < 3 ; $i++){
	   	$text.="<br/>".$data1[$i]['text'];
	   }
	   $_SESSION['twitter'] .= $text;
	   $text="";
	}while($row4 = $result4->fetch_array());
	 $suma += $suma_twitter;
?>