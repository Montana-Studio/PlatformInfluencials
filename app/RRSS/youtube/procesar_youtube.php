<?php
require('../../conexion.php');
$youtubeId =$_POST['youtubeId'];
$key=$_POST['key'];
$id_persona = $_SESSION['id'];

$json_user_url ="https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$youtubeId."&fields=items/statistics/subscriberCount&key=AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c";
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$subscribers = $links_user_url->items[0]->statistics->subscriberCount;
$results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$youtubeId' AND descripcion_rrss='youtube' AND persona_id=".$_SESSION['id']);
$num_row1=mysqli_num_rows($results1);

if($num_row1 < 1){
	$results2 = $mysqli->query("INSERT INTO rrss (descripcion_rrss,rrss_id,persona_id) VALUES ('youtube','$youtubeId','$id_persona')");
}

else{
	$results2 = $mysqli->query("SELECT * FROM rrss WHERE rrss_id='$youtubeId' AND descripcion_rrss='youtube' AND persona_id='$id_persona'");
	$num_row2=mysqli_num_rows($results2);
	if($num_row2>0)echo 'registrado';
	else echo 'otro';
}



?>