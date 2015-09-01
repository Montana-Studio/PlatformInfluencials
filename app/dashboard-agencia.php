<?php
//holi
require('conexion.php');
if(isset($_SESSION['nombre'])==false){
header('Location:registro.php');
die();
}
else{
//$mysqli->set_charset('utf8');
$id=$_SESSION['id'];
$query="SELECT * FROM campana  WHERE idpersona=".$id." ORDER BY id DESC LIMIT 3";
$result= mysqli_query($mysqli,$query)or die(mysqli_error());
$row= mysqli_fetch_array($result, MYSQLI_NUM);
}
?>
<html>
<head>
	<meta  charset="UTF-8" >
	<title>dashboard - <?php $_SESSION['nombre']; ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			//variables globales
			var correo,nombre,correo,tel1,tel2,empresa;
			var rsid = $('#RsId').val();
			if (rsid != ''){
			$('#correo input').removeAttr('disabled');
			}
			var foto=0;
				$('#file').click(function(){
				  foto=1; 
			});
				
				$('#imagenform').on('submit',(function (e){
				e.preventDefault;
				info = new FormData(this);
				info.append('correo',$('#correo input').val());
				info.append('rsid',$('#RsId').val());
				info.append('nombre',$('#nombre input').val());
				info.append('tel1',$('#tel1 input').val());
				info.append('tel2',$('#tel2 input').val());
				info.append('empresa',$('#empresa input').val());
				info.append('picture_url', '<?php echo $_SESSION['pictureUrl'];?>');
			
				if(foto==1) {
				$.ajax({
						type: "POST",  
						url: "procesar_imagen.php",  
						data: info,
						enctype: 'multipart/form-data',
						contentType: false,      
						cache: false,             
						processData:false, 
					
					success: function(data){ 
						window.location.reload();
					}
					});
				}
				else{
					$.ajax({  
					
							type: "POST",  
							url: "procesar-dashboard-agencia.php",  
							data: info,
							enctype: 'multipart/form-data',
							contentType: false,      
							cache: false,             
							processData:false,

						success: function(data){ 
							console.log(data);
							window.location.reload();
						}
					});
				};
			}));	

			//campañas creadas 
			$('#editaCampaña').hide();
			$('#creadas #guardar').hide();
			//editar
			$('#creadas #editar').click (function (){
				$('#editaCampaña').show();
				$('#creadas #guardar').show();
				$('#creadas #editar').hide();
			});
			//guardar cambios
			$('#creadas #guardar').click (function (){
				$('#editaCampaña').hide();
				$('#creadas #guardar').hide();
				$('#creadas #editar').show();
			});
			$('#guardar').hide();
			$('#editar').show();
		});
		
		function valida(e){
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla==8){
					return true;
				};
				patron =/[0-9]/;
				tecla_final = String.fromCharCode(tecla);
				return patron.test(tecla_final);
			};
		function phone1Length(){
			var tel1 = $('#telefono1nuevo').val();
			var tel2 = $('#telefono2nuevo').val();
			$('#registrarse').attr('disabled','disabled');
			if (tel1.length > 7 && tel2.length > 7)
				$('#registrarse').removeAttr('disabled');
			else
				$('#registrarse').attr('disabled','disabled');
			}

		function phone2Length(){
			var tel1 = $('#telefono1nuevo').val();
			var tel2 = $('#telefono2nuevo').val();
			$('#registrarse').attr('disabled','disabled');
			if (tel1.length > 7 && tel2.length > 7)
				$('#registrarse').removeAttr('disabled');
			else
				$('#registrarse').attr('disabled','disabled');
		}

	</script>
	<style>
		input{
		border:none;
		background-color:#fff;
		color:#000;
		cursor:pointer;
		font-family: 'Impact',Courier,Sans-Serif;
		}
		.alert{
			color:red;
			background-color:rose;
			border:1px solid red;
		}
		.content{
			display:none;
		}
	</style>
</head>
<body>
	<div style="text-align:right;">
		<a href="logout.php">cerrar sesion</a>
		-
		<a href>ayuda</a>
	</div>
	<h2>dashboard</h2>
	<form id='imagenform'>
		<div id="inicio" disabled>
		<div id="nombre">
			<input value="<?php echo $_SESSION['nombre']; ?>">
		</div>
		<img src="<?php echo $_SESSION['pictureUrl'];?>" width="100" height="auto">
		<input id="RsId" style="display:none" value="<?php echo $_SESSION['rsid']; ?>">
		<div id="empresa">
			<input value="<?php echo $_SESSION['empresa']; ?>">
		</div>
		<input type="file" name="file" id="file">
	<h2>Datos de facturaci&oacuten </h2>
			<div id="correo">
				<input value="<?php echo $_SESSION['correo']; ?>" disabled>
			</div>
			<div id="tel1">
				<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono1']; ?>">
			</div>
			<div id="tel2">
				<input type="text"  onkeypress="return valida(event)" value="<?php echo $_SESSION['telefono2']; ?>">
			</div>
			<button id="guardarFacturacion" type="submit">Guardar</button>
		</div>
	</form>
	<?php 
	if ((int)$row[0] != 0){ ?>
		<?php 
			echo '
		<a href="campana.php">ir a campa&ntildeas</a>
		
			<div id="creadas">
				<h2>&uacutetlimas campa&ntildeas creadas</h2>
				<script type="text/javascript">
					$(document).ready(function(){
						$(".volver").hide();
						var contador=0;
						$("#recientes .content_all").click(function(){
							if (contador==0){
							$("#recientes .content_all").not(this).hide();
							$("#recientes .content, .volver").show(this);
								//console.log(clicked_id);
								contador=1;
							}
						});
						
						$(".volver").click(function(){
							if (contador==1){
							$("#recientes .content_all").show();
							$("#recientes .content").hide();
								//console.log(clicked_id);
								contador=0;
								$(".volver").hide();
							}
						});
					});
				</script>
			
			';
				do{
				 echo '
				<div id="recientes">
					<div class="content_all">
					<img id="imagen'.$row[0].'"width="100" height="auto"  src="'.$row[3].'"/>
						<div class="content" >
							<p class="campana'.$row[0].'" ">'.$row[2].'</p>
							<p>'.$row[4].'</p>
							
						</div>
					</div>
					
				 </div>
			 
				'; }while($row = mysqli_fetch_row($result)); ?>
				
				<?php 
				echo '<button class="volver">Volver</button>';?>
			</div>
	<?php 
	}else{
	echo '<a href="nueva-campana.php"><h2>crear campa&ntildea</h2></a>';
	}
	?>	
	<div id="contacto">
		<h2>Contacto</h2>
		<div>
			<input placeholder="asunto">
		</div>
		<div>
			<textarea  placeholder="descripcion" rows="10" cols="40"></textarea>
		</div>
		<div>
			<button>Enviar</button>
		</div>
	</div>

</body>
</html>