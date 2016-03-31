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

<h1 id="profileName"></h1> 
<table id="desktop">
  <tr><h2>Desktop</h2></tr>
    <tr><td>Views </td><td id="pageviews-desktop" class="desktop"></td></tr>
    <tr><td>Sessions </td><td id="sessions-desktop" class="desktop"></td></tr>
    <tr><td>SessionDuration </td><td id="sessionDuration-desktop" class="desktop"></td></tr>
    <tr><td>PageviewsPerSession </td><td id="pageviewsPerSession-desktop" class="desktop"></td></tr>
    <tr><td>UniquePageviews </td><td id="uniquePageviews-desktop" class="desktop"></td></tr>
    <tr><td>AvgTimeOnPage </td><td id="avgTimeOnPage-desktop" class="desktop"></td></tr>
    <tr><td>SessionsPerUser </td><td id="sessionsPerUser-desktop" class="desktop"></td></tr>
</table>
<table id="mobile">
  <tr><h2>Mobile</h2></tr>
    <tr><td>Views </td><td id="pageviews-mobile" class="mobile"></td></tr>
    <tr><td>Sessions </td><td id="sessions-mobile" class="mobile"></td></tr>
    <tr><td>SessionDuration </td><td id="sessionDuration-mobile" class="mobile"></td></tr>
    <tr><td>PageviewsPerSession </td><td id="pageviewsPerSession-mobile" class="mobile"></td></tr>
    <tr><td>UniquePageviews </td><td id="uniquePageviews-mobile" class="mobile"></td></tr>
    <tr><td>AvgTimeOnPage </td><td id="avgTimeOnPage-mobile" class="mobile"></td></tr>
    <tr><td>SessionsPerUser </td><td id="sessionsPerUser-mobile" class="mobile"></td></tr>
</table>
<table id="tablet">
  <tr><h2>Tablet</h2></tr>
    <tr><td>Views </td><td id="pageviews-tablet" class="tablet"></td></tr>
    <tr><td>Sessions </td><td id="sessions-tablet" class="tablet"></td></tr>
    <tr><td>SessionDuration </td><td id="sessionDuration-tablet" class="tablet"></td></tr>
    <tr><td>PageviewsPerSession </td><td id="pageviewsPerSession-tablet" class="tablet"></td></tr>
    <tr><td>UniquePageviews </td><td id="uniquePageviews-tablet" class="tablet"></td></tr>
    <tr><td>AvgTimeOnPage </td><td id="avgTimeOnPage-tablet" class="tablet"></td></tr>
    <tr><td>SessionsPerUser </td><td id="sessionsPerUser-tablet" class="tablet"></td></tr>
</table>

<script-->
<script>
  $(document).ready(function(){
      var CLIENT_ID = '1025436094979-pl26ineap35ds15olqsqjoisi2ql4inb.apps.googleusercontent.com';
      var SCOPES = ['https://www.googleapis.com/auth/analytics.readonly'];


      $('#auth-button').click(function(){
        authorize();
     });

    $('#subscribeAnalytics').click(function(){
      var profile= $('#listado option:selected').attr('value');
      queryPageViews(profile);
    });
  });
 
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
      'end-date': 'yesterday',
      'metrics': 'ga:pageviews, ga:sessions, ga:sessionDuration, ga:pageviewsPerSession, ga:uniquePageviews, ga:avgTimeOnPage, ga:sessionsPerUser',
      'dimensions' : 'ga:deviceCategory', 
    })
    .then(function(response) {
      var formattedJson = JSON.stringify(response.result, null, 2);
      document.getElementById('query-output').value = formattedJson;
         obj = JSON.parse(formattedJson);
         document.getElemetsByTag('p').value= obj.rows[0];
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
        'end-date': 'yesterday',
        'metrics': 'ga:pageviews, ga:sessions, ga:sessionDuration, ga:pageviewsPerSession, ga:uniquePageviews, ga:avgTimeOnPage, ga:sessionsPerUser',
        'dimensions' : 'ga:deviceCategory', 
      })
      .then(function(response) {
        var formattedJson = JSON.stringify(response.result, null, 2);
        obj = JSON.parse(formattedJson);
        document.getElementById('profileName').innerHTML ="Datos de "+ obj.profileInfo.profileName;
        document.getElementById('pageviews-desktop').innerHTML = obj.rows[0][1];
        document.getElementById('sessions-desktop').innerHTML = obj.rows[0][2];
        document.getElementById('sessionDuration-desktop').innerHTML = parseInt(obj.rows[0][3]);
        document.getElementById('pageviewsPerSession-desktop').innerHTML = parseFloat(obj.rows[0][4]).toFixed(2);
        document.getElementById('uniquePageviews-desktop').innerHTML = obj.rows[0][5];
        document.getElementById('avgTimeOnPage-desktop').innerHTML = parseInt(obj.rows[0][6]) + " segundos";
        document.getElementById('sessionsPerUser-desktop').innerHTML = obj.rows[0][7];
        document.getElementById('pageviews-mobile').innerHTML = obj.rows[1][1];
        document.getElementById('sessions-mobile').innerHTML = obj.rows[1][2];
        document.getElementById('sessionDuration-mobile').innerHTML = parseInt(obj.rows[1][3]);
        document.getElementById('pageviewsPerSession-mobile').innerHTML = parseFloat(obj.rows[1][4]).toFixed(2);
        document.getElementById('uniquePageviews-mobile').innerHTML = obj.rows[1][5];
        document.getElementById('avgTimeOnPage-mobile').innerHTML = parseInt(obj.rows[1][6]) + " segundos";
        document.getElementById('sessionsPerUser-mobile').innerHTML = obj.rows[1][7];
        document.getElementById('pageviews-tablet').innerHTML = obj.rows[2][1];
        document.getElementById('sessions-tablet').innerHTML = obj.rows[2][2];
        document.getElementById('sessionDuration-tablet').innerHTML = parseInt(obj.rows[2][3]);
        document.getElementById('pageviewsPerSession-tablet').innerHTML = parseFloat(obj.rows[2][4]).toFixed(2);
        document.getElementById('uniquePageviews-tablet').innerHTML = obj.rows[2][5];
        document.getElementById('avgTimeOnPage-tablet').innerHTML = parseInt(obj.rows[2][6]) + " segundos";
        document.getElementById('sessionsPerUser-tablet').innerHTML = obj.rows[2][7];
        document.getElementById('query-output').value = formattedJson;
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

<!--script src="https://apis.google.com/js/client.js?onload=authorize"></script>
<select id="listado"><option value="defaultvalue">seleccione propiedad</option></select>
<button id="subscribeAnalytics">agregar página</button>
<div id="muestra_datos">
  <p></p>
</div>

</body>
</html-->