<?php
$resultado= $_POST['resultado'];
$inputs = $_POST['inputs'];
$largoinputs = intval($_POST['largoinputs']);
$textareas = $_POST['textareas'];
$largotextareas = intval($_POST['largotextareas']);
$checkboxs = $_POST['checkboxs'];
$largocheckboxs = intval($_POST['largocheckboxs']);
$apertura="<?php";
$termino="\n?>";
$input = explode(',',$inputs);
$textarea = explode(',',$textareas);
$checkbox = explode(',',$checkboxs);
$code1="";
$peso="$";
$inicio=$apertura."\n\t".$peso."action=".$peso."_REQUEST['action'];";
$request=$peso."_REQUEST['";
for ($i=0; $i<$largoinputs;$i++){
$acumula_variables .= "\n\t".$peso.$input[$i]."=".$request.$input[$i]."'];";
}

for ($i=0; $i<$largotextareas;$i++){
$acumula_variables .= "\n\t".$peso.$textarea[$i]."=".$request.$textarea[$i]."'];";
}

for ($i=0; $i<$largocheckboxs;$i++){
$acumula_variables .= "\n\t".$peso.$checkbox[$i]."=".$request.$checkbox[$i]."'];";
}

$acumula_variables.="\n\t".$peso."nombre=".$peso."_REQUEST['nombre'];";
$acumula_variables.="\n\t".$peso."correo=".$peso."_REQUEST['correo'];";
$acumula_variables.="\n\t".$peso."mensaje=".$peso."_REQUEST['mensaje'];";
$acumula_variables.="\n\t".$peso."asunto=".$peso."_REQUEST['asunto'];";
$acumula_variables.="\n\t\t"."if((".$peso."nombre=='')||(".$peso."correo=='')||(".$peso."mensaje=='')){";
$acumula_variables.="\n\t\techo 'Recuerde ingresar todos los parametros del correo';";
$acumula_variables.="\n\t\t}else{";
$acumula_variables.="\n\t\tmail('<reemplazar_por_correo_que_recibe>',".$peso."asunto, ".$peso."mensaje,null,'-f'.".$peso."correo.'');";
$acumula_variables.="\n\t\techo '<div><p>div de respuesta</p></div>';";
$acumula_variables.="\n\t\t}";
$acumula_variables.="\n\t}";

//echo $inicio."\n\t"."if(".$peso."action==''){".$termino."\n".$resultado."\n".$apertura."\n\t}\n\telse{\n\t".$acumula_variables.$termino;
echo $resultado."\n".$inicio."\n\t"."if(".$peso."action!=''){\n\t".$acumula_variables.$termino;
/*<?php 
$action=$_REQUEST['action']; 
if ($action!=""){ 
    $name=$_REQUEST['name']; 
    $email=$_REQUEST['correo']; 
    $message=$_REQUEST['message'];
    $asunto=$_REQUEST['asunto']; 
    $email_from="elperoy@gmail.com"; 
    $headers = 'From: '.$email_from;
    if (($name=="")||($email=="")||($message=="")) 
        { 
        echo "All fields are required, please fill <a href=\"\">the form</a> again."; 
        } 
    else{         
        $from="From: ".$name."<".$email.">"; 
        $subject=$asunto; 
        mail($email_from, $subject, $message, null, '-f'.$email.''); 
        echo '  <div>
                    <p>div de respuesta</p>
                </div>'; 
        } 
}   
?> 

/*
    <?php 
    }  
else                /* send the submitted data  
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



*/





?>