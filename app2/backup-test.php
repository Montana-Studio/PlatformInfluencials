<?php
//include('controller/database/backup.php');
?>
<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var nombre="nibaldo";
		$("#backup").click(function(){
			$.ajax({
				type: "POST",
				url: "controller/database/backup.php",
				//data="nombre="+nombre,
				success: function(data){
					console.log(data);
				}
			})

		})
	});
</script>
<head>
<!--script type="text/javascript" src="js/platform_influencials.min.js"></script-->
	<title>Backup-Test</title>
</head>
<body>
<button id="backup">Backup DB</button>
</body>
</html>