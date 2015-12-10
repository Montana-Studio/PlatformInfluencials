
<?php

		$query="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."'";
		$result=mysqli_query($mysqli,$query)or die (mysqli_error());
		$row= mysqli_fetch_array($result, MYSQLI_BOTH);
		$num_row=mysqli_num_rows($result);

		$query2="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."' AND estado_solicitud='1'";
		$result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
		$row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
		$num_row2=mysqli_num_rows($result2);

		$query3="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_inicio_server <= date(now())";
			$result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
			$row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
			$num_row3=mysqli_num_rows($result3);




if($num_row2>0){
	do{	
		$campanas_activas .= '<div>';
		//echo $query3;
		//echo $row3[11]."...";
		$rrss_list = explode(",",$row3[11]);
		$cantidad_redes_sociales = count($rrss_list)-1;
		$i=0;
		if ($num_row3 > 0 && $cantidad_redes_sociales>0){
			do{
				$campanas_activas .= '
				<h2>Iniciadas</h2>
				<div>
					<div>
						<div>
							<h3>'.$row3[1].'<span>by '.$row3[4].'</span></h3>
						</div>
						<div>
								<div>
									<input placeholder="'.$row3[1].'" disabled />
								</div>

								<div>
									<input  placeholder="by '.$row3[4].'" disabled />
								</div>

								<span class="campa-ico"><i class="fa fa-calendar"> Inicio'.$row3[7].'- Término '.$row3[8].'</i></span>
								<div>
									<textarea placeholder="descripcion" disabled>'.$row3[2].'</textarea>
								</div>

								<div class="ingresar_urls" id="'.$row3[0].'">
								<h3>Ingresa tus URLs marcadas</h3>';

					do{
						$query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND id_estado='1' AND  descripcion_rrss='".$rrss_list[$i]."'";
						$result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
						$row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
						$num_row4=mysqli_num_rows($result4);
						do{
							if($row4[2]=='facebook'){

								$facebookPage=$row4[3];
								$facebookKey ="693511c0b86cda985e20ba5a19f556c0";
								$facebookAppId = "973652052702468";
								$json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
						        $json_user_url = str_replace(" ", "%20", $json_user_url1);
						        $json_user= file_get_contents($json_user_url);
						        $links_user_url= json_decode($json_user);
						        $facebookWebsite =$links_user_url->website;
						    
						        $campanas_activas .=  '<div class="rrss" name="facebook" >Facebook ['.$facebookWebsite.']<input id="'.$row4[3].'"/></div>';				
							}
							if($row4[2]=='instagram'){
							  $json_user_url ="https://api.instagram.com/v1/users/".$row4[3]."?access_token=".$row4[6];
						      $json_user= file_get_contents($json_user_url);
						      $links_user_url= json_decode($json_user);
						      $username_instagram = $links_user_url->data->username;
						      $campanas_activas .=  '<div class="rrss" name="instagram" ">Instagram ['.$username_instagram.']<input id="'.$row4[3].'"/></div>';
								
							}
							
							if($row4[2]=='twitter'){
								$settings = array(
								'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
								'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
								'consumer_key' => "hV95sLlCLjKIQbsVx1uVIxgKQ",
								'consumer_secret' => "FU3GBmbIldTUzJZJOJqrynhiiecmt2FPHAShlkGi3AH8jY7GrV"
								);
								$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
								$requestMethod = 'GET';
								$usuario1 = $row4[3];
						        $getfield1 = '?id='.$usuario1;
						        $twitter1 = new TwitterAPIExchange($settings);
						        $follow_count1=$twitter1->setGetfield($getfield1)
						        ->buildOauth($ta_url, $requestMethod)
						        ->performRequest();
						        $data1 = json_decode($follow_count1, true);
						        $followers_count1=$data1[0]['user']['followers_count'];
						        $username_twitter=$data1[0]['user']['screen_name'];
								$campanas_activas .=  '<div class="rrss" name="twitter" id="'.$row4[3].'" >Twitter ['.$username_twitter.']<input/></div>';
							}

							if($row4[2]=='youtube'){
								$googleplusKey ="AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
								$json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$num_row4[3]."&key=".$googleplusKey;
						        $json_user= file_get_contents($json_user_url);
						        $links_user_url= json_decode($json_user);
						        $youtubeName = $links_user_url->items[0]->snippet->title;
								$campanas_activas .=  '<div class="rrss" name="youtube" id="'.$row4[3].'">Youtube ['.$youtubeName.']<input/></div>';
							}

							if($row4[2]=='googleplus'){
								$googleplusKey ="AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
								$googleplusId = $row4[3];
	        					$json_user_url ="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
	        					$json_user= file_get_contents($json_user_url);
						        $links_user_url= json_decode($json_user);
						        $googleplusName =$links_user_url->displayName;
								$campanas_activas .=  '<div class="rrss" name="googleplus" id="'.$row4[3].'">Google Plus ['.$googleplusName.']<input/></div>';
							}
						}while($row4 = mysqli_fetch_row($result4));

						$query9="SELECT DISTINCT * FROM Analytics WHERE persona_id=".$_SESSION['id']." AND id_estado='1' ORDER BY PVMBL DESC";
					    $result9=mysqli_query($mysqli,$query9)or die (mysqli_error());
					    $row9= mysqli_fetch_array($result9, MYSQLI_BOTH);
					    $num_row9=mysqli_num_rows($result9);
					    do{
					    	if($rrss_list[$i]=='analytics' && $num_row9 > 0){
								$campanas_activas .= '<div class="rrss" name="analytics"  >Google Analytics ['. $row9[6].']<input id="'.$row9[4].'"/></div>';
							}
					    }while($row9 = mysqli_fetch_array($result9));	
						$i++;
					}while($i<count($rrss_list)-1);
				
								$campanas_activas .= '
								<button type="submit" id="enviar_url">Enviar URLs</button>
								</div>
							<div>
									<!--img src="'.$row3[3].'"/-->
							</div>
						</div>
					</div>
				</div>
				';
			}while($row3 = mysqli_fetch_row($result3));
$campanas_activas .= '
</div>';
			}else{
				//$campanas_activas = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';
			}

			$query6="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='0' AND  fecha_termino_server > date(now())";
			$result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
			$row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
			$num_row6=mysqli_num_rows($result6);
			//echo $query6;
			if ($num_row6 > 0){
				$campanas_inactivas .= '<div>';
				do{
					$campanas_inactivas .= '

					<h2>Por Iniciar</h2>
					<div>
						<div>
							<div>
								<h3>'.$row6[1].'<span>by '.$row6[4].'</span></h3>
							</div>
							<div class="content">
									<div id="'.$row6[0].'">
										<input placeholder="'.$row6[1].'" disabled />
									</div>

									<div id="'.$row6[0].'">
										<input  placeholder="by '.$row6[4].'" disabled />
									</div>

									<span class="campa-ico"><i class="fa fa-calendar"> Inicio'.$row6[7].'- Término '.$row6[8].'</i></span>
									<div id="'.$row6[0].'">
										<textarea placeholder="descripcion" disabled>'.$row6[2].'</textarea>
									</div>
							
								<div>
										<!--img src="'.$row6[3].'"/-->
								</div>
							</div>
						</div>
					</div>
					';
				}while($row6 = mysqli_fetch_row($result6));
				$campanas_inactivas .= '
				</div>';
			}else{

			}

			$query5="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='0' AND  fecha_termino_server < date(now())";
			$result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
			$row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
			$num_row5=mysqli_num_rows($result5);
			if ($num_row5 > 0){
				$campanas_historial .= '<div>';
				do{
					$campanas_historial .= '

					<h2>Finalizadas</h2>
					<div>
						<div>
							<div>
								<h3>'.$row5[1].'<span>by '.$row5[4].'</span></h3>
							</div>

							<div>
									<div id="'.$row5[0].'">
										<input placeholder="'.$row5[1].'" disabled />
									</div>

									<div id="'.$row5[0].'">
										<input  placeholder="by '.$row5[4].'" disabled />
									</div>

									<span><i class="fa fa-calendar"> Inicio'.$row5[7].'- Término '.$row5[8].'</i></span>
									<div id="'.$row5[0].'">
										<textarea placeholder="descripcion" disabled>'.$row5[2].'</textarea>
									</div>

									<div id="ingresar_urls">
									<h3>URLs marcadas</h3>';
									$rrss_list = explode(",",$row5[11]);
									$i=0;
									do{
									$campanas_historial .= $rrss_list[$i].'<!--input/--></br/>';
									$i++;
									}while($i<count($rrss_list)-1);
									$campanas_historial .= '
									</div>
							
							</div>
						</div>
					</div>
					';
				}while($row5 = mysqli_fetch_row($result5));
				$campanas_historial .= '
				</div>';
			}else{
				//$campanas_historial = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';
			}
	}while($row2 = mysqli_fetch_row($result2));
}else{

	$campanas_activas = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';

	$campanas_inactivas = '';
	$campanas_historial = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="fa fa-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';


}
?>
