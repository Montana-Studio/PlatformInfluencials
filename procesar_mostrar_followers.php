<?php


    echo '	   	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

				<script> 
	 			$(document).ready(function(){
	 		
	 				
					$(".estado_rs").click(function(){			
					var id_activar_rs = this.id;
	 				var tipo = "activar_rs";
	 				var estado =parseInt(this.name);
	 				//alert(id_activar_rs+"-"+tipo+"-"+estado);
						
						$.ajax({  
							type: "POST",  
							url: "./rrss/procesar_activar_rs.php",  
							data: "id_activar_rs="+id_activar_rs+"&estado="+estado+"&tipo="+tipo,	
							success: function(data){ 
								alert(data);
								window.location.reload();
							}
						});
					
					});
				});
			</script>';
	/****************************************************************************************************
									GET INSTAGRAM REACH
	****************************************************************************************************/
$query3="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='instagram'";
 $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
 $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
 $num_row3= mysqli_num_rows($result3);
 $_SESSION['instagram']="";
	if($num_row3>0){
		do{
		$json_user_url ="https://api.instagram.com/v1/users/".$row3[3]."?access_token=".$row3[6];
		$json_user= file_get_contents($json_user_url);
		$links_user_url= json_decode($json_user);
		$followers_instagram = $links_user_url->data->counts->followed_by;
		$username = $links_user_url->data->username;
		$avatar = $links_user_url->data->profile_picture;
	    if ($row3[5] == 1){
	  		$suma_instagram+=(int)$followers_instagram;
	    }	
	    if ($row3[5] == 0){
	    	$estado= 0;
		    $estado_descripcion="activar";
		 }else{
		    $estado= 1;
		    $estado_descripcion="desactivar";
		 }
			$_SESSION['instagram'] .="<h3>".$username."   -    ".(int)$followers_instagram."<button class='estado_rs' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button><br/></h3><img src='".$avatar."'/>";


	}while($row3 = $result3->fetch_array());
	$suma += $suma_instagram;

	}

		/****************************************************************************************************
											TWITTER BUTTON AND GET REACH SUM
		****************************************************************************************************/
		$query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='twitter'";
		$result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
		$row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
		$num_row4=mysqli_num_rows($result4);
		$settings = array(
			'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
			'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
			'consumer_key' => "hV95sLlCLjKIQbsVx1uVIxgKQ",
			'consumer_secret' => "FU3GBmbIldTUzJZJOJqrynhiiecmt2FPHAShlkGi3AH8jY7GrV"
		);
		$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestMethod = 'GET';
		$_SESSION['twitter']="";
	if($num_row4>0){    
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
	

	 
    //echo "Result " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ".$interval->h."hours".$interval->m." minute";
    



		    if($row4[5] == 1 ){
		   		$suma_twitter+=	$followers_count1;
		    }
		    if ($row4[5] == 0){
		    	$estado=0;
		    	$estado_descripcion="activar";
		    }else{
		    	$estado=1;
		    	$estado_descripcion = "desactivar";
		    }

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


		   $_SESSION['twitter'] .="<h3>".$username."   -    ".(int)$followers_count1."  <button class='estado_rs' name='".$estado."' id='".$row4[3]."'>".$estado_descripcion."</button> </h3><img src='".$avatar."'/>
		   <div>últimos tweets";
		   for($i = 0; $i < 3 ; $i++){
		   	$start_date = new DateTime("now");
		   	$postDate = $data1[$i]['created_at'];
			$years = substr($postDate,26,4);
			$months = substr($postDate,4,3); //nov
			$day = substr($postDate,8,2);
			$time = substr($postDate,11,8);
			$formattedPostDate= $years."-".month($months)."-".$day." ".$time;	
			$end_date = new DateTime($formattedPostDate);
			$interval = $start_date->diff($end_date);

			if(intval($interval->m) > 0){
				$dateDiff = $interval->m."months";
			}else if(intval($interval->d)>0){
				$dateDiff = $interval->d."d";
			}else if(intval($interval->h)>0){
				$dateDiff = $interval->h."h";
			} 
			else if(intval($interval->m)>0){
				$dateDiff = $interval->i."m";
			} 

			
		   	
		   	$text.="<h4>".$data1[$i]['text']."</h4>
		   			<p> Retweet ".$data1[$i]['retweet_count']." - Favourites ".$data1[$i]['favorite_count']." - ".$dateDiff.
		   			"</div>";

		   }
		   $_SESSION['twitter'] .= $text;
		   $text="";
			}while($row4 = $result4->fetch_array());
			 $suma += $suma_twitter;
		}

		


	$query5="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='youtube'";
	$result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
	$row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
	$num_row5=mysqli_num_rows($result5);
	$_SESSION['youtube']="";
	if($num_row5>0){
		do{
					$json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row5[3]."&key=AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
					$json_user= file_get_contents($json_user_url);
					$links_user_url= json_decode($json_user);
					$youtubeSubscribers = $links_user_url->items[0]->statistics->subscriberCount;
					$youtubeName = $links_user_url->items[0]->snippet->title;
					$youtubeImgUrl = $links_user_url->items[0]->snippet->thumbnails->high->url;

				    if ($row5[5] == 1){
				  		$suma_youtube+=(int)$youtubeSubscribers;
				    }	
				    if ($row5[5] == 0){
				    	$estado= 0;
					    $estado_descripcion="activar";
					 }else{
					    $estado= 1;
					    $estado_descripcion="desactivar";
					 }
						$_SESSION['youtube'] .="<h3>".$youtubeName."   -    ".(int)$youtubeSubscribers."<button class='estado_rs' name='".$estado."' id='".$row5[3]."'>".$estado_descripcion."</button><br/></h3><img src='".$youtubeImgUrl."'/>";


			}while($row5 = $result5->fetch_array());
		}
		$suma += $suma_youtube;
		$results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$youtubeId' AND descripcion_rrss='youtube'");
		$num_row1=mysqli_num_rows($results1);

		/****************************************************************************************************
										FACEBOOK GET REACH SUM
	****************************************************************************************************/
		$query6="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='facebook'";
	 $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
	 $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
	 $num_row6=mysqli_num_rows($result6);
	 $facebookKey ="693511c0b86cda985e20ba5a19f556c0";
		$facebookAppId = "973652052702468";
		$_SESSION['facebook']="";
		if($num_row6>0){
			do{
				
					$facebookPage = $row6[3];
					$json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
					$json_user_url = str_replace(" ", "%20", $json_user_url1);
					$json_user= file_get_contents($json_user_url);
					$links_user_url= json_decode($json_user);
					$facebookLikes =$links_user_url->likes;
					$facebookTalkingAbout =$links_user_url->talking_about_count;
					$facebookUsername =$links_user_url->username;
					$facebookWebsite =$links_user_url->website;
					$facebookImgUrl = "https://graph.facebook.com/".$facebookUsername."/picture?type=large";
					
					if ($row6[5] == 1){
				  		$suma_facebook+=(int)$facebookLikes;
				    }	
				    if ($row6[5] == 0){
				    	$estado= 0;
					    $estado_descripcion="activar";
					 }else{
					    $estado= 1;
					    $estado_descripcion="desactivar";
					 }
					 if((int)$facebookLikes>0){
					 	$_SESSION['facebook'] .="<h3>".$facebookUsername."   -    ".(int)$facebookLikes."<button class='estado_rs' name='".$estado."' id='".$facebookPage."'>".$estado_descripcion."</button><br/></h3><h3>Gente hablando : ".$facebookTalkingAbout."</h3><a href=".$facebookWebsite.">".$facebookWebsite."</a><div><img src='".$facebookImgUrl."'/></div>";	
					 }

			}while($row6 = $result6->fetch_array());
			$suma += $suma_facebook;
		}

				/****************************************************************************************************
										GOOGLEPLUS  GET REACH SUM
	****************************************************************************************************/
	 $query7="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='googleplus'";
	 $result7=mysqli_query($mysqli,$query7)or die (mysqli_error());
	 $row7= mysqli_fetch_array($result7, MYSQLI_BOTH);
	 $num_row7=mysqli_num_rows($result7);

	 $googleplusKey ="AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
		$_SESSION['googleplus']="";
		if($num_row7>0){
			do{
				
					$googleplusId = $row7[3];
					$json_user_url ="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
					$json_user= file_get_contents($json_user_url);
					$links_user_url= json_decode($json_user);			
					$googleplusSubscriber =$links_user_url->circledByCount;
					$googleplusName =$links_user_url->displayName;
					if ($row7[5] == 1){
				  		$suma_googleplus+=(int)$googleplusSubscriber;
				    }	
				    if ($row7[5] == 0){
				    	$estado= 0;
					    $estado_descripcion="activar";
					 }else{
					    $estado= 1;
					    $estado_descripcion="desactivar";
					 }
					 if((int)$googleplusSubscriber>0){
					 	$_SESSION['googleplus'] .="<h3>".$googleplusName."   -    ".(int)$googleplusSubscriber."<button class='estado_rs' name='".$estado."' id='".$googleplusId."'>".$estado_descripcion."</button><br/></h3>";
					 }

			}while($row7 = $result7->fetch_array());
			$suma += $suma_googleplus;

		}




?>