function createYTPlayer(vidID){
	player = new YT.Player('player', {
        videoId: vidID,
        playerVars: {
            wmode: "opaque",
            showinfo: 0,
            modestbranding: 1
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': playerEvents
        }
    });
};

function onPlayerReady(event) {
    event.target.playVideo();
}

function playerEvents(event) {
    if (event.data == YT.PlayerState.PLAYING) {

        $('#play').children('i').removeClass('icon-halfling-play').addClass('icon-halfling-pause');
        setTitle();

    } else if (event.data == YT.PlayerState.ENDED) {
        
        var nextSong = $('.playing').nextAll().first();
        $('.playing').removeClass('playing');
        nextSong.addClass('playing');

        var yt = $('.playing .thumbnail').attr('id');
        var $newPlayer = $('<div id="player"/>');

        $('#player').remove();
        $('.playing .thumbnail').prepend($newPlayer);
        createYTPlayer(yt);
        $('#player').height(h);

    } else {

        $('#play').children('i').removeClass('icon-halfling-pause').addClass('icon-halfling-play');

    } 
}

function setTitle(){
    var trackTitle = $('.playing h5').text();
    $('#song-title').text(trackTitle);
}

$(document).ready(function(){

    $('.track img').lazyload({
        effect : "fadeIn"
    });

	$('.thumbnail').click(function(){

        $('#player-controls').show();

        var $this = $(this);
        var $trak = $this.parents('.track');
        var yt = $this.attr('id');
        var $newPlayer = $('<div id="player"/>');
        var h = $this.width()*.5625;

        $('#player').remove();
        $trak.addClass('playing');
        $('.track').not($trak).removeClass('playing');
        $this.prepend($newPlayer);
        createYTPlayer(yt);
        $('#player').height(h);

        setTitle();
    });

    $('#play').click(function(){
        if($(this).children('i').hasClass('icon-halfling-play')) {
            player.playVideo();
            $(this).children('i').removeClass('icon-halfling-play').addClass('icon-halfling-pause');
        } else {
            player.pauseVideo();
            $(this).children('i').removeClass('icon-halfling-pause').addClass('icon-halfling-play');
        }
    });

    $('#next').click(function() { 
        var h = $('.playing .thumbnail').width()*.5625;
        var nextSong = $('.playing').nextAll().first();
        $('.playing').removeClass('playing');
        nextSong.addClass('playing');

        var yt = $('.playing .thumbnail').attr('id');
        var $newPlayer = $('<div id="player"/>');
        

        $('#player').remove();
        $('.playing .thumbnail').prepend($newPlayer);
        createYTPlayer(yt);
        $('#player').height(h);

        setTitle();

    });

    $('#prev').click(function() { 
        var isPrevPost = $('.playing').prevAll('.track').first().hasClass('track');        
        if ( isPrevPost === true ) {
            var h = $('.playing .thumbnail').width()*.5625;
            var prevSong = $('.playing').prevAll().first();
            $('.playing').removeClass('playing');
            prevSong.addClass('playing');


            var yt = $('.playing .thumbnail').attr('id');
            var $newPlayer = $('<div id="player"/>');

            $('#player').remove();
            $('.playing .thumbnail').prepend($newPlayer);
            createYTPlayer(yt);
            $('#player').height(h);

            setTitle();
        }
    });

});


