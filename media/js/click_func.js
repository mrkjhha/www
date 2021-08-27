var actcon_height_p;
var actcon_height;
var con_h;
var wrap_h;
var updown_p=0;
var upcnt=0;

$(document).ready(function(){

    story_click();
    actors_click();
    album_click();
    up_down_btn();

    $(window).resize(function () {
        $('.actors .con_box dl dd').css({height:'auto'});
    });
});

function story_click() {

    $('.story .bottom_box li').hover(function(){
        var story_ind = $(this).index('.story_list');
        $('.actors .bottom_box li a').removeClass('story_show');
        $('.actors .bottom_box li:eq('+story_ind+') a').addClass('story_show');
    });
}

function actors_click() {

    $('.actors .img_box li a').click(function(e){
        e.preventDefault();
        actcon_height_p = $('.actors .con_box .show dd').height();
        var act_ind = $(this).index('.act');
        $('.actors .con_box').css({background:'url(./images/actor_on'+(act_ind+1)+'.jpg) center top no-repeat',backgroundSize:'cover'});
        $('.actors .con_box dl').removeClass('show').addClass('hide');
        $('.actors .img_box li').removeClass('act_on').addClass('act_off');
        $('.actors .con_box dl:eq('+act_ind+')').removeClass('hide').addClass('show');
        $('.actors .img_box li:eq('+act_ind+')').removeClass('act_off').addClass('act_on');
        actcon_height = $('.actors .con_box dl:eq('+act_ind+') dd').height();

        if(actcon_height!=actcon_height_p){
            $('.actors .con_box .show dd').css({height:actcon_height_p});
            $('.actors .con_box .hide dd').css({height:'auto'});
        }
    });
}

function album_click() {

    $('.albums_inner ul li>a').click(function(e){
        e.preventDefault();
        var album_ind = $(this).index('.album_list');
        upcnt=0;
        updown_p=0

        $('.albums_inner .left_side li a img').css({left:0});
        $('.albums_inner .right_side li a img').css({right:0});
        $('.albums_inner ul li').addClass('music_off');
        $('.albums_inner ul li dl').removeClass('music_show').addClass('music_hide');
        $('.albums_inner ul li:eq('+album_ind+') dl').removeClass('music_hide').addClass('music_show');
        $('.albums_inner ul li:eq('+album_ind+') .music_show .cen_conwrap').css({top:0});

        if(album_ind<3){
            $('.albums_inner ul li:eq('+album_ind+') a img').css({left:120+'%',transform:'scale(.95)'});
        } else {
            $('.albums_inner ul li:eq('+album_ind+') a img').css({right:120+'%',transform:'scale(.95)'});
        }

        $('.albums_inner ul li:eq('+album_ind+')').removeClass('music_off');
    });
}

function up_down_btn(){

    $('.albums_inner ul li p .ud_btn').click(function(event){
        event.preventDefault();
        var $target=$(event.target);
        con_h=$('.albums_inner ul li .music_show .cen_conwrap').height();
        wrap_h=$('.albums_inner ul li .music_show p').height()-200;

        if($target.is('.albums_inner ul li p .up_btn')){
            updown_p-=(con_h-wrap_h-20)/2;
            upcnt++;
            if(con_h+updown_p<=wrap_h){
                updown_p+=(con_h-wrap_h-20)/2;
                upcnt--;
            }
            $('.albums_inner ul li .cen_conwrap').css({top:updown_p})

        } else if($target.is('.albums_inner ul li p .down_btn')){
            updown_p+=(con_h-wrap_h-20)/2;
            upcnt--;
            
            if(upcnt<0){
                updown_p=0;
                upcnt=0;
            }
            $('.albums_inner ul li .cen_conwrap').css({top:updown_p})   
        }
    });
}