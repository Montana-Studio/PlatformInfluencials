<?php
   include '../analytics-prueba/google-api-php-client/src/Google/Client.php';
   set_include_path(get_include_path() . PATH_SEPARATOR . '../analytics-prueba/google-api-php-client/src');
   session_start();   
/************************************************ 
 The following 3 values an befound in the setting 
 for the application you created on Google    
 Developers console.     Developers console.
 The Key file should be placed in a location   
 that is not accessable from the web. outside of 
 web root.     web root.
     
 In order to access your GA account you must  
 Add the Email address as a user at the   
 ACCOUNT Level in the GA admin.     
 ************************************************/
  $client_id = '1045210216843-rplujhgcennvu03bhggu891cbuojf3bn.apps.googleusercontent.com';
  $Email_address = 'account-2@platform2-1069.iam.gserviceaccount.com';   
  $key_file_location = '../p12/client_secrets.p12';    
  
  $client = new Google_Client();    
  $client->setApplicationName("HelloAnalytics");
  $key = file_get_contents($key_file_location);  

  // seproate additional scopes with a comma   
  $scopes ="https://www.googleapis.com/auth/analytics.readonly";  

  $cred = new Google_Auth_AssertionCredentials($Email_address,     
                 array($scopes),    
                 $key);   

  $client->setAssertionCredentials($cred);
  if($client->getAuth()->isAccessTokenExpired()) {    
     $client->getAuth()->refreshTokenWithAssertion($cred);    
  }   

  $service = new Google_Service_Analytics($client);

  
  
  //Adding Dimensions
  $params = array('dimensions' => 'ga:userType'); 
  // requesting the data  
  $data = $service->data_ga->get("ga:89798036", "2014-12-14", "2014-12-14", "ga:users,ga:sessions", $params );   
?>

<html>   
Results for date:  2014-12-14<br>
  <table border="1">   
    <tr>   
    <?php  
    //Printing column headers
    foreach($data->getColumnHeaders() as $header){
       print "<td><b>".$header['name']."</b></td>";     
      }   
    ?>    
    </tr>   
    <?php   
    //printing each row.
    foreach ($data->getRows() as $row) {    
      print "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";   
    }  
?>    
<tr><td colspan="2">Rows Returned <?php print $data->getTotalResults();?> </td></tr>   
</table>   
</html> 
  ?>