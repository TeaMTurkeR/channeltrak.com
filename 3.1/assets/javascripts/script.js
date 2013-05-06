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

        $('#play').children('span').removeClass('play spin').addClass('pause');

    } else if (event.data == YT.PlayerState.ENDED) {
        
        var $nextSong = $('.playing').next();        
        if ( $nextSong.length !== 0 ) {
            var yt = $nextSong.attr('data-song-yt-id');
            var $newPlayer = $('<div id="youtube" class="flex-video widescreen"><div id="player"></div></div>');

            $('#youtube').remove();
            $('.playing').removeClass('playing');
            $nextSong.addClass('playing');

            $('.playing .thumbnail').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();
            $.scrollTo('.playing', 500, {offset:-25} );
        }

    } else if (event.data == YT.PlayerState.PAUSED){

        $('#play').children('span').removeClass('pause spin').addClass('play');

    } else {

        $('#play').children('span').removeClass('pause play').addClass('spin');

    }
}

function submitForm(element){
    element.type = 'hidden';

    while(element.className != 'form')
        element = element.parentNode;
        
    var form = document.getElementById('update');
    
    var inputs = element.getElementsByTagName('input');
    while(inputs.length > 0) 
        form.appendChild(inputs[0]);
        
    var selects = element.getElementsByTagName('select');
    while(selects.length > 0) 
        form.appendChild(selects[0]);
        
    var textareas = element.getElementsByTagName('textarea');
    while(textareas.length > 0) 
        form.appendChild(textareas[0]);
    
    form.submit();
}

function favorite(newCount, id, direction){ 
    var data = 'newCount='+newCount+'&songId='+id+'&favorite='+direction;
    console.log(data);
    $.ajax({
        type: 'POST',
        url: 'http://channeltrak.com/song/favorite', 
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
        var img = $('.playing').find('img').attr('src');

        $('#playing-thumbnail a').attr('href', '#'+id);
        $('#playing-thumbnail img').attr('src', img);
        $('#playing-song-title').text(title);
        $('#html-title').text(title+' | Channeltrak');

    } else {

        var id = $('.song').attr('id');
        var title = $('.song').first().find('h2').text();
        var img = $('.song').first().find('img').attr('src');

        $('#playing-thumbnail a').attr('href', '#'+id);
        $('#playing-thumbnail img').attr('src', img);
        $('#playing-song-title').text(title);

    }
}

function paginationCallback(){

    $('.song .thumbnail').click(function(){

        var $this = $(this);
        var $song = $this.parents('.song');
        var yt = $song.attr('data-song-yt-id');
        var $newPlayer = $('<div id="youtube" class="flex-video widescreen"><div id="player"></div></div>');

        $('#youtube').remove();
        $song.addClass('playing');
        $('.song').not($song).removeClass('playing');
        $this.prepend($newPlayer);
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
        var url = 'http://localhost/channeltrak.com/3.0/index.php/song/'+songSlug;

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

    $('#start').click(function(){
        $.scrollTo('#logo', 500, {offset:0} );
    });

    $('#toggle-mobile-nav').click(function(){
        $('#site-nav, #account-nav').toggleClass('hide-mobile');
    });

    $('.song .thumbnail').click(function(){

        var $this = $(this);
        var $song = $this.parents('.song');
        var yt = $song.attr('data-song-yt-id');
        var $newPlayer = $('<div id="youtube" class="flex-video widescreen"><div id="player"></div></div>');

        $('#youtube').remove();
        $song.addClass('playing');
        $('.song').not($song).removeClass('playing');
        $this.prepend($newPlayer);
        createYTPlayer(yt);

        setPlayingInfo();

    });

    $('#playing-thumbnail').click(function(){
        $.scrollTo('.playing', 500, {offset:-25} );
    });

    $('#play').click(function(){
        if ($('.song').hasClass('playing')) {
            if($(this).children('span').hasClass('play')) {
                player.playVideo();
                $(this).children('span').removeClass('play').addClass('pause');
            } else {
                player.pauseVideo();
                $(this).children('span').removeClass('pause').addClass('play');
            }
        } else {

            var $song = $('.song').first();
            var $this = $song.find('.thumbnail');
            var yt = $song.attr('data-song-yt-id');
            var $newPlayer = $('<div id="youtube" class="flex-video widescreen"><div id="player"></div></div>');

            $song.addClass('playing');
            $('.song').not($song).removeClass('playing');
            $this.prepend($newPlayer);
            createYTPlayer(yt);

        }
    });

    $('#next').click(function() { 
        var $nextSong = $('.playing').next();        
        if ( $nextSong.length !== 0 ) {
            var yt = $nextSong.attr('data-song-yt-id');
            var $newPlayer = $('<div id="youtube" class="flex-video widescreen"><div id="player"></div></div>');

            $('#youtube').remove();
            $('.playing').removeClass('playing');
            $nextSong.addClass('playing');

            $('.playing .thumbnail').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();
        }
    });

    $('#prev').click(function() { 
        var $prevSong = $('.playing').prev();   
        if ( $prevSong.length !== 0 ) {
            var yt = $prevSong.attr('data-song-yt-id');
            var $newPlayer = $('<div id="youtube" class="flex-video widescreen"><div id="player"></div></div>');

            $('#youtube').remove();
            $('.playing').removeClass('playing');
            $prevSong.addClass('playing');

            $('.playing .thumbnail').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();
        }
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
        var url = 'http://localhost/channeltrak.com/3.0/index.php/song/'+songSlug;

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

    //var down = $(window).height() + 300;
    //if ($(window).scrollTop() > $(document).height() - down){
    $('#load-more').click(function(){

        var $this = $('#load-more');
        var offset = parseInt($this.attr('data-offset'))+10;
        var data = 'offset='+offset;

        $.ajax({
            type: 'POST',
            url: 'http://localhost/channeltrak.com/3.1/index.php/site',
            data: data,
            success: function() {
                console.log(data);
            }
        }).done(function(html) {
            $('#main #loop').append(html);
            paginationCallback();
        });

        $this.attr('data-offset', offset);

    });
});