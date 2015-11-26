<script>

      var CLIENT_ID = '1045210216843-rplujhgcennvu03bhggu891cbuojf3bn.apps.googleusercontent.com';
      var SCOPES = ['https://www.googleapis.com/auth/analytics.readonly'];

/*
      $('#auth-button').click(function(){
        authorize();
     });

    $('#subscribeAnalytics').click(function(){
        var profile= $('#listado option:selected').attr('value');
        queryPageViews(profile);
      }); 
*/
  function authorize() {
    var useImmdiate = event ? false : true;
    var authData = {
      client_id: CLIENT_ID,
      scope: SCOPES,
      immediate: useImmdiate
    };

    gapi.auth.authorize(authData, function(response) {
    //  var authButton = document.getElementById('auth-button');
      if (response.error) {
      //  authButton.hidden = false;
      }
      else {
      //  authButton.hidden = true;
        queryAccounts();
      }
    });
  }

  function queryAccounts() {
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
    var paginas_analytics ="";
    var paginas_analytics_nombre =""; 
    var tipo= "muestra_cuentas";
    //$('#listado').show();
    for (var i = 0, account; account = accounts[i]; i++) {
     // $('#listado').append('<optgroup label='+account.name+'>');
      if (account.webProperties) {
        for (var j = 0, property; property = account.webProperties[j]; j++) {
          if (property.profiles) {
            for (var k = 0, profile; profile = property.profiles[k]; k++) { 
            // $('#listado').append('<option id='+account.id+' name='+property.id+' value = '+profile.id+'>'+property.name+' - '+profile.name+'</option>');
            paginas_analytics_nombre += profile.name+",";
            paginas_analytics += profile.id+",";
            }
          }
        //  $('#listado').append('</optgroup>');
        }
      }
      // $('#listado').append('</optgroup>');
    }

      $.ajax({  
            type: "POST",  
            url: "./rrss/analytics/procesar_listado_analytics.php",
            data: "id_paginas_analytics="+paginas_analytics+"&paginas_analytics="+paginas_analytics_nombre+"&tipo="+tipo,
              success: function(data){ 
                console.log(data);

              }
           });

   // console.log(paginas_analytics);
  }
/*
  function queryCoreReportingApi(profile) {
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
        console.log(err);
    });
  }

   function queryPageViews(profile) {
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
          console.log(err);
      });
  }

  document.getElementById('auth-button').addEventListener('click', authorize);
  */
</script>