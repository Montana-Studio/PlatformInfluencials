<?php
include('header.php');
require('rrss/rrss_keys.php');

/****************************************************************************************************
                GET INSTAGRAM REACH
****************************************************************************************************/
  $query3='SELECT DISTINCT * FROM rrss WHERE persona_id="'.$row[0].'" AND descripcion_rrss="instagram" AND id_estado=1';
  $result3=mysqli_query($mysqli,$query3)or die (mysqli_error($mysqli));
  $row3= mysqli_fetch_array($result3, MYSQLI_BOTH);
  $num_row3= mysqli_num_rows($result3);
  $_SESSION['instagram']="";
  if($num_row3>0){
    do{
      echo 'holi';
      include_once('rrss/Instagram/instagram.php');
      $json_user_url ="https://api.instagram.com/v1/users/".$row3[3]."?access_token=".$row3[6];
      $json_user= file_get_contents($json_user_url);
      $links_user_url= json_decode($json_user);
      $followers_instagram = $links_user_url->data->counts->followed_by;
      $username = $links_user_url->data->username;
      $avatar = $links_user_url->data->profile_picture;
      if ($row3[5] == 1){
        $suma_instagram+=$followers_instagram;
      }
     $_SESSION['instagram'] .=
      "<div class='red-info'>
        <h3>".$username."</h3>
        <ul>
          <li><img src='".$avatar."'/></li>
          <li>Followers<br><span>".formato_numeros_reachs($followers_instagram)."</span></li>
        </ul>
      </div>";
    }while($row3 = $result3->fetch_array());
      $suma += $suma_instagram;
  }
/****************************************************************************************************
                  TWITTER BUTTON AND GET REACH SUM
****************************************************************************************************
$query4='SELECT DISTINCT * FROM rrss WHERE persona_id="'.$row[0].'" AND descripcion_rrss="twitter" AND id_estado=1';
    $result4=mysqli_query($mysqli,$query4)or die (mysqli_error($mysqli));
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
        if($row4[5] == 1 ){
          $suma_twitter+= $followers_count1;
        }
        $_SESSION['twitter'] .="
        <div class='red-info'>
          <h3>".$username."</h3>
          <ul>
            <li><img src='".$avatar."'/></li>
            <li>Followers<br><span>".formato_numeros_reachs($followers_count1)."</span></li>
          </ul>
        </div>";
        $_SESSION['twitter'] .= $text;
        $text="";
      }while($row4 = $result4->fetch_array());
        $suma += $suma_twitter;
    }

/****************************************************************************************************
            YOUTUBE  GET REACH SUM
****************************************************************************************************
    $query5='SELECT DISTINCT * FROM rrss WHERE persona_id="'.$row[0].'" AND descripcion_rrss="youtube" AND id_estado=1';
    $result5=mysqli_query($mysqli,$query5)or die (mysqli_error($mysqli));
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
  
        $_SESSION['youtube'] .="
        <div class='red-info'>
          <h3>".$youtubeName."</h3>
          <ul>
            <li><img src='".$youtubeImgUrl."'/></li>
            <li>Suscriptos<br><span>".formato_numeros_reachs($youtubeSubscribers)."</span></li>
          </ul>
        </div>";
      }while($row5 = $result5->fetch_array());
    }
    $suma += $suma_youtube;
    $results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$youtubeId' AND descripcion_rrss='youtube'");
    $num_row1=mysqli_num_rows($results1);

/****************************************************************************************************
                FACEBOOK GET REACH SUM
****************************************************************************************************
    $query6='SELECT DISTINCT * FROM rrss WHERE persona_id="'.$row[0].'" AND descripcion_rrss="facebook" AND id_estado=1';
    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error($mysqli));
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

        if((int)$facebookLikes>0){
          $_SESSION['facebook'] .="
            <div class='red-info'>
            <h3>".$facebookUsername."</h3>
            <ul>
              <li><img src='".$facebookImgUrl."'/></li>
              <li>Likes <br/><span>".formato_numeros_reachs($facebookLikes)."</span></li>
              <li>Gente hablando <br/><span>".formato_numeros_reachs(intval($facebookTalkingAbout))."</span></li>
            </ul>
            </div>";
        }
        } else {
          // fail
        }
      }while($row6 = $result6->fetch_array());
        $suma += $suma_facebook;
    }

/****************************************************************************************************
            GOOGLEPLUS  GET REACH SUM
****************************************************************************************************
    $query7='SELECT DISTINCT * FROM rrss WHERE persona_id="'.$row[0].'" AND descripcion_rrss="googleplus" AND id_estado=1';
    $result7=mysqli_query($mysqli,$query7)or die (mysqli_error($mysqli));
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
        if((int)$googleplusSubscriber>0){
          $_SESSION['googleplus'] .="
          <div class='red-info'>
            <h3>".$googleplusName."</h3>
            <ul>
              <li>Followers<br><span>".formato_numeros_reachs($googleplusSubscriber)."</span></li>
            </ul>
          </div>";
        }

      }while($row7 = $result7->fetch_array());
      $suma += $suma_googleplus;
    }
/****************************************************************************************************
            ANALYTICS  GET REACH SUM
****************************************************************************************************
    $query8='SELECT DISTINCT * FROM rrss WHERE persona_id="'.$row[0].'" AND descripcion_rrss="analytics" AND id_estado=1';
    $result8=mysqli_query($mysqli,$query8)or die (mysqli_error($mysqli));
    $row8= mysqli_fetch_array($result8, MYSQLI_BOTH);
    $num_row8=mysqli_num_rows($result8);

    
    $query9='SELECT DISTINCT * FROM Analytics WHERE persona_id=".$row[0]." AND id_estado=1 ORDER BY PVMBL DESC';
    $result9=mysqli_query($mysqli,$query9)or die (mysqli_error($mysqli));
    $row9= mysqli_fetch_array($result9, MYSQLI_BOTH);
    $num_row9=mysqli_num_rows($result9);

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
                <li>PageView x Usuario <br> <span>".$row9[10]."</span></li>
                <li>Tiempo en la pagina <br> <span>".$row9[12]."</span></li>
                <li>Sesiones x Usuario <br> <span>".$row9[13]."</span></li>
              </ul>

              <h4>Mobile</h4>
              <div id='chartContainerMobile".$variable."' style='width:100%;margin:0 auto;'></div>
              <ul>
                <li>Page Views Per User <br> <span>".$row9[17]."</span></li>
                <li>Tiempo en la pagina <br> <span>".$row9[19]."</span></li>
                <li>Sessions Per User <br> <span>".$row9[20]."</span></li>
              </ul>
              <br>
              <h4>Tablet</h4>
              <div id='chartContainerTablet".$variable."' style='width:100%;margin:0 auto;'></div>
              <ul>
                <li>Page Views Per User <br> <span>".$row9[24]."</span></li>
                <li>Tiempo en la pagina <br> <span>".$row9[26]."</span></li>
                <li>Sessions Per User <br> <span>".$row9[27]."</span></li>
              </ul>
          </div>";
          $variable++;
      }while($row9 = $result9->fetch_array());
      $suma += $suma_analytics;
    }
    $variable--;
*/
?>
    
<?php
if($row){
  echo "<h2>Perfil de ".$row[5]."</h2>";
  echo "<img src='".$row[12]."' width='100' heigth='100' />";

  if($num_row6 > 0){
    echo '<div class="red-title"><i class="pi pi-facebook"></i> <span class="red-name">Facebook</span> <i class="pi pi-arrow-bottom"></i></div>
        <div class="rs-inscription">';
    echo '<div class="reach-total">facebook reach <span>'.formato_numeros_reachs($suma_facebook).'</span></div>';
    echo $_SESSION['facebook'];
    echo '</div>';
  } 
/*
  if($num_row3 > 0){
    echo '<div class="red-title"><i class="pi pi-instagram"></i> <span class="red-name">Instagram</span> <i class="pi pi-arrow-bottom"></i></div>
        <div class="rs-inscription">';
    echo '<div class="reach-total">instagram reach <span>'.formato_numeros_reachs($suma_instagram).'</span></div>';
    echo $_SESSION['instagram'];
    echo '</div>';
    }

  if($num_row4 > 0){
    echo '<div class="red-title"><i class="pi pi-twitter"></i> <span class="red-name">Twitter</span> <i class="pi pi-arrow-bottom"></i></div>
          <div class="rs-inscription">';
    echo '<div class="reach-total">twitter reach <span>'.formato_numeros_reachs($suma_twitter).'</span></div>';
    echo $_SESSION['twitter'];
    echo '</div>';
  }

  if($num_row9 > 0){
    echo '<div class="red-title"><i class="pi pi-analytics"></i> <span class="red-name">Analytics</span> <i class="pi pi-arrow-bottom"></i></div>
        <div class="rs-inscription">';
    echo '<div class="reach-total">
      analytics reach 
      <span>'.formato_numeros_reachs($suma_analytics).'</span>
    </div>';
    echo $_SESSION['analytics'];
    echo '</div>';
  }

  if($num_row5 > 0){
    echo '<div class="red-title"><i class="pi pi-youtube"></i> <span class="red-name">Youtube</span> <i class="pi pi-arrow-bottom"></i></div>
          <div class="rs-inscription">';
    echo '<div class="reach-total">youtube reach <span>'.formato_numeros_reachs($suma_youtube).'</span></div>';
    echo $_SESSION['youtube'];
    echo '</div>';
  }

  if($num_row7 > 0){
    echo '<div class="red-title"><i class="pi pi-googleplus"></i> <span class="red-name">Google Plus</span> <i class="pi pi-arrow-bottom"></i></div>
        <div class="rs-inscription">';
    echo '<div class="reach-total">google plus reach <span>'.formato_numeros_reachs($suma_googleplus).'</span></div>';
    echo $_SESSION['googleplus'];
    echo '</div>';
  }*/
}else{
  echo '<h2>Perfil no registrado</h2>';
}



?>
  
<?php
include('footer.php');
?>