<?php
	 if($_SESSION['user_admin']==null || $_SESSION['user_admin']==''){  
?>
<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<!--script type="text/javascript" src="resources/js/jquery.min.js"></script-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
			<script type="text/javascript" src="resources/js/formularios.js"></script>   
		</head>
<body>
	<form id ="admin_login">
		Nombre de Usuario:<input id="admin_user" required />
		Contraseña : <input type="password" id="admin_pass" required />
		<p><button id="iniciar_sesion">Ingresar</button></p>
	</form>
</body>
</html>
<?php
	
	  
	  }else{
	  		header('Location: dashboard-admin.php');
	  	}
?>