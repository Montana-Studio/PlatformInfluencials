<?php
require('../../conexion.php');

if($_POST['tipo']== 'muestra_cuentas'){
  /*
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
*/

$id = $_SESSION['id'];
$paginas_analytics=$_POST['paginas_analytics'];
$id_paginas_analytics=$_POST['id_paginas_analytics'];

$PVDSK=$_POST['pageviews_desktop'];
$SSDSK=$_POST['sessions_desktop'];
$SSDDSK=$_POST['sessionDuration_desktop'];
$PVPSSDSK=$_POST['pageviewsPerSession_desktop'];
$UPVDSK=$_POST['uniquePageviews_desktop'];
$AVGTPDSK=$_POST['avgTimeOnPage_desktop'];
$SSPUDSK=$_POST['sessionsPerUser_desktop'];

$PVMBL=$_POST['pageviews_mobile'];
$SSMBL=$_POST['sessions_mobile'];
$SSDMBL=$_POST['sessionDuration_mobile'];
$PVPSSMBL=$_POST['pageviewsPerSession_mobile'];
$UPVMBL=$_POST['uniquePageviews_mobile'];
$AVGTPMBL=$_POST['avgTimeOnPage_mobile'];
$SSPUMBL=$_POST['sessionsPerUser_mobile'];

$PVTBLT=$_POST['pageviews_tablet'];
$SSTBLT=$_POST['sessions_tablet'];
$SSDTBLT=$_POST['sessionDuration_tablet'];
$PVPSSTBLT=$_POST['pageviewsPerSession_tablet'];
$UPVTBLT=$_POST['uniquePageviews_tablet'];
$AVGTPTBLT=$_POST['avgTimeOnPage_tablet'];
$SSPUTBLT=$_POST['sessionsPerUser_tablet'];

$results= $mysqli->query('INSERT INTO rrss (descripcion_rrss,analytics_page,persona_id,id_estado, analytics_page_name) VALUES ("analytics","'.$id_paginas_analytics.'", "'.$id.'" , "0" , "'.$paginas_analytics.'" )');
$results2 = $mysqli->query('INSERT INTO Analytics (descripcion_rrss,id_estado,PN,persona_id, profile_id ,PVDSK,SSDSK,SSDDSK,PVPSSDSK,UPVDSK,AVGTPDSK,SSPUDSK,PVMBL,SSMBL,SSDMBL,PVPSSMBL,UPVMBL,AVGTPMBL,SSPUMBL,PVTBLT,SSTBLT,SSDTBLT,PVPSSTBLT,UPVTBLT,AVGTPTBLT,SSPUTBLT) VALUES ("analytics","0", "'.$paginas_analytics.'","'.$id.'", "'.$id_paginas_analytics.'" ,"'.$PVDSK.'","'.$SSDSK.'","'.$SSDDSK.'","'.$PVPSSDSK.'","'.$UPVDSK.'","'.$AVGTPDSK.'","'.$SSPUDSK.'","'.$PVMBL.'","'.$SSMBL.'","'.$SSDMBL.'","'.$PVPSSMBL.'","'.$UPVMBL.'","'.$AVGTPMBL.'","'.$SSPUMBL.'","'.$PVTBLT.'","'.$SSTBLT.'","'.$SSDTBLT.'","'.$PVPSSTBLT.'","'.$UPVTBLT.'","'.$AVGTPTBLT.'","'.$SSPUTBLT.'")');
echo 'muestra';

}if($_POST['tipo']== 'salida'){
echo 'salida';
}else{
  //prueba para prueba_analytics.php
 /* $mysqli = mysqli_connect("localhost","root","root","adnativo_pi") or die("Error " . mysqli_error($link)); 
$mysqli->set_charset('utf8');*/
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
  $results= $mysqli->query('SELECT profile_id FROM Analytics WHERE profile_id="'.$profile.'"');
  $num_rows= mysqli_num_rows($results);
  echo 'inscripcion';
  if($num_rows<1){
   $results2 = $mysqli->query('INSERT INTO Analytics (account_id,webProperty_id,profile_id,PN,PV,SS,SSD,PVPSS,UPV,ATP,SSPU) VALUES ("'.$account.'","'.$webProperty.'","'.$profile.'","'.$pn.'","'.$pv.'","'.$ss.'","'.$ssd.'","'.$pvps.'","'.$upv.'","'.$atp.'","'.$sspu.'")');

  }
}

}

?>