<?php
if(isset($_FILES["file"]["type"]))
{	
	$validextensions = array("jpeg", "jpg", "png","gif","JPEG","JPG","PNG","GIF");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);

	if (((strtolower($file_extension) == "png") || ( strtolower($file_extension) == "jpg") || (strtolower($file_extension) == "gif" || ( strtolower($file_extension) == "jpeg"))
	) && ($_FILES["file"]["size"] < 200000)//Approx. 200000kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
	
		if ($_FILES["file"]["error"] > 0){
			echo "error";
			}
			else{
			echo "ok";
		}
	 echo "validacion";
}
?>