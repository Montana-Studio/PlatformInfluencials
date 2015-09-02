<?php
$userinfo = fetchData("https://api.instagram.com/v1/users/2007022744access_token=2007022744.85b53d1.44743542fe3d4687a38e2b83dd9af8ab");
$userinfo = json_decode($userinfo);

$followers = $userinfo['data']['counts']['followed_by'];

echo "Folled by: " . $followers . " people";

?>