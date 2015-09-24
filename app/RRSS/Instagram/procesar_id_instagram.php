<?php 
$instagramId =$_POST['instagramId'];
$accessToken = $_POST['accessToken'];
$json_user_url ="https://api.instagram.com/v1/users/".$instagramId."?access_token=".$accessToken;
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$followers = $links_user_url->data->counts->followed_by;
echo "el id del usuario es :".$instagramId."  sus seguidores son :  ".$followers." con accessToken : ".$accessToken;

/*INSERCIÓN DE LOS DATOS EN LA BASE DE DATOS*/


?>