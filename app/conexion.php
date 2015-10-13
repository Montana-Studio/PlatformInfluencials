<?php 
session_start();
/*
if(basename($_SERVER['PHP_SELF'])=='formulario-agencia.php'){
		session_unset();
		session_destroy();
	}*/

ini_set('session.cookie_lifetime', 600); //too keep ir by one year use 60*60*24*365
ini_set('session.gc-maxlifetime', 600);


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // last request was more than 300 seconds ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
//Conexión a base de datos
$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8');
?>