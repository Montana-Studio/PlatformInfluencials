<?php

// OAuth2 service account p12 key file
$p12FilePath = 'client_secrets.p12';

// OAuth2 service account ClientId
$serviceClientId = '1045210216843-cefe3gbi031hpdrrgihdocpfr79qgqjr.apps.googleusercontent.com';

// OAuth2 service account email address
$serviceAccountName = '1045210216843-cefe3gbi031hpdrrgihdocpfr79qgqjr@developer.gserviceaccount.com';

// Scopes we're going to use, only analytics for this tutorial
$scopes = array(
    'https://www.googleapis.com/auth/analytics.readonly'
);

$googleAssertionCredentials = new Google_Auth_AssertionCredentials(
    $serviceAccountName,
    $scopes,
    file_get_contents($p12FilePath)
);

$client_email = '1045210216843-cefe3gbi031hpdrrgihdocpfr79qgqjr@developer.gserviceaccount.com';
$private_key = file_get_contents('client_secrets.p12');
$scopes = array('https://www.googleapis.com/auth/analytics.readonly');
$credentials = new Google_Auth_AssertionCredentials(
    $client_email,
    $scopes,
    $private_key
);




$client = new Google_Client();
$client->setAssertionCredentials($credentials);
$client->setClientId($serviceClientId);
$client->setApplicationName("prueba");

// Create Google Service Analytics object with our preconfigured Google_Client
$analytics = new Google_Service_Analytics($client);

// Add Analytics View ID, prefixed with "ga:"
$analyticsViewId    = 'ga:54334926';

$startDate          = '2015-01-01';
$endDate            = '2015-01-15';
$metrics            = 'ga:sessions,ga:pageviews';

$data = $analytics->data_ga->get($analyticsViewId, $startDate, $endDate, $metrics, array(
    'dimensions'    => 'ga:pagePath',
));

// Data 
$items = $data->getRows();

echo $items;
?>