var m_cnt=1;
var m_imgcnt=3;
var m_p=[];
var m_moveOn=[];
var m_center=0;
var m_per=100;
var m_move_pX;
var m_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;
var mcnt_set=0; //홀수=0 짝수=1

$(document).ready(function(){

    var startX, endX;
    
    m_even_odd();
    init_m_set();

    $('.con_box div').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.con_box div').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });

    $(".con_box div").on("touchmove", function(e){

        var doc_w=$(document).width();        
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        m_move_pX=(startX-moveX)/doc_w*50;
        m_move_pY=(startY-moveY)/doc_w;

        if(on_init==0){
            on_init=1;
            if(Math.abs(m_move_pY)+5>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0;}
        }

        if(scroll_on==0){
            e.preventDefault();
            if((Math.abs(startX-moveX)/doc_w)>Math.abs(m_move_pY)){
                m_move_X();
            }
        }
    });

    $('.con_box div').on('touchend mouseup',function(e){
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;
        
        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    if(m_cnt<1){m_cnt=m_imgcnt;}
                    // 오른쪽으로 터치드래그
                    m_toright();
                }else{
                    if(m_cnt==(m_imgcnt+1)){m_cnt=1;}
                    // 왼쪽로 터치드래그
                    m_toleft();
                }
            } else {
                for(var i=0; i<m_imgcnt; i++){
                    m_moveOn[i]=m_p[i];
                    $('.con_box:eq('+i+')').css({left:m_p[i]+'%', transition:'none'});
                }
            }
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });

    $('.management .m_next').click(function(e){
        e.preventDefault();
        m_toleft();
    });
});

function m_even_odd(){
    if(m_imgcnt%2==0){mcnt_set=1; //even
    } else {mcnt_set=0;} //odd
}

function init_m_set(){
    for(var i=0; i<m_imgcnt; i++){
        m_p[i]=m_center+m_per*i;
        if (m_p[i]>m_center+m_per){
            m_p[i]=m_center-m_per;
        };

        m_moveOn[i]=m_p[i];
    }
}

function m_toright(){

    for(var i=0; i<m_imgcnt; i++){
        if(m_p[i]==(m_center+(parseInt(m_imgcnt/2)+mcnt_set)*m_per)){
            m_p[i]=m_center-parseInt(m_imgcnt/2)*m_per;
        }else {m_p[i]+=m_per;}

        m_moveOn[i]=m_p[i];
    };

    for(var j=0; j<m_imgcnt; j++){
        if(m_p[j]==m_center-m_per){
            $('.con_box:eq('+j+')').css({left:m_p[j]+'%', opacity:0, transition:'none'})
        } else {
            $('.con_box:eq('+j+')').css({left:m_p[j]+'%', opacity:1, transition:'all .5s ease-out'})
        } 
    };
};

function m_toleft(){

    for(var i=0; i<m_imgcnt; i++){
        if(m_p[i]==(m_center-(parseInt(m_imgcnt/2)+mcnt_set)*m_per)){
            m_p[i]=m_center+parseInt(m_imgcnt/2)*m_per;
        }else {m_p[i]-=m_per;}
        
        m_moveOn[i]=m_p[i];
    }
    
    for(var j=0; j<m_imgcnt; j++){
        if(m_p[j]==(m_center+parseInt(m_imgcnt/2)*m_per)){
            $('.con_box:eq('+j+')').css({left:m_p[j]+'%', opacity:0, transition:'none'})
        } else {
            $('.con_box:eq('+j+')').css({left:m_p[j]+'%', opacity:1, transition:'all .5s ease-out'})
        } 
    };
};

function m_move_X(){
    
    for(var i=0; i<b_imgcnt; i++){
        m_moveOn[i]-=m_move_pX;
        $('.con_box:eq('+i+')').css({left:m_moveOn[i]+'%', transition:'none'});
        m_moveOn[i]=m_p[i];
    }
}