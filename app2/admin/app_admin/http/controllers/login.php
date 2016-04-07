<?php
require('./conexion.php');
	$user=$_POST['user'];
	$pass=MD5($_POST['pass']);
	$result_existe_en_login = $mysqli->query("SELECT * FROM login WHERE  correo='$user' AND pass='$pass'");
	echo "SELECT * FROM login WHERE  correo='$user' AND pass='$pass'";
	$num_row_login= mysqli_num_rows($result_existe_en_login);
	$row_login= mysqli_fetch_array($result_existe_en_login, MYSQLI_BOTH);
	$id=$row_login[0];
	
/*
	function unsetVariables(){
		unset($user);
		unset($pass);
		unset($result_existe_en_login);
		unset($num_row_login);
		unset($row_login);
		unset($id);
		unset($result_admin);
		unset($num_row_adim);
		unset($row_admin);

	}*/

	if($num_row_login>0){
		$result_admin = $mysqli->query("SELECT * FROM persona WHERE  correo='$user'");
		$num_row_adim= mysqli_num_rows($result_admin);
		$row_admin= mysqli_fetch_array($result_admin, MYSQLI_BOTH);
		if($row_admin['id_tipo']==1){
			$_SESSION['user_admin']=$row_admin[5];

			//unsetVariables();
			echo 'ok';
		}else{
			//unsetVariables();
			echo 'false';

		}
	}else{
		//unsetVariables();
		echo 'false';
	}
?>