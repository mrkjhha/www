$(document).ready(function(){
    var op = false;  //네비가 열려있으면(true) , 닫혀있으면(false)
    var scroll_onoff=0;
    var documentHeight =  $(document).height();
    $("#gnb").css('height',documentHeight);
    $(".gnb_left").css('height',documentHeight);
    $('.topMove').hide();

    $(".menu_btn").click(function(e) {
        e.preventDefault();
        if(op==false){
            $(this).removeClass('menu_off').addClass('menu_on');
            $('#gnb').animate({right:0,opacity:1}, 'fast');
            $('.gnb_left').css('left',0);
            $('#headerArea').css('background','rgba(255,255,255,1)');
            op=true;

        } else {
        
            $(this).removeClass('menu_on').addClass('menu_off');
            $('#gnb').animate({right:'-100%',opacity:0}, 'fast');
            $('.gnb_left').css('left','-100%');
        
            if(scroll_onoff==0){
                $('#headerArea').css('background','rgba(255,255,255,.3)');
            }
            op=false;
        }
    });

    var onoff=[false,false,false,false];
    var arrcount=onoff.length;
    
    $('#gnb .menu h3 a').click(function(e){
        e.preventDefault();
        var ind=$(this).parents('.menu').index();
        
        $('.menu .depth_menu').slideUp(500);
        
        if(onoff[ind]==false){
            for(var i=0; i<arrcount; i++) {
                onoff[i]=false;
                $('.menu:eq('+i+') h3').removeClass('nav_on');
            }
            $('.menu:eq('+ind+') .depth_menu').slideDown(500);
            $('.menu:eq('+ind+') h3').addClass('nav_on');
            onoff[ind]=true;
        }
        else{
            $('.menu:eq('+ind+') .depth_menu').slideUp(500);
            $('.menu:eq('+ind+') h3').removeClass('nav_on');
            onoff[ind]=false;
        }
    });

    $(window).on('scroll',function(e){
        e.preventDefault();
        var scroll = $(window).scrollTop();

        if(scroll>30){
            scroll_onoff=1;
            $('#headerArea').css('background','#fff');
            $('.topMove').fadeIn('slow').clearQueue();

        }else{
            scroll_onoff=0;
            if(op==false){
                $('#headerArea').css('background','rgb(255,255,255,.3)');
            }
            $('.topMove').fadeOut('fast').clearQueue();
        }
    });

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});
