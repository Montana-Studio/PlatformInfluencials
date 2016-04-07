<?php include 'app_admin/Http/Controllers/header.php';
	  require('app_admin/Http/Controllers/conexion.php');
		$result_agencia = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_tipo='2' AND id_estado='1' AND id='".$_GET['id']."'");
		$row_agencia= mysqli_fetch_array($result_agencia, MYSQLI_BOTH);
 ?>
	 <h2>Edición de Campañas - <?php echo $row_agencia[5]; ?></h2>
	 <table style="width:100%">
	  <th colspan="8">Actuales</th>
	  <tr>
	    <td>Nombre</td> 
	    <td>Descripción</td>
	    <td>Imagen</td>
	    <td>Marca</td>
	    <td>Estado</td>
	    <td>Fecha Inicio</td>
	    <td>Fecha Termino</td>
	    <td>Redes Sociales</td>
	  </tr>
<?php 
		
	$result_campanas_habilitadas = $mysqli->query("SELECT DISTINCT * FROM campana WHERE  idpersona='".$_GET['id']."'");
	$row_campanas_habilitadas= mysqli_fetch_array($result_campanas_habilitadas, MYSQLI_BOTH);
	
	do{
		echo"
		<tr>
		    <td><input class='nombre-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[1]."'/></td> 
		    <td><input class='descripcion-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[2]."'/></td>
		    <td><input class='imagenes-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[3]."'/></td>
		    <td><input class='marca-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[4]."'/></td>
		    <td><input class='estado-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[6]."'/></td>
		    <td><input class='fecha-inicio-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[7]."'/></td>
		    <td><input class='fecha-termino-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[8]."'/></td>
		    <td><input class='redes-sociales-".$row_campanas_habilitadas[0]."' value='".$row_campanas_habilitadas[11]."'/></td>

		    <td><button class='editar' id='".$row_campanas_habilitadas[0]."'>Editar</button></td>
	  </tr>";
	}while($row_redes_sociales_visibles == $result_campanas_habilitadas->fetch_array());
	 ?>
	 </table>

 </body>
</html>