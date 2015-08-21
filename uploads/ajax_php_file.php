<?php
$id=$_POST['id'];
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "PNG");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 100000)//Approx. 1000kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "error";
}
else
{
if (file_exists("uploads/$id/test/" . $_FILES["file"]["name"])) {
echo 'existe';
}
else
{
mkdir("uploads/$id/test", 0777, true);
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "uploads/$id/test/".$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
echo "subido";
}
}
}
else
{
echo "invalido";
}
}
?>