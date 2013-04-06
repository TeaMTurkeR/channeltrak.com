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
        url: 'http://localhost/channeltrak.com/3.0/index.php/song/favorite', 
        data: data
    });
}

$(function(){

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
        } else if ( $this.hasClass('favorited') && $('body').hasClass('logged-in')){

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

});