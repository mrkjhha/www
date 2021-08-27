var selected_con;
var cf_set=[30,30,30,30];
var cf_iniset=[30,30,30,30];
var cf_lasset=[-79.99,-46.66,-79.99,-113.32];
var cf_moveset=[30,30,30,30];
var cf_pastset=[30,30,30,30];
var cf_move_pX;
var cf_move_pY;
var on_init=0;
var scroll_on=0;
var swipe_on=0;

$(document).ready(function(){
    var startX, endX;

    $('.con ol').on('mousedown',function(e){
        e.preventDefault();
        startX=e.clientX || e.originalEvent.clientX;
        startY=e.pageY || e.originalEvent.pageY;
        selected_con=$(this).parents('.con').index('.con');
    });

    $('.con ol').on('touchstart',function(e){
        startX=e.clientX || e.originalEvent.touches[0].clientX;
        startY=e.pageY || e.originalEvent.touches[0].pageY;
        selected_con=$(this).parents('.con').index('.con');
    });

    $('.con ol').on('touchend touchmove', function(e){
        
        var doc_w=$(document).width();
        var moveX = e.originalEvent.changedTouches[0].clientX;
        var moveY = e.originalEvent.changedTouches[0].pageY;
        cf_move_pX=(startX-moveX)/doc_w*100;
        cf_move_pY=(startY-moveY)/doc_w;
        
        if(on_init==0){
            on_init=1;
            if(Math.abs(cf_move_pY)>Math.abs(startX-moveX)){scroll_on=1; swipe_on=0;} 
            else {swipe_on=1; scroll_on=0; }
        }
        
        if(scroll_on==0){
            if(Math.abs(startX-moveX)>5){
                e.preventDefault();
                if((Math.abs(startX-moveX)/doc_w)>Math.abs(cf_move_pY)){
                    cf_move_X();
                }
            }
        }
    });

    $('.con ol').on('touchend mouseup',function(e){
        
        endX=e.clientX || e.originalEvent.changedTouches[0].clientX;
        endY=e.pageY || e.originalEvent.changedTouches[0].pageY;

        if (scroll_on==0){
            if(Math.abs(startX-endX)>Math.abs(startY-endY)){
                cf_pastset[selected_con]=cf_moveset[selected_con]-cf_move_pX;

                if(cf_pastset[selected_con]>cf_iniset[selected_con]) {

                    $('.content_'+(selected_con+1)+' .flow_box ol').css({left:(cf_iniset[selected_con])+'%', transition:'all .5s ease-out'});
                    cf_pastset[selected_con]=cf_iniset[selected_con];
                } else if (cf_pastset[selected_con]<cf_lasset[selected_con]){

                    $('.content_'+(selected_con+1)+' .flow_box ol').css({left:(cf_lasset[selected_con])+'%', transition:'all .5s ease-out'});
                    cf_pastset[selected_con]=cf_lasset[selected_con];
                } else {
                    
                    $('.content_'+(selected_con+1)+' .flow_box ol').css({left:(cf_pastset[selected_con])+'%', transition:'all .5s ease-out'});
                }
            } else {
                cf_moveset[selected_con]=cf_pastset[selected_con];
                $('.content_'+(selected_con+1)+' .flow_box ol').css({left:(cf_pastset[selected_con])+'%', transition:'all .5s ease-out'});
            }
            
            cf_moveset[selected_con]=cf_pastset[selected_con];
        }
        on_init=0;
        swipe_on=0;
        scroll_on=0;
    });
});

function cf_move_X(){
    if(cf_move_pX>-50 && cf_move_pX<50) {
        cf_moveset[selected_con]-=cf_move_pX;
        $('.content_'+(selected_con+1)+' .flow_box ol').css({left:cf_moveset[selected_con]+'%', transition:'none'});
        cf_moveset[selected_con]=cf_pastset[selected_con];
    }
}