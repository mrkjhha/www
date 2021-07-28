var scroll_onoff=0;
var mouse_onoff=0;
$(document).ready(function(){
    $('.topMove').hide();

    $('#headerArea').hover(
        function(){
            mouse_onoff=1;
            $('#headerArea').css('background','#fff');
            $('#headerArea a').css('color','#333');
        }, function(){
            mouse_onoff=0;
            if(scroll_onoff==0){
                $('#headerArea').css('background','rgb(0,0,0,.2)');
                $('#headerArea a').css('color','#fff');
            }
    });

    $(window).on('scroll',function(e){
        e.preventDefault();

        var scroll = $(window).scrollTop();

        if(scroll>100){
            scroll_onoff=1;
            $('#headerArea').css('background','#fff').css('borderBottom', '1px solid #ccc');
            $('#headerArea a').css('color','#333');

        }else{
            scroll_onoff=0;
            if(mouse_onoff==0){
                $('#headerArea').css('background','rgb(0,0,0,.2)');
                $('#headerArea a').css('color','#fff');
            }
            $('#headerArea').css('borderBottom', '0');
        }
        
        if(scroll>620){$('.topMove').fadeIn('slow').clearQueue();}
        else{$('.topMove').fadeOut('fast').clearQueue();}
    });

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});