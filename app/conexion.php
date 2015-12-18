<?php 
session_start();
setlocale(LC_ALL,"es_ES");
$hoy= date("Y-m-d H:i:s");
$hoyFormatted= date("d M Y");
$day=trim(substr($hoy, 8 , 2));
$month= trim(substr($hoyFormatted,3,-5));
$year= trim(substr($hoyFormatted,-4));
if($month == 'Jan'){
	$month='Enero';
}
if($month == 'Feb'){
	$month='Febrero';
}
if($month == 'Mar'){
	$month='Marzo';
}
if($month == 'Apr'){
	$month='Abril';
}
if($month == 'May'){
	$month='Mayo';
}
if($month == 'Jun'){
	$month='Junio';
}
if($month == 'Jul'){
	$month='Julio';
}
if($month == 'Aug'){
	$month='Agosto';
}
if($month == 'Sep'){
	$month='Septiembre';
}
if($month == 'Oct'){
	$month='Octubre';
}
if($month == 'Nov'){
	$month='Noviembre';
}
if($month == 'Dec'){
	$month='Diciembre';
}
$hoyFormatted=$day." ".$month." ".$year;


function formato_numeros_reachs($num){
			if($num/1000000000>1){
				$n= number_format((float)$num/1000000000,2,'.','');
				$resultado = $n."B";
			}else if ($num/1000000>1){
				$n= number_format((float)$num/1000000,2,'.','');
				$resultado = $n."M";
			}else if($num/1000>1){
				$n= number_format((float)$num/1000,2,'.','');
				$resultado = $n."K";
			}else{
				$resultado=$num;
			}
			return $resultado;
		}
//if(substr($hoyFormatted,3,2))
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
$mysqli = mysqli_connect("localhost","adnativo_user","}O%X;&KD[1_*","adnativo_ipe") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8_bin');
?>