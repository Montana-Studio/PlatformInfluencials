<!--DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Hello Analytics - A quickstart guide for JavaScript</title>
</head>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<button id="auth-button" hidden>Authorize</button>
<textarea cols="80" rows="20" id="query-output"></textarea>
<p>Datos</p>
Views<input id="pageviews" class="desktop"></input><br/>
Sessions<input id="sessions" class="desktop"></input><br/>
SessionDuration<input id="sessionDuration" class="desktop"></input><br/>
PageviewsPerSession<input id="pageviewsPerSession" class="desktop"></input><br/>
UniquePageviews<input id="uniquePageviews" class="desktop"></input><br/>
AvgTimeOnPage<input id="avgTimeOnPage" class="desktop"></input><br/>
SessionsPerUser<input id="sessionsPerUser" class="desktop"></input><br/-->

<script>
  $(document).ready(function(){
    var auth=0;

     $('#auth-button').click(function(){
        auth =1;
        authorize();
        
     });

    $('#subscribeAnalytics').click(function(){
      var name= $('#listado option:selected').val();
      var account= $('#listado option:selected').attr('id');
      var webProperty= $('#listado option:selected').attr('name');
      var profile= $('#listado option:selected').attr('value');
      var tipo="inscripcion";
      //queryCoreReportingApi(profile);
      $.ajax({  
        type: "POST",  
        url: "./rrss/analytics/procesar_listado_analytics.php",
        data: "account="+account+"&webProperty="+webProperty+"&profile="+profile+"&tipo="+tipo,
        success: function(data){ 

          }
      });
    });
  });
 
  var CLIENT_ID = '1045210216843-rplujhgcennvu03bhggu891cbuojf3bn.apps.googleusercontent.com';
  var SCOPES = ['https://www.googleapis.com/auth/analytics.readonly'];

  function authorize(event) {
    // Handles the authorization flow.
    // `immediate` should be false when invoked from the button click
    var useImmdiate = event ? false : true;
    var authData = {
      client_id: CLIENT_ID,
      scope: SCOPES,
      immediate: useImmdiate,
      access_type: offline,
    };

    gapi.auth.authorize(authData, function(response) {
     // var authButton = document.getElementById('auth-button');
      if (response.error) {
       // authButton.hidden = false;
      }
      else {
        //authButton.hidden = true;
        queryAccounts();
      }
    });
  }

  function queryAccounts() {
    // Load the Google Analytics client library.
     gapi.client.load('analytics', 'v3').then(function() {

      /* AQUI QUEDE!!!!!!!!!!!!!!!!!!!!!!!
     // queryCoreReportingApi(profile); 
     */
    var request = gapi.client.analytics.management.accountSummaries.list();
    request.execute(handleResponse);
    });
    
    
  }


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
    //queryPageViews('110469162'); //here I must take the id of every account registered
 //   var a = "-";
    for (var i = 0, account; account = accounts[i]; i++) {
      $('#listado').append('<optgroup label='+account.name+'>');
      // Print the properties.
      if (account.webProperties) {
         // printProperties(account.webProperties);
        for (var j = 0, property; property = account.webProperties[j]; j++) {
       //   $('#listado').append('<!--optgroup label='+a+property.name+'-->');
          if (property.profiles) {
            for (var k = 0, profile; profile = property.profiles[k]; k++) { 
             $('#listado').append('<option id='+account.id+' name='+property.id+' value = '+profile.id+'>'+property.name+' - '+profile.name+'</option>');
            }
          }
          $('#listado').append('</optgroup>');
        }
      }
       $('#listado').append('</optgroup>');
    }
  }



  function queryCoreReportingApi(profile) {
    // Query the Core Reporting API for the number sessions for
    // the past seven days.
    gapi.client.analytics.data.ga.get({
      'ids': 'ga:'+profile,
      'start-date': '90daysAgo',
      'end-date': 'today',
      'metrics': 'ga:pageviews, ga:sessions, ga:sessionDuration, ga:pageviewsPerSession, ga:uniquePageviews, ga:avgTimeOnPage, ga:sessionsPerUser',
      'dimensions' : 'ga:deviceCategory', 
      
    })
    .then(function(response) {
      var formattedJson = JSON.stringify(response.result, null, 2);
      //document.getElementById('query-output').value = formattedJson;
         obj = JSON.parse(formattedJson);
         //document.getElemetsByTag('p').value= obj.rows[0];
        alert(obj.rows[0].desktop);
    })
    .then(null, function(err) {
        // Log any errors.
        console.log(err);
    });
  }

   function queryPageViews(profile) {
      // Query the Core Reporting API for the number sessions for
      // the past seven days.
      gapi.client.analytics.data.ga.get({
        'ids': 'ga:'+profile,
        'start-date': '90daysAgo',
        'end-date': 'today',
        'metrics': 'ga:pageviews, ga:sessions, ga:sessionDuration, ga:pageviewsPerSession, ga:uniquePageviews, ga:avgTimeOnPage, ga:sessionsPerUser',
        'dimensions' : 'ga:deviceCategory', 
      })
      .then(function(response) {
        /*var formattedJson = JSON.stringify(response.result, null, 2);
        obj = JSON.parse(formattedJson);
        document.getElementById('pageviews').value = obj.rows[0][1];
        document.getElementById('sessions').value = obj.rows[0][2];
        document.getElementById('sessionDuration').value = parseInt(obj.rows[0][3]);
        document.getElementById('pageviewsPerSession').value = parseFloat(obj.rows[0][4]).toFixed(2);
        document.getElementById('uniquePageviews').value = obj.rows[0][5];
        document.getElementById('avgTimeOnPage').value = parseInt(obj.rows[0][6]) + " segundos";
        document.getElementById('sessionsPerUser').value = obj.rows[0][7];*/
           //document.getElemetsByTag('p').value= obj.rows[0];
          //alert(obj.rows[0]);
      })
      .then(null, function(err) {
          // Log any errors.
          console.log(err);
      });
  }
  // Add an event listener to the 'auth-button'.
  //document.getElementById('auth-button').addEventListener('click', authorize);
</script>
