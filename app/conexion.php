<?php 
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // last request was more than 300 seconds ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
//Conexi�n a base de datos
$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8');

?>