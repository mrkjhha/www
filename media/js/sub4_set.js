var screen_width;
var p_screen_width;
var documentHeight;
var visual_height;
var header_height;
var actor_dl_height=[];
var current=false;
//gallery_var start
var column_cnt=5;
var img_cnt=31;
var con_width;
var con_height=[];
var min_height=9999;
var gallery_height=0;
var position_x=0;
var position_y=0;
var show_ind_p=0;
var show_cnt=0;
//gallery_var end

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
    login_join_height_set();

    $(window).load(function(){

        gallery_height_set();
    });

    gal_open();

    $(window).resize(function () {

        screen_width=$(window).width();
        
        if(p_screen_width!=screen_width){
            value_set();
            height_set();
            visual_img_set();
            gallery_height_set();
            login_join_height_set();
            p_screen_width=screen_width;
        }
    });

    $(".visual_title .mouse").click(function(e) {
        e.preventDefault();
        $("html,body").stop().animate({"scrollTop":visual_height-header_height},1000).clearQueue();
    });
});

function value_set(){
    documentHeight = $(document).height();
    visual_height=$('.visualBox').height();
    header_height=$('#headerArea').height();
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
        $('#headerArea .gnb_menu').css('height',documentHeight-47);

    } else if(screen_width>640 && screen_width<=1280) {
        $('#headerArea .gnb_menu').css('height','auto');

    } else {
        $('#headerArea .gnb_menu').css('height','auto');
    }
}

function gallery_height_set(){

    position_x=0;
    position_y=0;
    min_height=9999;
    gallery_height=0;

    con_width=$('.g_box').width();
    if(screen_width>1620){ column_cnt=5; 
    } else if(screen_width>1280 && screen_width<=1620){ column_cnt=4;
    } else if(screen_width>1024 && screen_width<=1280){ column_cnt=3;
    } else if(screen_width>640 && screen_width<=1024){ column_cnt=2;
    } else { column_cnt=1;
    };

    for(var i=0; i<img_cnt; i++){
        con_height[i]=$('.g_box:eq('+i+')').height();
        if(con_height[i]<min_height){ min_height=con_height[i];};
        gallery_height+=con_height[i]+30;
    }

    $('.gallery_box').height(gallery_height/column_cnt*1.2);

    for(var i=0; i<img_cnt; i++){
        $('.g_box:eq('+i+')').css({left:position_x, top:position_y});
        position_y+=con_height[i]+30;
        
        if(position_y+con_height[i+1]>gallery_height/column_cnt*1.2){
            position_y=0;
            position_x+=con_width;
        }
    };

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
};

function gal_open(){
    $("section dl dt .more_btn").click(function(e) {
        e.preventDefault();
        var show_ind=$(this).index('.more_btn');
        $('.g_box_top .gal_content').hide();
        
        if(show_cnt==1){ 
            show_cnt=0;
            if(show_ind!=show_ind_p){show_cnt=1;};
            $('.g_box_top .gal_content:eq('+show_ind+')').show();
            $('.g_box_top .gal_content:eq('+show_ind_p+')').hide();
            
        } else if(show_cnt==0) { 
            show_cnt=1;
            $('.g_box_top .gal_content:eq('+show_ind+')').show();
        };

        position_x=0;
        position_y=0;
        min_height=9999;

        for(var i=0; i<img_cnt; i++){
            con_height[i]=$('.g_box:eq('+i+')').height();
            if(con_height[i]<min_height){min_height=con_height[i];};
        }
    
        for(var i=0; i<img_cnt; i++){
            $('.g_box:eq('+i+')').css({left:position_x, top:position_y});
            position_y+=con_height[i]+30;
            
            if(position_y+con_height[i+1]>gallery_height/column_cnt*1.2){
                position_y=0;
                position_x+=con_width;
            }
        }
        show_ind_p=show_ind;
    });
};

function login_join_height_set() {
    $('.entire_bg').height($(window).height());
    $('.join_form').height($(window).height()*0.9);
    $('.information_form').height($(window).height()*0.9);
};