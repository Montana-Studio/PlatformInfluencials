<?php 
//Get Facebook Likes Count of a page
function fbLikeCount($id,$appid,$appsecret){
  //Construct a Facebook URL
  $json_url ='https://graph.facebook.com/'.$id.'?access_token='.$appid.'|'.$appsecret.'&fields=likes';
  $json = file_get_contents($json_url);
  $json_output = json_decode($json);
 
  //Extract the likes count from the JSON object
  if($json_output->likes){
    return $likes = $json_output->likes;
  }else{
    return 0;
  }
}
//This Will return like count of CoffeeCupWeb Facebook page
echo fbLikeCount('soycrackcl','939225322786309','98502e4ecdf908f4abe464d8373252fd');
?>