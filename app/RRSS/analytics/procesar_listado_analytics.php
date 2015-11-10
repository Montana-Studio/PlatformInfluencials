<?php

$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8');
//if($_POST['tipo'] == 'agregaListado'){
$account =$_POST['account'];
$webProperty=$_POST['webProperty'];
$profile=$_POST['profile'];

$pn=$_POST['pn'];
$pv=$_POST['pv'];
$ss=$_POST['ss'];
$ssd=$_POST['ssd'];
$pvps=$_POST['pvps'];
$upv=$_POST['upv'];
$atp=$_POST['atp'];
$sspu=$_POST['sspu'];

if($_POST['tipo']=='inscripcion'){
  $results= $mysqli->query("SELECT profile_id FROM Analytics WHERE profile_id='$profile'");
  $num_rows= mysqli_num_rows($results);

  if($num_rows<1){
   $results2 = $mysqli->query("INSERT INTO Analytics (account_id,webProperty_id,profile_id,PN,PV,SS,SSD,PVPSS,UPV,ATP,SSPU) VALUES ('$account','$webProperty','$profile','$pn','$pv','$ss','$ssd','$pvps','$upv','$atp','$sspu')");
  // echo 'registro exitoso';
 /* $json_user_url ="https://www.googleapis.com/analytics/v3/data/ga?ids=ga%3A".$profile."&start-date=30daysAgo&end-date=yesterday&metrics=ga%3Apageviews";
  $json_user= file_get_contents($json_user_url);
  $links_user_url= json_decode($json_user);

  $analyticsSubscribers = $links_user_url->response;
  echo $analyticsSubscribers;*/
  }
}
/*
if($_POST['tipo']== 'inscripcion'){

 	$results2 = $mysqli->query("INSERT INTO rrss (rrss,descripcion_rrss,rrss_id,id_estado) VALUES ('$name','analytics','$id','0')");

	//channelSubscribers = response.items[0].statistics.subscriberCount;
	$visits = $links_user_url->rows[0];
	echo $visits;
}
*/
?>