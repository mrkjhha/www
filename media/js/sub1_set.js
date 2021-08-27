var screen_width;
var p_screen_width;
var documentHeight;
var visual_height;
var header_height;
var episode_wrap_height;
var film_link_width;
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
    link_img_set();
    visual_img_set();

    $(window).resize(function () {

        screen_width=$(window).width();
        value_set();

        if(p_screen_width!=screen_width){
            height_set();
            visual_img_set();
            login_join_height_set();
            p_screen_width=screen_width;
        }
    });

    $(".visual_title .mouse").click(function(e) {
        e.preventDefault();
        $("html,body").stop().animate({"scrollTop":visual_height-header_height},1000).clearQueue();
    });

    login_join_height_set();

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
    film_link_width=$('.film_box .episode_link').width();
};

function link_img_set(){
    for(var i=0; i<6; i++){
        $('.film_box .episode_link:eq('+i+')').css({background:'url(./images/episode_link_'+(i+1)+'.jpg)center no-repeat', backgroundSize:'contain'});
    }
};

function visual_img_set(){

    if( screen_width > 768 && current==true){
        $("#imgBG").attr('src','./images/visual_img2.jpg');
        current=false;
    }
    if(screen_width <= 768 && current==false){
        $("#imgBG").attr('src','./images/visual_img3.jpg');
        current=true;
    }
};

function height_set(){
    $('.visual_title').css('height',visual_height);
    $('.film_box .episode_link').css('height',film_link_width/2);

    if(screen_width>1280){
        $('.episode_wrap').css({marginBottom:film_link_width/2+140});
        $('.film_box').css({height:film_link_width/2,bottom:70});

    } else if(screen_width>1024 && screen_width<=1280){
        $('.episode_wrap').css({marginBottom:film_link_width/2+100});
        $('.film_box').css({height:film_link_width/2,bottom:55});
        
    } else if(screen_width>768 && screen_width<=1024) {
        $('.episode_wrap').css({marginBottom:film_link_width/2+80});
        $('.film_box').css({height:film_link_width/2,bottom:45});

    } else if(screen_width<=768){
        $('.episode_wrap').css({marginBottom:0});
        $('.film_box').css({height:film_link_width/2,bottom:0});
    }

    if(screen_width<=640){
        $('#headerArea .gnb_menu').css('height',documentHeight-47);

    } else if(screen_width>640 && screen_width<=1280) {
        $('#headerArea .gnb_menu').css('height','auto');

    } else {
        $('#headerArea .gnb_menu').css('height','auto');
    }
};

function login_join_height_set() {
    $('.entire_bg').height($(window).height());
    $('.join_form').height($(window).height()*0.9);
    $('.information_form').height($(window).height()*0.9);
};