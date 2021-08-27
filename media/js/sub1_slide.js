var f_cnt=1;
var f_imgcnt=6;
var f_p=[];
var f_moveOn=[];
var f_move_pX;
var f_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;
var fcnt_set=0; //홀수=0 짝수=1
var f_ind;
var f_center;
var f_per;
var center_ind=0;
var f_ind;

$(document).ready(function(){

    pf_screen_width=$(window).width();
    f_screen_width=pf_screen_width;
    init_film_set();
    var startX, endX;

    $(window).resize(function () {

        f_screen_width=$(window).width();
        if(pf_screen_width!=f_screen_width){
            init_film_set();
            pf_screen_width=f_screen_width;
        }
    });

    $('.film_box').mousedown(function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.film_box').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        startY=e.pageY || e.originalEvent.changedTouches[0].pageY;
    });

    $('.film_box').on('touchmove', function(e){
        var doc_w=$(document).width();
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        f_move_pX=(startX-moveX)/doc_w*50;
        f_move_pY=(startY-moveY)/doc_w;

        if(on_init==0){
            on_init=1;
            if(Math.abs(f_move_pY)+5>Math.abs(startX-moveX)){
                scroll_on=1; swipe_on=0;
            } else {
                e.preventDefault();
                swipe_on=1; scroll_on=0;
            }
        }

        if(scroll_on==0){
            if((Math.abs(startX-moveX)/doc_w)>Math.abs(f_move_pY)){
                f_move_X();                
                light_on();
            }
        }
    });

    $('.film_box').on('touchend mouseup',function(e){

        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    f_cnt--;
                    f_toright();
                    // 오른쪽으로 터치드래그
                    if(f_cnt<1){f_cnt=1;}
                } else {
                    f_cnt++;
                    f_toleft();
                    // 왼쪽로 터치드래그
                    if(f_cnt==(f_imgcnt+1)){f_cnt=f_imgcnt;}
                }
            };
            $('.episode_wrap .episode_box').css('display','none');
            for(var i=0; i<6; i++){
                if(f_p[i]==f_center){
                    $('.episode_wrap .episode_'+(i+1)).css('display','block');                    
                }
            }
            light_off();
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
        btn_on=false;
        img_on=false;
    });

    f_click();
});

function init_film_set(){
    
    if(screen_width>1280){
        f_center=-6;
        f_per=25;
    } else if(screen_width>1024 && screen_width<=1280){
        f_center=-20;
        f_per=35;
    } else {
        f_center=-34;
        f_per=45;
    }
    
    for(var i=0; i<6; i++){
        f_p[i]=f_center+f_per*i;
        $('.film_box .episode_link:eq('+i+')').css({background:'url(./images/episode_link_'+(i+1)+'.jpg)center no-repeat', backgroundSize:'contain', left:f_p[i]+'%', transition:'none'});
    }
}

function f_toright(){

    for(var i=0; i<f_imgcnt; i++){
        if(f_p[i]==(f_center+(f_imgcnt-1)*f_per)){
            f_p[i]=f_center;
            center_ind=i;
        }else {f_p[i]+=f_per;}
        f_moveOn[i]=f_p[i];
    };

    for(var j=0; j<f_imgcnt; j++){
        if(f_p[j]==f_center){
            $('.film_box .episode_link:eq('+j+')').css({left:f_p[j]+'%', transition:'none'})
        } else {
            $('.film_box .episode_link:eq('+j+')').css({left:f_p[j]+'%', transition:'all .5s ease-out'})
        }
    };
};

function f_toleft(){

    for(var i=0; i<f_imgcnt; i++){
        if(f_p[i]==f_center){
            f_p[i]=f_center+(f_imgcnt-1)*f_per;
        }else {
            f_p[i]-=f_per;
            if(f_p[i]==f_center){
                center_ind=i;
            }
        }
        f_moveOn[i]=f_p[i];
    };
    
    for(var j=0; j<f_imgcnt; j++){
        if(f_p[j]==f_center+(f_imgcnt-1)*f_per){
            $('.film_box .episode_link:eq('+j+')').css({left:f_p[j]+'%', transition:'none'})
        } else {
            $('.film_box .episode_link:eq('+j+')').css({left:f_p[j]+'%', transition:'all .5s ease-out'})
        }
    };
};

function f_move_X(){
    
    for(var i=0; i<f_imgcnt; i++){

        f_moveOn[i]-=f_move_pX;
        $('.film_box .episode_link:eq('+i+')').css({left:f_moveOn[i]+'%', transition:'none'});
        f_moveOn[i]=f_p[i];
    }
}

function light_on(){

    $('.main_episode .film_box .deco_black2').css({boxShadow:'rgba(255,255,255,.8) 0 0 10px 2px', transition:'all .5s ease-out'});
    $('.main_episode .film_box .deco_black').addClass('light_on');
    if(f_screen_width>1280){
        $('.main_episode .film_box .deco_black3').css({boxShadow:'rgba(255,255,255,.8) 0 0 10px 2px'});
    }
}

function light_off(){
    
    $('.main_episode .film_box .deco_black2').css({boxShadow:'rgba(255,255,255,.2) 0 0 5px 2px', transition:'none'});
    $('.main_episode .film_box .deco_black').removeClass('light_on');
    if(f_screen_width>1280){
        $('.main_episode .film_box .deco_black3').css({boxShadow:'rgba(255,255,255,.2) 0 0 5px 2px'});
    }
}

function f_click(){
    $('.film_box .episode_link').click(function(e){
        e.preventDefault();
        f_ind = $(this).index('.episode_link');

        $('.episode_wrap .episode_box').css('display','none');
        $('.episode_wrap .episode_'+(f_ind+1)).css('display','block');

    });
}