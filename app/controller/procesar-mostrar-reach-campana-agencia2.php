<?php
require("master_key.php");
function ingresa_registros($cuenta, $campana_id, $rrss_name, $rrss_img, $likes, $comments, $shares, $followers, $retweet, $favorites, $reproducciones, $reach, $url, $mysqli){
    $query_datos_core="SELECT DISTINCT * FROM core_redes_sociales_campanas WHERE url='".$url."'";
    $result_datos_core=mysqli_query($mysqli,$query_datos_core)or die (mysqli_error());
    $num_row_datos_core= mysqli_num_rows($result_datos_core);

    if($num_row_datos_core>0){
        $query_inserta_datos_core='UPDATE core_redes_sociales_campanas SET  likes="'.$likes.'", comments="'.$comments.'",shares="'.$shares.'",followers="'.$followers.'",retweet="'.$retweet.'",favorites="'.$favorites.'",reproducciones="'.$reproducciones.'",reach="'.$reach.'" WHERE rrss_id="'.$cuenta.'" AND url="'.$url.'"';
        $result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
    }/*else{
        $query_inserta_datos_core='INSERT INTO core_redes_sociales_campanas (campana_id, url , rrss_id, rrss_name, rrss_img , persona_id, likes, comments, shares, followers, retweet, favorites, reproducciones) VALUES ("'.$campana_id.'", "'.$url.'" ,"'.$cuenta.'", "'.$rrss_name.'","'.$rrss_img.'","'.$persona_id.'", "'.$likes.'", "'.$comments.'", "'.$shares.'", "'.$followers.'", "'.$retweet.'", "'.$favorites.'", "'.$reproducciones.'")';
        $result_inserta_datos_core=mysqli_query($mysqli,$query_inserta_datos_core)or die (mysqli_error());
    }*/
}

function core_facebook($red_social, $rrss_id, $campana_id, $mysqli){
    include('rrss/rrss_keys.php');
    $facebookKey =FACEBOOK_CONSUMER_KEY;
    $facebookAppId = FACEBOOK_APP_ID;
    $json_user_url1 ="https://graph.facebook.com/".$rrss_id."?access_token=".$facebookAppId."|".$facebookKey."&fields=name,likes,talking_about_count,username,website";
    $json_user_url = str_replace(" ", "%20", $json_user_url1);
    $json_user= @file_get_contents($json_user_url);
    $links_user_url= json_decode($json_user);
    $rrss_name =$links_user_url->name;

    //Muestro URL Ingresada
    $query_url_facebook ="SELECT * FROM campanarrss WHERE descripcion_rrss='".$red_social."' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."' ";
    $result_url_facebook = mysqli_query($mysqli,$query_url_facebook);
    $row_url_facebook= mysqli_fetch_array($result_url_facebook, MYSQLI_BOTH);
    $num_rows_url_facebook=mysqli_num_rows($result_url_facebook);
    if(strlen($rrss_name)>0){
        if($num_rows_url_facebook>0){
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
                    $url=$row_url_facebook[4];
                    $reach_facebook = (($facebook_likes+$facebook_history_comments+$facebook_history_shares)/$followers_facebook);
                    $reach_total_facebook += $reach_facebook;
                    
                    ingresa_registros($rrss_id, $campana_id, $rrss_name, $rrss_img, $facebook_likes, $facebook_comments, $facebook_shares, $followers_facebook, $retweet, $favorites, $reproducciones, number_format($reach_facebook,3), $url, $mysqli);
                }while($row_url_facebook = mysqli_fetch_row($result_url_facebook));
        }
   
            return array($reach_total_facebook,$campanas_activas);         
    }   
}

function core_instagram($red_social, $rrss_id, $campana_id, $token, $mysqli){
    include('rrss/rrss_keys.php');
    $json_user_url ="https://api.instagram.com/v1/users/".$rrss_id."?access_token=".$token;
    $json_user= @file_get_contents($json_user_url);
    $links_user_url= json_decode($json_user);
    $rrss_name = $links_user_url->data->username;
    //Muestro URL Ingresada
    $query_url_instagram ="SELECT * FROM campanarrss WHERE descripcion_rrss='instagram' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."'";
    $result_url_instagram = mysqli_query($mysqli,$query_url_instagram);
    $row_url_instagram= mysqli_fetch_array($result_url_instagram, MYSQLI_BOTH);
    $num_rows_url_instagram=mysqli_num_rows($result_url_instagram);
    if(strlen($rrss_name)>0){
        if($num_rows_url_instagram>0){
            do{
                    $followers_instagram = $links_user_url->data->counts->followed_by;
                    $api = @file_get_contents("http://api.instagram.com/oembed?url=".$row_url_instagram[4]);  
                    $apiObj = json_decode($api,true);  
                    $media_id = $apiObj['media_id']; 
                    $instagram_post_query = @file_get_contents("https://api.instagram.com/v1/media/".$media_id."?access_token=".$token);
                    $instagram_post_json = json_decode($instagram_post_query,true); 
                    $cuenta_comments_instagram = intval($instagram_post_json['data']['comments']['count']);
                    $cuenta_likes_instagram = intval($instagram_post_json['data']['likes']['count']);
                    $url=$row_url_instagram[4];
                    //$campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="instagram"> '.$url.'</p>';
                    $reach_instagram = (($cuenta_likes_instagram+$cuenta_comments_instagram+$cuenta_shares_instagram)/$followers_instagram);
                    $reach_total_instagram +=$reach_instagram;                  
                    ingresa_registros($rrss_id, $persona_id, $campana_id, $rrss_name, $rrss_img, $cuenta_likes_instagram, $cuenta_comments_instagram, $facebook_history_shares, $followers_instagram, $retweet, $favorites, $reproducciones, number_format($reach_instagram,3), $url, $mysqli);
                }while($row_url_instagram = mysqli_fetch_row($result_url_instagram));
                $campanas_activas_urls_ingresadas = '   <div class="rrss" name="instagram" >
                                                            <i class="pi pi-instagram"></i>
                                                            <p>Reach '.number_format($reach_total_instagram,2,".",",").'</p>
                                                        </div>';
            
        }
   
            return array($reach_total_instagram,$campanas_activas);            
    }
}

function core_twitter($red_social, $rrss_id, $campana_id, $mysqli){
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
    $query_url_twitter ="SELECT * FROM campanarrss WHERE descripcion_rrss='twitter' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."'";
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
    $rrss_name=$data1[0]['user']['screen_name'];
    
    if($num_rows_url_twitter>0){           
            
            do{
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
                //$rrss_name=$data1[0]['user']['screen_name'];
                $url=$row_url_twitter[4];
                //$campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="twitter"> '.$url.'</p>';
                $reach_twitter = (($cuenta_retweet_twitter+$cuenta_favorite_twitter+$cuenta_replies_twitter)/$followers_twitter);
                $reach_total_twitter +=$reach_twitter;
                ingresa_registros($rrss_id, $campana_id, $rrss_name, $rrss_img, $cuenta_likes_instagram, $cuenta_comments_instagram, $facebook_history_shares, $followers_instagram, $cuenta_retweet_twitter, $cuenta_favorite_twitter, $reproducciones, number_format($reach_twitter,3), $url, $mysqli);

            }while($row_url_twitter = mysqli_fetch_row($result_url_twitter));
            $campanas_activas_urls_ingresadas = '   <div class="rrss" name="twitter" >
                                                        <i class="pi pi-twitter"></i>
                                                        <p>'.number_format($reach_total_twitter,2,".",",").'</p>
                                                    </div>'; 

    }  
   
            return array($reach_total_twitter,$campanas_activas);
            //return $campanas_activas_urls_ingresadas;  
}

function core_youtube($red_social, $rrss_id, $campana_id, $mysqli){
    include('rrss/rrss_keys.php');
    $googleplusKey =GOOGLE_CONSUMER_KEY;
    $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$rrss_id."&key=".$googleplusKey;
    $json_user= file_get_contents($json_user_url);
    $links_user_url= json_decode($json_user);
    $rrss_name = $links_user_url->items[0]->snippet->title;


    //Muestro URL Ingresada
    $query_url_youtube ="SELECT * FROM campanarrss WHERE descripcion_rrss='youtube' AND rrss_id='".$rrss_id."' AND campana_id='".$campana_id."' ";
    $result_url_youtube = mysqli_query($mysqli,$query_url_youtube);
    $row_url_youtube= mysqli_fetch_array($result_url_youtube, MYSQLI_BOTH);
    $num_rows_url_youtube=mysqli_num_rows($result_url_youtube);
    if(strlen($rrss_name)>0){
        if($num_rows_url_youtube>0){           
                do{
                    $url= $row_url_youtube[4];
                    //$campanas_activas_urls_ingresadas .= '<p id="'.$rrss_id.'" name="youtube"> '.$url.'</p>';
                    $reproducciones = $links_user_url->items[0]->statistics->viewCount;
                    $reproducciones_total +=$reproducciones;
                    ingresa_registros($rrss_id, $campana_id, $rrss_name, $rrss_img, $cuenta_likes_instagram, $cuenta_comments_instagram, $facebook_history_shares, $followers_instagram, $cuenta_retweet_twitter, $cuenta_favorite_twitter, $reproducciones, number_format($reach_twitter,3), $url, $mysqli);
                }while($row_url_youtube = mysqli_fetch_row($result_url_youtube));
                $campanas_activas_urls_ingresadas = '   <div class="rrss" name="youtube" >
                                                            <i class="pi pi-youtube"></i>
                                                            <p>'.$reproducciones_total.'</p>
                                                        </div>'; 
        }   
        return array($reproducciones_total,$campanas_activas);
        //return $campanas_activas_urls_ingresadas;  
    }
}

function identifica_red_social($red_social, $rrss_id, $campana_id, $token, $mysqli){
    if($red_social=='facebook'){
        $resultado = core_facebook($red_social, $rrss_id, $campana_id,$mysqli);
        return array($resultado[0], $resultado[1]);
    }

    if($red_social=='instagram'){
        $resultado= core_instagram($red_social, $rrss_id, $campana_id, $token,$mysqli);
        return array($resultado[0], $resultado[1]);
    }

    if($red_social=='twitter'){
        $resultado=  core_twitter($red_social, $rrss_id, $campana_id,$mysqli);
        return array($resultado[0], $resultado[1]);
    }

    if($red_social=='youtube'){
        $resultado= core_youtube($red_social, $rrss_id, $campana_id,$mysqli);
        return array($resultado[0], $resultado[1]);
    }
}



function muestra_campanas_activas($num_row_campanas_activas, $row_campanas_activas,$result_campanas_activas, $mysqli){
    $rrss_list = explode(",",$row_campanas_activas[11]);
    $cantidad_redes_sociales = count($rrss_list); 
    $i=0;

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
                                                $query4="SELECT DISTINCT * FROM rrss WHERE descripcion_rrss='".$rrss_list[$i]."'";
                                                $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
                                                $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
                                                $num_row4=mysqli_num_rows($result4);
                                                $campanas_activas.= '';
                                                $total_facebook=0;
                                                $total_instagram=0;
                                                $total_twitter=0;
                                                $total_youtube=0;
                                                do{
                                                  $urls_ingresdas=  identifica_red_social($rrss_list[$i], $row4[3], $row_campanas_activas[0], $row4[6], $mysqli);
                                                  if($rrss_list[$i]=='facebook'){
                                                    $total_facebook+=$urls_ingresdas[0];
                                                  }
                                                  if($rrss_list[$i]=='instagram'){
                                                    $total_instagram+=$urls_ingresdas[0];
                                                  }
                                                  if($rrss_list[$i]=='twitter'){
                                                    $total_twitter+=$urls_ingresdas[0];
                                                  }
                                                  if($rrss_list[$i]=='youtube'){
                                                    $total_youtube+=$urls_ingresdas[0];
                                                  }
                                                  //$urls_ya_ingresadas=html_reach($urls_ingresdas[0], $rrss_list[$i]);
                                                  $campanas_activas.= $urls_ingresdas[1];

                                                }while($row4 = mysqli_fetch_row($result4)); 
                                                $i++;


                                                if ($i==count($rrss_list)){
                                                    $query5="SELECT SUM(reach) FROM core_redes_sociales_campanas WHERE campana_id='".$row_campanas_activas[0]."'";
                                                    $result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
                                                    $row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
                                                    $campanas_activas .= "<p> Reach Actual : ".number_format($row5[0],2,".",",")."</p>";

                                                    $query6="SELECT * FROM core_redes_sociales_campanas WHERE campana_id='".$row_campanas_activas[0]."'";
                                                    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
                                                    $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
                                                    $suma_facebook=0;
                                                    $suma_instagram=0;
                                                    $suma_twitter=0;
                                                    $suma_youtube=0;
                                                    do{
                                                        if(strpos($row6[3],'facebook')!==false){
                                                            $suma_facebook+=$row6[14];
                                                        }

                                                        if(strpos($row6[3],'instagram')!==false){
                                                            $suma_instagram+=$row6[14];
                                                        }

                                                        if(strpos($row6[3],'twitter')!==false){
                                                            $suma_twitter+=$row6[14];
                                                        }

                                                        if(strpos($row6[3],'youtube')!==false){
                                                            $suma_youtube+=$row6[14];
                                                        }
                                                    }while($row6= mysqli_fetch_array($result6));
                                                    //$campanas_activas .= html_reach($suma_facebook,'facebook');
                                                    //$campanas_activas .= html_reach($suma_instagram,'instagram');
                                                    //$campanas_activas .= html_reach($suma_twitter,'twitter');
                                                    //$campanas_activas .= html_reach($suma_youtube,'youtube');
                                                    
                                                }


                                                
                                            }while($i<count($rrss_list));
                                             $campanas_activas .= '<a href="./informe/reporte-influenciadores-pdf.php?id='.$row_campanas_activas[0].'">PDF</a>'; 
                                             $campanas_activas .= '<a href="./informe/reporteexcel/reporte-influenciadores-excel.php?id='.$row_campanas_activas[0].'">Excel</a>'; 
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

	


function muestra_campanas($campana_id, $persona_id){

    $mysqli = mysqli_connect(LOCAL,USER,PASS,BD) or die("Error " . mysqli_error($link)); 
    $mysqli->set_charset('utf8_bin');
    $persona_id=$_SESSION['id'];
    

    $query2="SELECT DISTINCT * FROM solicitudes WHERE estado_solicitud='1' AND id_agencia='".$persona_id."' AND id_campana='".$campana_id."'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
    $row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
    $num_row2=mysqli_num_rows($result2);

  
    if($num_row2>0){
        do{
            $campana_reach .= muestra_campanas_activas($num_row2, $row2 ,$result2 , $mysqli, $persona_id);
        }while ($row2=mysqli_fetch_array($result2));
            return $campana_reach;
    }
    
    

}




?>