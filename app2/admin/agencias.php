<?php include 'header.php';
	  require('app_admin/http/controllers/conexion.php');
 ?>
	 <h2>Edición de Agencias</h2>
	 <table style="width:100%">
	  <tr>
	    <td>Nombre</td>
	    <td>Empresa</td> 
	    <td>Telefono 1</td>
	    <td>Telefono 2</td>
	    <td>Fecha de ingreso</td>
	    <td>Url de Foto</td>
	    <td>Estado</td>
	    <td colspan="2">Acción</td>
	  </tr>
<?php 
		
	$result_agencias = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_tipo='2' AND id_estado='1'");
	$row_agencias= mysqli_fetch_array($result_agencias, MYSQLI_BOTH);
	
	do{
		echo"<tr>
	    <td><input class='nombre-".$row_agencias[0]."'value='".$row_agencias[5]."'/></td>
	    <td><input class='empresa-".$row_agencias[0]."'value='".$row_agencias[13]."'/></td> 
	    <td><input class='telefono1-".$row_agencias[0]."'value='".$row_agencias[7]."'/></td>
	    <td><input class='telefono2-".$row_agencias[0]."'value='".$row_agencias[8]."'/></td>
	    <td><input class='fecha-ingreso-".$row_agencias[0]."'value='".$row_agencias[9]."'/></td>
	    <td><img src'".$row_agencias[12]."' /></td>
	    <td><input class='estado-".$row_agencias[0]."'value='".$row_agencias[3]."'/></td>
	    <td><button name=".$row_agencias[0]." class='ver_campanas'>Ver Campañas</button></td>
	    <td><button class='editar' id='".$row_agencias[0]."'>Editar</button></td>
	  </tr>";


	}while($row_agencias = $result_agencias->fetch_array());
	 ?>
	</table>
 </body>
</html>