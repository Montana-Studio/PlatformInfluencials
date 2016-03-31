<script  async type="text/javascript">

var OAUTH2_CLIENT_ID = '1025436094979-pl26ineap35ds15olqsqjoisi2ql4inb.apps.googleusercontent.com';
var OAUTH2_SCOPES = ['https://www.googleapis.com/auth/plus.me'];

// Upon loading, the Google APIs JS client automatically invokes this callback.
googleApiClientReadyGooglePlus = function() {
  gapi.auth.init(function() {
    window.setTimeout(checkAuthGooglePlus, 1);
  });
}


function checkAuthGooglePlus() {
   gapi.auth.authorize({
      client_id: OAUTH2_CLIENT_ID,
      scope: OAUTH2_SCOPES,
      immediate: false
    }, handleAuthResult);
}


function handleAuthResult(authResult) {
  if (authResult && !authResult.error) {
    loadAPIClientInterfaces();

  } else {
    gapi.auth.authorize({
      client_id: OAUTH2_CLIENT_ID,
      scope: OAUTH2_SCOPES,
      immediate: false
    }, handleAuthResult);
  }
}

  function loadAPIClientInterfaces() {
    gapi.client.load('plus','v1', function(){
       var request = gapi.client.plus.people.get({
         'userId': 'me'
       });

       request.execute(function(resp) {
        var id = resp.id;
        $.ajax({
            type: "POST",
            url: "rrss/googleplus/procesar_googleplus.php",
            data: "googlePlusId="+id, //"&youtubeName="+channelName+"&youtubeSubscribers="+channelSubscribers+"&youtubeImgUrl="+channelImg,
            success: function(data){
                //inscripcion_googleplus();
            }
        });
      })

    })
  }
</script>
