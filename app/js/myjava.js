$(function(){

$('#ingresar').on('click', function(){
var usu= $('#usu').val();
var pass= $('#pass').val();
var url='./controller/procesar_login.php';
var total = usu.length*pass.length;
if (total>0){
	$.ajax({
	type: 'POST',
	url: url,
	data: 'usu='+usu+'&pass='+pass,

	
	 success:function(valor){
		if(valor == 'usuario'){
			$('#mensaje').html('La contraseña o usuario ingresados no existe');
			/* se puede agregar clase si existe en css usando .addClass('') 
			luego de la variable $('mensaje') */
			$('#username-antiguo').focus();
			return false;
		}else if (valor == 'password'){
			$('#mensaje').html('La contraseña o usuario ingresados no existe');
			$('#contraseña-antiguo').focus();
			return false;
		}else if(valor == 'activo'){
		$('#mensaje').html('Usuario inactivo');
		$('#username-antiguo').focus();

		}else {
		//redireccionar según idTipo de usuario
		$('#mensaje').html('paso por todas las validaciones');
		}
	 },
	 
	 error: function(xhr, textStatus, error){
		console.log(xhr.statusText);
		console.log(textStatus);
		console.log(error);
	 }
	

	});
	}else{
	$('#mensaje').html('Complete todos los campos');
	}

})
})