$(document).ready(function (e) {
var info;
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
info = new FormData(this);
info.append('id',$('#id').val());
$.ajax({

		url: "ajax_php_file.php", // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: info, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		enctype: 'multipart/form-data',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false

success: function(data)   // A function to be called if request succeeds
{
 switch (data){
  case 'invalido' : alert("peso o formato no permitido");
  break;
 case 'subido' : alert("archivo subido correctamente");
 break;
 case 'existe': alert("el archivo ya existe");
 break;
 case 'error': alert("error en arhivo de origen");
 break;
 }
}
});
}));

});