(function ($, window, document, undefined) {
'use strict';

    $(function () {
        
        /* Settings
           ========================================================================== */
        var facebookPage = "296448387178344",
            youtubeId = "UCbSAk3R9JeqCQYAYrrn_fgQ",
            googlePlusId = "106493591583179933181",
            googleKey = "AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c",
            pinterestUser = "marlenetiare",
            instagramUserId = "2007022744",
            instagramToken = "2007022744.4c1a459.69ecf02d9af84061ae4186bdd677dab6",
            flickrUserId = "XXXXXX",
            flickrApiKey = "XXXXXX", 
            facebookAppId = "973652052702468",
            facebookKey ="693511c0b86cda985e20ba5a19f556c0";

        /* Facebook
           ========================================================================== */
        $.getJSON('https://graph.facebook.com/'+facebookPage+'?access_token='+facebookAppId+'|'+facebookKey+'&fields=likes,talking_about_count,username,website', function(data) {
            var fb_count = data['likes'].toString();
            var fb_talking_count = data['talking_about_count'].toString();
            var username = data['username'].toString();
            var website = data['website'].toString();
            // Display
            $('.fb-username').html(username);
            $('.fb-website').html(website);
            $('.fb-likes').html(fb_count);
            $('.fb-talking-about').html(fb_talking_count);
        });

       /* Youtube
           ========================================================================== */
        $.getJSON('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id='+youtubeId+'&key='+googleKey, function(data) {
            var ytSubscriberCount = data.items[0].statistics.subscriberCount;
            var ytName = data.items[0].snippet.title;
            var ytImg = data.items[0].snippet.thumbnails.high.url;
            //Display
            $('.yt-subscribers').html(ytSubscriberCount);
            $('.yt-name').html(ytName);
            $('.yt-img img').attr('src',ytImg);

        });

        /* Google+
           ========================================================================== */
        $.getJSON('https://www.googleapis.com/plus/v1/people/'+googlePlusId+'?key='+googleKey, function(data) {
            // followers count
            var gpSubscriberCount = data.circledByCount;
            gpSubscriberCount = add_space(gpSubscriberCount);
            var gpName= data.name.givenName + " " + data.name.familyName;
            var gpImage = data.image.url;
            console.log(gpImage);

            // Display
            $('.gp-followers').html(gpSubscriberCount);
            $('.gp-img img').attr('src', gpImage);
        });


        /* Instagram
           ========================================================================== */
        $.ajax({
            url: 'https://api.instagram.com/v1/users/'+instagramUserId+'/?access_token='+instagramToken,
            dataType: 'jsonp',
            success: function(data){
                // media count
                var instMediaCount = data.data.counts.media;
                instMediaCount = add_space(instMediaCount);

                // followers count
                var instFollowerCount = data.data.counts.followed_by;
                instFollowerCount = add_space(instFollowerCount);

                // // Display
                $('.inst-media').html(instMediaCount);
                $('.inst-followers').html(instFollowerCount);
            }
        });


        /* Flickr
           ========================================================================== 
        $.getJSON('https://api.flickr.com/services/rest/?method=flickr.people.getInfo&api_key='+flickrApiKey+'&user_id='+flickrUserId+'&format=json&nojsoncallback=1', function(data) {
            // photo count
            var flPhotoCount = data.person.photos.count._content;
            flPhotoCount = add_space(flPhotoCount);

            // Display
            $('.fl-photos').html(flPhotoCount);
        });
        $.getJSON('https://api.flickr.com/services/rest/?method=flickr.photosets.getList&api_key='+flickrApiKey+'&user_id='+flickrUserId+'&format=json&nojsoncallback=1', function(data) {
            // album(photoset) count
            var flPhotoSetCount = data.photosets.total;
            flPhotoSetCount = add_space(flPhotoSetCount);

            // Display
            $('.fl-photoSet').html(flPhotoSetCount);
        });



        /* Pinterest  (http://stackoverflow.com/questions/9951045/pinterest-api-documentation)
           ========================================================================== */
        $.ajax({
            url: 'https://api.pinterest.com/v3/pidgets/users/'+pinterestUser+'/pins/',
            dataType: 'jsonp',
            success: function(data){
                // pins count
                var ptPinCount = data.data.pins[0].pinner.pin_count;
                ptPinCount = add_space(ptPinCount);

                // followers count
                var ptFollowerCount = data.data.pins[0].pinner.follower_count;
                ptFollowerCount = add_space(ptFollowerCount);

                // Display
                $('.pt-pins').html(ptPinCount);
                $('.pt-followers').html(ptFollowerCount);
            }
        });



        /* Twitter (https://dev.twitter.com/rest/reference/get/users/show)
           ========================================================================== */

                
                    

    });

})(jQuery, window, document);


/* Add a space every 3 decimals '1293847' => '1 293 847'
   ========================================================================== */
function add_space(number) {
    if (number.length > 3) {
        var mod = number.length % 3;
        var output = (mod > 0 ? (number.substring(0,mod)) : '');
        for (var i=0 ; i < Math.floor(number.length / 3); i++) {
            if ((mod === 0) && (i === 0)) {
                output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
            } else {
                output+= ' ' + number.substring(mod + 3 * i, mod + 3 * i + 3);
            }
        }
        return (output);
    } else {
        return number;
    }
}