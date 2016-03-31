<?php 
	  require('app_admin/http/controllers/conexion.php');
	 /*if($_SESSION['user_admin']==null || $_SESSION['user_admin']==''){
	  	header('Location: index.php');
	  }else{
	  	include 'app_admin/http/controllers/header.php';*/
 ?>
	<h1>Bienvenido <?php echo $_SESSION['admin_user']; ?></h1>
	<a href="agencias.php" id="ir_a_agencias">Administrar Agencias</a>
	<a href="influenciadores-admin.php" id="ir_a_influenciadores">Administrar Influenciadores</a>
	<a href="admin.php" id="ir_a_admin">Crear Nuevo Admin</a>

	<h2>Usuarios Pendientes de Activación</h2>
	<?php echo $_SESSION['user_admin'];?>
	<table style="width:100%">
	  <tr>
	    <td>id</td>
	    <td>Nombre</td> 
	    <td>Tipo de Usuario</td>
	    <td>Correo</td>
	    <td>Fecha de ingreso</td>
	    <td>Descripción</td>
	  </tr>
	<?php 
		
	$result_inactivos = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_estado='0'");
	$row_inactivos= mysqli_fetch_array($result_inactivos, MYSQLI_BOTH);
	
	do{
		echo"<tr>
	    <td>".$row_inactivos[0]."</td>
	    <td>".$row_inactivos[5]."</td>
	    <td>".$row_inactivos[2]."</td> 
	    <td>".$row_inactivos[6]."</td>
	    <td>".$row_inactivos[9]."</td>
	    <td><button class='activar_cuenta' id='".$row_inactivos[0]."'>Activar</button></td>
	  </tr>";
	}while($row_inactivos = $result_inactivos->fetch_array());
	 ?>
	</table>
	
	<?php
		$result_mensajes_agencias = $mysqli->query("SELECT DISTINCT * FROM mensajes WHERE descripcion_tipo='agencia' ORDER BY id DESC");
	$row_mensajes_agencias= mysqli_fetch_array($result_mensajes_agencias, MYSQLI_BOTH);

	$result_mensajes_influenciadores = $mysqli->query("SELECT DISTINCT * FROM mensajes WHERE descripcion_tipo='influenciador' ORDER BY id DESC");
	$row_mensajes_influenciadores= mysqli_fetch_array($result_mensajes_influenciadores, MYSQLI_BOTH);
	?>
	
	<div id="nuevo_mensaje_agencias" style="border:1px solid black;">
		<h2>Enviar Mensaje a agencias</h2>
		Seleccione tipo de Mensaje
		<select id="tipo_mensaje_agencia">
			<option value="0" selected>General</option>
			<option value="usuario">Usuario</option>
		</select>
		<select id="correo_mensaje_agencia" name="agencia" style="display:none">
		<option value="0" selected disabled>Seleccione una agencia</option>
		<?php
		$result_agencias_activos = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_estado='1' AND id_tipo='2'");
		$row_agencias_activos= mysqli_fetch_array($result_inactivos, MYSQLI_BOTH);
		do{
			if($row_agencias_activos[0]!=''){
				echo "<option id='".$row_agencias_activos[0]."' value='".$row_agencias_activos[6]."'>$row_agencias_activos[6]</option>";
			}
		 	
		}while($row_agencias_activos = $result_agencias_activos->fetch_array());
		?>
		</select>
		<input id="mensaje_agencias" class="mensaje" placeholder="Mensaje"/> <button  id="btn_mensaje_agencias" class="agencia">Subir Mensaje</button>
		<small id="mensaje_agencia"><?php echo "[Mensaje Actual : ".$row_mensajes_agencias['mensaje']."]";?></small>
		<small id="mensaje_agencia_selected" style="display:none" ></small>
	</div>
	

	
	<div id="nuevo_mensaje_influenciadores" style="border:1px solid black;">
		<h2>Enviar Mensaje a influenciadores</h2>
		Seleccione tipo de Mensaje
		<select id="tipo_mensaje_influenciador">
			<option value="0" selected>General</option>
			<option value="usuario">Usuario</option>
		</select>
		<select id="correo_mensaje_influenciador" name="influenciador" style="display:none">
		<option value="0" selected disabled>Seleccione una influenciador</option>
		<?php
		$result_influenciadores_activos = $mysqli->query("SELECT DISTINCT * FROM persona WHERE  id_estado='1' AND id_tipo>'2'");
		$row_influenciadores_activos= mysqli_fetch_array($result_inactivos, MYSQLI_BOTH);
		do{
			if($row_influenciadores_activos[0]!=''){
				echo "<option id='".$row_influenciadores_activos[0]."' value='".$row_influenciadores_activos[6]."'>$row_influenciadores_activos[6]</option>";
			}
		 	
		}while($row_influenciadores_activos = $result_influenciadores_activos->fetch_array());
		?>
		</select>
		<input id="mensaje_influenciadores" class="mensaje" placeholder="Mensaje"/> <button  id="btn_mensaje_influenciadores" class="influenciador">Subir Mensaje</button>
		<small id="mensaje_influenciador"><?php echo "[Mensaje Actual : ".$row_mensajes_influenciadores['mensaje']."]";?></small>
		<small id="mensaje_influenciador_selected" style="display:none" ></small>
	</div>
<?php// } var_dump($_SESSION); echo date("Y-m-d H:i:s");;?>	


</body>
</html>

