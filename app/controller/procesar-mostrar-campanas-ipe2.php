<?php
    include('rrss/rrss_keys.php');
    $query="SELECT DISTINCT * FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."'";
    $result=mysqli_query($mysqli,$query)or die (mysqli_error());
    $row= mysqli_fetch_array($result, MYSQLI_BOTH);
    $num_row=mysqli_num_rows($result);

    $query2="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."' AND estado_solicitud='1'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
    $row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
    $num_row2=mysqli_num_rows($result2);

    $query_actualiza_finalizadas= "UPDATE campana SET finalizada = '1' WHERE fecha_termino_server<curdate()";
    $result_actualiza_finalizadas = mysqli_query($mysqli,$query_actualiza_finalizadas)or die (mysqli_error());

    if($num_row2>0){
        
        do{ 
            $query_campanas_activas="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_termino_server > curdate() AND finalizada='0'";
            $result_campanas_activas=mysqli_query($mysqli,$query_campanas_activas)or die (mysqli_error());
            $row_campanas_activas= mysqli_fetch_array($result_campanas_activas, MYSQLI_BOTH);
            $num_row_campanas_activas=mysqli_num_rows($result_campanas_activas);
            $i=0;

            $query_campanas_finalizadas="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_termino_server < curdate() AND finalizada='1'";
            $result_campanas_finalizadas=mysqli_query($mysqli,$query_campanas_finalizadas)or die (mysqli_error());
            $row_campanas_finalizadas= mysqli_fetch_array($result_campanas_finalizadas, MYSQLI_BOTH);
            $num_row_campanas_finalizadas=mysqli_num_rows($result_campanas_finalizadas);

            if($num_row_campanas_activas>0){
                $rrss_list = explode(",",$row_campanas_activas[11]);
                $cantidad_redes_sociales = count($rrss_list); 
            }

            if($num_row_campanas_finalizadas>0){
                $rrss_list = explode(",",$row_campanas_finalizadas[11]);
                $cantidad_redes_sociales = count($rrss_list); 
            }
            

            if ($num_row_campanas_activas > 0 && $cantidad_redes_sociales>0){
                
                $campanas_activas .= '  
                <div id="redes_sociales_campana_'.$row2[0].'" class="reach-campana">
                    <h2 class="sub-titulo">Metricas de la campaña</h2>';
                do{
                    $campanas_activas .= '
                    <div class="creadas">
                        <div class="recientes">
                            <div class="cont-campana">
                                <div class="bg-campana" style="background-image:url('.$row_campanas_activas[3].');">
                                    <h3>'.$row_campanas_activas[1].'<span>by '.$row_campanas_activas[4].'</span></h3>
                                </div>

                                <div class="ver-mas">
                                    <span>
                                        <i class="pi"></i>
                                    </span>
                                </div>
                                <div class="content">
                                    <div class="btn_close"><span><i class="pi pi-close"></i></span></div>
                                    <div class="campana-data">
                                        <span class="campa-ico activada"><i class="pi pi-tool"></i>Activada</span>
                                        <span class="campa-ico fecha-activada">
                                            <i class="pi pi-calendar"> Inicio </i><span>'.$row_campanas_activas[7].'</span> al <span>'.$row_campanas_activas[8].'</span>
                                        </span>
                                    </div>
                                        <div class="inputs-campana descripcion descripcion-campana" id="'.$row_campanas_activas[0].'">
                                            <textarea placeholder="descripcion" disabled>'.$row_campanas_activas[2].'</textarea>
                                        </div>
                                        <div class="img-compana-deskt hide">
                                            <img src="'.$row_campanas_activas[3].'"/>
                                            <div class="ingresar_urls" id="'.$row_campanas_activas[0].'">
                                            <h2>Ingresa tus URLs marcadas</h2>';
                                            do{
                                                $query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND id_estado='1' AND  descripcion_rrss='".$rrss_list[$i]."'";
                                                $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
                                                $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
                                                $num_row4=mysqli_num_rows($result4);
                                                $campanas_activas.= '';
                                                do{
                                                    
                                                    if($row4[2]=='facebook'){
                                                        $facebookPage=$row4[3];
                                                        $facebookKey =FACEBOOK_CONSUMER_KEY;
                                                        $facebookAppId = FACEBOOK_APP_ID;
                                                        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=name,likes,talking_about_count,username,website";
                                                        $json_user_url = str_replace(" ", "%20", $json_user_url1);
                                                        $json_user= @file_get_contents($json_user_url);
                                                        $links_user_url= json_decode($json_user);
                                                        $facebookWebsite =$links_user_url->name;
                                                        //$campanas_activas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$facebookWebsite.']">'.$row4[2].' -- ['.$facebookWebsite.']</option>';
                                                        //$sitio_actual_nombre = $facebookWebsite;

                                                        //Muestro URL Ingresada
                                                        $query_url_facebook ="SELECT * FROM campanarrss WHERE descripcion_rrss='facebook' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_activas[0]."' AND persona_id='".$_SESSION['id']."' ";
                                                        $result_url_facebook = mysqli_query($mysqli,$query_url_facebook);
                                                        $row_url_facebook= mysqli_fetch_array($result_url_facebook, MYSQLI_BOTH);
                                                        $num_rows_url_facebook=mysqli_num_rows($result_url_facebook);

                                                        if(strlen($facebookWebsite)>0){
                                                            if($num_rows_url_facebook>0){
                                                                
                                                                $campanas_activas_urls_ingresadas .= '
                                                                <div class="rrss" name="facebook" >
                                                                    <i class="pi pi-facebook"></i>
                                                                    <span>['.$facebookWebsite.']</span>';
                                                                    
                                                                    do{
                                                                        
                                                                        $facebookPage = $row_url_facebook[2];
                                                                        $facebook_post_id=explode("/",$row_url_facebook['url']);
                                                                        $json_user_url="https://graph.facebook.com/".$row_url_facebook[2]."_".trim(end($facebook_post_id))."?fields=likes.limit(0).summary(true),comments.limit(0).summary(true),shares";
                                                                        $json_user_url = str_replace(" ", "%20", $json_user_url);
                                                                        $json_user= @file_get_contents($json_user_url);
                                                                        $links_user_url= json_decode($json_user);

                                                                        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,name";
                                                                        $json_user_url1 = str_replace(" ", "%20", $json_user_url1);
                                                                        $json_user1= @file_get_contents($json_user_url1);
                                                                        $links_user_url1= json_decode($json_user1);
                                                                        $followers_facebook = $links_user_url1->likes;

                                                                        if ($row6[5] == 1){
                                                                          $suma_facebook+=(int)$facebookLikes;
                                                                        }

                                                                        $cuenta_likes_facebook+= $links_user_url->likes->summary->total_count;
                                                                        $cuenta_comments_facebook += $links_user_url->comments->summary->total_count;
                                                                        $cuenta_shares_facebook+= $links_user_url->shares->count;  
                                                                        $campanas_activas_urls_ingresadas .= '<p id="'.$row4[3].'" name="facebook"> '.$row_url_facebook[4].'</p>';
                                                                        $reach_facebook = (($cuenta_likes_facebook+$cuenta_comments_facebook+$cuenta_shares_facebook)/$followers_facebook);
                                                                        $campanas_activas_urls_ingresadas.= '<p>Reach '.number_format($reach_facebook,2,".",",").'</p>';
                                                                    }while($row_url_facebook = mysqli_fetch_row($result_url_facebook));
                                                                $campanas_activas_urls_ingresadas .='</div>';
                                                                
                                                            }
                                                                $campanas_activas .=  '
                                                                <div class="rrss" name="facebook" >
                                                                    <i class="pi pi-facebook"></i>
                                                                    <span>['.$facebookWebsite.']</span>
                                                                    <input id="'.$row4[3].'" name="facebook" class="social"/>
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';                
                                                            
                                                        }
                                                                       
                                                    }
                                                    if($row4[2]=='instagram'){
                                                      $json_user_url ="https://api.instagram.com/v1/users/".$row4[3]."?access_token=".$row4[6];
                                                      $json_user= @file_get_contents($json_user_url);
                                                      $links_user_url= json_decode($json_user);
                                                      $username_instagram = $links_user_url->data->username;
                                                      //$campanas_activas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$username_instagram.']">'.$row4[2].' -- ['.$username_instagram.']</option>';
                                                      //$sitio_actual_nombre = $username_instagram;
                                                      //Muestro URL Ingresada
                                                        $query_url_instagram ="SELECT * FROM campanarrss WHERE descripcion_rrss='instagram' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_activas[0]."' AND persona_id='".$_SESSION['id']."'";
                                                        $result_url_instagram = mysqli_query($mysqli,$query_url_instagram);
                                                        $row_url_instagram= mysqli_fetch_array($result_url_instagram, MYSQLI_BOTH);
                                                        $num_rows_url_instagram=mysqli_num_rows($result_url_instagram);
                                                        //echo $row_url_instagram[0];
                                                        if(strlen($username_instagram)>0){
                                                            if($num_rows_url_instagram>0){
                                                                
                                                                $campanas_activas_urls_ingresadas .= '
                                                                <div class="rrss" name="instagram" >
                                                                    <i class="pi pi-instagram"></i>
                                                                    <span>['.$username_instagram.']</span>';
                                                                    

                                                                    do{
                                                                        $followers_instagram = $links_user_url->data->counts->followed_by;
                                                                        $api = @file_get_contents("http://api.instagram.com/oembed?url=".$row_url_instagram[4]);  
                                                                        $apiObj = json_decode($api,true);  
                                                                        $media_id = $apiObj['media_id']; 
                                                                        //$instagram_id = $row_url_instagram['rrss_id'];
                                                                        $query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$row4[3];
                                                                        $result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error($link));
                                                                        $row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
                                                                        $access_token = $row_instagram_rrss['access_token'];
                                                                        $instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
                                                                        $instagram_post_json = json_decode($instagram_post_query,true); 
                                                                        $cuenta_comments_instagram += intval($instagram_post_json['data']['comments']['count']);
                                                                        $cuenta_likes_instagram += intval($instagram_post_json['data']['likes']['count']);
                                                                        $campanas_activas_urls_ingresadas .= '<p id="'.$row4[3].'" name="instagram"> '.$row_url_instagram[4].'</p>';
                                                                        $reach_instagram = (($cuenta_likes_instagram+$cuenta_comments_instagram+$cuenta_shares_instagram)/$followers_instagram);
                                                                        $campanas_activas_urls_ingresadas .= '<p>Reach '.number_format($reach_instagram,2,".",",").'</p>';
                                                                    }while($row_url_instagram = mysqli_fetch_row($result_url_instagram));
                                                                    $campanas_activas_urls_ingresadas .='</div>';
                                                                
                                                            }
                                                                $campanas_activas .=  '
                                                                <div class="rrss" name="instagram" >
                                                                    <i class="pi pi-instagram"></i>
                                                                    <span>['.$username_instagram.']</span>
                                                                    <input id="'.$row4[3].'" name="instagram" class="social"/>
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';                
                                                            
                                                        }
                                                          
                                                    }

                                                    if($row4[2]=='twitter'){
                                                        include_once("rrss/twitter/inc/twitteroauth.php");
                                                        include_once('rrss/twitter/inc/TwitterAPIExchange.php');
                                                        $settings = array(
                                                        'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
                                                        'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
                                                        'consumer_key' => TWITTER_CONSUMER_KEY,
                                                        'consumer_secret' => TWITTER_CONSUMER_SECRET
                                                        );
                                                        
                                                        //$campanas_activas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$username_twitter.']">'.$row4[2].' -- ['.$username_twitter.']</option>';
                                                        //$sitio_actual_nombre = $username_twitter;
                                                        //Muestro URL Ingresada
                                                        $query_url_twitter ="SELECT * FROM campanarrss WHERE descripcion_rrss='twitter' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_activas[0]."' AND persona_id='".$_SESSION['id']."'";
                                                        $result_url_twitter = mysqli_query($mysqli,$query_url_twitter);
                                                        $row_url_twitter= mysqli_fetch_array($result_url_twitter, MYSQLI_BOTH);
                                                        $num_rows_url_twitter=mysqli_num_rows($result_url_twitter);
                                                        if(strlen($username_twitter)>0){
                                                            if($num_rows_url_twitter>0){           
                                                                $campanas_activas_urls_ingresadas .= '
                                                                <div class="rrss" name="twitter" >
                                                                    <i class="pi pi-twitter"></i>
                                                                    <span>['.$username_twitter.']</span>';
                                                                    do{

                                                                        $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                                                                        $requestMethod = 'GET';
                                                                        $usuario1 = $row4[3];
                                                                        $getfield1 = '?id='.$usuario1;
                                                                        $twitter1 = new TwitterAPIExchange($settings);
                                                                        $follow_count1=$twitter1->setGetfield($getfield1)
                                                                        ->buildOauth($ta_url, $requestMethod)
                                                                        ->performRequest();
                                                                        $data1 = json_decode($follow_count1, true);
                                                                        $username_twitter=$data1[0]['user']['screen_name'];

                                                                        /**********************/
                                                                        $twitter_post_id_array= explode('/', $row_url_twitter[4]);
                                                                        $string_post_id= end($twitter_post_id_array);
                                                                        
                                                                        $ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
                                                                        $requestMethod = 'GET';
                                                                        $usuario1 = $row_url_twitter[2];
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
                                                                        $followers_twitter=$data1["user"]["followers_count"];
                                                                       
                                                                        do{
                                                                          $reply_user_id_str=$data3->statuses[0]->in_reply_to_status_id_str;
                                                                          $twitter_replies++;
                                                                          $k++;
                                                                        }while($k<$reply_array_length);

                                                                        $cuenta_replies_twitter+=$twitter_replies;
                                                                        $cuenta_retweet_twitter+=$data1["retweet_count"];
                                                                        $cuenta_favorite_twitter+=$data1["favorite_count"];
                                                                        $username=$data1[0]['user']['screen_name'];
                                                                        $campanas_activas_urls_ingresadas .= '<p id="'.$row4[3].'" name="twitter"> '.$row_url_twitter[4].'</p>';
                                                                        $reach_twitter = (($cuenta_retweet_twitter+$cuenta_favorite_twitter)/$followers_twitter);
                                                                        $campanas_activas_urls_ingresadas .='<p>'.number_format($reach_twitter,2,".",",").'</p>';

                                                                    }while($row_url_twitter = mysqli_fetch_row($result_url_twitter));
                                                                    
                                                                    
                                                                $campanas_activas_urls_ingresadas .='</div>'; 
                                                            }
                                                                $campanas_activas .=  '
                                                                <div class="rrss" name="twitter">
                                                                    <i class="pi pi-twitter"></i>
                                                                    <span>['.$username_twitter.']</span>
                                                                    <input id="'.$row4[3].'" name="twitter"/>
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';
                                                            
                                                        }
                            
                                                    }

                                                    if($row4[2]=='youtube'){
                                                        $googleplusKey =GOOGLE_CONSUMER_KEY;
                                                        $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row4[3]."&key=".$googleplusKey;
                                                        $json_user= file_get_contents($json_user_url);
                                                        $links_user_url= json_decode($json_user);
                                                        $youtubeName = $links_user_url->items[0]->snippet->title;
                                                        //$campanas_activas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$youtubeName.']">'.$row4[2].' -- ['.$youtubeName.']</option>';
                                                        //$sitio_actual_nombre = $youtubeName;
                                                        //Muestro URL Ingresada
                                                        $query_url_youtube ="SELECT * FROM campanarrss WHERE descripcion_rrss='youtube' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_activas[0]."' AND persona_id='".$_SESSION['id']."'";
                                                        $result_url_youtube = mysqli_query($mysqli,$query_url_youtube);
                                                        $row_url_youtube= mysqli_fetch_array($result_url_youtube, MYSQLI_BOTH);
                                                        $num_rows_url_youtube=mysqli_num_rows($result_url_youtube);
                                                        if(strlen($youtubeName)>0){
                                                            if($num_rows_url_youtube>0){           
                                                                $campanas_activas_urls_ingresadas .= '
                                                                <div class="rrss" name="youtube" >
                                                                    <i class="pi pi-youtube"></i>
                                                                    <span>['.$youtubeName.']</span>';
                                                                    do{


                                                                        $campanas_activas_urls_ingresadas .= '<p id="'.$row4[3].'" name="youtube"> '.$row_url_youtube[4].'</p>';
                                                                    }while($row_url_youtube = mysqli_fetch_row($result_url_instagram));
                                                                $campanas_activas_urls_ingresadas .='</div>'; 
                                                            }
                                                                $campanas_activas .=  '
                                                                <div class="rrss" name="youtube">
                                                                    <i class="pi pi-youtube"></i>
                                                                    <span>['.$youtubeName.']</span>
                                                                    <input id="'.$row4[3].'" name="youtube" />
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';
                                                        }
                                                    }   
                                                }while($row4 = mysqli_fetch_row($result4)); 
                                                $i++;
                                                if ($i==count($rrss_list)){
                                                    $campanas_activas .='<h2>URLs ingresadas</h2>'.$campanas_activas_urls_ingresadas;
                                                }
                                            }while($i<count($rrss_list));

                                            $campanas_activas .= '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }while($row_campanas_activas = mysqli_fetch_row($result_campanas_activas));
                $campanas_activas_urls_ingresadas = '';
                 $campanas_activas .= ' </div>';

            }


            if ($num_row_campanas_finalizadas > 0 && $cantidad_redes_sociales>0){
                
                $campanas_finalizadas .= '  
                <div id="redes_sociales_campana_'.$row2[0].'" class="reach-campana">
                    <h2 class="sub-titulo">Metricas de la campaña</h2>';
                do{
                    $campanas_finalizadas .= '
                    <div class="creadas">
                        <div class="recientes">
                            <div class="cont-campana">
                                <div class="bg-campana" style="background-image:url('.$row_campanas_finalizadas[3].');">
                                    <h3>'.$row_campanas_finalizadas[1].'<span>by '.$row_campanas_finalizadas[4].'</span></h3>
                                </div>

                                <div class="ver-mas">
                                    <span>
                                        <i class="pi"></i>
                                    </span>
                                </div>
                                <div class="content">
                                    <div class="btn_close"><span><i class="pi pi-close"></i></span></div>
                                    <div class="campana-data">
                                        <span class="campa-ico activada"><i class="pi pi-tool"></i>Activada</span>
                                        <span class="campa-ico fecha-activada">
                                            <i class="pi pi-calendar"> Inicio </i><span>'.$row_campanas_finalizadas[7].'</span> al <span>'.$row_campanas_finalizadas[8].'</span>
                                        </span>
                                    </div>
                                        <div class="inputs-campana descripcion descripcion-campana" id="'.$row_campanas_finalizadas[0].'">
                                            <textarea placeholder="descripcion" disabled>'.$row_campanas_finalizadas[2].'</textarea>
                                        </div>
                                        <div class="img-compana-deskt hide">
                                            <img src="'.$row_campanas_finalizadas[3].'"/>';
                                            do{
                                                $query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND id_estado='1' AND  descripcion_rrss='".$rrss_list[$i]."'";
                                                $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
                                                $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
                                                $num_row4=mysqli_num_rows($result4);
                                                $campanas_finalizadas.= '';
                                                do{
                                                    
                                                    if($row4[2]=='facebook'){
                                                        $facebookPage=$row4[3];
                                                        $facebookKey =FACEBOOK_CONSUMER_KEY;
                                                        $facebookAppId = FACEBOOK_APP_ID;
                                                        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=name,likes,talking_about_count,username,website";
                                                        $json_user_url = str_replace(" ", "%20", $json_user_url1);
                                                        $json_user= @file_get_contents($json_user_url);
                                                        $links_user_url= json_decode($json_user);
                                                        $facebookWebsite =$links_user_url->name;
                                                        //$campanas_finalizadas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$facebookWebsite.']">'.$row4[2].' -- ['.$facebookWebsite.']</option>';
                                                        //$sitio_actual_nombre = $facebookWebsite;

                                                        //Muestro URL Ingresada
                                                        $query_url_facebook ="SELECT * FROM campanarrss WHERE descripcion_rrss='facebook' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_finalizadas[0]."' AND persona_id='".$_SESSION['id']."' ";
                                                        $result_url_facebook = mysqli_query($mysqli,$query_url_facebook);
                                                        $row_url_facebook= mysqli_fetch_array($result_url_facebook, MYSQLI_BOTH);
                                                        $num_rows_url_facebook=mysqli_num_rows($result_url_facebook);

                                                        if(strlen($facebookWebsite)>0){
                                                            if($num_rows_url_facebook>0){
                                                                
                                                                $campanas_finalizadas_urls_ingresadas .= '
                                                                <div class="rrss" name="facebook" >
                                                                    <i class="pi pi-facebook"></i>
                                                                    <span>['.$facebookWebsite.']</span>';
                                                                    
                                                                    do{
                                                                        
                                                                        $facebookPage = $row_url_facebook[2];
                                                                        $facebook_post_id=explode("/",$row_url_facebook['url']);
                                                                        $json_user_url="https://graph.facebook.com/".$row_url_facebook[2]."_".trim(end($facebook_post_id))."?fields=likes.limit(0).summary(true),comments.limit(0).summary(true),shares";
                                                                        $json_user_url = str_replace(" ", "%20", $json_user_url);
                                                                        $json_user= @file_get_contents($json_user_url);
                                                                        $links_user_url= json_decode($json_user);

                                                                        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,name";
                                                                        $json_user_url1 = str_replace(" ", "%20", $json_user_url1);
                                                                        $json_user1= @file_get_contents($json_user_url1);
                                                                        $links_user_url1= json_decode($json_user1);
                                                                        $followers_facebook = $links_user_url1->likes;

                                                                        if ($row6[5] == 1){
                                                                          $suma_facebook+=(int)$facebookLikes;
                                                                        }

                                                                        $cuenta_likes_facebook+= $links_user_url->likes->summary->total_count;
                                                                        $cuenta_comments_facebook += $links_user_url->comments->summary->total_count;
                                                                        $cuenta_shares_facebook+= $links_user_url->shares->count;  
                                                                        $campanas_finalizadas_urls_ingresadas .= '<p id="'.$row4[3].'" name="facebook"> '.$row_url_facebook[4].'</p>';
                                                                        $reach_facebook = (($cuenta_likes_facebook+$cuenta_comments_facebook+$cuenta_shares_facebook)/$followers_facebook);
                                                                        $campanas_finalizadas_urls_ingresadas.= '<p>Reach '.number_format($reach_facebook,2,".",",").'</p>';
                                                                    }while($row_url_facebook = mysqli_fetch_row($result_url_facebook));
                                                                $campanas_finalizadas_urls_ingresadas .='</div>';
                                                                
                                                            }
                                                                /*$campanas_finalizadas .=  '
                                                                <div class="rrss" name="facebook" >
                                                                    <i class="pi pi-facebook"></i>
                                                                    <span>['.$facebookWebsite.']</span>
                                                                    <input id="'.$row4[3].'" name="facebook" class="social"/>
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';*/             
                                                            
                                                        }
                                                                       
                                                    }
                                                    if($row4[2]=='instagram'){
                                                      $json_user_url ="https://api.instagram.com/v1/users/".$row4[3]."?access_token=".$row4[6];
                                                      $json_user= @file_get_contents($json_user_url);
                                                      $links_user_url= json_decode($json_user);
                                                      $username_instagram = $links_user_url->data->username;
                                                      //$campanas_finalizadas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$username_instagram.']">'.$row4[2].' -- ['.$username_instagram.']</option>';
                                                      //$sitio_actual_nombre = $username_instagram;
                                                      //Muestro URL Ingresada
                                                        $query_url_instagram ="SELECT * FROM campanarrss WHERE descripcion_rrss='instagram' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_finalizadas[0]."' AND persona_id='".$_SESSION['id']."'";
                                                        $result_url_instagram = mysqli_query($mysqli,$query_url_instagram);
                                                        $row_url_instagram= mysqli_fetch_array($result_url_instagram, MYSQLI_BOTH);
                                                        $num_rows_url_instagram=mysqli_num_rows($result_url_instagram);
                                                        //echo $row_url_instagram[0];
                                                        if(strlen($username_instagram)>0){
                                                            if($num_rows_url_instagram>0){
                                                                
                                                                $campanas_finalizadas_urls_ingresadas .= '
                                                                <div class="rrss" name="instagram" >
                                                                    <i class="pi pi-instagram"></i>
                                                                    <span>['.$username_instagram.']</span>';
                                                                    

                                                                    do{
                                                                        $followers_instagram = $links_user_url->data->counts->followed_by;
                                                                        $api = @file_get_contents("http://api.instagram.com/oembed?url=".$row_url_instagram[4]);  
                                                                        $apiObj = json_decode($api,true);  
                                                                        $media_id = $apiObj['media_id']; 
                                                                        //$instagram_id = $row_url_instagram['rrss_id'];
                                                                        $query_instagram_rrss= "SELECT DISTINCT * FROM rrss WHERE rrss_id=".$row4[3];
                                                                        $result_instagram_rrss=mysqli_query($mysqli,$query_instagram_rrss)or die (mysqli_error($link));
                                                                        $row_instagram_rrss= mysqli_fetch_array($result_instagram_rrss, MYSQLI_BOTH); 
                                                                        $access_token = $row_instagram_rrss['access_token'];
                                                                        $instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$access_token);
                                                                        $instagram_post_json = json_decode($instagram_post_query,true); 
                                                                        $cuenta_comments_instagram += intval($instagram_post_json['data']['comments']['count']);
                                                                        $cuenta_likes_instagram += intval($instagram_post_json['data']['likes']['count']);
                                                                        $campanas_finalizadas_urls_ingresadas .= '<p id="'.$row4[3].'" name="instagram"> '.$row_url_instagram[4].'</p>';
                                                                        $reach_instagram = (($cuenta_likes_instagram+$cuenta_comments_instagram+$cuenta_shares_instagram)/$followers_instagram);
                                                                        $campanas_finalizadas_urls_ingresadas .= '<p>Reach '.number_format($reach_instagram,2,".",",").'</p>';
                                                                    }while($row_url_instagram = mysqli_fetch_row($result_url_instagram));
                                                                    $campanas_finalizadas_urls_ingresadas .='</div>';
                                                                
                                                            }
                                                                /*$campanas_finalizadas .=  '
                                                                <div class="rrss" name="instagram" >
                                                                    <i class="pi pi-instagram"></i>
                                                                    <span>['.$username_instagram.']</span>
                                                                    <input id="'.$row4[3].'" name="instagram" class="social"/>
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';*/               
                                                            
                                                        }
                                                          
                                                    }

                                                    if($row4[2]=='twitter'){
                                                        include_once("rrss/twitter/inc/twitteroauth.php");
                                                        include_once('rrss/twitter/inc/TwitterAPIExchange.php');
                                                        $settings = array(
                                                        'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
                                                        'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
                                                        'consumer_key' => TWITTER_CONSUMER_KEY,
                                                        'consumer_secret' => TWITTER_CONSUMER_SECRET
                                                        );
                                                        
                                                        //$campanas_finalizadas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$username_twitter.']">'.$row4[2].' -- ['.$username_twitter.']</option>';
                                                        //$sitio_actual_nombre = $username_twitter;
                                                        //Muestro URL Ingresada
                                                        $query_url_twitter ="SELECT * FROM campanarrss WHERE descripcion_rrss='twitter' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_finalizadas[0]."' AND persona_id='".$_SESSION['id']."'";
                                                        $result_url_twitter = mysqli_query($mysqli,$query_url_twitter);
                                                        $row_url_twitter= mysqli_fetch_array($result_url_twitter, MYSQLI_BOTH);
                                                        $num_rows_url_twitter=mysqli_num_rows($result_url_twitter);
                                                        if(strlen($username_twitter)>0){
                                                            if($num_rows_url_twitter>0){           
                                                                $campanas_finalizadas_urls_ingresadas .= '
                                                                <div class="rrss" name="twitter" >
                                                                    <i class="pi pi-twitter"></i>
                                                                    <span>['.$username_twitter.']</span>';
                                                                    do{

                                                                        $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                                                                        $requestMethod = 'GET';
                                                                        $usuario1 = $row4[3];
                                                                        $getfield1 = '?id='.$usuario1;
                                                                        $twitter1 = new TwitterAPIExchange($settings);
                                                                        $follow_count1=$twitter1->setGetfield($getfield1)
                                                                        ->buildOauth($ta_url, $requestMethod)
                                                                        ->performRequest();
                                                                        $data1 = json_decode($follow_count1, true);
                                                                        $username_twitter=$data1[0]['user']['screen_name'];

                                                                        /**********************/
                                                                        $twitter_post_id_array= explode('/', $row_url_twitter[4]);
                                                                        $string_post_id= end($twitter_post_id_array);
                                                                        
                                                                        $ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
                                                                        $requestMethod = 'GET';
                                                                        $usuario1 = $row_url_twitter[2];
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
                                                                        $followers_twitter=$data1["user"]["followers_count"];
                                                                       
                                                                        do{
                                                                          $reply_user_id_str=$data3->statuses[0]->in_reply_to_status_id_str;
                                                                          $twitter_replies++;
                                                                          $k++;
                                                                        }while($k<$reply_array_length);

                                                                        $cuenta_replies_twitter+=$twitter_replies;
                                                                        $cuenta_retweet_twitter+=$data1["retweet_count"];
                                                                        $cuenta_favorite_twitter+=$data1["favorite_count"];
                                                                        $username=$data1[0]['user']['screen_name'];
                                                                        $campanas_finalizadas_urls_ingresadas .= '<p id="'.$row4[3].'" name="twitter"> '.$row_url_twitter[4].'</p>';
                                                                        $reach_twitter = (($cuenta_retweet_twitter+$cuenta_favorite_twitter)/$followers_twitter);
                                                                        $campanas_finalizadas_urls_ingresadas .='<p>'.number_format($reach_twitter,2,".",",").'</p>';

                                                                    }while($row_url_twitter = mysqli_fetch_row($result_url_twitter));
                                                                    
                                                                    
                                                                $campanas_finalizadas_urls_ingresadas .='</div>'; 
                                                            }
                                                                /*$campanas_finalizadas .=  '
                                                                <div class="rrss" name="twitter">
                                                                    <i class="pi pi-twitter"></i>
                                                                    <span>['.$username_twitter.']</span>
                                                                    <input id="'.$row4[3].'" name="twitter"/>
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';*/
                                                            
                                                        }
                            
                                                    }

                                                    if($row4[2]=='youtube'){
                                                        $googleplusKey =GOOGLE_CONSUMER_KEY;
                                                        $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row4[3]."&key=".$googleplusKey;
                                                        $json_user= file_get_contents($json_user_url);
                                                        $links_user_url= json_decode($json_user);
                                                        $youtubeName = $links_user_url->items[0]->snippet->title;
                                                        //$campanas_finalizadas .=  '<option id="'.$row4[3].'" name="'.$row4[2].'" value ="['.$youtubeName.']">'.$row4[2].' -- ['.$youtubeName.']</option>';
                                                        //$sitio_actual_nombre = $youtubeName;
                                                        //Muestro URL Ingresada
                                                        $query_url_youtube ="SELECT * FROM campanarrss WHERE descripcion_rrss='youtube' AND rrss_id='".$row4[3]."' AND campana_id='".$row_campanas_finalizadas[0]."' AND persona_id='".$_SESSION['id']."'";
                                                        $result_url_youtube = mysqli_query($mysqli,$query_url_youtube);
                                                        $row_url_youtube= mysqli_fetch_array($result_url_youtube, MYSQLI_BOTH);
                                                        $num_rows_url_youtube=mysqli_num_rows($result_url_youtube);
                                                        if(strlen($youtubeName)>0){
                                                            if($num_rows_url_youtube>0){           
                                                                $campanas_finalizadas_urls_ingresadas .= '
                                                                <div class="rrss" name="youtube" >
                                                                    <i class="pi pi-youtube"></i>
                                                                    <span>['.$youtubeName.']</span>';
                                                                    do{


                                                                        $campanas_finalizadas_urls_ingresadas .= '<p id="'.$row4[3].'" name="youtube"> '.$row_url_youtube[4].'</p>';
                                                                    }while($row_url_youtube = mysqli_fetch_row($result_url_instagram));
                                                                $campanas_finalizadas_urls_ingresadas .='</div>'; 
                                                            }
                                                                /*$campanas_finalizadas .=  '
                                                                <div class="rrss" name="youtube">
                                                                    <i class="pi pi-youtube"></i>
                                                                    <span>['.$youtubeName.']</span>
                                                                    <input id="'.$row4[3].'" name="youtube" />
                                                                    <button class="enviar_url" class="btns">Enviar URL</button>
                                                                </div>';*/
                                                        }
                                                    }   
                                                }while($row4 = mysqli_fetch_row($result4)); 
                                                $i++;
                                                if ($i==count($rrss_list)){
                                                    $campanas_finalizadas .='<h2>URLs ingresadas</h2>'.$campanas_finalizadas_urls_ingresadas;
                                                }
                                            }while($i<count($rrss_list));

                                            $campanas_finalizadas .= '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }while($row_campanas_finalizadas = mysqli_fetch_row($result_campanas_finalizadas));
                $campanas_finalizadas_urls_ingresadas = '';
                 $campanas_finalizadas .= ' </div>';

            }


        









            /*else{
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

                                    <span class="campa-ico">
                                        Inicio <i class="pi pi-calendar">'.$row6[7].'- Término '.$row6[8].'</i>
                                    </span>
                                    <div id="'.$row6[0].'">
                                        <textarea placeholder="descripcion" disabled>'.$row6[2].'</textarea>
                                    </div>

                                <div class="img-compana-deskt hide">
                                    <img src="'.$row6[3].'"/>
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

                                    <span>Inicio <i class="pi pi-calendar">'.$row5[7].'- Término '.$row5[8].'</i></span>
                                    <div id="'.$row5[0].'">
                                        <textarea placeholder="descripcion" disabled>'.$row5[2].'</textarea>
                                    </div>
                                    
                                    <div class="img-compana-deskt hide">
                                        <img src="'.$row5[3].'"/>
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

            }*/
        }while($row2 = mysqli_fetch_row($result2));


    }else{
        $campanas_activas = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="pi pi-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';
        $campanas_inactivas = '';
        $campanas_historial = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="pi pi-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';
    }

?>