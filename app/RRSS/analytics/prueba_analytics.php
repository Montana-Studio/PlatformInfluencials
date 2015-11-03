<!DOCTYPE html>
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
Profile<p id="profileName"></p>
Views<p id="pageviews" class="desktop"></p>
Sessions<p id="sessions" class="desktop"></p>
SessionDuration<p id="sessionDuration" class="desktop"></p>
PageviewsPerSession<p id="pageviewsPerSession" class="desktop"></p>
UniquePageviews<p id="uniquePageviews" class="desktop"></p>
AvgTimeOnPage<p id="avgTimeOnPage" class="desktop"></p>
SessionsPerUser<p id="sessionsPerUser" class="desktop"></p>

<script>
  $(document).ready(function(){
      $('#auth-button').click(function(){
        authorize();
     });
    $('#subscribeAnalytics').click(function(){
      var profile= $('#listado option:selected').attr('value');
      queryPageViews(profile);
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
   // queryPageViews('88393644'); //here I must take the id of every account registered
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
      document.getElementById('query-output').value = formattedJson;
         obj = JSON.parse(formattedJson);
         //document.getElemetsByTag('p').value= obj.rows[0];
        alert(obj.rows[0][1]);
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
        var formattedJson = JSON.stringify(response.result, null, 2);
        obj = JSON.parse(formattedJson);
        document.getElementById('profileName').innerHTML = obj.profileInfo.profileName;
        document.getElementById('pageviews').innerHTML = obj.rows[0][1];
        document.getElementById('sessions').innerHTML = obj.rows[0][2];
        document.getElementById('sessionDuration').innerHTML = parseInt(obj.rows[0][3]);
        document.getElementById('pageviewsPerSession').innerHTML = parseFloat(obj.rows[0][4]).toFixed(2);
        document.getElementById('uniquePageviews').innerHTML = obj.rows[0][5];
        document.getElementById('avgTimeOnPage').innerHTML = parseInt(obj.rows[0][6]) + " segundos";
        document.getElementById('sessionsPerUser').innerHTML = obj.rows[0][7];
       /* var PageName = obj.profileInfo.profileName;
        var Pageviews = obj.rows[0][1];
        var Sessions= obj.rows[0][2];
        var SessionsDuration= parseInt(obj.rows[0][3]);
        var PageviewsPerSession = parseFloat(obj.rows[0][4]).toFixed(2);
        alert(pageviewsPerSession);
        var UniquePageviews = obj.rows[0][5];
        var AvgTimeOnPage= parseInt(obj.rows[0][6]) + " segundos";
        var SessionsPerUser = obj.rows[0][7];
        var tipo = 'inscripcion';*/
        $(document).ready(function(){
             var name= $('#listado option:selected').val();
            var account= $('#listado option:selected').attr('id');
            var webProperty= $('#listado option:selected').attr('name');
            var profile= $('#listado option:selected').attr('value');
            var tipo="inscripcion";
            //var PageName = $('#profileName').html();
            var Pageviews = $('#pageviews').html();
            var Sessions = $('#sessions').html();
            var SessionsDuration = $('#sessionDuration').html();
            var PageviewsPerSession = $('#pageviewsPerSession').html();
            var UniquePageviews = $('#uniquePageviews').html();
            var AvgTimeOnPage = $('#avgTimeOnPage').html();
            var SessionsPerUser = $('#sessionsPerUser').html();

            $.ajax({  
            type: "POST",  
            url: "procesar_listado_analytics.php",
            data: "account="+account+"&webProperty="+webProperty+"&profile="+profile+"&tipo="+tipo+"&pn="+name+"&pv="+Pageviews+"&ss="+Sessions+"&ssd="+SessionsDuration+"&pvps="+PageviewsPerSession+"&upv="+UniquePageviews+"&atp="+AvgTimeOnPage+"&sspu="+SessionsPerUser,
              success: function(data){ 

              }
           });
        })
        
      })
      .then(null, function(err) {
          // Log any errors.
          console.log(err);
      });
  }
  // Add an event listener to the 'auth-button'.
  document.getElementById('auth-button').addEventListener('click', authorize);
</script>

<script src="https://apis.google.com/js/client.js?onload=authorize"></script>
<select id="listado"><option value="defaultvalue">seleccione propiedad</option></select>
<button id="subscribeAnalytics">agregar página</button>
<div id="muestra_datos">
  <p></p>
</div>

</body>
</html>