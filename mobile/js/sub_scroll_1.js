$(document).ready(function(){
    var op = false;  //네비가 열려있으면(true) , 닫혀있으면(false)
    var scroll_onoff=0;
    var changed=0;
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
        var h2=$('.content_2').offset().top;
        var h3=$('.content_3').offset().top;

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
        $('.con_nav li').removeClass('con_current');

        if(scroll>60){
            changed=1;
            $('#content .con_nav').addClass('changed_nav');
        } else {
            changed=0;
            $('#content .con_nav').removeClass('changed_nav');
        }

        if(scroll>0 && scroll<h2-180){
            $('.con_nav li:eq(0)').addClass('con_current');
        }else if(scroll>h2-180 && scroll<h3-180){
            $('.con_nav li:eq(1)').addClass('con_current');
        }else if(scroll>(h3-180)){
            $('.con_nav li:eq(2)').addClass('con_current');
        }
    });

    $('.con_nav a').click(function(e){
        e.preventDefault();
        var value=0;
        var ind=$(this).index('.con_nav li a');

        if(changed==1) {
            value= $('.content_'+(ind+1)).offset().top-105;
        }else if(changed==0){
            value= $('.content_'+(ind+1)).offset().top-195;
        }
        $("html,body").stop().animate({"scrollTop":value},1000);
    });

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});
