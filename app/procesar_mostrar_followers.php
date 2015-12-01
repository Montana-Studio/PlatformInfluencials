<?php
    echo '<script>
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
                    window.location.reload();
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
     //$_SESSION['instagram'] .=$username." ".(int)$followers_instagram." <button class='estado_rs' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button><br/></h3><img src='".$avatar."'/>";
     $_SESSION['instagram'] .=
      "<div class='red-info'>
      <h3>".$username."</h3>
      <ul>
      <li><img src='".$avatar."'/></li>
      <li>Followers<br><span>".(int)$followers_instagram."</span></li>
      </ul>
      <!--button type='checkbox' class='btn".$estado_descripcion." estado_rs cmn-toggle' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button-->
      <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
      <div class='onoffswitch'>
          <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs onoffswitch-checkbox' id='".$row3[3]."'>
          <label class='btn".$estado_descripcion." onoffswitch-label' for='".$row3[3]."'></label>
      </div>
      </div>";
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
       
        $_SESSION['twitter'] .="
        <div class='red-info'>
        <h3>".$username."</h3>
        <ul>
        <li><img src='".$avatar."'/></li>
        <li>Followers<br><span>".(int)$followers_count1."</span></li>
        </ul>
        <!--button type='checkbox' class='btn".$estado_descripcion." estado_rs cmn-toggle' name='".$estado."' id='".$row3[3]."'>".$estado_descripcion."</button-->
        <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
        <div class='onoffswitch'>
            <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs onoffswitch-checkbox' id='".$row4[3]."'>
            <label class='btn".$estado_descripcion." onoffswitch-label' for='".$row4[3]."'></label>
        </div>
        </div>
        últimos tweets";
        
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
          $text.="
          <h3>".$data1[$i]['text']."</h3>
          <p>Retweet ".$data1[$i]['retweet_count']." - Favourites ".$data1[$i]['favorite_count']." - ".$dateDiff."</p>";
        }
        $_SESSION['twitter'] .= $text;
        $text="";
      }while($row4 = $result4->fetch_array());
        $suma += $suma_twitter;
    }

/****************************************************************************************************
            YOUTUBE  GET REACH SUM
****************************************************************************************************/
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
        $_SESSION['youtube'] .="
        <div class='red-info'>
        <h3>".$youtubeName."</h3>
        <ul>
        <li><img src='".$youtubeImgUrl."'/></li>
        <li>Suscriptos<br><span>".(int)$youtubeSubscribers."</span></li>
        </ul>
        <!--button class='estado_rs' name='".$estado."' id='".$row5[3]."'>".$estado_descripcion."</button-->
        <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
        <div class='onoffswitch'>
          <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs onoffswitch-checkbox' id='".$row3[3]."'>
          <label class='btn".$estado_descripcion." onoffswitch-label' for='".$row5[3]."'></label>
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
    $query6="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='facebook'";
    $result6=mysqli_query($mysqli,$query6)or die (mysqli_error());
    $row6= mysqli_fetch_array($result6, MYSQLI_BOTH);
    $num_row6=mysqli_num_rows($result6);
    $facebookKey ="693511c0b86cda985e20ba5a19f556c0";
    $facebookAppId = "979526535448353";
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
          $_SESSION['facebook'] .="
            <div class='red-info'>
            <h3>".$facebookUsername."</h3>
            <ul>
            <li><img src='".$facebookImgUrl."'/></li>
            <li>Likes <br/><span>".(int)$facebookLikes."</span></li>
            <li>Gente hablando <br/><span>".$facebookTalkingAbout."</span></li>
            <!--li><a href=".$facebookWebsite.">ver sitio</a></li-->
            </ul>
            <!--button class='estado_rs' name='".$estado."' id='".$facebookPage."'>".$estado_descripcion."</button-->
            <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
            <div class='onoffswitch'>
                <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs onoffswitch-checkbox' id='".$facebookPage."'>
                <label class='btn".$estado_descripcion." onoffswitch-label' for='".$facebookPage."'></label>
            </div>
            </div>";
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
          <li>Followers<br><span>".(int)$googleplusSubscriber."</span></li>
          </ul>
          <!--button class='estado_rs' name='".$estado."' id='".$googleplusId."'>".$estado_descripcion."</button-->
          <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
          <div class='onoffswitch'>
              <input type='checkbox' name='".$estado."' class='btn".$estado_descripcion." estado_rs onoffswitch-checkbox' id='".$googleplusId."'>
              <img src='".$picture."'/>
              <label class='btn".$estado_descripcion." onoffswitch-label' for='".$googleplusId."'></label>
          </div>
          </div>";
        }

      }while($row7 = $result7->fetch_array());
      $suma += $suma_googleplus;
    }
/****************************************************************************************************
            ANALYTICS  GET REACH SUM
****************************************************************************************************/
    $query8="SELECT DISTINCT * FROM rrss WHERE persona_id=".$_SESSION['id']." AND descripcion_rrss='analytics'";
    $result8=mysqli_query($mysqli,$query8)or die (mysqli_error());
    $row8= mysqli_fetch_array($result8, MYSQLI_BOTH);
    $num_row8=mysqli_num_rows($result8);

    
    $query9="SELECT DISTINCT * FROM Analytics WHERE persona_id=".$_SESSION['id']." ORDER BY PVMBL DESC";
    $result9=mysqli_query($mysqli,$query9)or die (mysqli_error());
    $row9= mysqli_fetch_array($result9, MYSQLI_BOTH);
    $num_row9=mysqli_num_rows($result9);

    //$googleplusKey ="AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
    //$json_query= json_encode($row9);
    $r07= json_encode($row9[7]);
    $r21= json_encode($row9[21]);
    $r14= json_encode($row9[14]);
    $r15= json_encode($row9[15]);
    $r08= json_encode($row9[8]);
    $r09= json_encode($row9[9]);
    $r10= json_encode($row9[10]);
    $r11= json_encode($row9[11]);
    $r17= json_encode($row9[17]);
    $r18= json_encode($row9[18]);
    $r16= json_encode($row9[16]);
    $r22= json_encode($row9[22]);
    $r23= json_encode($row9[23]);
    $r24= json_encode($row9[24]);
    $datas = '[["Dispositivo","PagesViews"],["Desktop" ,'.substr($r07, 1, -1).'],["Tablet" ,'.substr($r21, 1, -1).'],["Mobile",'.substr($r14, 1, -1).']]';
    //echo $json_query;

    $_SESSION["analytics"]="";
    if($num_row9>0){
      do{
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
          <div class='red-info'>
            <h3>".$row9[6]." reach total ".$reach_page."</h3>
            <script>
              google.load('visualization', '1', {packages:['corechart']});
              google.setOnLoadCallback(drawChart);
              function drawChart(){

                var data = google.visualization.arrayToDataTable([
                  ['Devices', 'PageView'],
                  ['Desktop',".substr($r07, 1, -1)."],
                  ['Tablet',      ".substr($r21, 1, -1)."],
                  ['Mobile',  ".substr($r14, 1, -1)."],
                ]);

                var data2 = google.visualization.arrayToDataTable([
                   ['Metrics', 'Desktop', 'Tablet', 'Mobile'],
                   ['Page Views',  ".substr($r07, 1,-1).",".substr($r21, 1,-1).",".substr($r14, 1,-1)."],
                   ['Sessions',  ".substr($r09, 1,-1).", ".substr($r22, 1,-1).",".substr($r15, 1,-1)."],
                   ['Session Duration',  ".substr($r10, 1,-1).",".substr($r23, 1,-1).", ".substr($r16, 1,-1)."],
                   ['Page Views Per User',  ".substr($r11, 1,-1).",".substr($r24, 1,-1).",".substr($r17, 1,-1)."],
                   ['Unique Page Views',  ".substr($r12, 1,-1).",".substr($r25, 1,-1).",".substr($r18, 1,-1)."]
                ]);
                

                var options = {
                  title:'false',
                  pieHole:0.6,
                  colors: ['#009dce', '#67b8de', '#91c9e8'],
                  tooltip: {trigger: 'none'},
                  legend: {position:'bottom',alignment:'left'},
                  charArea:{width:'100%',height:'100%'},
                  titlePosition: 'none'
                };
                var options2 = {
                  title : 'Monthly Coffee Production by Country',
                  vAxis: {title: 'Cups'},
                  hAxis: {title: 'Month'},
                  seriesType: 'bars',
                  series: {5: {type: 'line'}}
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                var chart2 = new google.visualization.ComboChart(document.getElementById('piecharts'));

                chart.draw(data, options);
                chart2.draw(data2, options2);
              }
              $(document).ready(function(){
                var ctx = $('#myChart').get(0).getContext('2d');
                var myLineChart = new Chart(ctx).Line(data, options);
                var data = {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [
                        {
                            label: 'My First dataset',
                            fillColor: 'rgba(220,220,220,0.2)',
                            strokeColor: 'rgba(220,220,220,1)',
                            pointColor: 'rgba(220,220,220,1)',
                            pointStrokeColor: '#fff',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: 'My Second dataset',
                            fillColor: 'rgba(151,187,205,0.2)',
                            strokeColor: 'rgba(151,187,205,1)',
                            pointColor: 'rgba(151,187,205,1)',
                            pointStrokeColor: '#fff',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(151,187,205,1)',
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
                var options = {

                    ///Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines : true,
                    //String - Colour of the grid lines
                    scaleGridLineColor : 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth : 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve : true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension : 0.4,

                    //Boolean - Whether to show a dot for each point
                    pointDot : true,

                    //Number - Radius of each point dot in pixels
                    pointDotRadius : 4,

                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth : 1,

                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius : 20,

                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke : true,

                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth : 2,

                    //Boolean - Whether to fill the dataset with a colour
                    datasetFill : true,

                    //String - A legend template
                    //legendTemplate : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].strokeColor%>\'></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'

                };
              });
            </script>

            <div id='piechart' style='width:100%;min-height:300px;margin:0 auto;'></div>
            <div id='piecharts' style='width:100%;min-height:300px;margin:0 auto;'></div>

            <ul>
              <div class='red-info'>
                <h5>Desktop</h5>

                <canvas id='myChart' width='400' height='400'></canvas>
                
                <ul>
                  <li>Page Views : <span></span>".$row9[7]."</li>
                  <li>Sessions : <span></span>".$row9[8]."</li>
                  <li>Session Duration : <span></span>".$row9[9]."</li>
                  <li>Page Views Per User : <span></span>".$row9[10]."</li>
                  <li>Unique Page Views : <span></span>".$row9[11]."</li>
                  <li>Average Time On Page : <span></span>".$row9[12]."</li>
                  <li>Sessions Per User : <span></span>".$row9[13]."</li>
                </ul>
              </div>
              <div class='red-info'>
                <h5>Mobile</h5>
                <ul>
                  <li>Page Views : <span></span>".$row9[14]."</li>
                  <li>Sessions : <span></span>".$row9[15]."</li>
                  <li>Session Duration : <span></span>".$row9[16]."</li>
                  <li>Page Views Per User : <span></span>".$row9[17]."</li>
                  <li>Unique Page Views : <span></span>".$row9[18]."</li>
                  <li>Average Time On Page : <span></span>".$row9[19]."</li>
                  <li>Sessions Per User : <span></span>".$row9[20]."</li>
                </ul>
              </div>
              <div class='red-info'>
                <h5>Tablet</h5>
                <ul>
                  <li>Page Views : <span></span>".$row9[21]."</li>
                </ul>
                <ul>
                  <li>Sessions : <span></span>".$row9[22]."</li>
                </ul>
                <!--ul>
                  <li>Session Duration : <span></span>".$row9[23]."</li>
                </ul-->
                <!--ul> 
                  <li>Page Views Per User : <span></span>".$row9[24]."</li>
                </ul-->
                <ul>
                  <li>Unique Page Views : <span></span>".$row9[25]."</li>
                </ul>
                <ul>
                  <li>Average Time On Page : <span></span>".$row9[26]."</li>
                </ul>
                <!--ul>
                  <li>Sessions Per User : <span></span>".$row9[27]."</li>
                </ul-->
              </div>

            </ul>
            <span class='txt-".$estado_descripcion."'>".$estado_descripcion."</span>
            <div class='onoffswitch'>
                <input type='checkbox' name='".$estado."' value='analytics' class='btn".$estado_descripcion." estado_rs onoffswitch-checkbox' id='".$row9[4]."'>
                <label class='btn".$estado_descripcion." onoffswitch-label' for='".$row9[4]."'></label>
            </div>
          </div>";
      }while($row9 = $result9->fetch_array());
      $suma += $suma_analytics;
    }

?>
