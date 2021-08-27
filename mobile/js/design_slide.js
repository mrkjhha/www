var d_cnt=1;
var d_imgcnt=5;
var d_p=[];
var d_moveOn=[];
var d_center=0;
var d_per=20;
var d_move_pX;
var d_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;
var dcnt_set=0; //홀수=0 짝수=1
var d_ind;

$(document).ready(function(){

    var startX, endX;
    init_d_set();

    $('.design_con li img').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.design_con li img').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });

    $(".design_con li img").on("touchmove", function(e){

        var doc_w=$(document).width();
        
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        d_move_pX=(startX-moveX)/doc_w*10;
        d_move_pY=(startY-moveY)/doc_w;

        if(on_init==0){
            on_init=1;
            if(Math.abs(d_move_pY)+5>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0;}
        }

        if(scroll_on==0){
            e.preventDefault();
            if((Math.abs(startX-moveX)/doc_w)>Math.abs(d_move_pY)){
                d_move_X();
            }
        }
    });

    $('.design_con li img').on('touchend mouseup',function(e){

        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    if(d_cnt<1){d_cnt=d_imgcnt;}
                    // 오른쪽으로 터치드래그
                    d_toright();
                }else{
                    if(d_cnt==(d_imgcnt+1)){d_cnt=1;}
                    // 왼쪽로 터치드래그
                    d_toleft();
                }
            } else {
                for(var i=0; i<d_imgcnt; i++){
                    d_moveOn[i]=d_p[i];
                    $('.design_con li:eq('+i+')').css({left:d_p[i]+'%', transition:'none'});
                }
            }
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
});

function init_d_set(){
    for(var i=0; i<d_imgcnt; i++){
        d_p[i]=d_center;
        if (i>(parseInt(d_imgcnt/2))){
            d_p[i]=d_center-d_per*d_imgcnt;
        };
        d_moveOn[i]=d_p[i];
    }
}

function d_toright(){
    
    $('.m_doc span').removeClass('on');
    for(var i=0; i<d_imgcnt; i++){
        if(d_p[i]==(d_center+(parseInt(d_imgcnt/2)-i)*d_per)){
            d_p[i]=d_center-(parseInt(d_imgcnt/2)+i)*d_per;
        }else {d_p[i]+=d_per;}
        
        d_moveOn[i]=d_p[i];
    };

    for(var j=0; j<d_imgcnt; j++){
        if(d_p[j]==d_center-(parseInt(d_imgcnt/2)+j)*d_per){
            $('.design_con li:eq('+j+')').css({left:d_p[j]+'%', opacity:0, transition:'none'})
        } else {
            $('.design_con li:eq('+j+')').css({left:d_p[j]+'%', opacity:1, transition:'all .5s ease-out'})
        }

        if(d_p[j]==d_center-j*d_per){
            $('.m_doc span:eq('+j+')').addClass('on');
        }
    };

};

function d_toleft(){

    $('.m_doc span').removeClass('on');
    for(var i=0; i<d_imgcnt; i++){
        if(d_p[i]==(d_center-(parseInt(d_imgcnt/2)+i)*d_per)){
            d_p[i]=d_center+(parseInt(d_imgcnt/2)-i)*d_per;
        }else {d_p[i]-=d_per;}
        
        d_moveOn[i]=d_p[i];
    };
    
    for(var j=0; j<d_imgcnt; j++){
        if(d_p[j]==(d_center+(parseInt(d_imgcnt/2)-j)*d_per)){
            $('.design_con li:eq('+j+')').css({left:d_p[j]+'%', opacity:0, transition:'none'})
        } else {
            $('.design_con li:eq('+j+')').css({left:d_p[j]+'%', opacity:1, transition:'all .5s ease-out'})
        }

        if(d_p[j]==d_center-j*d_per){
            $('.m_doc span:eq('+j+')').addClass('on');
        }
    };
};

function d_move_X(){
    
    for(var i=0; i<d_imgcnt; i++){
        d_moveOn[i]-=d_move_pX;
        $('.design_con li:eq('+i+')').css({left:d_moveOn[i]+'%', transition:'none'});
        d_moveOn[i]=d_p[i];
    }
}