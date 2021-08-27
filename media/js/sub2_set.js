var screen_width;
var p_screen_width;
var documentHeight;
var visual_height;
var header_height;
var actor_dl_height=[];
var current=false;

var join_clk=0;
var login_clk=0;
var info_clk=0;
var delete_clk=0;

$(document).ready(function(){

    p_screen_width=$(window).width();
    screen_width=p_screen_width;
    value_set();
    height_set();
    visual_img_set();
    actor_hover();
    
    login_join_height_set();

    if(screen_width>640 && screen_width<=1024){
        $('.other_box span').addClass('click');
    } else {        
        $('.other_box span').removeClass('click');
    }
    $(window).resize(function () {

        screen_width=$(window).width();
        
        if(p_screen_width!=screen_width){
            if(screen_width>640 && screen_width<=1024){
                $('.other_box span').addClass('click');
            } else {        
                $('.other_box span').removeClass('click');
            }
            value_set();
            height_set();
            visual_img_set();
            actor_hover();
            login_join_height_set();
            p_screen_width=screen_width;
        }
    });

    $(".visual_title .mouse").click(function(e) {
        e.preventDefault();
        $("html,body").stop().animate({"scrollTop":visual_height-header_height},1000).clearQueue();
    });

    $('#login').click(function(){
        login_clk=1;    
        $('.entire_bg').show();
        $('.login_form').show();
    });

    $('#join').click(function(){
        join_clk=1;
        $('.entire_bg').show();
        $('.join_form').show();
    });

    $('#info').click(function(){
        info_clk=1;
        $('.entire_bg').show();
        $('.information_form').show();
    });

    $('#del').click(function(){
        delete_clk=1;
        $('.entire_bg').show();
        $('.delete_form').show();
    });

    $('.close_btn').click(function(){
        $('.entire_bg').hide();
        if(join_clk==1){ join_clk=0;
            $('.join_form').hide();
        } else if(login_clk==1) { login_clk=0;
            $('.login_form').hide();
            all_on=0;
        } else if(info_clk==1){ info_clk=0;
            $('.information_form').hide();
            all_on=0;
        } else if(delete_clk==1){ delete_clk=0;
            $('.delete_form').hide();
        }
    });
});

function value_set(){
    documentHeight = $(document).height();
    visual_height=$('.visualBox').height();
    header_height=$('#headerArea').height();
    for(var i=0; i<2; i++){
        actor_dl_height[i]=$('.actor_'+(i+1)+' dl').height()+20;
    }
}

function visual_img_set(){

    if( screen_width > 768 && current==true){
        $("#imgBG").attr('src','./images/visual_img4.jpg');
        current=false;
    }
    if(screen_width <= 768 && current==false){
        $("#imgBG").attr('src','./images/visual_img5.jpg');
        current=true;
    }
}

function height_set(){
    $('.visual_title').css('height',visual_height);

    if(screen_width<=640){
        $('.actors_wrap .actor_box').css({top:0,transition:'none'});
        $('.others_wrap .other_box div').css({transform:'none', transition:'none'});
    } else {
        for(var i=0; i<2; i++){
            $('.actors_wrap .actor_box:eq('+i+')').css({top:-actor_dl_height[i],transition:'none'});
            $('.others_wrap .other_box div').css({transform:'translateX(-50%) translateY(200%)', transition:'none'});
        }
    }

    if(screen_width<=640){
        $('#headerArea .gnb_menu').css('height',documentHeight-47);

    } else if(screen_width>640 && screen_width<=1280) {
        $('#headerArea .gnb_menu').css('height','auto');

    } else {
        $('#headerArea .gnb_menu').css('height','auto');
    }
}

function actor_hover(){

    $('.actors_wrap .actor_box').hover(function(){
        if(screen_width>640){
            $(this).css({top:'0',transition:'all .5s ease-out'})
        };
    }, function(){
        if(screen_width>640){
            if($(this).hasClass('.actor_1')){
                $(this).css({top:-actor_dl_height[0],transition:'all .5s ease-out'});
            } else {
                $(this).css({top:-actor_dl_height[1],transition:'all .5s ease-out'});
            }
        };
    });

    $('.others_wrap .other_box').hover(function(){
        if(screen_width>640){
            var other_ind=$(this).index('.other_box');
            if(screen_width<1024){$('.other_box:eq('+other_ind+') span').removeClass('click');}
            $('.others_wrap .other_box:eq('+other_ind+') div').css({transform:'translateX(-50%) translateY(-50%)', transition:'all .5s ease-out'});
        }
    }, function(){
        if(screen_width>640){
            var other_ind=$(this).index('.other_box');
            if(screen_width<1024){$('.other_box:eq('+other_ind+') span').addClass('click');}
            $('.others_wrap .other_box:eq('+other_ind+') div').css({transform:'translateX(-50%) translateY(200%)', transition:'all .5s ease-out'});
        }
    });
};

function login_join_height_set() {
    $('.entire_bg').height($(window).height());
    $('.join_form').height($(window).height()*0.9);
    $('.information_form').height($(window).height()*0.9);
};