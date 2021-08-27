var screen_width;
var p_screen_width;
var documentHeight;
var visual_height;
var header_height;
var switch_width;
var current=false;
var music_ind=0;
var music_on=0;
var auto_on=0;
var auto_init=0;
var timeonoff;
var sec_cnt=0;
var audio_play;
var audio_stop;

var join_clk=0;
var login_clk=0;
var info_clk=0;
var delete_clk=0;

$(document).ready(function(){
    
    p_screen_width=$(window).width();
    screen_width=p_screen_width;
    $('.albums_wrap .album_1').show();
    value_set();
    height_set();
    visual_img_set();
    nb_btn_click();
    music_start();
    auto_play_click();
    audio_init_set();
    login_join_height_set();

    $(window).resize(function () {
        screen_width=$(window).width();
        value_set();

        if(p_screen_width!=screen_width){
            height_set();
            visual_img_set();
            login_join_height_set();
            
            if(music_on==1){
                $('.control_panel .switch .onoff_box').css({marginLeft:switch_width+'px', transition:'none'});
            } else {
                $('.control_panel .switch .onoff_box').css({marginLeft:5+'px', transition:'none'});
            };
            
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

//Function Set Up Start 
function value_set(){
    documentHeight = $(document).height();
    visual_height=$('.visualBox').height();
    header_height=$('#headerArea').height();
};

function visual_img_set(){

    if( screen_width > 768 && current==true){
        $("#imgBG").attr('src','./images/visual_img6.jpg');
        current=false;
    }
    if(screen_width <= 768 && current==false){
        $("#imgBG").attr('src','./images/visual_img7.jpg');
        current=true;
    }
};

function height_set(){
    $('.visual_title').css('height',visual_height);

    if(screen_width>1280){
        $('.left_box .control_panel').css({width:visual_height*0.6});
    }else if(screen_width>1024 && screen_width<=1280){
        $('.left_box .control_panel').css({width:90+'%'});
    } else {
        $('.left_box .control_panel').css({width:100+'%'});
    };
    
    if(screen_width<=768){
        $('.left_box').css({height:'auto'});
        $('.left_box .lp_plate').css({width:0, height:0});
        $('.albums_wrap .album_box dd').css('height',visual_height*0.7);
    }else {
        $('.left_box').css({height:visual_height*0.8});
        $('.left_box .lp_plate').css({width:visual_height*0.6, height:visual_height*0.6});
        $('.albums_wrap .album_box dd').css('height',visual_height*0.5);
    }
    
    switch_width=$('.control_panel').width()*0.3-45;

    if(screen_width<=640){
        $('#headerArea .gnb_menu').css('height',documentHeight-47);

    } else if(screen_width>640 && screen_width<=1280) {
        $('#headerArea .gnb_menu').css('height','auto');

    } else {
        $('#headerArea .gnb_menu').css('height','auto');
    };
};

function next_do(){
    audio_play=document.getElementById('audioplay'+(music_ind+1));
    $('.albums_wrap .album_'+(music_ind+1)).show();
    $('.albums_wrap .album_'+(music_ind+1)+' dt').addClass('on');
    $('.albums_wrap .album_'+(music_ind+1)+' dd a').css({transform:'translateX(-200%)', transition:'all .5s ease-out'});
    $('.albums_wrap .album_'+(music_ind+1)+' dd p').show().addClass('on');
    audio_play.play();

    if(music_ind==0){
        audio_stop=document.getElementById('audioplay6');
        $('.albums_wrap .album_6').hide();
        $('.albums_wrap .album_6 dt').removeClass('on');
        $('.albums_wrap .album_6 dd a').css({transform:'translateX(-50%)', transition:'none'});
        $('.albums_wrap .album_6 dd p').hide().removeClass('on');
        audio_stop.pause();

    } else {
        audio_stop=document.getElementById('audioplay'+music_ind);
        $('.albums_wrap .album_'+music_ind).hide();
        $('.albums_wrap .album_'+music_ind+' dt').removeClass('on');
        $('.albums_wrap .album_'+music_ind+' dd a').css({transform:'translateX(-50%)', transition:'none'});
        $('.albums_wrap .album_'+music_ind+' dd p').hide().removeClass('on');
        audio_stop.pause();
        
    };
};

function before_do(){
    audio_play=document.getElementById('audioplay'+(music_ind+1));
    $('.albums_wrap .album_'+(music_ind+1)).show();
    $('.albums_wrap .album_'+(music_ind+1)+' dt').addClass('on');
    $('.albums_wrap .album_'+(music_ind+1)+' dd a').css({transform:'translateX(-200%)', transition:'all .5s ease-out'});
    $('.albums_wrap .album_'+(music_ind+1)+' dd p').show().addClass('on');
    audio_play.play();
    
    if(music_ind==5){
        audio_stop=document.getElementById('audioplay1');
        $('.albums_wrap .album_1').hide();
        $('.albums_wrap .album_1 dt').removeClass('on');
        $('.albums_wrap .album_1 dd a').css({transform:'translateX(-50%)', transition:'none'});
        $('.albums_wrap .album_1 dd p').hide().removeClass('on');
        audio_stop.pause();
    } else {
        audio_stop=document.getElementById('audioplay'+(music_ind+2));
        $('.albums_wrap .album_'+(music_ind+2)).hide();
        $('.albums_wrap .album_'+(music_ind+2)+' dt').removeClass('on');
        $('.albums_wrap .album_'+(music_ind+2)+' dd a').css({transform:'translateX(-50%)', transition:'none'});
        $('.albums_wrap .album_'+(music_ind+2)+' dd p').hide().removeClass('on');
        audio_stop.pause();
    };
};

function nb_btn_click(){

    $('.btn_box .nb_btn').click(function(e){
        e.preventDefault();
        var $target=$(e.target);
        sec_cnt=0;

        if($target.is('.btn_box .next_btn')){
            music_ind++;
            if(music_ind>=6){music_ind=0;};
            
            if(music_on==1){
                next_do();

            } else if(music_on==0){
                if(music_ind==0){
                    $('.albums_wrap .album_6').hide();
                } else {
                    $('.albums_wrap .album_'+music_ind).hide();
                };
                $('.albums_wrap .album_'+(music_ind+1)).show();
            };

        } else if($target.is('.btn_box .before_btn')){
            music_ind--;
            if(music_ind<0){music_ind=5;};

            if(music_on==1){
                before_do();

            } else if(music_on==0){
                if(music_ind==5){
                    $('.albums_wrap .album_1').hide();
                } else {
                    $('.albums_wrap .album_'+(music_ind+2)).hide();
                };
                $('.albums_wrap .album_'+(music_ind+1)).show();
            };
        };
    });
};

function onoff_do(){
    if(music_on==0){
        music_on=1;
        sec_cnt=0;
        audio_play=document.getElementById('audioplay'+(music_ind+1));
        audio_play.play();
        $('.control_panel .switch').addClass('on');
        $('.control_panel .switch .onoff_box').css({marginLeft:switch_width+'px', transition:'all .5s ease-out'}).addClass('on');
        $('.control_panel .switch .onoff_box .off').hide();
        $('.control_panel .switch .onoff_box .on').show();
        $('.albums_wrap .album_'+(music_ind+1)+' dt').addClass('on');
        $('.albums_wrap .album_'+(music_ind+1)+' dd a').css({transform:'translateX(-200%)', transition:'all .5s ease-out'});
        $('.albums_wrap .album_'+(music_ind+1)+' dd p').show().addClass('on');
        $('.control_panel>span').addClass('on');
        $('.lp_plate').addClass('on');
        $('.audioplay'+(music_ind+1)).attr('src','./images/audio_'+(music_ind+1)+'.mp3');
        
    } else if(music_on==1){
        music_on=0;
        audio_stop=document.getElementById('audioplay'+(music_ind+1));
        audio_stop.pause();
        $('.control_panel .switch').removeClass('on');
        $('.control_panel .switch .onoff_box').css({marginLeft:5+'px', transition:'all .5s ease-out'}).removeClass('on');
        $('.control_panel .switch .onoff_box .off').show();
        $('.control_panel .switch .onoff_box .on').hide();
        $('.albums_wrap .album_'+(music_ind+1)+' dt').removeClass('on');
        $('.albums_wrap .album_'+(music_ind+1)+' dd a').css({transform:'translateX(-50%)', transition:'all .5s ease-out'});
        $('.albums_wrap .album_'+(music_ind+1)+' dd p').hide().removeClass('on');
        $('.control_panel>span').removeClass('on');
        $('.lp_plate').removeClass('on');
        $('.audioplay'+(music_ind+1)).attr('src','');
    };
};

function music_start(){

    $('.album_box dd a').click(function(e){
        e.preventDefault();
        music_ind=$(this).index('.music_cover');
        onoff_do();
    });

    $('.control_panel .switch').click(function(e){
         
        e.preventDefault();
        onoff_do();
    })
};

function auto_play_click(){

    $('.control_panel .auto').click(function(e){
        e.preventDefault();
        if(auto_on==1){
            auto_on=0;
            $('.control_panel .auto').removeClass('on');
            clearInterval(auto_slide);
        } else {
            auto_on=1;
            $('.control_panel .auto').addClass('on');
            timeonoff=setInterval(auto_slide,1000);
        };
    });
};

function auto_slide(){
    sec_cnt++;
    if(sec_cnt==14){
        sec_cnt=0;
        if(auto_on==1 && music_on==1){
            music_ind++;
            if(music_ind>=6){music_ind=0;};
            next_do();
        };
    };
};

function audio_init_set(){
    for(var i=0; i<6; i++){
        audio_stop=document.getElementById('audioplay'+(i+1));
        audio_stop.pause();
    }
};

function login_join_height_set() {
    $('.entire_bg').height($(window).height());
    $('.join_form').height($(window).height()*0.9);
    $('.information_form').height($(window).height()*0.9);
};
//Function Set End 