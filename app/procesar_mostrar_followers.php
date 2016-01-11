
<?php
//include('rrss/rrss_keys.php');

    echo '<script async>
        $(document).ready(function(){

          $(".estado_rs").click(function(){
            if(this.value == "analytics"){
                var id_activar_rs = this.id;
                var tipo = "activar_rs2";
                var estado =parseInt(this.name);
                $.ajax({
                  type: "POST",
                  url: "./rrss/procesar_activar_rs.php",
                  data: "id_activar_rs="+id_activar_rs+"&estado="+estado+"&tipo="+tipo,
                  success: function(data){
                    window.location.reload("dashboard-ipe.php#fragment-2");
                  }
                });

            }else{
                var id_activar_rs = this.id;
                var tipo = "activar_rs";
                var estado =parseInt(this.name);
                $.ajax({
                  type: "POST",
                  url: "./rrss/procesar_activar_rs.php",
                  data: "id_activar_rs="+id_activar_rs+"&estado="+estado+"&tipo="+tipo,
                  success: function(data){
                    window.location.reload();
                  }
                });
            }

          });
        $(".elimina").click(function(){
           id_rrss = $(this).attr("name");
           tipo="desactivar";
           $.ajax({
                  type: "POST",
                  url: "./rrss/procesar_activar_rs.php",
                  data: "id_rrss="+id_rrss+"&tipo="+tipo,
                  success: function(data){
                    alert("cuenta desvinculada");
                    window.location.reload();
                  }
                });
        });
          
        });
      </script>';

    require('rrss/rrss_keys.php');
    
/****************************************************************************************************
                GET INSTAGRAM REACH
****************************************************************************************************/
  $query3="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='instagram' AND cuenta='1'";
  $result3=mysqli_query($mysqli,$query3)or die (mysqli_error());
  $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
  $num_row3= mysqli_num_rows($result3);
  $_SESSION['instagram']="";
  if($num_row3>0){
    do{
      include_once('rrss/Instagram/instagram.php');
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
     //$_SESSION['instagram'] .=$username." ".(int)$followers_instagram." <button class='estado_rs' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button><br/></h3><img src='".$avatar."'/>";
     $_SESSION['instagram'] .=
      "<div class='red-info'>
      <h3>".$username."</h3>
      <ul>
      <li><img src='".$avatar."'/></li>
      <li>Followers<br><span>".formato_numeros_reachs($followers_instagram)."</span></li>
      </ul>
      <!--button type='checkbox' class='btn".$estado_descripcion." estado_rs cmn-toggle' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button-->
      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
      <div class='onoffswitch'>
          <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row3[3]."'>
          <label class='btn".$estado_descripcion." switch-label' for='".$row3[3]."'></label>
      </div>
      <div class='onoffswitch'>
          <p name='".$row3[0]."' class='elimina'>elimina</p>
      </div>
      </div>";
    }while($row3 = $result3->fetch_array());
      $suma += $suma_instagram;
  }
/****************************************************************************************************
                  TWITTER BUTTON AND GET REACH SUM
****************************************************************************************************/
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
    $ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';
    $_SESSION['twitter']="";
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
    if($num_row4>0){
      do{
        include_once('rrss/twitter/inc/twitteroauth.php');
        include_once('rrss/twitter/inc/TwitterAPIExchange.php');
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
          $suma_twitter+= $followers_count1;
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
            <li>Followers<br><span>".formato_numeros_reachs($followers_count1)."</span></li>
          </ul>
          <!--button type='checkbox' class='btn".$estado_descripcion." estado_rs cmn-toggle' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button-->
          <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
          <div class='onoffswitch'>
              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row4[3]."'>
              <label class='btn".$estado_descripcion." switch-label' for='".$row4[3]."'></label>
          </div>
          <div class='onoffswitch'>
            <p name='".$row4[0]."' class='elimina'>elimina</p>
          </div>
        </div>";
        
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
            $dateDiff = $interval->m." Meses";
          }else if(intval($interval->d)>0){
            $dateDiff = $interval->d." Días";
          }else if(intval($interval->h)>0){
            $dateDiff = $interval->h." Horas";
          }
          else if(intval($interval->m)>0){
            $dateDiff = $interval->i." Minutos";
          }
          $tweet = $data1[$i]['text'];
          //Convert urls to <a> links
          $tweet = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $tweet);
          //Convert hashtags to twitter searches in <a> links
          $tweet = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_blank\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $tweet);
          //Convert attags to twitter profiles in &lt;a&gt; links
          $tweet = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a target=\"_blank\" href=\"http://www.twitter.com/$1\">@$1</a>", $tweet);
          $text.="
          <div class='twitt-content'>
          
            <div>".$tweet."</div>
            <ul>
              <li>
                <i class='fa fa-retweet'></i> ".$data1[$i]['retweet_count']."
              </li>
              <li>
                <i class='fa fa-heart'></i>".$data1[$i]['favorite_count']."
              </li>
              <li>
                <i class='fa fa-calendar'></i>".$dateDiff."
              </li>
            </ul>
            </div>";
        }
        $_SESSION['twitter'] .= $text;
        $text="";
      }while($row4 = $result4->fetch_array());
        $suma += $suma_twitter;
    }



/****************************************************************************************************
            YOUTUBE  GET REACH SUM
****************************************************************************************************/
    $query5="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='youtube' AND cuenta='1'";
    $result5=mysqli_query($mysqli,$query5)or die (mysqli_error());
    $row5= mysqli_fetch_array($result5, MYSQLI_BOTH);
    $num_row5=mysqli_num_rows($result5);
    $_SESSION['youtube']="";
    if($num_row5>0){
      do{
        include_once('rrss/youtube/auth.php');
        $json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=".$row5[3]."&key=".GOOGLE_CONSUMER_KEY;
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
        $_SESSION['youtube'] .="
        <div class='red-info'>
        <h3>".$youtubeName."</h3>
        <ul>
        <li><img src='".$youtubeImgUrl."'/></li>
        <li>Suscriptos<br><span>".formato_numeros_reachs($youtubeSubscribers)."</span></li>
        </ul>
        <!--button class='estado_rs' name='".$estado."' id='".$row5[3]."'>".$estado_descripcion."</button-->
       <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
          <div class='onoffswitch'>
              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$row5[3]."'>
              <label class='btn".$estado_descripcion." switch-label' for='".$row5[3]."'></label>
          </div>
          <div class='onoffswitch'>
            <p name='".$row5[0]."' class='elimina'>elimina</p>
          </div>
        </div>";
      }while($row5 = $result5->fetch_array());
    }
    $suma += $suma_youtube;
    $results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$youtubeId' AND descripcion_rrss='youtube'");
    $num_row1=mysqli_num_rows($results1);

/****************************************************************************************************
                FACEBOOK GET REACH SUM
****************************************************************************************************/
    $query6="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='facebook' AND cuenta='1'";
    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
    $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
    $num_row6=mysqli_num_rows($result6);
    $facebookKey =FACEBOOK_CONSUMER_KEY;
    $facebookAppId = FACEBOOK_APP_ID;
    $_SESSION['facebook']="";
    if($num_row6>0){
      do{

        include_once('rrss/facebook/facebook-auth.php');
        $facebookPage = $row6[3];
        $json_user_url1 ="https://graph.facebook.com/".$facebookPage."?access_token=".$facebookAppId."|".$facebookKey."&fields=likes,talking_about_count,username,website";
        $json_user_url = str_replace(" ", "%20", $json_user_url1);
        $json_user= @file_get_contents($json_user_url);
        $links_user_url= json_decode($json_user);

        if ($json_user) {
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
          $_SESSION['facebook'] .="
            <div class='red-info'>
            <h3>".$facebookUsername."</h3>
            <ul>
            <li><img src='".$facebookImgUrl."'/></li>
            <li>Likes <br/><span>".formato_numeros_reachs($facebookLikes)."</span></li>
            <li>Gente hablando <br/><span>".formato_numeros_reachs(intval($facebookTalkingAbout))."</span></li>
            <!--li><a href=".$facebookWebsite.">ver sitio</a></li-->
            </ul>
            <!--button class='estado_rs' name='".$estado."' id='".$facebookPage."'>".$estado_descripcion."</button-->
            <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
            <div class='onoffswitch'>
                <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$facebookPage."'>
                <label class='btn".$estado_descripcion." switch-label' for='".$facebookPage."'></label>
            </div>
            <div class='onoffswitch'>
              <p name='".$row6[0]."' class='elimina'>elimina</p>
 
            </div>
            </div>";
        }
        } else {
          // fail
        }
        /*
        
*/
      }while($row6 = $result6->fetch_array());
        $suma += $suma_facebook;
    }

/****************************************************************************************************
            GOOGLEPLUS  GET REACH SUM
****************************************************************************************************/
    $query7="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='googleplus' AND cuenta='1'";
    $result7=mysqli_query($mysqli,$query7)or die (mysqli_error());
    $row7= mysqli_fetch_array($result7, MYSQLI_BOTH);
    $num_row7=mysqli_num_rows($result7);

    $googleplusKey =GOOGLE_CONSUMER_KEY;
    $_SESSION['googleplus']="";
    if($num_row7>0){
      do{
        include_once('rrss/googleplus/auth.php');
        $googleplusId = $row7[3];
        $json_user_url ="https://www.googleapis.com/plus/v1/people/".$googleplusId."?key=".$googleplusKey;
        $json_user_picture="https://www.googleapis.com/plus/v1/people/".$googleplusId."?fields=image&key=".$googleplusKey;

        $json_user= file_get_contents($json_user_url);
        $links_user_url= json_decode($json_user);
        $googleplusSubscriber =$links_user_url->circledByCount;
        $googleplusName =$links_user_url->displayName;

        $json_picture = file_get_contents($json_user_picture);
        $links_user_url2 = json_decode($json_picture);
        $picture = $links_user_url2->image->url;
        $pictureSize= "100";
        $googleplusImage=substr($picture,0,-2).$pictureSize;
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
          $_SESSION['googleplus'] .="
          <div class='red-info'>
          <h3>".$googleplusName."</h3>
          <ul>
          <li><img src='".$picture."'/></li>
          <li>Followers<br><span>".formato_numeros_reachs($googleplusSubscriber)."</span></li>
          </ul>
          <!--button class='estado_rs' name='".$estado."' id='".$googleplusId."'>".$estado_descripcion."</button-->
          <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
          <div class='onoffswitch'>
              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$googleplusId."'>
              <label class='btn".$estado_descripcion." switch-label' for='".$googleplusId."'></label>
          </div>
          <div class='onoffswitch'>
              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs switch-checkbox' id='".$googleplusId."'>
              <label class='btn".$estado_descripcion." switch-label' for='".$googleplusId."'></label>
          </div>
          <div class='onoffswitch'>
            <p name='".$row7[0]."' class='elimina'>elimina</p>
          </div>
          </div>";
        }

      }while($row7 = $result7->fetch_array());
      $suma += $suma_googleplus;
    }
/****************************************************************************************************
            ANALYTICS  GET REACH SUM
****************************************************************************************************/
    $query8="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='analytics' AND cuenta='1'";
    $result8=mysqli_query($mysqli,$query8)or die (mysqli_error());
    $row8= mysqli_fetch_array($result8, MYSQLI_BOTH);
    $num_row8=mysqli_num_rows($result8);

    
    $query9="SELECT DISTINCT * FROM Analytics WHERE persona_id=".$_SESSION['id']." ORDER BY PVMBL DESC";
    $result9=mysqli_query($mysqli,$query9)or die (mysqli_error());
    $row9= mysqli_fetch_array($result9, MYSQLI_BOTH);
    $num_row9=mysqli_num_rows($result9);

    //$googleplusKey ="AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
    //$json_query= json_encode($row9);
    

    $_SESSION["analytics"]="";
    if($num_row9>0){
      $variable=1;
      do{
        include('rrss/analytics/procesar_analytics.php');
        $r07= json_encode($row9[7]);
        $r08= json_encode($row9[8]);
        $r09= json_encode($row9[9]);
        $r10= json_encode($row9[10]);
        $r11= json_encode($row9[11]);
        $r12= json_encode($row9[12]);
        $r13= json_encode($row9[13]);
        $r14= json_encode($row9[14]);
        $r15= json_encode($row9[15]);
        $r16= json_encode($row9[16]);
        $r17= json_encode($row9[17]);
        $r18= json_encode($row9[18]);
        $r21= json_encode($row9[21]);
        $r22= json_encode($row9[22]);
        $r23= json_encode($row9[23]);
        $r24= json_encode($row9[24]);
        $r25= json_encode($row9[25]);
        
        $dias= intval(substr($r09, 1, -1)/86400)."d";

        if($dias == '0d') $dias ='';
         $horas=intval((substr($r09, 1, -1)%86400)/3600);
         $minutos=intval(((substr($r09, 1, -1)%86400)%3600)/60);
         $segundos=intval((((substr($r09, 1, -1)%86400)%3600)%60/60));
        
        if ($row9[3] == 0){
          $estado= 0;
          $estado_descripcion="activar";
        }else{
          $estado= 1;
          $estado_descripcion="desactivar";
        }

        if ($row9[3] == 1){
          $suma_analytics+=$row9[7]+$row9[14]+$row9[21];
        }

        $reach_page = $row9[7]+$row9[14]+$row9[21];

        $_SESSION['analytics'] .= "
          <div class='red-info secc-analytics'>
            <div class='tit-analytics'>
              <h3>".$row9[6]."</h3> <small>reach total</small>
            </div>
            <div class='reach-analytics'>".formato_numeros_reachs($reach_page)."</div>
              <script type='text/javascript'>
                google.load('visualization', '1', {packages:['corechart']});

                google.setOnLoadCallback(drawChart);

                function drawChart() {

                  var data = google.visualization.arrayToDataTable([
                    ['Metrics', 'Valor'],
                    ['PageViews', ".substr($r07, 1, -1)."],
                    ['Sessions', ".substr($r08, 1, -1)."],
                    ['U. PageViews', ".substr($r11, 1, -1)."]
                  ]);

                  var dataMobile = google.visualization.arrayToDataTable([
                    ['Metrics', 'Valor'],
                    ['PageViews', ".substr($r14, 1, -1)."],
                    ['Sessions', ".substr($r15, 1, -1)."],
                    ['U. PageViews', ".substr($r18, 1, -1)."]
                  ]);
                  
                  var dataTablet = google.visualization.arrayToDataTable([
                    ['Metrics', 'Valor'],
                    ['PageViews', ".substr($r21, 1, -1)."],
                    ['Sessions', ".substr($r22, 1, -1)."],
                    ['U. PageViews', ".substr($r25, 1, -1)."]
                  ]);

                  var options = {
                    title: 'My Daily Activities',
                    pieHole: 0.6,
                    'width':'100%',
                    tooltip:{trigger:'none'},
                    pieSliceText: 'value',
                    pieSliceTextStyle:{color:'#000',position:'left',fontSize:16},
                    chartArea:{left:'-50px',top:10,width:'100%',height:'75%'},
                    vAxis: {maxValue: 20},
                    colors: ['#3399cc', '#67b8de', '#91c9e8', '#b4dced'],
                    legend:{position: 'right', textStyle: {fontSize: 12}},
                    pieSliceBorderColor:'none',
                    fontName:'Montserrat'
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('chartContainer".$variable."'));
                  var chartMobile = new google.visualization.PieChart(document.getElementById('chartContainerMobile".$variable."'));
                  var chartTablet = new google.visualization.PieChart(document.getElementById('chartContainerTablet".$variable."'));

                  chart.draw(data, options);
                  chartMobile.draw(dataMobile, options);
                  chartTablet.draw(dataTablet, options);
                }
              </script>

              <h4>Desktop</h4>
              <div id='chartContainer".$variable."' style='width:100%;margin:0 auto;'></div>
              <ul>
                <!--li>Page Views <br> <span>".$row9[7]."</span></li-->
                <!--li>Sessions <br> <span>".$row9[8]."</span></li-->
                <!--li>Duracion Sesion <br> <span>".$dias." ".$horas.":".$minutos.":".$segundos."</span></li-->
                <li>PageView x Usuario <br> <span>".$row9[10]."</span></li>
                <!--li>Unique Page Views <br> <span>".$row9[11]."</span></li-->
                <li>Tiempo en la pagina <br> <span>".$row9[12]."</span></li>
                <li>Sesiones x Usuario <br> <span>".$row9[13]."</span></li>
              </ul>

              <h4>Mobile</h4>
              <div id='chartContainerMobile".$variable."' style='width:100%;margin:0 auto;'></div>
              <ul>
                <!--li>Page Views <br> <span>".$row9[14]."</span></li-->
                <!--li>Sessions <br> <span>".$row9[15]."</span></li-->
                <!--li>Session Duration <br> <span>".$row9[16]."</span></li-->
                <li>Page Views Per User <br> <span>".$row9[17]."</span></li>
                <!--li>Unique Page Views <br> <span>".$row9[18]."</span></li-->
                <li>Tiempo en la pagina <br> <span>".$row9[19]."</span></li>
                <li>Sessions Per User <br> <span>".$row9[20]."</span></li>
              </ul>
              <br>
              <h4>Tablet</h4>
              <div id='chartContainerTablet".$variable."' style='width:100%;margin:0 auto;'></div>
              <ul>
                <!--li>Page Views <br> <span>".$row9[21]."</span></li-->
                <!--li>Sessions <br> <span>".$row9[22]."</span></li-->
                <!--li>Session Duration <br> <span>".$row9[23]."</span></li-->
                <li>Page Views Per User <br> <span>".$row9[24]."</span></li>
                <!--li>Unique Page Views <br> <span>".$row9[25]."</span></li-->
                <li>Tiempo en la pagina <br> <span>".$row9[26]."</span></li>
                <li>Sessions Per User <br> <span>".$row9[27]."</span></li>
              </ul>

            <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
            <div class='onoffswitch'>
              <p name='".$row9[0]."' class='elimina'>elimina</p>
 
            </div>
          </div>";
          $variable++;
      }while($row9 = $result9->fetch_array());
      $suma += $suma_analytics;
    }
    $variable--;

?>
