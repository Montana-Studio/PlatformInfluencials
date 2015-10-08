<?php include 'header.php'; ?>
			<script>
				$(document).ready(function(){
					var $envnom=0;
					var nombre;
					var correo;
					var telefono1;
					var telefono2;	
					
					$('.guardar').on('submit',function(){
						nombre=$('#nombre input').val();
						empresa=$('#empresa input').val();
						correo=$('#correo input').val();
						telefono1=$('#tel1 input').val();
						telefono2=$('#tel2 input').val();
						console.log(nombre,correo,telefono1,telefono2);
						$.ajax({  
							type: "POST",  
							url: "procesar_formulario.php",  
							data: "nombre="+nombre+"&empresa="+empresa+"&correo="+correo+"&tel1="+telefono1+"&tel2="+telefono2, 
							
							success: function(html){ 
								alert("Registro de datos completo");
								window.location.href= "./";
								}
						});
					});
					$('#tel1 input, #tel2 input').keypress(function(){
						valida(event);
						phone();
					});
					phone();	
				});
				
				function phone(){

					var tel1 = $('.telefono1nuevo').val();
					var tel2 = $('.telefono2nuevo').val();
					$('#tel1 input, #tel2 input').keypress(function(){
						
					});
					var revisa = 0;
					if (revisa=0){
						$('.guardar').attr('disabled','disabled');
					}
					if (tel1.length > 7 && tel2.length > 7){
						$('.guardar').removeAttr('disabled');
						revisa =1;
						console.log(tel1.length);
					}
				}

			


			</script>
			<p>favor ingresar los siguientes datos para continuar</p>
			<h2>formulario de ingreso</h2>
			<form>

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
						<input class="telefono1nuevo" placeholder="telefono 1" type="text" maxlength="11" required>
					</div>
					<div id="tel2">
						<input class="telefono2nuevo" placeholder="telefono 2" type="text" maxlength="11" required>
					</div>

					<button class="guardar" disabled>guardar</button>
				
			</div>
</form>
		<?php include 'footer.php'; ?>
	</body>
</html>