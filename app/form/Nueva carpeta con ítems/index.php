<?php 
$action=$_REQUEST['action']; 
if ($action=="")    /* display the contact form */ 
    { 
    ?> 
    <form  action="" method="POST" enctype="multipart/form-data"> 
    <input type="hidden" name="action" value="submit"> 
    Nombre:<br> 
    <input name="name" type="text" value="" size="30"/><br> 
    Correo:<br> 
    <input name="correo" type="text" value="" size="30"/><br> 
     Asunto:<br> 
    <input name="asunto" type="text" value="" size="30"/><br> 
    Mensaje:<br> 
    <textarea name="message" rows="7" cols="30"></textarea><br> 
    <input type="submit" value="Send email"/> 
    </form> 
    <?php 
    }  
else                /* send the submitted data */ 
    { 
    $name=$_REQUEST['name']; 
    $email=$_REQUEST['correo']; 
    $message=$_REQUEST['message'];
    $asunto=$_REQUEST['asunto'];  
    if (($name=="")||($email=="")||($message=="")) 
        { 
        echo "All fields are required, please fill <a href=\"\">the form</a> again."; 
        } 
    else{         
        $from="From: $name<$email>;"; 
        $subject=$asunto; 
        mail("elperoy@gmail.com", $subject, $message, $from); 
        echo "Email sent!"; 
        } 
    }   
?> 