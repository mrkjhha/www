var s_init=0;
var s_imgcnt=6;
var s_p=[];
var s_moveOn=[];
var s_center;
var s_per;
var s_move_pX;
var s_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;
var img_w;
var prev_img_w;

$(document).ready(function(){
    var startX, endX;
    prev_img_w=$('.content_1 img').width();
    content_set();
    init_s_set();
    
    $('#content section').hide();
    $('#content .content_1').show();
    
    $(window).resize(function (){
        img_w=$('.content_1 img').width();
        
        if(img_w!=prev_img_w){
            content_set();
            init_s_set();
        }
    });

    $('.con_nav li a').click(function(e){
        e.preventDefault();
        var c_ind=$(this).index('.link');

        $('#content section').hide();
        $('#content .con_nav li').removeClass('con_current');
        $('#content .con_nav li:eq('+c_ind+')').addClass('con_current');
        $('#content .content_'+(c_ind+1)).fadeIn(500);
        
        content_set();
        init_s_set();
    });

    $('.content_1 ul li').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
    });

    $('.content_1 ul li').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
    });

    $(".content_1 ul li").on("touchend touchmove", function(e){
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        s_move_pX=startX-moveX;
        s_move_pY=startY-moveY;
        
        if(on_init==0){
            on_init=1;
            if(Math.abs(s_move_pY)+5>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0;}
        }
        
        if(scroll_on==0){
            e.preventDefault();
            if((Math.abs(startX-moveX))>Math.abs(s_move_pY)){
                move_X();
            }
        }
    });
    
    $('.content_1 ul li').on('touchend mouseup',function(e){
        
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        console.log(s_p);
        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                if(startX<endX) {
                    // 오른쪽으로 터치드래그
                    s_toright();
                }else{
                    // 왼쪽로 터치드래그
                    s_toleft();
                }
            } else {
                for(var i=0; i<s_imgcnt; i++){
                    $('.content_1 ul li:eq('+i+') img').css({marginLeft:(s_p[i]/doc_w)+'px', transition:'none'});
                    s_moveOn[i]=s_p[i];
                }
            }
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
});

function content_set(){
    
    img_w=$('.content_1 img').width();
    con_h=$('.content_1 dl').height();

    s_center=-img_w/2;
    s_per=img_w;
    $('.content_1 ul').css({height:(img_w+con_h+50)+'px'});
    $('.content_1 ul li dl').hide();
    $('.content_1 ul li:eq(0)').children('dl').show();
    $('.content_1 ul li img').css({top:0});
}

function init_s_set(){
    for(var i=0; i<s_imgcnt; i++){
        s_p[i]=s_center+s_per*i;
        if (s_p[i]>s_center+parseInt(s_imgcnt/2)*s_per){
            s_p[i]=s_center-s_per*(s_imgcnt-i);
        };
        $('.content_1 ul li:eq('+i+') img').css({marginLeft:s_p[i]+'px',transition:'none'});
        s_moveOn[i]=s_p[i];
    }
}

function s_toright(){

    for(var i=0; i<s_imgcnt; i++){
        if(s_p[i]==(s_center+parseInt(s_imgcnt/2)*s_per)){
            s_p[i]=s_center-s_per*2;
        }else {s_p[i]+=s_per;}
        s_moveOn[i]=s_p[i];
    };

    for(var j=0; j<s_imgcnt; j++){
        if(s_p[j]==s_center-s_per*2){
            $('.content_1 ul li:eq('+j+') img').fadeOut(1).css({marginLeft:s_p[j], transition:'all .4s ease-out'}).fadeIn(600);
        } else {
            $('.content_1 ul li:eq('+j+') img').css({marginLeft:s_p[j], transition:'all .5s ease-out'});
        }

        if(s_p[j]==s_center){
            $('.content_1 ul li dl').hide();
            $('.content_1 ul li:eq('+j+')').children('dl').show();
        }
    };
};

function s_toleft(){

    for(var i=0; i<s_imgcnt; i++){
        if(s_p[i]==(s_center-s_per*2)){
            s_p[i]=s_center+parseInt(s_imgcnt/2)*s_per;
        }else {s_p[i]-=s_per;}
        s_moveOn[i]=s_p[i];
    }

    for(var j=0; j<s_imgcnt; j++){
        if(s_p[j]==(s_center+parseInt(s_imgcnt/2)*s_per)){
            $('.content_1 ul li:eq('+j+') img').css({marginLeft:s_p[j]+'px', transition:'none'});
        } else {
            $('.content_1 ul li:eq('+j+') img').css({marginLeft:s_p[j]+'px', transition:'all .5s ease-out'});
        } 

        if(s_p[j]==s_center){
            $('.content_1 ul li dl').hide();
            $('.content_1 ul li:eq('+j+')').children('dl').show();
        }
    };
};

function move_X(){
    
    for(var i=0; i<s_imgcnt; i++){
        s_moveOn[i]-=s_move_pX;
        $('.content_1 ul li:eq('+i+') img').css({marginLeft:s_moveOn[i]+'px', transition:'none'});
        s_moveOn[i]=s_p[i];
    }
}