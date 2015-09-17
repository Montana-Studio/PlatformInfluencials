<?php
//start session
session_start();

//just simple session reset on logout click
if($_GET["reset"]==1)
{
	session_destroy();
	header('Location: ./index.php');
}

// Include config file and twitter PHP Library by Abraham Williams (abraham@abrah.am)
include_once("config.php");
include_once("inc/twitteroauth.php");
include_once('inc/TwitterAPIExchange.php');




?>
<html>
<head>
<title>Sign-in with Twitter</title>
</head>
<body>
<div>
<?php
if(isset($_SESSION['status']) && $_SESSION['status']=='verified') 
{	//Success, redirected back from process.php with varified status.
	//retrive variables
    $mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
    $mysqli->set_charset('utf8');

	$screenname 		= $_SESSION['request_vars']['screen_name'];
	$twitterid 			= $_SESSION['request_vars']['user_id'];
	$oauth_token 		= $_SESSION['request_vars']['oauth_token'];
	$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

	   $settings = array(
        'oauth_access_token' => "3523857136-MwHOy2ZrYGqvvT6fSpkCbFxe5BYqlmQzUs41UdN",
        'oauth_access_token_secret' => "Verk18Cyb8oTYGdcptHvvZaCOXD5gaNDBtMFdd1tqPL9k",
        'consumer_key' => "57Ad64b6xTGNDDyIAAWvcKlGV",
        'consumer_secret' => "YHQUctM9IPL9UHrd0EfNv4MATF8Q1t1Zmqpn3OS12OhHOFF3tX"
    );

	//Get followers
	$usuario = $_SESSION['request_vars']['user_id'];
	$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?id='.$_SESSION['request_vars']['user_id'];
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $follow_count=$twitter->setGetfield($getfield)
    ->buildOauth($ta_url, $requestMethod)
    ->performRequest();
    $data = json_decode($follow_count, true);
     $followers_count=(int)$data[0]['user']['followers_count'];
     if ($followers_count == 0){
     	//alert("tú numero de seguidores es muy bajo");
     	//$display = "none";
     	//echo '<script language="javascript">alert("tus followers son demasiado pocos");</script>'; 
        //session_destroy();

        $mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
        $mysqli->set_charset('utf8');
        $query="INSERT INTO rrss (persona_id, rrss, descripcion_rrss) VALUES(321321,".$followers_count.",".$usuario.")";
        $result= mysqli_query($mysqli,$query)or die(mysqli_error());
      //  $row= mysqli_fetch_array($result, MYSQLI_NUM);
         $display = "block";

         session_destroy();
     }else{

         $display = "block";
         session_destroy();
     }
    
		
}else{
	$display = "none";
}

?>
</div>
<a href="process.php">twitter</a>
<div id="twitter" style="display:<?php echo $display;?>">
	<h2>Usuario = <?php echo $usuario;?></h2>
	<h3>Followers = <?php echo $followers_count;?></h3>
<a href="index.php?reset=1">Logout</a>

</div>
</body>
</html>
