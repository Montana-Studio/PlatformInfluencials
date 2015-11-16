/*
// The client ID is obtained from the Google Developers Console
// at https://console.developers.google.com/.
// If you run this code from a server other than http://localhost,
// you need to register your own client ID.
var OAUTH2_CLIENT_ID = '1045210216843-rplujhgcennvu03bhggu891cbuojf3bn.apps.googleusercontent.com';
var OAUTH2_SCOPES = ['https://www.googleapis.com/auth/youtube'];

// Upon loading, the Google APIs JS client automatically invokes this callback.
googleApiClientReady = function() {
  gapi.auth.init(function() {
    window.setTimeout(checkAuth, 1);
  });
}

// Attempt the immediate OAuth 2.0 client flow as soon as the page loads.
// If the currently logged-in Google Account has previously authorized
// the client specified as the OAUTH2_CLIENT_ID, then the authorization
// succeeds with no user intervention. Otherwise, it fails and the
// user interface that prompts for authorization needs to display.
function checkAuth() {
  $('#youtube').click(function() {
    gapi.auth.authorize({
      client_id: OAUTH2_CLIENT_ID,
      scope: OAUTH2_SCOPES,
      immediate: false
    }, handleAuthResult);
   });
}

// Handle the result of a gapi.auth.authorize() call.
function handleAuthResult(authResult) {
  if (authResult && !authResult.error) {
    // Authorization was successful. Hide authorization prompts and show
    // content that should be visible after authorization succeeds.
  //  $('.pre-auth').hide();
   // $('.post-auth').show();
    loadAPIClientInterfaces();
  } else {
    // Make the #login-link clickable. Attempt a non-immediate OAuth 2.0
    // client flow. The current function is called when that flow completes.
    
      gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES,
        immediate: false
        }, handleAuthResult);
   
  }
}


   //   $.getJSON('https://www.googleapis.com/youtube/v3/channels?part=id&mine=true', function(data) {    
   

 // Load the client interfaces for the YouTube Analytics and Data APIs, which
  // are required to use the Google APIs JS client. More info is available at
  // https://developers.google.com/api-client-library/javascript/dev/dev_jscript#loading-the-client-library-and-the-api
  function loadAPIClientInterfaces() {
    gapi.client.load('youtube', 'v3', function() {
      gapi.client.load('youtubeAnalytics', 'v1', function() {
        // After both client interfaces load, use the Data API to request
        // information about the authenticated user's channel.
        getUserChannel();
      });
    });
  }

// Keep track of the currently authenticated user's YouTube channel ID.
  var channelId, channelName, channelSubscribers, channelImg;

  // Call the Data API to retrieve information about the currently
  // authenticated user's YouTube channel.
  function getUserChannel() {
    // Also see: https://developers.google.com/youtube/v3/docs/channels/list
    var request = gapi.client.youtube.channels.list({
      // Setting the "mine" request parameter's value to "true" indicates that
      // you want to retrieve the currently authenticated user's channel.
      mine: true,
      part: 'snippet, statistics'
    });                 

    request.execute(function(response) {
      if ('error' in response) {
        displayMessage(response.error.message);
      } else {
        // We need the channel's channel ID to make calls to the Analytics API.
        // The channel ID value has the form "UCdLFeWKpkLhkguiMZUp8lWA".
        channelId = response.items[0].id;
        //channelName = response.items[0].snippet.title;
        //channelSubscribers = response.items[0].statistics.subscriberCount;
        //channelImg = response.items[0].snippet.thumbnails.high.url;
        //tipo= "youtube";
       // alert("youtubeId: " +channelId+"-  youtubeName: "+channelName+"-  youtubeSubscribers: "+ channelSubscribers+"- img link: "+ channelImg);
          $.ajax({  
            type: "POST",  
            url: "rrss/youtube/procesar_youtube.php",  
            data: "youtubeId="+channelId, //"&youtubeName="+channelName+"&youtubeSubscribers="+channelSubscribers+"&youtubeImgUrl="+channelImg, 
            success: function(data){ 
              //alert(data);
              }
          });

      }
    });
  }
*/