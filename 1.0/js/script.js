function resize(){
	var winW = $(window).width();
	var winH = $(window).height() - $('#header').height();
	$('#track-list').width(winW);
	$('#track-player').width(winW).height(winH).css('margin-left', winW);
	$('#player').height($('#player').width()*.5625);

	var	dropdownX = $('#dropdown-link').parent('li').offset().left - 1,
	    dropdownY = $('#dropdown-link').parent('li').offset().top - 1;
}

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

function formatTime(secs){
   var mins = Math.floor(secs / 60);
   secs = Math.ceil(secs % 60);
   return mins+':'+(secs < 10 ? '0' + secs : secs); 
}

function favorite(count, post){ 
	var data = 'count='+count+'&postId='+post;
	$.ajax({
	    type: 'POST',
	    url: 'upvote.php', 
	    data: data
	});
}

$(document).ready(function(){

	$('img.yt-image').lazyload({
		effect : "fadeIn"
	});

	var	dropdownX = $('#dropdown-link').parent('li').offset().left - 1,
	    dropdownY = $('#dropdown-link').parent('li').offset().top - 1;

    $(window).resize(function(){

    	resize();

    });

	$('#dropdown-link').click(function(){
				
		$('#dropdown-menu').css('left', dropdownX).css('top', dropdownY).show();

	});

	$('#dropdown-hide').click(function(){
				
		$('#dropdown-menu').hide();

	});

	$('.track-content').click(function(){

		var $track = $(this).parents('.track');
		var trackId = $track.attr('data-track-url');

		player.loadVideoById(trackId);

		$('.track').not($track).removeClass('playing');
		$track.addClass('playing');

		var trackTitle = $('.playing h2').text();
		$('#logo').hide();
		$('#song-title').fadeIn();
		$('#song-title a').text(trackTitle);

	});

	$('.track-thumbnail').click(function(){

		var $track = $(this).parents('.track');

		if ( !$track.hasClass('playing')) {

			var trackId = $track.attr('data-track-url');

			player.loadVideoById(trackId);

			$('.track').not($track).removeClass('playing');
			$track.addClass('playing');
			
			$('body').addClass('player-visible');
			$('#track-player').animate({ marginLeft: 0 }, 500);
			$('#track-list').animate({ marginLeft: -winW }, 500);

			var trackTitle = $('.playing h2').text();
			$('#logo').hide();
			$('#song-title, #list-view').fadeIn();
			$('#song-title a').text(trackTitle);

		} else {

			$('body').addClass('player-visible');
			$('#list-view').fadeIn();
			$('#track-player').animate({ marginLeft: 0 }, 500);
			$('#track-list').animate({ marginLeft: -winW }, 500);

		}

	});

	$('#song-title').click(function(){

		$('body').addClass('player-visible');
		$('#list-view').fadeIn();
		$('#track-player').animate({ marginLeft: 0 }, 500);
		$('#track-list').animate({ marginLeft: -winW }, 500);

	});

	$('#list-view').click(function(){

		$('body').removeClass('player-visible');
		$('#list-view').fadeOut();
		$('#track-player').animate({ marginLeft: winW }, 500);
		$('#track-list').animate({ marginLeft: 0 }, 500);

	});

	$('.favorite').click(function(){

		var $this = $(this);

		if ( !$this.hasClass('voted') ) {
	  
		  	var $this = $(this);
			var post = $this.parents('.track').attr('data-track-id');
			var countNum = $this.attr('data-track-upvotes');
			var count = parseInt(countNum) + 1;

			console.log(countNum);

			favorite(count, post);
			$this.children('span').text(count);
			$this.addClass('voted alert');

		};

		event.stopPropagation();

	});

	$('#intro .close').click(function(){
		$('#intro').slideUp('fast');
	});

});

