var img_cnt=6;//total image
var img_show=4;
var img_p=0;
var window_p=143;
var p_center=8;
var per_set=232;
var init=1;
var cnt_set=0;
var move_cnt=0;

$(document).ready(function(){
    img_init();
    img_p=p_center-img_cnt*per_set;
    $('.move_box .img_box').before($('.move_box .img_box').clone());
    $('.move_box').css('left',img_p);
    $('.con_wrap ul li:eq(0)').css('display','block');
    
    img_p=p_center-img_cnt*per_set;
    // videofunc();
    click_set();
    $('.con_wrap span a').click(function(event){
        event.preventDefault();
        var $target=$(event.target);
        if($target.is('.before')){
            slide_toright();
            d_show();
            console.log(cnt_set);
            console.log(move_cnt);
        } else if($target.is('.next')){
            slide_toleft();
            d_show();
            console.log(cnt_set);
            console.log(move_cnt);
        }     
        // videofunc();
    });
});

function img_init(){
    for(var i=0; i<img_cnt; i++){
        $('.img_box span:eq('+i+')').css('background','url(./images/content4/work_'+(i+1)+'.jpg)0 0 no-repeat').css('backgroundSize','contain');
    }
}
function slide_toleft(){    
    
    if(cnt_set<3 && move_cnt<3){
        move_cnt++;
        cnt_set++;
        window_p+=per_set;
        $('.con_wrap .img_window').stop().animate({left:window_p},'slow');
    } else if (cnt_set<(img_cnt-1)){
        cnt_set++;
        img_p-=per_set;
        $('.img_wrap .move_box').stop().animate({left:img_p},'slow');
    } else if (cnt_set==img_cnt-1){
        cnt_set=0;
        move_cnt=0;
        img_p=p_center-img_cnt*per_set;
        window_p=143;
        $('.img_wrap .move_box').animate({left:img_p},'slow');
        $('.con_wrap .img_window').stop().animate({left:window_p},'slow')
    }
};

function slide_toright(){

    if(move_cnt>0 && cnt_set>0){
        move_cnt--;
        cnt_set--;
        window_p-=per_set;
        $('.con_wrap .img_window').stop().animate({left:window_p},'slow');
    } else if(move_cnt>0 && cnt_set<=0){
        move_cnt--;
        cnt_set--;
        window_p-=per_set;
        $('.con_wrap .img_window').stop().animate({left:window_p},'slow');
    } else if(move_cnt==0 && cnt_set>0){
        cnt_set--;
        img_p+=per_set;
        $('.img_wrap .move_box').stop().animate({left:img_p},'slow');
    } 
    else if (cnt_set>-(img_cnt-1) && cnt_set<=0){
        cnt_set--;
        img_p+=per_set;
        $('.img_wrap .move_box').stop().animate({left:img_p},'slow');
    } 
    else {
        cnt_set=0;
        img_p=p_center-img_cnt*per_set;
        $('.img_wrap .move_box').stop().animate({left:img_p},'slow');
    };
};

function click_set(){

    $('.con_wrap .img_box span').click(function(event){
        event.preventDefault();
        var d_ind = $(this).index('.con_wrap .img_box span');
        if(d_ind>5){d_ind-=img_cnt;}
        $('.con_wrap .show_box li').hide();
        $('.con_wrap .show_box li:eq('+d_ind+')').addClass('main_show').show();
        
        console.log(d_ind);
    });
}
function d_show(){

    $('.con_wrap .show_box li').removeClass('main_show').hide();
    $('.con_wrap .show_box li:eq('+cnt_set+')').addClass('main_show').show();
}

function videofunc(){
    $('.center>a').click(
        function(e){
            e.preventDefault();
            $('.content_area #box').show();
            $('.center .video').fadeIn('fast');
            $('.center .video iframe').attr('id','player');
    });
    
    $('.content_area #box, .center .video a').click(
        function(e){
            e.preventDefault();
            $('.content_area #box').hide();
            $('.center .video').hide();

            var video = $('#player').attr('src');
            $('#player').attr('src','');
            $('#player').attr('src',video);
            $('.center .video iframe').removeAttr('id');
    });
};