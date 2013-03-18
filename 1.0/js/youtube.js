// Find first video on the page
var firstTrackId = $('#track-list .track').first().attr('data-track-id');

// Load YT player via the API
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        videoId: firstTrackId,
        playerVars: {
            color: 'white',
            wmode: 'opaque',
            showinfo: 0,
            modestbranding: 1
        },
        events: {
            'onStateChange': playerEvents
        }
    });
}

// Events to call on certain events
function playerEvents(event) {
    if (event.data == YT.PlayerState.PLAYING) {

        var length = formatTime(player.getDuration());
        $('#track-length').text(length);

        setInterval(function(){ 
            
            var elapsed = formatTime(player.getCurrentTime());  
            $('#track-elapsed').text(elapsed);

        }, 1000);

    } else if (event.data == YT.PlayerState.ENDED) {
        
        var nextSong = $('.playing').nextAll().first();
        $('.playing').removeClass('playing');
        nextSong.addClass('playing');

        var nextVidID = $('.playing').attr('data-track-url');
        player.loadVideoById(nextVidID);

        var trackTitle = $('.playing h2').text();
        $('#song-title a').text(trackTitle);

    } else {

        $('#play').children('i').removeClass('icon-pause').addClass('icon-play');

    } 
}