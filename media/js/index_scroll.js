var op = false;  //네비가 열려있으면(true) , 닫혀있으면(false)
var scroll_onoff=0;
var mouse_onoff=0;

$(document).ready(function(){

    $('.topMove').hide();

    $(".menu_btn").click(function(e) {
        e.preventDefault();

        if(op==false){
            var headerHeight = $(document).height();
            $('#headerArea').css({height:headerHeight});
            $('#headerArea').css('background','rgba(0,0,0,.9)');
            $('.login_join').css('background','rgba(0,0,0,.9)');
            $('#gnb').animate({right:0, top:71}, 'fast');
            op=true;

        } else {
            $('#headerArea').css({height:'auto'});
            $('#gnb').animate({right:'-100%'}, 'fast');
        
            if(scroll_onoff==0){
                $('#headerArea').css('background','rgba(0,0,0,.2)');
            }
            op=false;
        }
    });

    $('#headerArea').hover(
        function(){
            mouse_onoff=1;
            if(scroll_onoff==0){
                $('#headerArea').css('background','rgba(0,0,0,.9)');
                $('.login_join').css('background','rgba(0,0,0,.9)');
            }
        }, function(){
            mouse_onoff=0;
            if(scroll_onoff==0){
                $('#headerArea').css('background','rgba(0,0,0,.2)');
                $('.login_join').css('background','rgba(0,0,0,.2)');
            }
    });

    $(window).on('scroll',function(e){
        e.preventDefault();
        var scroll = $(window).scrollTop();
           
        if(scroll>400){
            scroll_onoff=1;
            $('#headerArea').css('background','rgba(0,0,0,.9)');
            $('.login_join').css('background','rgba(0,0,0,.9)');
            $('.topMove').fadeIn('slow').clearQueue();

        }else{
            scroll_onoff=0;
            if(mouse_onoff==0){
                $('#headerArea').css('background','rgba(0,0,0,.2)');
                $('.login_join').css('background','rgba(0,0,0,.2)');
            }
            $('.topMove').fadeOut('fast').clearQueue();
        }
    });

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});
