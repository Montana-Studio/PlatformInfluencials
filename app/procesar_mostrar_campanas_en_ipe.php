<?php
    include('rrss/rrss_keys.php');
    $query="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."'";
    $result=mysqli_query($mysqli,$query)or die (mysqli_error());
    $row= mysqli_fetch_array($result, MYSQLI_BOTH);
    $num_row=mysqli_num_rows($result);

    $query2="SELECT DISTINCT id_campana FROM solicitudes WHERE id_influenciador='".$_SESSION['id']."' AND estado_solicitud='1'";
    $result2=mysqli_query($mysqli,$query2)or die (mysqli_error());
    $row2= mysqli_fetch_array($result2, MYSQLI_BOTH);
    $num_row2=mysqli_num_rows($result2);

    if($num_row2>0){
        $query3="SELECT DISTINCT * FROM campana WHERE id=".$row2[0]." AND idEstado='1' AND  fecha_inicio_server <= date(now())";
        $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
        $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
        $num_row3=mysqli_num_rows($result3);

        do{	
            $campanas_activas .= '';
            $rrss_list = explode(",",$row3[11]);
            $cantidad_redes_sociales = count($rrss_list)-1;
            $i=0;

            if ($num_row3 > 0 && $cantidad_redes_sociales>0){
                do{
                    $campanas_activas .= '<h2 class="sub-titulo">Iniciadas</h2>
                    <div class="creadas">
                        <div class="recientes">
                            <div class="cont-campana">
                                <div class="bg-campana" style="background-image:url('.$row3[3].');">
                                    <h3>'.$row3[1].'<span>by '.$row3[4].'</span></h3>
                                </div>

                                <div class="ver-mas">
                                    <span>
                                        <i class="fa"></i>
                                    </span>
                                </div>
                                <div class="content">
                                    <div class="btn_close"><span><i class="pi pi-close"></i></span></div>

                                    <form class="campanaForm" id="'.$row3[0].'">

                                        <!--div class="inputs-campana nombre nombre-campana" id="'.$row3[0].'">
                                            <input placeholder="'.$row3[1].'" disabled />
                                        </div>

                                        <div class="inputs-campana marca marca-campana" id="'.$row3[0].'">
                                            <input  placeholder="by '.$row3[4].'" disabled />
                                        </div-->
                                        <span class="campa-ico activada"><i class="pi pi-tool"></i>Activada</span>

                                        <span class="campa-ico fecha-activada">
                                            <i class="pi pi-calendar"> Inicio </i><span>'.$row3[7].'</span> al <span>'.$row3[8].'</span>
                                        </span>

                                        <div class="inputs-campana descripcion descripcion-campana" id="'.$row3[0].'">
                                            <textarea placeholder="descripcion" disabled>'.$row3[2].'</textarea>
                                        </div>

                                        <div class="ingresar_urls" id="'.$row3[0].'">
                                            <h2 class="sub-titulo">Ingresa tus URLs marcadas</h2>';

                                        do{
                                            $query4="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND id_estado='1' AND  descripcion_rrss='".$rrss_list[$i]."'";
                                            $result4=mysqli_query($mysqli,$query4)or die (mysqli_error());
                                            $row4= mysqli_fetch_array($result4, MYSQLI_BOTH);
                                            $num_row4=mysqli_num_rows($result4);
                                            do{
                                                if($row4[2]=='facebook'){
                                                    $facebookPage=$row4[3];
                                                    $facebookKey =FACEBOOK_CONSUMER_KEY;
                                                    $facebookAppId = FACEBOOK_APP_ID;
                                                    $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
                                                    $json_user_url = str_replace(" ", "%20", $json_user_url1);
                                                    $json_user= file_get_contents($json_user_url);
                                                    $links_user_url= json_decode($json_user);
                                                    $facebookWebsite =$links_user_url->website;
                                                    //Muestro URL Ingresada
                                                    $query_url_facebook ="SELECT * FROM campanarrss WHERE descripcion_rrss='facebook' AND rrss_id='".$row4[3]."'";
                                                    $result_url_facebook = mysqli_query($mysqli,$query_url_facebook);
                                                    $row_url_facebook= mysqli_fetch_array($result_url_facebook, MYSQLI_BOTH);
                                                    $num_rows_url_facebook=mysqli_num_rows($result_url_facebook);
                                                    //echo $row_url_facebook[0];
                                                    if($num_rows_url_facebook>0){
                                                        $campanas_activas .= '
                                                        <div class="rrss" name="facebook" >
                                                            <i class="pi pi-facebook"></i>
                                                            <span>['.$facebookWebsite.']</span>
                                                            <input id="'.$row4[3].'" value="'.$row_url_facebook['url'].'" disabled/>
                                                        </div>';
                                                    }else{
                                                        $campanas_activas .=  '
                                                        <div class="rrss" name="facebook" >
                                                            <i class="pi pi-facebook"></i>
                                                            <span>['.$facebookWebsite.']</span>
                                                            <input id="'.$row4[3].'"/>
                                                        </div>';				
                                                    }
                                                }
                                                if($row4[2]=='instagram'){
                                                  $json_user_url ="https://api.instagram.com/v1/users/".$row4[3]."?access_token=".$row4[6];
                                                  $json_user= file_get_contents($json_user_url);
                                                  $links_user_url= json_decode($json_user);
                                                  $username_instagram = $links_user_url->data->username;

                                                   //Muestro URL Ingresada
                                                    $query_url_instagram ="SELECT * FROM campanarrss WHERE descripcion_rrss='instagram' AND rrss_id='".$row4[3]."'";
                                                    $result_url_instagram = mysqli_query($mysqli,$query_url_instagram);
                                                    $row_url_instagram= mysqli_fetch_array($result_url_instagram, MYSQLI_BOTH);
                                                    $num_rows_url_instagram=mysqli_num_rows($result_url_instagram);
                                                    //echo $row_url_instagram[0];
                                                    if($num_rows_url_instagram>0){
                                                        $campanas_activas .= '
                                                        <div class="rrss" name="instagram" ">
                                                            <i class="pi pi-instagram"></i>
                                                            <span>['.$username_instagram.']</span>
                                                            <input id="'.$row4[3].'" value="'.$row_url_instagram['url'].'" disabled/>
                                                        </div>';
                                                    }else{
                                                        $campanas_activas .=  '
                                                        <div class="rrss" name="instagram" ">
                                                            <i class="pi pi-instagram"></i>
                                                            <span>['.$username_instagram.']</span>
                                                            <input id="'.$row4[3].'"/>
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
                                                    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
                                                    $requestMethod = 'GET';
                                                    $usuario1 = $row4[3];
                                                    $getfield1 = '?id='.$usuario1;
                                                    $twitter1 = new TwitterAPIExchange($settings);
                                                    $follow_count1=$twitter1->setGetfield($getfield1)
                                                    ->buildOauth($ta_url, $requestMethod)
                                                    ->performRequest();
                                                    $data1 = json_decode($follow_count1, true);
                                                    //$followers_count1=$data1[0]['user']['followers_count'];
                                                    $username_twitter=$data1[0]['user']['screen_name'];

                                                    //Muestro URL Ingresada
                                                    $query_url_twitter ="SELECT * FROM campanarrss WHERE descripcion_rrss='twitter' AND rrss_id='".$row4[3]."'";
                                                    $result_url_twitter = mysqli_query($mysqli,$query_url_twitter);
                                                    $row_url_twitter= mysqli_fetch_array($result_url_twitter, MYSQLI_BOTH);
                                                    $num_rows_url_twitter=mysqli_num_rows($result_url_twitter);
                                                    if($num_rows_url_twitter>0){
                                                        $campanas_activas .= '
                                                        <div class="rrss" name="twitter">
                                                            <i class="pi pi-twitter"></i>
                                                             <span>['.$username_twitter.']</span>
                                                            <input id="'.$row4[3].'" value="'.$row_url_twitter['url'].'"  disabled/>
                                                        </div>';
                                                    }else{
                                                        $campanas_activas .=  '
                                                        <div class="rrss" name="twitter">
                                                            <i class="pi pi-twitter"></i>
                                                            <span>['.$username_twitter.']</span>
                                                            <input id="'.$row4[3].'"/>
                                                        </div>';
                                                    }


                                                }
                                                if($row4[2]=='youtube'){
                                                    $googleplusKey =GOOGLE_CONSUMER_KEY;
                                                    $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row4[3]."&key=".$googleplusKey;
                                                    $json_user= file_get_contents($json_user_url);
                                                    $links_user_url= json_decode($json_user);
                                                    $youtubeName = $links_user_url->items[0]->snippet->title;
                                                    //Muestro URL Ingresada
                                                    $query_url_youtube ="SELECT * FROM campanarrss WHERE descripcion_rrss='youtube' AND rrss_id='".$row4[3]."'";
                                                    $result_url_youtube = mysqli_query($mysqli,$query_url_youtube);
                                                    $row_url_youtube= mysqli_fetch_array($result_url_youtube, MYSQLI_BOTH);
                                                    $num_rows_url_youtube=mysqli_num_rows($result_url_youtube);
                                                    if($num_rows_url_youtube>0){
                                                        $campanas_activas .= '
                                                        <div class="rrss" name="youtube">
                                                            <i class="pi pi-youtube"></i>
                                                            <span>['.$youtubeName.']</span>
                                                            <input id="'.$row4[3].'" value="'.$row_url_youtube['url'].'"  disabled/>
                                                        </div>';
                                                    }else{
                                                        $campanas_activas .=  '
                                                        <div class="rrss" name="youtube">
                                                            <i class="pi pi-youtube"></i>
                                                            <span>['.$youtubeName.']</span>
                                                            <input id="'.$row4[3].'"/>
                                                        </div>';
                                                    }
                                                }
                                                if($row4[2]=='googleplus'){
                                                    $googleplusKey =GOOGLE_CONSUMER_KEY;
                                                    $googleplusId = $row4[3];
                                                    $json_user_url ="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
                                                    $json_user= file_get_contents($json_user_url);
                                                    $links_user_url= json_decode($json_user);
                                                    $googleplusName =$links_user_url->displayName;
                                                    //Muestro URL Ingresada
                                                    $query_url_googleplus ="SELECT * FROM campanarrss WHERE descripcion_rrss='googleplus' AND rrss_id='".$row4[3]."'";
                                                    $result_url_googleplus = mysqli_query($mysqli,$query_url_googleplus);
                                                    $row_url_googleplus= mysqli_fetch_array($result_url_googleplus, MYSQLI_BOTH);
                                                    $num_rows_url_googleplus=mysqli_num_rows($result_url_googleplus);
                                                    $campanas_activas.=$num_rows_url_googleplus;
                                                    //echo $row_url_instagram[0];
                                                    if($num_rows_url_googleplus>0){
                                                        $campanas_activas.="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
                                                        $campanas_activas .= '
                                                        <div class="rrss" name="googleplus">
                                                            <i class="pi pi-googleplus"></i>
                                                            <span>['.$googleplusName.']</span>
                                                            <input id="'.$row4[3].'" value="'.$row_url_googleplus['url'].'"  disabled/>
                                                        </div>';
                                                    }else{
                                                        $campanas_activas .=  '
                                                        <div class="rrss" name="googleplus">
                                                            <i class="pi pi-googleplus"></i>
                                                            <span>['.$googleplusName.']</span>
                                                            <input id="'.$row4[3].'"/>
                                                        </div>';
                                                    }
                                                }


                                            }while($row4 = mysqli_fetch_row($result4));

                                            $query9="SELECT DISTINCT * FROM Analytics WHERE persona_id='".$_SESSION['id']."' AND id_estado='1' ORDER BY PVMBL DESC";
                                            $result9=mysqli_query($mysqli,$query9)or die (mysqli_error());
                                            $row9= mysqli_fetch_array($result9, MYSQLI_BOTH);
                                            $num_row9=mysqli_num_rows($result9);
                                            do{
                                                if($rrss_list[$i]=='analytics' && $num_row9>0){
                                                    //Muestro URL Ingresada
                                                    $query_url_analytics ="SELECT * FROM campanarrss WHERE descripcion_rrss='analytics' AND rrss_id='".$row9[4]."'";
                                                    $result_url_analytics = mysqli_query($mysqli,$query_url_analytics);
                                                    $row_url_analytics= mysqli_fetch_array($result_url_analytics, MYSQLI_BOTH);
                                                    $num_rows_url_analytics=mysqli_num_rows($result_url_analytics);
                                                    if($num_rows_url_analytics>0){

                                                        $campanas_activas .= '
                                                        <div class="rrss" name="analytics" >
                                                            <i class="pi pi-analytics"></i>
                                                            <span>['.$row9[6].']</span>
                                                            <input id="'.$row9[4].'" value="'.$row_url_analytics['url'].'"  disabled/>
                                                        </div>';
                                                    }else{
                                                        $campanas_activas .= '
                                                        <div class="rrss" name="analytics">
                                                            <i class="pi pi-analytics"></i>
                                                            <span>['. $row9[6].']</span>
                                                            <input id="'.$row9[4].'"/>
                                                        </div>';
                                                    }
                                                }
                                            }while($row9 = mysqli_fetch_array($result9));	
                                            $i++;
                                        }while($i<count($rrss_list));

                                        $campanas_activas .= '
                                            <button type="submit" id="enviar_url" class="btns">Enviar URLs</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                }while($row3 = mysqli_fetch_row($result3));
                $campanas_activas .= '';
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

                                    <span class="campa-ico"><i class="pi pi-calendar"> Inicio'.$row6[7].'- Término '.$row6[8].'</i></span>
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

                                    <span><i class="pi pi-calendar"> Inicio'.$row5[7].'- Término '.$row5[8].'</i></span>
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

            }
        }while($row2 = mysqli_fetch_row($result2));

    }else{
        $campanas_activas = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="pi pi-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';
        $campanas_inactivas = '';
        $campanas_historial = '<main class="no-campana"><a href="#" class="hrefCamp"><i class="pi pi-suitcase"></i><h2>sin campañas para mostrar</h2><p>Para empezar a administrar tus campañas, primero debes ser asignado a una.Mejora tu perfil si estas no llegan.</p></a></main>';
    }
?>
