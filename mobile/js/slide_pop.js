var pop_cnt=6;
var pop_p=[];
var pop_moveOn=[];
var pop_center=-135;
var pop_per=270;
var pop_move_pX;
var pop_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;

$(document).ready(function(){
    
    var startX, endX;
    box_init_set();

    $('.show_box li').on('touchstart mousedown',function(e){

        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });

    $('.show_box li').on("touchend touchmove", function(e){

        var doc_w=$(document).width();
        
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        pop_move_pX=(startX-moveX)/doc_w*100;
        pop_move_pY=(startY-moveY)/doc_w;
        
        if(on_init==0){
            on_init=1;
            if(Math.abs(pop_move_pY)+5>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0;}
        }
        
        if(scroll_on==0){
            e.preventDefault();
            if((Math.abs(startX-moveX)/doc_w)>Math.abs(pop_move_pY)){
                pop_move_X();
            }
        }
    });

    $('.show_box li').on('touchend mouseup',function(e){
        
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    if(pop_cnt<1){pop_cnt=pop_cnt;}
                    // 오른쪽으로 터치드래그
                    pop_toright();
                }else{
                    if(pop_cnt==(pop_cnt+1)){pop_cnt=1;}
                    // 왼쪽로 터치드래그
                    pop_toleft();
                }
            } else {
                for(var i=0; i<pop_cnt; i++){
                    pop_moveOn[i]=box_p[i];
                    $('.show_box li:eq('+i+') img').css({marginLeft:pop_p[i]+'px', transition:'none'});
                }
            }
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
    
});

function pop_init_set(){

    for(var i=0; i<pop_cnt; i++){
        pop_p[i]=pop_center+pop_per*i;
        if (pop_p[i]>pop_center+parseInt(pop_cnt/2)*pop_per){
            pop_p[i]=pop_center-pop_per*(pop_cnt-i);
        };
        pop_moveOn[i]=pop_p[i];
        $('.show_box li:eq('+i+')').find('img').css({marginLeft:pop_p[i]});
    }
}

function pop_toright(){

    for(var i=0; i<pop_cnt; i++){
        if(pop_p[i]==(pop_center+parseInt(pop_cnt/2)*pop_per)){
            pop_p[i]=pop_center-2*pop_per;
        }else {pop_p[i]+=pop_per;}
        pop_moveOn[i]=pop_p[i];
    };

    for(var j=0; j<pop_cnt; j++){
        if(pop_p[j]==pop_center-2*pop_per){
            $('.img_box span:eq('+j+')').fadeOut(1).css({marginLeft:pop_p[j]+'px', transition:'none'}).fadeIn(600);
        } else {
            $('.img_box span:eq('+j+')').css({marginLeft:pop_p[j]+'px', transition:'all .5s ease-out'});
        } 
    };
};

function pop_toleft(){

    for(var i=0; i<pop_cnt; i++){
        if(pop_p[i]==(pop_center-2*pop_per)){
            pop_p[i]=pop_center+parseInt(pop_cnt/2)*pop_per;
        }else {pop_p[i]-=pop_per;}
        pop_moveOn[i]=pop_p[i];
    }
    for(var j=0; j<pop_cnt; j++){
        if(pop_p[j]==(pop_center+parseInt(pop_cnt/2)*pop_per)){
            $('.img_box span:eq('+j+')').css({marginLeft:pop_p[j]+'px', transition:'none'});
        } else {
            $('.img_box span:eq('+j+')').css({marginLeft:pop_p[j]+'px', transition:'all .5s ease-out'});
        } 
    };
};

function pop_move_X(){
    
    for(var i=0; i<pop_cnt; i++){
        pop_moveOn[i]-=pop_move_pX;
        $('.img_box span:eq('+i+')').css({marginLeft:pop_moveOn[i]+'px', transition:'none'});
        pop_moveOn[i]=pop_p[i];
    }
}