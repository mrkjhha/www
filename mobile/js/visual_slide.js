var v_cnt=1;
var v_imgcnt=3;
var on_init=0;
var scroll_on=0;
var swipe_on=0;

$(document).ready(function(){

    var startX, endX;
    $('.visual').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.visual').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });
    
    $(".visual").on("touchmove", function(e){
        
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;

        if(on_init==0){
            on_init=1;
            if(Math.abs(startY-moveY)+5>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0;}
        }
        if(scroll_on==0){e.preventDefault();}
    });

    $('.visual').on('touchend mouseup',function(e){
                      
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;
        
        if (scroll_on==0){
            if(startX<endX) {
                v_cnt--;
                if(v_cnt<1){v_cnt=v_imgcnt;}
                // 오른쪽으로 터치드래그
            }else{
                v_cnt++;
                if(v_cnt==(v_imgcnt+1)){v_cnt=1;}
                // 왼쪽로 터치드래그
            }            
            visualslide();
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
});

function visualslide(){
    
    $('.visual_text li').hide();
    $('.visual_text li:eq('+(v_cnt-1)+')').show();

    $('.dock_init').css('background','#fff');
    $('.dock_'+v_cnt).css('background','rgb(225,84,73)');

    if(v_cnt==1){
        for(var i=0; i<v_imgcnt; i++){
            if(i==0){$('.visual_img li:eq('+i+')').css({left:0, opacity:1});}
            else if(i==(v_imgcnt-1)){$('.visual_img li:eq('+i+')').css({left:'-100%', opacity:0});}
            else {$('.visual_img li:eq('+i+')').css({left:0, opacity:0});}
        }
    } else if (v_cnt==v_imgcnt){
        for(var i=0; i<v_imgcnt; i++){
            if(i==(v_imgcnt-1)){$('.visual_img li:eq('+i+')').css({left:'-66.66%', opacity:1});}
            else if(i==(v_imgcnt-2)){$('.visual_img li:eq('+i+')').css({left:'-66.66%', opacity:0});}
            else {$('.visual_img li:eq('+i+')').css({left:'33.33%', opacity:0});}
        }
    } else {
        for(var i=0; i<v_imgcnt; i++){
            if(i==(v_cnt-1)){$('.visual_img li:eq('+i+')').css({left:'-33.33%', opacity:1});}
            else if(i==(v_cnt-2)){$('.visual_img li:eq('+i+')').css({left:'-33.33%', opacity:0});}
            else {$('.visual_img li:eq('+i+')').css({left:'-33.33%', opacity:0});}
        }
    };
};