<?php include 'app_admin/Http/Controllers/header.php';
	  require('app_admin/Http/Controllers/conexion.php');
 ?>
	 <h2>Edición de Influenciadores</h2>
	 <table style="width:100%">
	  <tr>
	    <!--td>id</td-->
	    <td>Nombre</td> 
	    <!--td>Correo</td-->
	    <td>Descripción</td>
	    <td>Región</td>
	    <td>Comuna</td>
	    <td>Estado Formulario</td>
	    <td colspan="2">Acción</td>
	  </tr>
<?php 
		
	$result_influenciadores = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_tipo>'2' AND id_estado='1'");
	$row_influenciadores= mysqli_fetch_array($result_influenciadores, MYSQLI_BOTH);
	
	do{
		echo"<tr>
	    <!--td><input class='id-".$row_influenciadores[0]."' value='".$row_influenciadores[0]."'/></td-->
	    <td><input class='nombre-".$row_influenciadores[0]."' value='".$row_influenciadores[5]."'/></td> 
	    <!--td><input class='correo-".$row_influenciadores[0]."' value='".$row_influenciadores[6]."'/></td-->
	    <td><input class='descripcion-".$row_influenciadores[0]."' value='".$row_influenciadores[14]."'/></td>
	    <td><input class='region-".$row_influenciadores[0]."' value='".$row_influenciadores[15]."'/></td>
	    <td><input class='comuna-".$row_influenciadores[0]."' value='".$row_influenciadores[16]."'/></td>
	    <td><input class='estado-".$row_influenciadores[0]."' value='".$row_influenciadores[3]."'/></td>
	    <td><button name=".$row_influenciadores[0]." class='ver_redes'>Ver Redes Sociales</button></td>
	    <td><button class='editar' id='".$row_influenciadores[0]."'>Editar</button></td>
	  </tr>";
	}while($row_influenciadores = $result_influenciadores->fetch_array());
	 ?>
	</table>
 </body>
</html>