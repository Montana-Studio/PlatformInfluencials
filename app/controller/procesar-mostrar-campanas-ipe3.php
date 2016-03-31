<?php

function html_facebook(){

}
function html_instagram(){
    
}
function html_twitter(){
    
}
function html_youtube(){
    
}

function core_facebook($red_social, $rrss_id, $campana_id, $persona_id){
    include('rrss/rrss_keys.php');
    $facebookKey =FACEBOOK_CONSUMER_KEY;
    $facebookAppId = FACEBOOK_APP_ID;
    $json_user_url1 ="https://graph.facebook.com/".$rrss_id."?access_token=".$facebookAppId."|".$facebookKey."&fields=name,likes,talking_about_count,username,website";
    $json_user_url = str_replace(" ", "%20", $json_user_url1);
    $json_user= @file_get_contents($json_user_url);
    $links_user_url= json_decode($json_user);
    $rrss_name =$links_user_url->name;

    //Muestro URL Ingresada
    $query_url_facebook ="SELECT * FROM campanarrss WHERE descripcion_rrss='".$red_social."' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."' AND persona_id='".$persona_id."' ";
    $result_url_facebook = mysqli_query($mysqli,$query_url_facebook);
    $row_url_facebook= mysqli_fetch_array($result_url_facebook, MYSQLI_BOTH);
    $num_rows_url_facebook=mysqli_num_rows($result_url_facebook);

    if(strlen($rrss_name)>0){
        if($num_rows_url_facebook>0){
            
            $campanas_activas_urls_ingresadas .= '
            <div class="rrss" name="facebook" >
                <i class="pi pi-facebook"></i>
                <span>['.$$rrss_name.']</span>';
                
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
                    $facebook_likes=$links_user_url->likes->summary->total_count;
                    $facebook_comments = $links_user_url->comments->summary->total_count;
                    $facebook_shares= $links_user_url->shares->count;  
                    $campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="facebook"> '.$row_url_facebook[4].'</p>';
                    $reach_facebook = (($facebook_likes+$facebook_history_comments+$facebook_history_shares)/$followers_facebook);
                    $campanas_activas_urls_ingresadas.= '<p>Reach '.number_format($reach_facebook,2,".",",").'</p>';
                    ingresa_registros($rrss_id, $persona_id, $campana_id, $rrss_name, $rrss_img, $facebook_likes, $facebook_comments, $facebook_shares, $followers_facebook, $retweet, $favorites, $reproducciones, number_format($reach_facebook,2), $mysqli);
                    //falta agregar URL
                }while($row_url_facebook = mysqli_fetch_row($result_url_facebook));
            $campanas_activas_urls_ingresadas .='</div>';
            
        }
            $campanas_activas_input_url .=  '
            <div class="rrss" name="facebook" >
                <i class="pi pi-facebook"></i>
                <span>['.$$rrss_name.']</span>
                <input id="'.$rrss_id.'" name="facebook" class="social"/>
                <button class="enviar_url" class="btns">Enviar URL</button>
            </div>';    
            //return array($campanas_activas_urls_ingresadas, $campanas_activas_input_url); 
            return $campanas_activas_urls_ingresadas;         
    }   
}

function core_instagram($red_social, $rrss_id, $campana_id, $persona_id, $token){
    include('rrss/rrss_keys.php');
    $json_user_url ="https://api.instagram.com/v1/users/".$rrss_id."?access_token=".$token;
    $json_user= @file_get_contents($json_user_url);
    $links_user_url= json_decode($json_user);
    $rrss_name = $links_user_url->data->username;
    //Muestro URL Ingresada
    $query_url_instagram ="SELECT * FROM campanarrss WHERE descripcion_rrss='instagram' AND rrss_id='".$rrss_id."' AND campana_id='".$row_campanas_activas[0]."' AND persona_id='".$persona_id."'";
    $result_url_instagram = mysqli_query($mysqli,$query_url_instagram);
    $row_url_instagram= mysqli_fetch_array($result_url_instagram, MYSQLI_BOTH);
    $num_rows_url_instagram=mysqli_num_rows($result_url_instagram);
    if(strlen($rrss_name)>0){
        if($num_rows_url_instagram>0){
            
            $campanas_activas_urls_ingresadas .= '
            <div class="rrss" name="instagram" >
                <i class="pi pi-instagram"></i>
                <span>['.$rrss_name.']</span>';
                

                do{
                    $followers_instagram = $links_user_url->data->counts->followed_by;
                    $api = @file_get_contents("http://api.instagram.com/oembed?url=".$row_url_instagram[4]);  
                    $apiObj = json_decode($api,true);  
                    $media_id = $apiObj['media_id']; 
                    $instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$token);
                    $instagram_post_json = json_decode($instagram_post_query,true); 
                    $cuenta_comments_instagram = intval($instagram_post_json['data']['comments']['count']);
                    $cuenta_likes_instagram = intval($instagram_post_json['data']['likes']['count']);
                    $campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="instagram"> '.$row_url_instagram[4].'</p>';
                    $reach_instagram = (($cuenta_likes_instagram+$cuenta_comments_instagram+$cuenta_shares_instagram)/$followers_instagram);
                    $campanas_activas_urls_ingresadas .= '<p>Reach '.number_format($reach_instagram,2,".",",").'</p>';
                    ingresa_registros($rrss_id, $persona_id, $campana_id, $rrss_name, $rrss_img, $cuenta_likes_instagram, $cuenta_comments_instagram, $facebook_history_shares, $followers_instagram, $retweet, $favorites, $reproducciones, number_format($reach_instagram,2), $mysqli);
                    //falta agregar URL

                }while($row_url_instagram = mysqli_fetch_row($result_url_instagram));
                $campanas_activas_urls_ingresadas .='</div>';
            
        }
            $campanas_activas .=   '
            <div class="rrss" name="instagram" >
                <i class="pi pi-instagram"></i>
                <span>['.$username_instagram.']</span>
                <input id="'.$rrss_id.'" name="instagram" class="social"/>
                <button class="enviar_url" class="btns">Enviar URL</button>
            </div>';   
            //return array($campanas_activas_urls_ingresadas, $campanas_activas_input_url);  
            return $campanas_activas_urls_ingresadas;           
        
    }
}

function core_twitter($red_social, $rrss_id, $campana_id, $persona_id){
    include('rrss/rrss_keys.php');
    include_once("rrss/twitter/inc/twitteroauth.php");
    include_once('rrss/twitter/inc/TwitterAPIExchange.php');
    $settings = array(
    'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
    'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
    'consumer_key' => TWITTER_CONSUMER_KEY,
    'consumer_secret' => TWITTER_CONSUMER_SECRET
    );

    //Muestro URL Ingresada
    $query_url_twitter ="SELECT * FROM campanarrss WHERE descripcion_rrss='twitter' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."' AND persona_id='".$persona_id."'";
    $result_url_twitter = mysqli_query($mysqli,$query_url_twitter);
    $row_url_twitter= mysqli_fetch_array($result_url_twitter, MYSQLI_BOTH);
    $num_rows_url_twitter=mysqli_num_rows($result_url_twitter);
    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';
    $usuario1 = $rrss_id;
    $getfield1 = '?id='.$usuario1;
    $twitter1 = new TwitterAPIExchange($settings);
    $follow_count1=$twitter1->setGetfield($getfield1)
    ->buildOauth($ta_url, $requestMethod)
    ->performRequest();
    $data1 = json_decode($follow_count1, true);
    $username_twitter=$data1[0]['user']['screen_name'];

    if($num_rows_url_twitter>0){           
            
            do{
                $campanas_activas_urls_ingresadas .= '
                <div class="rrss" name="twitter" >
                    <i class="pi pi-twitter"></i>
                    <span>['.$username_twitter.']</span>';
                $twitter_post_id_array= explode('/', $row_url_twitter[4]);
                $string_post_id= end($twitter_post_id_array);
                
                $ta_url = 'https://api.twitter.com/1.1/statuses/show/'.$string_post_id.'.json';
                $requestMethod = 'GET';
                $usuario1 = $row_url_twitter[2];
                $getfield1 = '?id='.$usuario1;
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

                $cuenta_replies_twitter=$twitter_replies;
                $cuenta_retweet_twitter=$data1["retweet_count"];
                $cuenta_favorite_twitter=$data1["favorite_count"];
                $rrss_name=$data1[0]['user']['screen_name'];
                $campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="twitter"> '.$row_url_twitter[4].'</p>';
                $reach_twitter = (($cuenta_retweet_twitter+$cuenta_favorite_twitter+$cuenta_replies_twitter)/$followers_twitter);
                $campanas_activas_urls_ingresadas .='<p>'.number_format($reach_twitter,2,".",",").'</p>';
                ingresa_registros($rrss_id, $persona_id, $campana_id, $rrss_name, $rrss_img, $cuenta_likes_instagram, $cuenta_comments_instagram, $facebook_history_shares, $followers_instagram, $cuenta_retweet_twitter, $cuenta_favorite_twitter, $reproducciones, number_format($reach_twitter,2), $mysqli);
                //falta agregar URL


            }while($row_url_twitter = mysqli_fetch_row($result_url_twitter));
                
                
            $campanas_activas_urls_ingresadas .='</div>'; 
        }  
        $campanas_activas .=  '
            <div class="rrss" name="twitter">
                <i class="pi pi-twitter"></i>
                <span>['.$username_twitter.']</span>
                <input id="'.$rrss_id.'" name="twitter" />
                <button class="enviar_url" class="btns">Enviar URL</button>
            </div>';  

            return $campanas_activas_urls_ingresadas;  
}

function core_youtube($red_social, $rrss_id, $campana_id, $persona_id){
    include('rrss/rrss_keys.php');
    $googleplusKey =GOOGLE_CONSUMER_KEY;
    $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$rrss_id."&key=".$googleplusKey;
    $json_user= file_get_contents($json_user_url);
    $links_user_url= json_decode($json_user);
    $rrss_name = $links_user_url->items[0]->snippet->title;


    //Muestro URL Ingresada
    $query_url_youtube ="SELECT * FROM campanarrss WHERE descripcion_rrss='youtube' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."' AND persona_id='".$persona_id."'";
    $result_url_youtube = mysqli_query($mysqli,$query_url_youtube);
    $row_url_youtube= mysqli_fetch_array($result_url_youtube, MYSQLI_BOTH);
    $num_rows_url_youtube=mysqli_num_rows($result_url_youtube);
    if(strlen($rrss_name)>0){
        if($num_rows_url_youtube>0){           
            $campanas_activas_urls_ingresadas .= '
            <div class="rrss" name="youtube" >
                <i class="pi pi-youtube"></i>
                <span>['.$rrss_name.']</span>';
                do{


                    $campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="youtube"> '.$row_url_youtube[4].'</p>';
                    $reproducciones = $links_user_url->items[0]->statistics->viewCount;
                    $campanas_activas_urls_ingresadas .='<p>'.$reproducciones_youtube.'</p>';
                    ingresa_registros($rrss_id, $persona_id, $campana_id, $rrss_name, $rrss_img, $cuenta_likes_instagram, $cuenta_comments_instagram, $facebook_history_shares, $followers_instagram, $cuenta_retweet_twitter, $cuenta_favorite_twitter, $reproducciones, number_format($reach_twitter,2), $mysqli);
                    //falta URL
                }while($row_url_youtube = mysqli_fetch_row($result_url_youtube));
            $campanas_activas_urls_ingresadas .='</div>'; 
        }
            $campanas_activas .=  '
            <div class="rrss" name="youtube">
                <i class="pi pi-youtube"></i>
                <span>['.$rrss_name.']</span>
                <input id="'.$rrss_id.'" name="youtube" />
                <button class="enviar_url" class="btns">Enviar URL</button>
            </div>';
            return $campanas_activas_urls_ingresadas;  
    }
}

function identifica_red_social($red_social, $rrss_id, $campana_id, $persona_id, $token){
    if($red_social=='facebook'){
        return core_facebook($red_social, $rrss_id, $campana_id, $persona_id);
    }

    if($red_social=='instagram'){
        return core_instagram($red_social, $rrss_id, $campana_id, $persona_id, $token);
    }

    if($red_social=='twitter'){
        return core_twitter($red_social, $rrss_id, $campana_id, $persona_id);
    }

    if($red_social=='youtube'){
        return core_youtube($red_social, $rrss_id, $campana_id, $persona_id);
    }
}

function ingresa_registros($cuenta, $persona_id, $campana_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $followers, $retweet, $favorites, $reproducciones, $reach, $mysqli){
    $query_datos_core="SELECT DISTINCT * FROM core_redes_sociales_campanas WHERE rrss_id='".$cuenta."' AND campana_id=".$campana_id;
    $result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
    $num_row_datos_core= mysqli_num_rows($result_datos_core);

    if($num_row_datos_core>0){
        $query_inserta_datos_core='UPDATE core_redes_sociales_campanas SET  campana_id="'.$campana_id.'", likes="'.$likes.'", comments="'.$comments.'",shares="'.$shares.'",followers="'.$followers.'",retweet="'.$retweet.'",favorites="'.$favorites.'",reproducciones="'.$reproducciones.'",reach="'.$reach.'" WHERE rrss_id="'.$cuenta.'"';
        $result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
    }else{
        $query_inserta_datos_core='INSERT INTO core_redes_sociales_campanas (campana_id, rrss_id, rrss_name, rrss_img , persona_id, likes, comments, shares, followers, retweet, favorites, reproducciones) VALUES ("'.$campana_id.'", "'.$cuenta.'", "'.$rrss_name.'","'.$rrss_img.'","'.$persona_id.'", "'.$likes.'", "'.$comments.'", "'.$shares.'", "'.$followers.'", "'.$retweet.'", "'.$favorites.'", "'.$reproducciones.'")';
        $result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
    }
}

function muestra_campanas_activas($num_row_campanas_activas, $num_row_campanas_activas, $row_campanas_activas,$result_campanas_activas, $mysqli, $persona_id){


    $rrss_list = explode(",",$row_campanas_activas[11]);
    $cantidad_redes_sociales = count($rrss_list); 

    if ($num_row_campanas_activas > 0 && $cantidad_redes_sociales>0){
                
                $campanas_activas .= '  
                    <h2 class="sub-titulo">Resultados de la campaña</h2>
                        <div class="creadas">';
                do{
                    $campanas_activas .= '
                    
                        <div class="recientes">
                            <div class="cont-campana">
                                <div class="bg-campana" style="background-image:url('.$row_campanas_activas[3].');">
                                    <h3>'.$row_campanas_activas[1].'<span>by '.$row_campanas_activas[4].'</span></h3>
                                </div>

                                <div class="ver-mas">
                                    <span>
                                        <i class="pi pi-arrow-bottom"></i><i class="pi pi-plus"></i>
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
                                            <img src="'.$row_campanas_activas[3].'"/>';
                                            do{
                                                $query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$persona_id." AND id_estado='1' AND  descripcion_rrss='".$rrss_list[$i]."'";
                                                $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
                                                $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
                                                $num_row4=mysqli_num_rows($result4);
                                                $campanas_activas.= '';
                                                do{
                                                    
                                                    return identifica_red_social($rrss_list[$i], $row4[3], $row_campanas_activas[0], $persona_id, $row4[6]);

                                                }while($row4 = mysqli_fetch_row($result4)); 
                                                $i++;
                                                if ($i==count($rrss_list)){
                                                   $campanas_activas .='<h2>URLs ingresadas</h2>'.$campanas_activas_urls_ingresadas;
                                                }
                                            }while($i<count($rrss_list));
                                             $campanas_activas .= '<a href="./controller/index.php?id='.$row_campanas_activas[0].'&influenciador='.$persona_id.'">generar informe</a>'; 
                                            $campanas_activas .= '
                                </div>
                            </div>
                        </div>
                    </div>';
                }while($row_campanas_activas = mysqli_fetch_row($result_campanas_activas));
                $campanas_activas .= '</div>';
                return $campanas_activas;
                $campanas_activas_urls_ingresadas = '';
            }
}

function muestra_campanas_inactivas($row_campanas_inactivas,$result_campanas_inactivas, $mysqli){
    $campanas_inactivas='<h2 class="sub-titulo">Campañas no iniciadas</h2>
                         <div class="creadas">';
    do{

        $campanas_inactivas .= '<div class="recientes">
                                    <div class="cont-campana">
                                        <div class="bg-campana" style="background-image:url('.$row_campanas_inactivas[3].');">
                                            <h3>'.$row_campanas_inactivas[1].'<span>by '.$row_campanas_inactivas[4].'</span></h3>
                                        </div>

                                        <div class="ver-mas">
                                            <span>
                                                <i class="pi pi-arrow-bottom"></i><i class="pi pi-plus"></i>
                                            </span>
                                        </div>
                                        <div class="content">
                                            <div class="btn_close"><span><i class="pi pi-close"></i></span></div>
                                            <div class="campana-data">
                                                <span class="campa-ico activada"><i class="pi pi-tool"></i>Activada</span>
                                                <span class="campa-ico fecha-activada">
                                                    <i class="pi pi-calendar"> Inicio </i><span>'.$row_campanas_inactivas[7].'</span> al <span>'.$row_campanas_inactivas[8].'</span>
                                                </span>
                                            </div>
                                                <div class="inputs-campana descripcion descripcion-campana" id="'.$row_campanas_inactivas[0].'">
                                                    <textarea placeholder="descripcion" disabled>'.$row_campanas_inactivas[2].'</textarea>
                                                </div>
                                                <div class="img-compana-deskt hide">
                                                    <img src="'.$row_campanas_inactivas[3].'"/>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    }while($row_campanas_inactivas = mysqli_fetch_row($result_campanas_inactivas));
    $campanas_inactivas .= '</div>';
    return $campanas_inactivas;
}

function muestra_campanas($persona_id){

    $mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
    $mysqli->set_charset('utf8_bin');
    $persona_id=$_SESSION['id'];
    
    $query="SELECT DISTINCT * FROM solicitudes WHERE id_influenciador='".$persona_id."'";
    $result=mysqli_query($mysqli,$query)or die (mysqli_error());
    $row= mysqli_fetch_array($result, MYSQLI_BOTH);
    $num_row=mysqli_num_rows($result);

    $query2="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$persona_id."' AND estado_solicitud='1'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
    $row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
    $num_row2=mysqli_num_rows($result2);

    /*$query_actualiza_finalizadas= "UPDATE campana SET finalizada = '1' WHERE fecha_termino_server<curdate() AND fecha_termino_server<>'0000-00-00'";
    $result_actualiza_finalizadas = mysqli_query($mysqli,$query_actualiza_finalizadas)or die (mysqli_error());*/

    $query_campanas_activas="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_termino_server > curdate() AND finalizada='0'";
    $result_campanas_activas=mysqli_query($mysqli,$query_campanas_activas)or die (mysqli_error());
    $row_campanas_activas= mysqli_fetch_array($result_campanas_activas, MYSQLI_BOTH);
    $num_row_campanas_activas=mysqli_num_rows($result_campanas_activas);

    $query_campanas_inactivas="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='0' AND finalizada='0'";
    $result_campanas_inactivas=mysqli_query($mysqli,$query_campanas_inactivas)or die (mysqli_error());
    $row_campanas_inactivas= mysqli_fetch_array($result_campanas_inactivas, MYSQLI_BOTH);
    $num_row_campanas_inactivas=mysqli_num_rows($result_campanas_inactivas);

    $query_campanas_finalizadas="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_termino_server < curdate() AND finalizada='1'";
    $result_campanas_finalizadas=mysqli_query($mysqli,$query_campanas_finalizadas)or die (mysqli_error());
    $row_campanas_finalizadas= mysqli_fetch_array($result_campanas_finalizadas, MYSQLI_BOTH);
    $num_row_campanas_finalizadas=mysqli_num_rows($result_campanas_finalizadas);

    if($num_row_campanas_finalizadas>0){
        $rrss_list = explode(",",$row_campanas_finalizadas[11]);
        $cantidad_redes_sociales = count($rrss_list); 
    }

    if($num_row_campanas_activas > 0){
        return muestra_campanas_activas($row_campanas_activas,$num_row_campanas_activas,$result_campanas_activas, $mysqli, $persona_id);
    }

    if($num_row_campanas_finalizadas > 0 && $cantidad_redes_sociales>0){
        return muestra_campanas_finalizadas();
    }

    if($num_row_campanas_inactivas > 0 && $cantidad_redes_sociales>0){
        return muestra_campanas_inactivas($row_campanas_inactivas,$result_campanas_inactivas, $mysqli);
    }

}



?>