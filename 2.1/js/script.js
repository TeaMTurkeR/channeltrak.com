function submitForm(element){
    element.type = 'hidden';

    while(element.className != 'form')
        element = element.parentNode;
        
    var form = document.getElementById('poster');
    
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
};

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
    $('#html-title').text(trackTitle);
}

function favorite(count, id){ 
    var data = 'count='+count+'&postId='+id;
    console.log(data);
    $.ajax({
        type: 'POST',
        url: 'upvote.php', 
        data: data
    });
}

$(document).ready(function(){

//SETUP FUNCTIONS

    $('.track img').lazyload({
        effect : "fadeIn"
    });

    var i = 1;
    $('.rank').each(function(){
        $(this).text(i);
        i++;
    });


//CLICK FUNCTIONS
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

    $('.heart').click(function(){

        var $this = $(this);
        if ( !$this.hasClass('active') ) {
      
            var id = $this.parents('.track').attr('id');
            var currentCount = $this.attr('data-upvotes');
            var newCount = parseInt(currentCount) + 1;

            console.log(currentCount);

            favorite(newCount, id);
            // $this.children('span').text(count);
            // $this.addClass('voted alert');

            $this.addClass('active');

        };

    });

    $('.share').click(function(){

        var songId = $(this).parents('.track').find('.thumbnail').attr('id');
        var url = 'youtu.be/'+songId

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


