<script>

      var CLIENT_ID = '1025436094979-pl26ineap35ds15olqsqjoisi2ql4inb.apps.googleusercontent.com';
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
      if (response.error) {
      }
      else {
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


  function printAccountSummaries(accounts){
    var paginas_analytics ="";
    var page_name_analytics ="";
    var array_paginas_analytics = "" ;
    var largo_array_paginas_analytics = "" ;
    var array_paginas_analytics_nombre = "" ;
    var largo_array_paginas_analytics_nombre = "" ;
    var tipo= "muestra_cuentas";
    for (var i = 0, account; account = accounts[i]; i++){
      if (account.webProperties) {
        for (var j = 0, property; property = account.webProperties[j]; j++){
          if (property.profiles) {
            for (var k = 0, profile; profile = property.profiles[k]; k++){ 
                page_name_analytics += profile.name+",";
                paginas_analytics += profile.id+",";
                array_paginas_analytics = paginas_analytics.split(",");
                largo_array_paginas_analytics = array_paginas_analytics.length - 1;
                array_paginas_analytics_nombre = page_name_analytics.split(",");
                largo_array_paginas_analytics_nombre = array_paginas_analytics_nombre.length - 1;
               
             }
          }
        }
      }
    }

    var termino='0';
    if(termino=='0'){
     for(var l=0; l<=largo_array_paginas_analytics;l++){
        queryPageViews(array_paginas_analytics[l],array_paginas_analytics_nombre[l],tipo,l,largo_array_paginas_analytics);
        if(l==largo_array_paginas_analytics) termino='1';
    }
    }else if (termino=='1'){
    }
  }

   function queryPageViews(profile,profile_name,tipo,actual,largo) {
    
        console.log(tipo);
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
        var pageviews_desktop = obj.rows[0][1];
        var sessions_desktop= obj.rows[0][2];
        var sessionDuration_desktop = parseInt(obj.rows[0][3]);
        var pageviewsPerSession_desktop = parseFloat(obj.rows[0][4]).toFixed(2);
        var uniquePageviews_desktop = obj.rows[0][5];
        var avgTimeOnPage_desktop = parseInt(obj.rows[0][6]) + " segundos";
        var sessionsPerUser_desktop = obj.rows[0][7];
        var pageviews_mobile = obj.rows[1][1];
        var sessions_mobile = obj.rows[1][2];
        var sessionDuration_mobile = parseInt(obj.rows[1][3]);
        var pageviewsPerSession_mobile = parseFloat(obj.rows[1][4]).toFixed(2);
        var uniquePageviews_mobile = obj.rows[1][5];
        var avgTimeOnPage_mobile = parseInt(obj.rows[1][6]) + " segundos";
        var sessionsPerUser_mobile = obj.rows[1][7];
        var pageviews_tablet = obj.rows[2][1];
        var sessions_tablet = obj.rows[2][2];
        var sessionDuration_tablet = parseInt(obj.rows[2][3]);
        var pageviewsPerSession_tablet = parseFloat(obj.rows[2][4]).toFixed(2);
        var uniquePageviews_tablet = obj.rows[2][5];
        var avgTimeOnPage_tablet = parseInt(obj.rows[2][6]) + " segundos";
        var sessionsPerUser_tablet  = obj.rows[2][7];
        
        //console.log(pageviews_desktop+sessions_desktop+sessionDuration_desktop+pageviewsPerSession_desktop);
        
       $.ajax({  
            type: "POST",  
            url: "./rrss/analytics/procesar_listado_analytics.php",
            data: "id_paginas_analytics="+profile+"&paginas_analytics="+profile_name+"&tipo="+tipo+"&pageviews_desktop="+pageviews_desktop+"&sessions_desktop="+sessions_desktop+"&sessionDuration_desktop="+sessionDuration_desktop+"&pageviewsPerSession_desktop="+pageviewsPerSession_desktop+"&uniquePageviews_desktop="+uniquePageviews_desktop+"&avgTimeOnPage_desktop="+avgTimeOnPage_desktop+"&sessionsPerUser_desktop="+sessionsPerUser_desktop+"&pageviews_mobile="+pageviews_mobile+"&sessions_mobile="+sessions_mobile+"&sessionDuration_mobile="+sessionDuration_mobile+"&pageviewsPerSession_mobile="+pageviewsPerSession_mobile+"&uniquePageviews_mobile="+uniquePageviews_mobile+"&avgTimeOnPage_mobile="+avgTimeOnPage_mobile+"&sessionsPerUser_mobile="+sessionsPerUser_mobile+"&pageviews_tablet="+pageviews_tablet+"&sessions_tablet="+sessions_tablet+"&sessionDuration_tablet="+sessionDuration_tablet+"&pageviewsPerSession_tablet="+pageviewsPerSession_tablet+"&uniquePageviews_tablet="+uniquePageviews_tablet+"&avgTimeOnPage_tablet="+avgTimeOnPage_tablet+"&sessionsPerUser_tablet="+sessionsPerUser_tablet,
              success: function(data){ 
                <?php inscripcion_analytics();?>
              }

        });


      })
      .then(null, function(err) {
          console.log(err);
      });
  }




//  document.getElementById('auth-button').addEventListener('click', authorize);

</script>