<?php

$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8');
//if($_POST['tipo'] == 'agregaListado'){
$id =$_POST['id'];
$name=$_POST['name'];
if($_POST['tipo']=='listado'){
  $results= $mysqli->query("SELECT id_analytics FROM Analytics WHERE id_analytics='$id'");
  $num_rows= mysqli_num_rows($results);

  if($num_rows<1){
   $results2 = $mysqli->query("INSERT INTO Analytics (id_analytics,name_webpage) VALUES ('$id','$name')");
   echo 'registro exitoso';
  }
}

if($_POST['tipo']== 'inscripcion'){

 	$results2 = $mysqli->query("INSERT INTO rrss (rrss,descripcion_rrss,rrss_id,id_estado) VALUES ('$name','analytics','$id','0')");
  	$json_user_url ="https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A.$id.&start-date=90daysAgo&end-date=today&metrics=ga%3Avisits&key=AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
	$json_user= file_get_contents($json_user_url);
	$links_user_url= json_decode($json_user);
	//channelSubscribers = response.items[0].statistics.subscriberCount;
	$visits = $links_user_url->rows[0];
	echo $visits;
}


/*
$json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$youtubeId."&fields=items/statistics/subscriberCount&key=AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
//channelSubscribers = response.items[0].statistics.subscriberCount;
$subscribers = $links_user_url->items[0]->statistics->subscriberCount;
$results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$youtubeId' AND descripcion_rrss='youtube'");
$num_row1=mysqli_num_rows($results1);*/

/*if($num_row1 < 1){
  $results2 = $mysqli->query("INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id) VALUES ('youtube','$youtubeId','$id_persona')");
}

echo $subscribers;
/*
else{
  echo "ya inscribió este perfil, favor intente con otro";
}
*/



//}

?>