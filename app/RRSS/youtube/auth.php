<script>


var OAUTH2_CLIENT_ID = '1045210216843-rplujhgcennvu03bhggu891cbuojf3bn.apps.googleusercontent.com';
var OAUTH2_SCOPES_YOUTUBE = ['https://www.googleapis.com/auth/youtube'];


// Upon loading, the Google APIs JS client automatically invokes this callback.
googleApiClientReady = function() {
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
            if(data == 'exito'){
                  alert("gracias por registrar su cuenta");
                  window.location.reload();
                }
                else if(data == 'existe') alert('La cuenta ya está asociada, intente con una cuenta diferente')
                else if(data == 'otro') alert('La cuenta está asociada a otro usuario');
                //else window.reload();
            }
        });

    }
  });
}



  </script>