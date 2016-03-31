<script async type="text/javascript">


var OAUTH2_CLIENT_ID = '1025436094979-pl26ineap35ds15olqsqjoisi2ql4inb.apps.googleusercontent.com';
var OAUTH2_SCOPES_YOUTUBE = ['https://www.googleapis.com/auth/youtube'];


// Upon loading, the Google APIs JS client automatically invokes this callback.
googleApiClientYoutubeReady = function() {
  gapi.auth.init(function() {
    window.setTimeout(checkAuthYoutube, 1);
  });
}

function checkAuthYoutube() {
    gapi.auth.authorize({
      client_id: OAUTH2_CLIENT_ID,
      scope: OAUTH2_SCOPES_YOUTUBE,
      immediate: false
    }, handleAuthResultYoutube);
}


function handleAuthResultYoutube(authResult) {
  if (authResult && !authResult.error) {
    loadAPIClientInterfacesYoutube();
  } else {
      gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES_YOUTUBE,
        immediate: false
        }, handleAuthResultYoutube);

  }
}


function loadAPIClientInterfacesYoutube() {
  gapi.client.load('youtube', 'v3', function() {
    gapi.client.load('youtubeAnalytics', 'v1', function() {
      getUserChannel();
    });
  });
}

function getUserChannel() {
  var channelId;

  var request = gapi.client.youtube.channels.list({
    mine: true,
    part: 'snippet, statistics'
  });

  request.execute(function(response) {
    if ('error' in response) {
      displayMessage(response.error.message);
    } else {
      channelId = response.items[0].id;
      //alert(channelId);
        $.ajax({
          type: "POST",
          url: "rrss/youtube/procesar_youtube.php",
          data: "youtubeId="+channelId,
          success: function(data){
            //var data = <?php $_SESSION['data'];?>
            inscripcion_youtube();
            }
        });

    }
  });
}



  </script>
