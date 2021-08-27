var box_cnt=6;
var box_p=[];
var box_moveOn=[];
var box_center=-120;
var box_per=270;
var box_move_pX;
var box_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;

$(document).ready(function(){
    
    var startX, endX;
    box_init_set();

    $('.img_wrap').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.img_wrap').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });

    $('.img_wrap').on("touchend touchmove", function(e){

        var doc_w=$(document).width();
        
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        box_move_pX=(startX-moveX)/doc_w*100;
        box_move_pY=(startY-moveY)/doc_w;
        
        if(on_init==0){
            on_init=1;
            if(Math.abs(box_move_pY)+5>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0;}
        }
        
        if(scroll_on==0){
            e.preventDefault();
            if((Math.abs(startX-moveX)/doc_w)>Math.abs(box_move_pY)){
                box_move_X();
            }
        }
    });

    $('.img_wrap').on('touchend mouseup',function(e){
        
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    if(box_cnt<1){box_cnt=box_cnt;}
                    // 오른쪽으로 터치드래그
                    box_toright();
                }else{
                    if(box_cnt==(box_cnt+1)){box_cnt=1;}
                    // 왼쪽로 터치드래그
                    box_toleft();
                }
            } else {
                for(var i=0; i<box_cnt; i++){
                    box_moveOn[i]=box_p[i];
                    $('.img_box span:eq('+i+')').css({marginLeft:box_p[i]+'px', transition:'none'});
                }
            }
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
    
});

function box_init_set(){

    for(var i=0; i<box_cnt; i++){
        box_p[i]=box_center+box_per*i;
        if (box_p[i]>box_center+parseInt(box_cnt/2)*box_per){
            box_p[i]=box_center-box_per*(box_cnt-i);
        };
        box_moveOn[i]=box_p[i];
        $('.img_box span:eq('+i+')').css({background:'url(./images/work_'+(i+1)+'.jpg)0 0 no-repeat',backgroundSize:'contain',marginLeft:box_p[i]});
    }
}

function box_toright(){

    for(var i=0; i<box_cnt; i++){
        if(box_p[i]==(box_center+parseInt(box_cnt/2)*box_per)){
            box_p[i]=box_center-2*box_per;
        }else {box_p[i]+=box_per;}
        box_moveOn[i]=box_p[i];
    };

    for(var j=0; j<box_cnt; j++){
        if(box_p[j]==box_center-2*box_per){
            $('.img_box span:eq('+j+')').fadeOut(1).css({marginLeft:box_p[j]+'px', transition:'none'}).fadeIn(600);
        } else {
            $('.img_box span:eq('+j+')').css({marginLeft:box_p[j]+'px', transition:'all .5s ease-out'});
        }

        if(box_p[j]==box_center){
            $('.show_box li').removeClass('main_show');
            $('.show_box li:eq('+j+')').addClass('main_show');
        }
    };
};

function box_toleft(){

    for(var i=0; i<box_cnt; i++){
        if(box_p[i]==(box_center-2*box_per)){
            box_p[i]=box_center+parseInt(box_cnt/2)*box_per;
        }else {box_p[i]-=box_per;}
        box_moveOn[i]=box_p[i];
    }
    for(var j=0; j<box_cnt; j++){
        if(box_p[j]==(box_center+parseInt(box_cnt/2)*box_per)){
            $('.img_box span:eq('+j+')').css({marginLeft:box_p[j]+'px', transition:'none'});
        } else {
            $('.img_box span:eq('+j+')').css({marginLeft:box_p[j]+'px', transition:'all .5s ease-out'});
        } 

        if(box_p[j]==box_center){
            $('.show_box li').removeClass('main_show');
            $('.show_box li:eq('+j+')').addClass('main_show');
        }
    };
};

function box_move_X(){
    
    for(var i=0; i<box_cnt; i++){
        box_moveOn[i]-=box_move_pX;
        $('.img_box span:eq('+i+')').css({marginLeft:box_moveOn[i]+'px', transition:'none'});
        box_moveOn[i]=box_p[i];
    }
}