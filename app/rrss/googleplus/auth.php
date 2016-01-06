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
                if(data == 'exito'){
                  alert("gracias por registrar su cuenta");
                  //window.location.reload();
                  window.location.href='http://desarrollo.adnativo.com/pi/app/dashboard-ipe.php#fragment-2';
                }
                else if(data == 'existe') alert('La cuenta ya está asociada, intente con una cuenta diferente')
                else if(data == 'otro') alert('La cuenta está asociada a otro usuario');
                //else window.reload();

            }
        });
      })

    })
  }
</script>
