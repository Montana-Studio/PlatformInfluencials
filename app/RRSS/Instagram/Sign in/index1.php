<?php
require './src/Instagram.php';
use MetzWeb\Instagram\Instagram;
// initialize class
$instagram = new Instagram(array(
    'apiKey' => '4c1a45981cee4ec5b742e05ebb8b00b8',
    'apiSecret' => '4bc09ad9f9d84ece85d3a7061193b44a',
    'apiCallback' => 'http://local.mediatrends/PlatformInfluencials/app/RRSS/success.php' // must point to success.php
));
// create login URL
$loginUrl = $instagram->getLoginUrl();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="container">
                <a class="login" href="<?php echo $loginUrl ?>">» Login with Instagram</a>
</div>
</body>
</html>