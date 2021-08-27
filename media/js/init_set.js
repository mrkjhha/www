var screen_width;
var p_screen_width;
var documentHeight;
var visual_height;
var actors_height;
var current=false;

var gallery_cnt=10;
var init_set=[];
var p_center=-25;
var p_per=52;

var albums_height;
var cen_dt_height;

var join_clk=0;
var login_clk=0;
var info_clk=0;
var delete_clk=0;

$(document).ready(function(){
    p_screen_width=$(window).width();
    documentHeight = $(document).height();
    visual_height=$('.videoBox').height();
    actors_height=$('.actors .con_box').height();
    gallery_height=$('.gallery .img_wrap img').width()*520/968+40;
    screen_width=p_screen_width;

    if( screen_width > 768){
        $("#videoBG").show();
        $("#videoBG").attr('src','./images/visual.mp4');
        $("#imgBG").hide();
        current=true;
    }
    if(screen_width <= 768){
        $("#videoBG").hide();
        $("#videoBG").attr('src','');
        $("#imgBG").show();
    }
    
    
    story_imgset();
    actors_imgset();
    actors_click();
    init_positionset();

    $(window).load(function(){
        height_set();
        albums_height=$('.albums .albums_inner').height();
        cen_dt_height=$('.albums .music_center dt').height();
        $('.albums .music_center dd p').css({height:albums_height-cen_dt_height-300, marginBottom:200});
        if(screen_width<640){
            $('.albums_inner ul li dl:eq(0)').removeClass('music_show').addClass('music_hide');
        }
    });

    $(window).resize(function () {

        screen_width=$(window).width();
        documentHeight = $(document).height();
        visual_height=$('.videoBox').height();
        actors_height=$('.actors .con_box').height();
        gallery_height=$('.gallery .img_wrap img').width()*520/968+40;
        login_join_height_set();

        if( screen_width > 768 && current==false){
            $("#videoBG").show();
            $("#videoBG").attr('src','./images/visual.mp4');
            $("#imgBG").hide();
            current=true;
        }
        if(screen_width <= 768){
            $("#videoBG").hide();
            $("#videoBG").attr('src','');
            $("#imgBG").show();
            current=false;
        }

        if(p_screen_width!=screen_width){
            height_set();
            album_reset();
            if(screen_width<640){
                $('.albums_inner ul li dl:eq(0)').removeClass('music_show').addClass('music_hide');
            }
            p_screen_width=screen_width;
        }

        albums_height=$('.albums .albums_inner').height();
        cen_dt_height=$('.albums .music_center dt').height();
        $('.albums .music_center dd p').css({height:albums_height-cen_dt_height-300,marginBottom:200});
    });

    $(".visual_title .mouse").click(function(e) {
        e.preventDefault();

        $("html,body").stop().animate({"scrollTop":visual_height},1000).clearQueue();
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

function height_set(){
    $('.visual_title').css('height',visual_height);
    $('.gallery .con_wrap').css('height',gallery_height);

    if(screen_width<=640){
        $('#headerArea .gnb_menu').css('height',documentHeight-47);
        $('.actors .img_box li').css('height',(actors_height*2/3));
        $('.actors .more_btn').css('height',(actors_height/2)-10).css('border-radius', '0 0 15px 15px');

    } else if(screen_width>640 && screen_width<=1280) {
        $('#headerArea .gnb_menu').css('height','auto');
        $('.actors .img_box li').css('height',(actors_height*2/3)-10);
        $('.actors .more_btn').css('height',(actors_height*4/3)).css('border-radius',0);

    } else {
        $('#headerArea .gnb_menu').css('height','auto');
        $('.actors .img_box li').css('height',(actors_height/2)-15);
        $('.actors .more_btn').css('height',actors_height).css('border-radius', '0 0 30px 0');
    }
};

function story_imgset() {
    for(var i=0; i<6; i++){
        $('.story .bottom_box li:eq('+i+')').css({background:'url(./images/story_'+(i+1)+'.jpg) center bottom no-repeat', backgroundSize:'cover'});
    }
};

function actors_imgset() {
    for(var i=0; i<4; i++){
        $('.actors .img_box li:eq('+i+')').css({background:'url(./images/actor_'+(i+1)+'.jpg) center top no-repeat', backgroundSize:'cover'});
    }
};

function visual_set() {
    if( screen_width > 768 && current==false){      	
        $("#videoBG").show();
        $("#videoBG").attr('src','images/visual.mp4');
        $("#imgBG").hide();
        current=true;
      }
      if(screen_width <= 768){
        $("#videoBG").hide();
        $("#videoBG").attr('src','');
        $("#imgBG").show();
        current=false;
      }
};

function init_positionset(){
    for(var i=0; i<gallery_cnt; i++){
        init_set[i]=p_center+p_per*i
        if(init_set[i]>=p_center+p_per*(gallery_cnt/2)){
            init_set[i]=p_center-p_per*(gallery_cnt-i);
        }
        $('.gallery .img_wrap li:eq('+i+')').css({marginLeft:init_set[i]+'%'});
    }
};

function album_reset() {

    $('.albums_inner .left_side li a img').css({left:0});
    $('.albums_inner .right_side li a img').css({right:0});
    $('.albums_inner ul li').addClass('music_off');
    $('.albums_inner ul li dl').removeClass('music_show').addClass('music_hide');
    $('.albums_inner ul li dl:eq(0)').removeClass('music_hide').addClass('music_show');
};

function login_join_height_set() {
    $('.entire_bg').height($(window).height());
    $('.join_form').height($(window).height()*0.9);
    $('.information_form').height($(window).height()*0.9);
};