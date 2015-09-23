<?php
/**
 * Instagram PHP API
 *
 * @link https://github.com/cosenary/Instagram-PHP-API
 * @author Christian Metz
 * @since 01.10.2013
 */
require './src/Instagram.php';
use MetzWeb\Instagram\Instagram;
// initialize class
$instagram = new Instagram(array(
    'apiKey' => '4c1a45981cee4ec5b742e05ebb8b00b8',
    'apiSecret' => '4bc09ad9f9d84ece85d3a7061193b44a',
    'apiCallback' => 'http://local.mediatrends/PlatformInfluencials/app' // must point to success.php
));
// receive OAuth code parameter
$code = $_GET['code'];
// check whether the user has granted access
if (isset($code)) {
    // receive OAuth token object
    $data = $instagram->getOAuthToken($code);
    $username = $data->user->username;
    // store user access token
    $instagram->setAccessToken($data);
    // now you have access to all authenticated user methods
    $result = $instagram->getUser();
} else {
    // check whether an error occurred
    if (isset($_GET['error'])) {
        echo 'An error occurred: ' . $_GET['error_description'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <h1><?php echo $result;?></h1>

    <h1><?php //echo $result; $?></h1>
</div>
</body>
</html>