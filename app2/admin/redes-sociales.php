<?php include 'admin/app_admin/Http/Controllers/header.php';
	  require('app_admin/Http/Controllers/conexion.php');
		$result_influenciador = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_tipo>'2' AND id_estado='1' AND id='".$_GET['id']."'");
		$row_influenciador= mysqli_fetch_array($result_influenciador, MYSQLI_BOTH);
 ?>
	 <h2>Edición de Redes Sociales - <?php echo $row_influenciador[5]; ?></h2>
	 <table style="width:100%">
	  <th colspan="3">Visibles</th>
	  <tr>
	    <td>Red Social</td> 
	    <td>Red Social ID</td>
	    <td>Acción</td>
	  </tr>
<?php 
		
	$result_redes_sociales_visibles = $mysqli->query("SELECT DISTINCT * FROM rrss WHERE  persona_id='".$_GET['id']."' AND cuenta='1'");
	$row_redes_sociales_visibles= mysqli_fetch_array($result_redes_sociales_visibles, MYSQLI_BOTH);
	
	do{
		echo"
		<tr>
		    <td><input class='descripcion-rrss-".$row_redes_sociales_visibles[0]."' value='".$row_redes_sociales_visibles[2]."'/></td> 
		    <td><input class='descripcion-".$row_redes_sociales_visibles[0]."' value='".$row_redes_sociales_visibles[3]."'/></td>
		    <td><button class='deshabilitar' id='".$row_redes_sociales_visibles[0]."'>Deshabilitar</button></td>
	  </tr>";
	}while($row_redes_sociales_visibles = $result_redes_sociales_visibles->fetch_array());
	 ?>
	 </table>

	

	<table style="width:100%">
	  <th colspan="3">Eliminadas</th>
	  <tr>
	    <td>Red Social</td> 
	    <td>Red Social ID</td>
	    <td>Acción</td>
	  </tr>

<?php 
		
	$result_redes_sociales_eliminadas = $mysqli->query("SELECT DISTINCT * FROM rrss WHERE  persona_id='".$_GET['id']."' AND cuenta='0'");
	$row_redes_sociales_eliminadas= mysqli_fetch_array($result_redes_sociales_eliminadas, MYSQLI_BOTH);
	
	do{
		echo"
		<tr>
		    <td><input class='descripcion-rrss-".$row_redes_sociales_eliminadas[0]."' value='".$row_redes_sociales_eliminadas[2]."'/></td> 
		    <td><input class='descripcion-".$row_redes_sociales_eliminadas[0]."' value='".$row_redes_sociales_eliminadas[3]."'/></td>
		    <td><button class='habilitar' id='".$row_redes_sociales_eliminadas[0]."'>Habilitar</button></td>
	  </tr>";
	}while($row_redes_sociales_visibles = $result_redes_sociales_eliminadas->fetch_array());
	 ?>
	 </table>
 </body>
</html>