var scroll_onoff=0;
var mouse_onoff=0;
var changed=0;
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
        var h2=$('.content_area .content_2').offset().top;
        var h3=$('.content_area .content_3').offset().top;
        var h4=$('.content_area .content_4').offset().top;
        
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
        
        if(scroll>620){
            changed=1;
            $('#headerArea').hide();
            $('.title_area ul').addClass('onsub_nav');
            $('.wrap .sub_menu').addClass('onmain_nav');
            $('.wrap>span:eq(0)').addClass('top_bg');$('.wrap>span:eq(1)').addClass('top_bg2');
            $('.topMove').fadeIn('slow').clearQueue();

        }else{
            changed=0;
            $('#headerArea').show();
            $('.title_area ul').removeClass('onsub_nav');
            $('.wrap .sub_menu').removeClass('onmain_nav');
            $('.wrap>span:eq(0)').removeClass('top_bg');$('.wrap>span:eq(1)').removeClass('top_bg2');
            $('.topMove').fadeOut('fast').clearQueue();
        }    
        
        $('.title_area li').removeClass('current');

        if(scroll>=0 && scroll<(h2-80)){
            $('.title_area li:eq(0)').addClass('current');

        }else if(scroll>=(h2-80) && scroll<(h3-80)){
            $('.title_area li:eq(1)').addClass('current');
              
        }else if(scroll>=(h3-80) && scroll<(h4-80)){
            $('.title_area li:eq(2)').addClass('current');

        }else if(scroll>=(h4-80)){
            $('.title_area li:eq(3)').addClass('current');
        }
    });

    $('.title_area a').click(function(e){
        e.preventDefault();
        var value=0;
        var ind=$(this).index('.link');

        if(changed==1) {
            value= $('.content_area .content_'+(ind+1)).offset().top+100;
        }else if(changed==0){
            value= $('.content_area .content_'+(ind+1)).offset().top-50;
        }
        $("html,body").stop().animate({"scrollTop":value},1000);
    });

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});