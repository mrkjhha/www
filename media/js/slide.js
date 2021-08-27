var g_cnt=1;
var g_imgcnt=10;
var g_p=[];
var g_moveOn=[];
var g_move_pX;
var g_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;
var gcnt_set=0; //홀수=0 짝수=1
var g_ind;
var g_center=-25;
var g_per=52;
var btn_set=1.5;
var btn_set_m=1.5;
var btn_on=false;
var img_on=false;

$(document).ready(function(){

    init_g_set();
    var startX, endX;

    $('.gallery .img_wrap, .gallery .bar_wrap').mousedown(function(e){
        e.preventDefault();
        if($(this).hasClass('bar_wrap')){btn_on=true;}
        if($(this).hasClass('img_wrap')){img_on=true;}
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.gallery .img_wrap, .gallery .bar_wrap .drag_btn').on('touchstart',function(e){        
        if($(this).hasClass('drag_btn')){btn_on=true;}
        if($(this).hasClass('img_wrap')){img_on=true;}
        startX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        startY=e.pageY || e.originalEvent.changedTouches[0].pageY;
    });

    $('.gallery .img_wrap, .gallery .bar_wrap .drag_btn').on('touchmove', function(e){
        var doc_w=$(document).width();
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        g_move_pX=(startX-moveX)/doc_w*50;
        g_move_pY=(startY-moveY)/doc_w;

        if(on_init==0){
            on_init=1;
            if(Math.abs(g_move_pY)+5>Math.abs(startX-moveX)){
                scroll_on=1; swipe_on=0;
            } else {
                e.preventDefault();
                swipe_on=1; scroll_on=0;
            }
        }

        if(scroll_on==0){
            if((Math.abs(startX-moveX)/doc_w)>Math.abs(g_move_pY)){
                g_move_X();
            }
        }
    });

    $('.gallery .img_wrap, .gallery .bar_wrap').on('touchend mouseup',function(e){

        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(btn_on==true){
                    if(startX<endX) {
                        g_cnt++;
                        if(g_cnt<g_imgcnt+1){
                            g_toleft();
                            btn_move();
                        } else {
                            end_line_set()
                        }
                        if(g_cnt==(g_imgcnt+1)){g_cnt=g_imgcnt;}
                    }else{
                        g_cnt--;
                        if(g_cnt>=1){
                            g_toright();
                            btn_move();
                        } else {
                            end_line_set()
                        }
                        if(g_cnt<1){g_cnt=1;}
                    }
                } else if(img_on==true){
                    if(startX<endX) {
                        g_cnt--;
                        if(g_cnt>=1){
                            g_toright();
                            btn_move();
                        } else {
                            end_line_set();
                        }
                        // 오른쪽으로 터치드래그
                        if(g_cnt<1){g_cnt=1;}
    
                    }else{
                        g_cnt++;
                        if(g_cnt<g_imgcnt+1){
                            g_toleft();
                            btn_move();
                        } else {
                            end_line_set();
                        }
                        // 왼쪽로 터치드래그
                        if(g_cnt==(g_imgcnt+1)){g_cnt=g_imgcnt;}
                    }
                }
            } else {
                end_line_set()
            }
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
        btn_on=false;
        img_on=false;
    });
});

function init_g_set(){
    for(var i=0; i<g_imgcnt; i++){
        g_p[i]=g_center+g_per*i
        if (g_p[i]>=g_center+g_per*(g_imgcnt/2)){
            g_p[i]=g_center-g_per*(g_imgcnt-i);
        };
        g_moveOn[i]=g_p[i];
    }
}

function g_toright(){

    for(var i=0; i<g_imgcnt; i++){
        if(g_p[i]==(g_center+(parseInt(g_imgcnt/2)-1)*g_per)){
            g_p[i]=g_center-parseInt(g_imgcnt/2)*g_per;
        }else {g_p[i]+=g_per;}

        g_moveOn[i]=g_p[i];
    };

    for(var j=0; j<g_imgcnt; j++){
        if(g_p[j]==g_center-(parseInt(g_imgcnt/2))*g_per){
            $('.gallery .img_wrap li:eq('+j+')').css({marginLeft:g_p[j]+'%', opacity:0, transition:'none'})
        } else {
            $('.gallery .img_wrap li:eq('+j+')').css({marginLeft:g_p[j]+'%', opacity:1, transition:'all .5s ease-out'})
        }
    };
};

function g_toleft(){

    for(var i=0; i<g_imgcnt; i++){
        if(g_p[i]==(g_center-(parseInt(g_imgcnt/2))*g_per)){
            g_p[i]=g_center+(parseInt(g_imgcnt/2)-1)*g_per;
        }else {g_p[i]-=g_per;}
        
        g_moveOn[i]=g_p[i];
    };
    
    for(var j=0; j<g_imgcnt; j++){
        if(g_p[j]==(g_center+(parseInt(g_imgcnt/2)-1)*g_per)){
            $('.gallery .img_wrap li:eq('+j+')').css({marginLeft:g_p[j]+'%', opacity:0, transition:'none'})
        } else {
            $('.gallery .img_wrap li:eq('+j+')').css({marginLeft:g_p[j]+'%', opacity:1, transition:'all .5s ease-out'})
        }
    };
};

function btn_move(){
    btn_set=1.5+9.7*(g_cnt-1);
    if(btn_set<=1.5){btn_set=1.5;}
    if(btn_set>=1.5+9.7*9){btn_set=1.5+9.7*9}
    $('.gallery .bar_wrap .drag_btn').css({left:btn_set+'%', transition:'all .5s ease-out'});
}

function g_move_X(){
    
    for(var i=0; i<g_imgcnt; i++){
        if(btn_on==true){
            g_moveOn[i]+=g_move_pX;
            btn_set_m-=(g_move_pX/3);

        }else if(img_on==true){
            g_moveOn[i]-=g_move_pX;
            btn_set_m+=(g_move_pX/3);
        }
        if(btn_set_m<=1.5){btn_set_m=1.5;}
        if(btn_set_m>=1.5+9.7*9){btn_set_m=1.5+9.7*9}
        $('.gallery li:eq('+i+')').css({marginLeft:g_moveOn[i]+'%', transition:'none'});
        $('.gallery .bar_wrap .drag_btn').css({left:btn_set_m+'%', transition:'none'});
        g_moveOn[i]=g_p[i];
        btn_set_m=btn_set;
    }
}

function end_line_set(){
    for(var i=0; i<g_imgcnt; i++){
        g_moveOn[i]=g_p[i];
        $('.gallery .img_wrap li:eq('+i+')').css({marginLeft:g_p[i]+'%', transition:'none'});
    }
}