<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Hello Analytics - A quickstart guide for JavaScript</title>
</head>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<button id="auth-button" hidden>Authorize</button>
<!--textarea cols="80" rows="20" id="query-output"></textarea-->
<script>
$(document).ready(function(){

  $('#subscribeAnalytics').click(function(){
    var name= $('#listado option:selected').val();
    //var name= $('#listado ') 
    var id= $('#listado option:selected').attr('id');
    var tipo="inscripcion";
    $.ajax({  
      type: "POST",  
      url: "procesar_listado_analytics.php",
      data: "id="+id+"&name="+name+"&tipo="+tipo,
      success: function(data){ 
        alert(data);
        }
    });
  })
});

 
  var CLIENT_ID = '1045210216843-rplujhgcennvu03bhggu891cbuojf3bn.apps.googleusercontent.com';
  // Set authorized scope.
  var SCOPES = ['https://www.googleapis.com/auth/analytics.readonly'];


  function authorize(event) {
    // Handles the authorization flow.
    // `immediate` should be false when invoked from the button click
    var useImmdiate = event ? false : true;
    var authData = {
      client_id: CLIENT_ID,
      scope: SCOPES,
      immediate: useImmdiate
    };

    gapi.auth.authorize(authData, function(response) {
      var authButton = document.getElementById('auth-button');
      if (response.error) {
        authButton.hidden = false;
      }
      else {
        authButton.hidden = true;
        queryAccounts();
      }
    });
  }


function queryAccounts() {
  // Load the Google Analytics client library.
  gapi.client.load('analytics', 'v3').then(function() {

    // Get a list of all Google Analytics accounts for this user
  var request = gapi.client.analytics.management.accountSummaries.list();
  request.execute(handleResponse);
  });
}


/*
 * Example 2:
 * The results of the list method are passed as the response object.
 * The following code shows how to iterate through them.
 */
function handleResponse(response) {
  if (response && !response.error) {
    if (response.items) {
      printAccountSummaries(response.items);
    }
  } else {
    console.log('There was an error: ' + response.message);
  }
}


function printAccountSummaries(accounts) {
  for (var i = 0, account; account = accounts[i]; i++) {
    console.log('Account id: ' + account.id);
    console.log('Account name: ' + account.name);
    console.log('Account kind: ' + account.kind);

    // Print the properties.
    if (account.webProperties) {
      printProperties(account.webProperties);
    }
  }
}


function printProperties(properties) {
  for (var j = 0, property; property = properties[j]; j++) {
    console.log('Property id: ' + property.id);
    console.log('Property name: ' + property.name);
    console.log('Property kind: ' + property.kind);
    console.log('Internal id: ' + property.internalWebPropertyId);
    console.log('Property level: ' + property.level);
    console.log('Property url: ' + property.websiteUrl);

    // Print the views (profiles).
    if (property.profiles) {
      printProfiles(property.profiles);
    }
  }
}


function printProfiles(profiles) {
  for (var k = 0, profile; profile = profiles[k]; k++) {
    console.log('Profile id: ' + profile.id);
    console.log('Profile name: ' + profile.name);
    console.log('Profile kind: ' + profile.kind);
    console.log('Profile type: ' + profile.type);
  }
}

/*
function queryAccounts() {
  // Load the Google Analytics client library.
  gapi.client.load('analytics', 'v3').then(function() {

    // Get a list of all Google Analytics accounts for this user
    gapi.client.analytics.management.accounts.list().then(handleAccounts);
  });
}


function handleAccounts(response) {
  // Handles the response from the accounts list method.
  if (response.result.items && response.result.items.length) {
    document.getElementById('listado').innerHTML+='';
        var tipo= "listado"
    for(var i=0;i< response.result.items.length;i++){

          // Get the first Google Analytics account.
    var accountId = response.result.items[i].id;
    var accountName = response.result.items[i].name;
    $.ajax({  

            type: "POST",  
            url: "procesar_listado_analytics.php",
            data: "id="+accountId+"&name="+accountName+"&tipo="+tipo,
            success: function(data){ 
              //alert(data);
              }
          });

    // Query for properties.
    //queryProperties(firstAccountId);
    //listado_de_paginas=listado_de_paginas.concat(firstAccountId,"-");
    
    document.getElementById('listado').innerHTML+='<option id='+accountId+'>'+accountName+'</option>';


    }
   // console.log(listado_de_paginas);
    
  } else {
    console.log('No accounts found for this user.');
  }
}



/*
function queryProperties(accountId) {
  // Get a list of all the properties for the account.
  gapi.client.analytics.management.webproperties.list(
      {'accountId': accountId})
    .then(handleProperties)
    .then(null, function(err) {
      // Log any errors.
      console.log(err);
  });
}


function handleProperties(response) {
  // Handles the response from the webproperties list method.
  if (response.result.items && response.result.items.length) {

    // Get the first Google Analytics account
    var firstAccountId = response.result.items[0].accountId;

    // Get the first property ID
    var firstPropertyId = response.result.items[0].id;

    // Query for Views (Profiles).
    queryProfiles(firstAccountId, firstPropertyId);
  } else {
    console.log('No properties found for this user.');
  }
}


function queryProfiles(accountId, propertyId) {
  // Get a list of all Views (Profiles) for the first property
  // of the first Account.
  gapi.client.analytics.management.profiles.list({
      'accountId': accountId,
      'webPropertyId': propertyId
  })
  .then(handleProfiles)
  .then(null, function(err) {
      // Log any errors.
      console.log(err);
  });
}


function handleProfiles(response) {
  // Handles the response from the profiles list method.
  if (response.result.items && response.result.items.length) {
    // Get the first View (Profile) ID.
    var firstProfileId = response.result.items[0].id;

    // Query the Core Reporting API.
    queryCoreReportingApi(firstProfileId);
  } else {
    console.log('No views (profiles) found for this user.');
  }
}


function queryCoreReportingApi(profileId) {
  // Query the Core Reporting API for the number sessions for
  // the past seven days.
  gapi.client.analytics.data.ga.get({
    'ids': 'ga:' + profileId,
    'start-date': '90daysAgo',
    'end-date': 'today',
    'metrics': 'ga:sessions, ga:pageviews'
  })
  .then(function(response) {
    var formattedJson = JSON.stringify(response.result, null, 2);
    document.getElementById('query-output').value = formattedJson;
  })
  .then(null, function(err) {
      // Log any errors.
      console.log(err);
  });
}
*/
  // Add an event listener to the 'auth-button'.
  

document.getElementById('auth-button').addEventListener('click', authorize);



</script>

<script src="https://apis.google.com/js/client.js?onload=authorize"></script>
<select id="listado"><option value="defaultvalue">seleccione propiedad</option></select>
<button id="subscribeAnalytics">agregar página</button>

</body>
</html>