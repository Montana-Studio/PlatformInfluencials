<?php include 'header.php'; ?>
			<script>
				$(document).ready(function(){
					var $envnom=0;
					var nombre;
					var correo;
					var telefono1;
					var telefono2;	

					$('#formulario_agencias_sin_rs').on('submit',function(e){
						
						e.preventDefault();
					
						//alert($('#telefono1nuevo input').val());
						//alert("lala");
						
					//	console.log(nombre,correo,telefono1,telefono2);
						
						if($("#telefono1nuevo").val().length > 7 && $("#telefono2nuevo").val().length > 7 ){
								info = new FormData(this);
								info.append('nombre',$('#nombre input').val());
								info.append('empresa',$('#empresa input').val());
								info.append('correo',$('#correo input').val());
								info.append('tel1',$('#telefono1nuevo').val());
								info.append('tel2',$('#telefono2nuevo').val());

							$.ajax({
								type: "POST",  
								url: "procesar_formulario.php",   
								data: info,
								enctype: 'multipart/form-data',
								contentType: false,      
								cache: false,             
								processData:false, 							
								success: function(data){ 
									//alert(data);
									alert("Registro de datos completo");
									//window.location.href= "./";
								}
							});
						}else{

							alert("ingrese telefonos de al menos 8 cifras");
						}
						
					});
			
				});

				

			


			</script>
			<p>favor ingresar los siguientes datos para continuar</p>
			<h2>formulario de ingreso</h2>
			<form id="formulario_agencias_sin_rs">

			<div id="inicio">

				<div id="nombre">
					<input  value="<?php echo $_SESSION['nombre'];?>" required>
				</div>
				<div id="empresa">
					<input placeholder="Empresa a la que pertenece" required>
				</div>

			</div>

			<h2>datos de facturación</h2>
			
			<div id="facturacion">
				
					<div id="correo">
						<input value="<?php echo $_SESSION['correo'];?>" required>
					</div>
					<div id="tel1">
						<input id="telefono1nuevo" placeholder="telefono 1" onkeypress="return valida(event)" type="text" maxlength="11" required>
					</div>
					<div id="tel2">
						<input id="telefono2nuevo" placeholder="telefono 2" onkeypress="return valida(event)" type="text" maxlength="11" required>
					</div>

					<button id="guardar">guardar</button>
				
			</div>
</form>
		<?php include 'footer.php'; ?>
	</body>
</html>