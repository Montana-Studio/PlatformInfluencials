<?php 
if(basename($_SERVER['PHP_SELF'])=='news.php'){
//$mysqli = mysqli_connect("localhost","powerinf_user","uho$}~1(1;nn","powerinf_luencers") or die("Error " . mysqli_error($link)); 
$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8_bin');
}else{
	session_start();
$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8_bin');
	setlocale(LC_ALL,"es_ES");
	$hoy= date("Y-m-d H:i:s");
	$hoyFormatted= date("d M Y");
	$day=trim(substr($hoy, 8 , 2));
	$month= trim(substr($hoyFormatted,3,-5));
	$year= trim(substr($hoyFormatted,-4));
	function months(){
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
	function check_dates(){
		$hoy= date("Y-m-d H:i:s");
		$mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8_bin');
    	$query_dates="SELECT * FROM campana WHERE idEstado=1 ORDER BY id DESC";
		$result_dates= mysqli_query($mysqli,$query_dates)or die(mysqli_error());
		$row_dates= mysqli_fetch_array($result_dates, MYSQLI_NUM);
		$num_row_dates= mysqli_num_rows($result_dates);
    	do{
    		if($row_dates[8]){
    			if($row_dates[8]<$hoy){
					$query_update_dates="UPDATE campana SET finalizada=1, idEstado=0 WHERE id='".$row_dates[0]."'";
					$result_update_dates= mysqli_query($mysqli,$query_update_dates)or die(mysqli_error());
    			}
    		}
    	}while($row_dates = mysqli_fetch_row($result_dates));
    }
	//if(substr($hoyFormatted,3,2))
	/*
	if(basename($_SERVER['PHP_SELF'])=='formulario-red-social-agencia.php'){
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
	//$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	//Conexión a base de datos
	
}
?>