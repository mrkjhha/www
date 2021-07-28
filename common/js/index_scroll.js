$(document).ready(function(){
    var scroll_onoff=0;
    var mouse_onoff=0;
    $('.topMove').hide();
    buscon_initset();
    mancon_initset();
    carcon_initset();
    descon_initset();
    othcon_initset();

    $('#headerArea').mouseover(
        function(){
            mouse_onoff=1;
            $('#headerArea').css('background','#fff');
            $('#headerArea a').css('color','#333');
    });

    $('#headerArea').mouseleave(
        function(){
            mouse_onoff=0;
            if(scroll_onoff==0){
                $('#headerArea').css('background','rgb(0,0,0,.2)');
                $('#headerArea a').css('color','#fff');
            }
    });

    $(window).on('scroll',function(e){
        e.preventDefault();
        var scroll = $(window).scrollTop();
        var con1=$('.business').offset().top+250;
        var con2=$('.management').offset().top+250;
        var con3=$('.careers').offset().top+250;
        var con4=$('.design').offset().top+50;
           
        if(scroll>600){
            scroll_onoff=1;
            $('#headerArea').css('background','#fff').css('borderBottom', '1px solid #ccc');
            $('#headerArea a').css('color','#333');
            $('.topMove').fadeIn('slow').clearQueue();

        }else{
            scroll_onoff=0;
            if(mouse_onoff==0){
                $('#headerArea').css('background','rgb(0,0,0,.2)');
                $('#headerArea a').css('color','#fff');
            }
            $('.topMove').fadeOut('fast').clearQueue();
            $('#headerArea').css('borderBottom', '0');
        }

        if(scroll>600 && scroll<con1){

            $('.con_box').css('top','0');

        } else if(scroll>con1 && scroll<con2){

            $('.management_wrap').css('left','0');
            
        } else if(scroll>con2 && scroll<con3){

            $('.careers').css('opacity','1');
            $('.career_con .more').css('height','262px').css('bottom','-40px');

        } else if(scroll>con3 && scroll<con4){

            $('.design_inner').css('right','0');

        } else if(scroll>con4){

            $('.others').css('opacity','1');
        }
    });

    carcon_hover();

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});

function buscon_initset(){
    var b_top=80;
    for(var i=0; i<4; i++){
        b_top+=50;
        $('.con_box:eq('+i+')').css('top',-b_top);
    }
}

function mancon_initset(){
    $('.management_wrap').css('left','-100%');
}

function carcon_initset(){
    $('.careers').css('opacity','0');
    $('.career_con .more:eq(0)').css('height','2px').css('bottom','-170px');
    $('.career_con .more:eq(1)').css('height','82px').css('bottom','-130px');
    $('.career_con .more:eq(2)').css('height','162px').css('bottom','-90px');
}

function carcon_hover(){
    $('.career_con').hover(function(){
        var car_ind= $(this).index('.career_con');
        $('.career_con .more:eq('+car_ind+')').css('height','222px').css('bottom','-60px');
    },function(){        
        var car_ind= $(this).index('.career_con');
        $('.career_con .more:eq('+car_ind+')').css('height','262px').css('bottom','-40px');
    });
}

function descon_initset(){
    $('.design_inner').css('right','-2000px');
}

function othcon_initset(){
    $('.others').css('opacity','0');
}