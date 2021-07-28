$(document).ready(function(){
popUpfunc();
});

function popUpfunc(){
    $('.center>a').click(
        function(e){
            e.preventDefault();
            $('.content_area #box').show();
            $('.center .video').fadeIn('fast');
            $('.center .video iframe').attr('id','player');
    });
    
    $('.content_area #box, .center .video a').click(
        function(e){
            e.preventDefault();
            $('.content_area #box').hide();
            $('.center .video').hide();

            var video = $('#player').attr('src');
            $('#player').attr('src','');
            $('#player').attr('src',video);
            $('.center .video iframe').removeAttr('id');
    });
};