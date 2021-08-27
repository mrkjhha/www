var m_cnt=1;
var m_imgcnt=3;
var m_p=0;
var m_moveOn;
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
    $('.content_inner').css({left:m_center+'%', transition:'all .5s ease-out'})

    $('.con_nav li a').click(function(e){
        e.preventDefault();
        var ind = $(this).index('.link');

        $('#content .con_nav li').removeClass('con_current');
        $('#content .con_nav li:eq('+ind+')').addClass('con_current');
        
        m_p=m_center-ind*m_per;
        $('.content_inner').css({left:m_p+'%', transition:'all .5s ease-out'});
    });

    $('#content .content_inner').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });    
    
    $('#content .content_inner').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });

    $('#content .content_inner').on("touchmove", function(e){

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

    $('#content .content_inner').on('touchend mouseup',function(e){
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;
        
        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    m_cnt--;
                    if(m_cnt<1){m_cnt=1;}
                    // 오른쪽으로 터치드래그
                    m_toright();
                }else{
                    m_cnt++
                    if(m_cnt>m_imgcnt){m_cnt=m_imgcnt;}
                    // 왼쪽로 터치드래그
                    m_toleft();
                }
            } else {
                $('.content_inner').css({left:m_p+'%', transition:'none'});
            }
            $('#content .con_nav li').removeClass('con_current');
            $('#content .con_nav li:eq('+(m_cnt-1)+')').addClass('con_current');
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
});

function m_even_odd(){
    if(m_imgcnt%2==0){mcnt_set=1; //even
    } else {mcnt_set=0;} //odd
}

function m_toright(){

    if(m_p==m_center){
        m_p=m_center;
    }else {m_p+=m_per;}

    m_moveOn=m_p;
    
    $('.content_inner').css({left:m_p+'%', transition:'all .5s ease-out'})
};

function m_toleft(){

    if(m_p==(m_center-(m_imgcnt-1)*m_per)){
        m_p=m_center-(m_imgcnt-1)*m_per;
    }else {m_p-=m_per;}
    
    m_moveOn=m_p;
    $('.content_inner').css({left:m_p+'%', transition:'all .5s ease-out'})
};

function m_move_X(){

    m_moveOn-=m_move_pX;
        $('.content_inner').css({left:m_moveOn+'%', transition:'none'});
        m_moveOn=m_p;
}