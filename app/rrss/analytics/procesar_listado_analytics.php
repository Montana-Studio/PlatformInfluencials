<?php
require('../../conexion.php');

if($_POST['tipo']== 'muestra_cuentas'){
$id = $_SESSION['id'];
$paginas_analytics=$_POST['paginas_analytics'];
$id_paginas_analytics=$_POST['id_paginas_analytics'];
$array_paginas_analytics = explode(',',$paginas_analytics);
echo count($array_paginas_analytics);

$array_id_paginas_analytics = explode(',',$id_paginas_analytics);
echo count($array_id_paginas_analytics);


for($i=0;$i<count($array_paginas_analytics);$i++){
  if($array_id_paginas_analytics[$i] != ''){
    $results= $mysqli->query("INSERT INTO rrss (descripcion_rrss,analytics_page,persona_id,id_estado, analytics_page_name) VALUES ('analytics','$array_id_paginas_analytics[$i]', '$id' , '0' , '$array_paginas_analytics[$i]' )");
  }
  
}

}else{
  //prueba para prueba_analytics.php
  $mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8');
//if($_POST['tipo'] == 'agregaListado'){
$account =$_POST['account'];
$webProperty=$_POST['webProperty'];
$profile=$_POST['profile'];

$pn=$_POST['pn'];
$pv=$_POST['pv'];
$ss=$_POST['ss'];
$ssd=$_POST['ssd'];
$pvps=$_POST['pvps'];
$upv=$_POST['upv'];
$atp=$_POST['atp'];
$sspu=$_POST['sspu'];

if($_POST['tipo']=='inscripcion'){
  $results= $mysqli->query("SELECT profile_id FROM Analytics WHERE profile_id='$profile'");
  $num_rows= mysqli_num_rows($results);

  if($num_rows<1){
   $results2 = $mysqli->query("INSERT INTO Analytics (account_id,webProperty_id,profile_id,PN,PV,SS,SSD,PVPSS,UPV,ATP,SSPU) VALUES ('$account','$webProperty','$profile','$pn','$pv','$ss','$ssd','$pvps','$upv','$atp','$sspu')");

  }
}

}

?>