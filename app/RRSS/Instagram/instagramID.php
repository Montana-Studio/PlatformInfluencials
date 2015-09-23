<?php 

$json_url="https://api.instagram.com/v1/users/search?q=nibaldoperot89&client_id=4c1a45981cee4ec5b742e05ebb8b00b8";
$json = file_get_contents($json_url);
$links = json_decode($json);
$id = $links->data[0]->id;
//$id = $links->data[0]->id;
echo 'Instagram ID : '.$id;

$json_user_url ="https://api.instagram.com/v1/users/".$id."?access_token=2007022744.1fb234f.e3f7b3e1ae1645b3a38df74d87986941";

//https://api.instagram.com/v1/users/2007022744
$json_user= file_get_contents($json_user_url);
$links_user_url= json_decode($json_user);
$followers = $links_user_url->data->counts->followed_by;

echo "  sus seguidores son :  ".$followers;
?>