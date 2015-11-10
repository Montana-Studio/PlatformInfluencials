<?php
require('../../conexion.php');

$instagramId =$_POST['instagramId'];
$accessToken = $_POST['accessToken'];
$id_persona = $_SESSION['id'];
$json_user_url ="https://api.instagram.com/v1/users/".$instagramId."?access_token=".$accessToken;
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$followers_instagram = $links_user_url->data->counts->followed_by;
$results1 = $mysqli->query("SELECT rrss_id FROM rrss WHERE rrss_id='$instagramId' AND persona_id='$_SESSION['id']'  AND descripcion_rrss='instagram'");
$num_row1=mysqli_num_rows($results1);

if($num_row1 < 1){
	$results2 = $mysqli->query("INSERT INTO rrss (rrss,descripcion_rrss,rrss_id,persona_id,access_token) VALUES ('$nombre','instagram','$instagramId','$id_persona','$accessToken')");
}

echo $followers_instagram;

?>
