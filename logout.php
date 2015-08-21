<?php  
session_start();  
unset($_SESSION['id']); 
//setcookie("id","x",time()-3600, "/"); 
session_destroy();
header('Location: registro.php'); 
?> 
