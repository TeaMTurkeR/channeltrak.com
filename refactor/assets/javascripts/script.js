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

        $('#play').children('span').removeClass('icon-play icon-spinner icon-spin').addClass('icon-pause');
        
        var songTitle = $('.playing h2 a').attr('title');
        $('#html-title').text(songTitle + ' | Channeltrak');

    } else if (event.data == YT.PlayerState.ENDED) {
        
        var $nextSong = $('.playing').next();        
        if ( $nextSong.length !== 0 ) {
            var yt = $nextSong.attr('data-song-yt-id');
            var $newPlayer = $('<div id="player"></div>');

            $('#player').remove();
            $('.playing').removeClass('playing');
            $nextSong.addClass('playing');

            $('.playing .flex-media').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();
            $.scrollTo('.playing', 500, {offset:-25} );
        }

    } else if (event.data == YT.PlayerState.PAUSED){

        $('#play').children('span').removeClass('icon-pause icon-spinner icon-spin').addClass('icon-play');

    } else {

        $('#play').children('span').removeClass('icon-pause icon-play').addClass('icon-spinner icon-spin');

    }
}

function favorite(newCount, id, direction){ 
    var data = 'newCount='+newCount+'&songId='+id+'&favorite='+direction;
    console.log(data);
    $.ajax({
        type: 'POST',
        url: 'http://channeltrak.com/user/favorite', 
        data: data,
        success: function() {
            console.log('success');
        }
    });
}

function setPlayingInfo(){

    if ($('.song').hasClass('playing')) {

        var id = $('.playing').attr('id');
        var title = $('.playing h2').text();
        var img = $('.playing').find('img').attr('data-original');

        $('#playing-thumbnail a').attr('href', '#'+id);
        $('#playing-thumbnail img').attr('src', img);
        $('#playing-song-title').text(title);
        $('#html-title').text(title+' | Channeltrak');

    } else {

        var id = $('.song').attr('id');
        var title = $('.song').first().find('h2').text();
        var img = $('.song').first().find('img').attr('data-original');

        $('#playing-thumbnail a').attr('href', '#'+id);
        $('#playing-thumbnail img').attr('src', img);
        $('#playing-song-title').text(title);

    }
}

function paginationCallback(){

    $('.flex-media img').lazyload(); 

    $('.song .thumbnail').click(function(){

        var $this = $(this);
        var $song = $this.parents('.song');
        var yt = $song.attr('data-song-yt-id');
        var $newPlayer = $('<div id="player"></div>');

        $('#player').remove();
        $song.addClass('playing');
        $('.song').not($song).removeClass('playing');
        $this.children('.flex-media').prepend($newPlayer);
        createYTPlayer(yt);

        setPlayingInfo();

    });   

    $('.favorite-song').click(function(){

        var $this = $(this);
        if ( !$this.hasClass('favorited') && $('body').hasClass('logged-in')) {
      
            var id = $this.parents('.song').attr('id');
            var oldCount = $this.parents('.song').attr('data-song-favorites');
            var newCount = parseInt(oldCount) + 1;

            console.log('Old Count:'+oldCount);
            console.log('New Count:'+newCount);

            favorite(newCount, id, true);

            $this.addClass('favorited');
            $this.parents('.song').attr('data-song-favorites', newCount);

        } else if ( $this.hasClass('favorited') ){

            var id = $this.parents('.song').attr('id');
            var oldCount = $this.parents('.song').attr('data-song-favorites');
            var newCount = parseInt(oldCount) - 1;

            console.log('Old Count:'+oldCount);
            console.log('New Count:'+newCount);

            favorite(newCount, id, false);
            $this.removeClass('favorited');
            $this.parents('.song').attr('data-song-favorites', newCount);

        } else {

            alert('login please');

        }

    });

    $('.share-song').click(function(){

        var songSlug = $(this).parents('.song').attr('data-song-slug');
        var url = 'http://channeltrak.com/song/'+songSlug;

        var width  = 575,
            height = 400,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            opts   = 'status=1' +
                     ',width='  + width  +
                     ',height=' + height +
                     ',top='    + top    +
                     ',left='   + left;
        
        window.open('http://twitter.com/share?text=Listening%20to%20'+url+'%20on%20@channeltrak', 'twitter', opts);
     
        return false;
        
    });
}

$(function(){

    setPlayingInfo();

    //Scrolling controls actions

    $(window).scroll(function(){
        if ( $(window).scrollTop() > 180 ) {
            $('#controls').addClass('sticky');
        } else {
            $('#controls').removeClass('sticky');
        }
    });

    $('#playing-thumbnail').click(function(){
        $.scrollTo('.playing', 500, {offset:-80} );
    });

    $('.flex-media img').lazyload();

    $('#play').click(function(){
        if ($('.song').hasClass('playing')) {
            if($(this).children('span').hasClass('icon-play')) {
                player.playVideo();
                $(this).children('span').removeClass('icon-play').addClass('icon-pause');
            } else {
                player.pauseVideo();
                $(this).children('span').removeClass('icon-pause').addClass('icon-play');
            }
        } else {

            var $song = $('.song').first();
            var $this = $song.find('.thumbnail');
            var yt = $song.attr('data-song-yt-id');
            var $newPlayer = $('<div id="player"></div>');

            $song.addClass('playing');
            $('.song').not($song).removeClass('playing');
            $this.children('.flex-media').prepend($newPlayer);
            createYTPlayer(yt);

        }
    });

    $('#next').click(function() { 
        var $nextSong = $('.playing').next();        
        if ( $nextSong.length !== 0 ) {
            var yt = $nextSong.attr('data-song-yt-id');
            var $newPlayer = $('<div id="player"></div>');

            $('#player').remove();
            $('.playing').removeClass('playing');
            $nextSong.addClass('playing');

            $('.playing .flex-media').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();

            $.scrollTo('.playing', 500, {offset:-80} );
        }
    });

    $('#prev').click(function() { 
        var $prevSong = $('.playing').prev();   
        if ( $prevSong.length !== 0 ) {
            var yt = $prevSong.attr('data-song-yt-id');
            var $newPlayer = $('<div id="player"></div>');

            $('#player').remove();
            $('.playing').removeClass('playing');
            $prevSong.addClass('playing');

            $('.playing .flex-media').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();

            $.scrollTo('.playing', 500, {offset:-80} );
        }
    });

    //Individual song actions

    $('.song .thumbnail').click(function(){

        var $this = $(this);
        var $song = $this.parents('.song');
        var yt = $song.attr('data-song-yt-id');
        var $newPlayer = $('<div id="player"></div>');

        $('#player').remove();
        $song.addClass('playing');
        $('.song').not($song).removeClass('playing');
        $this.children('.flex-media').prepend($newPlayer);
        createYTPlayer(yt);

        setPlayingInfo();

    });

    $('.favorite-song').click(function(){

        var $this = $(this);
        if ( !$this.hasClass('favorited') && $('body').hasClass('logged-in')) {
      
            var id = $this.parents('.song').attr('id');
            var oldCount = $this.parents('.song').attr('data-song-favorites');
            var newCount = parseInt(oldCount) + 1;

            console.log('Old Count:'+oldCount);
            console.log('New Count:'+newCount);

            favorite(newCount, id, true);

            $this.addClass('favorited');
            $this.parents('.song').attr('data-song-favorites', newCount);

        } else if ( $this.hasClass('favorited') ){

            var id = $this.parents('.song').attr('id');
            var oldCount = $this.parents('.song').attr('data-song-favorites');
            var newCount = parseInt(oldCount) - 1;

            console.log('Old Count:'+oldCount);
            console.log('New Count:'+newCount);

            favorite(newCount, id, false);
            $this.removeClass('favorited');
            $this.parents('.song').attr('data-song-favorites', newCount);

        } else {

            $('#login-modal, #overlay').fadeIn();

        }

    });

    $('#overlay').click(function(){
        $('#login-modal, #overlay').fadeOut();
    });

    $('.share-song').click(function(){

        var songSlug = $(this).parents('.song').attr('data-song-slug');
        var url = 'http://channeltrak.com/song/'+songSlug;

        var width  = 575,
            height = 400,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            opts   = 'status=1' +
                     ',width='  + width  +
                     ',height=' + height +
                     ',top='    + top    +
                     ',left='   + left;
        
        if ( $(this).children('span').hasClass('icon-twitter') ) {

            window.open('http://twitter.com/share?text=Listening%20to%20'+url+'%20on%20@channeltrak', 'twitter', opts);

        } else if ( $(this).children('span').hasClass('icon-facebook') ) {

            window.open('https://www.facebook.com/sharer/sharer.php?u='+url, 'facebook', opts);

        } else {
            window.prompt ("Copy to clipboard: Ctrl+C, Enter", url);
        }

        return false;
        
    });

    $('#load-more').click(function(){

        var $this = $('#load-more');
        $this.html('<span class="icon-spinner icon-spin"></span> Loading');
        var offset = parseInt($this.attr('data-offset'))+20;
        var data = 'offset='+offset;

        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: data,
            success: function() {
                console.log(data);
            }
        }).done(function(html) {
            $('#playlist').append(html);
            $this.html('Load More');
            paginationCallback();
        });

        $this.attr('data-offset', offset);

    });

    $('.form').validate({
        rules : {
            new : {
                minlength : 5
            },
            confirm : {
                minlength : 5,
                equalTo : "#password"
            }
        }
    });
});