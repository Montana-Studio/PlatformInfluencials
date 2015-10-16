(function ($, window, document, undefined) {
'use strict';

    $(function () {
        
        /* Settings
           ========================================================================== */
        var facebookPage = "chilerunningscl",
            youtubeUser = "andro4all",
            googlePlusId = "XXXXXX",
            googlePlusKey = "XXXXXX",
            pinterestUser = "XXXXXX",
            instagramUserId = "XXXXXX",
            instagramToken = "XXXXXX",
            flickrUserId = "XXXXXX",
            flickrApiKey = "XXXXXX"; 
            

        /* Facebook
           ========================================================================== */
        $.getJSON('https://graph.facebook.com/'+facebookPage+'?callback=?', function(data) {
            var fb_count = data['likes'].toString();
            fb_count = add_space(fb_count);

            // Display
            $('.fb-likes').html(fb_count);
        });


        /* Youtube
           ========================================================================== */

        $.getJSON('https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername='+youtubeUser+'&fields=items/statistics/subscriberCount&key=AIzaSyDBMZsybp7GcJdmqdhgGDn-jRkGo9jyD-c', function(data) {
            
            https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&key={YOUR_API_KEY}
            // views count
            var ytViewsCount = data.entry.yt$statistics.totalUploadViews;
            ytViewsCount = add_space(ytViewsCount);

            // subscribers count
            var ytSubscriberCount = data.entry.yt$statistics.subscriberCount;
            ytSubscriberCount = add_space(ytSubscriberCount);

            // uploads count
            var ytUploadCount = data.entry.gd$feedLink[4].countHint;
            ytUploadCount = add_space(ytUploadCount);

            // Display
            $('.yt-views').html(ytViewsCount);
            $('.yt-subscribers').html(ytSubscriberCount);
            $('.yt-uploads').html(ytUploadCount);
        });


        /* Google+
           ========================================================================== */
        $.getJSON('https://www.googleapis.com/plus/v1/people/'+googlePlusId+'?key='+googlePlusKey, function(data) {
            // followers count
            var gpSubscriberCount = data.circledByCount;
            gpSubscriberCount = add_space(gpSubscriberCount);

            // Display
            $('.gp-followers').html(gpSubscriberCount);
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
           ========================================================================== */
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