var v_cnt=1;
var v_imgcnt=3;
var timeonoff;
var onoff=true;

$(document).ready(function(){

    var countable=function(){
        v_cnt++;
        if (v_cnt>v_imgcnt){
            v_cnt=1;
        };

        visualslide();
    };

    timeonoff=setInterval(countable,4000);

    $('.dock_init').click(function(event){
        var $target=$(event.target);
        clearInterval(timeonoff);
        
        $('.dock_init').css('background','#fff');
        if($target.is('.dock_1')){
            v_cnt=1;
        }else if($target.is('.dock_2')){
            v_cnt=2;
        }else if($target.is('.dock_3')){
            v_cnt=3;
        }

        visualslide();
        
        timeonoff=setInterval(countable,4000);
        
        if(onoff==false){
            onoff==true;
            $('.ps').css('background','url(images/stop_button.png)');
        }
    });

    //play/stop 버튼 클릭시 동작
    $('.ps').click(function(){
        if(onoff==true){
            clearInterval(timeonoff);
            $(this).css('background','url(images/ps_run.svg)');
            onoff=false;
        }else{
            timeonoff=setInterval(countable,4000);
            $(this).css('background','url(images/ps_pause.svg)');
            onoff=true;
        }
    });
});

function visualslide(){
    
    $('.visual_text li').hide();
    $('.visual_text li:eq('+(v_cnt-1)+')').fadeIn(1000);

    $('.dock_init').css('background','#fff');
    $('.dock_'+v_cnt).css('background','rgb(225,84,73)');

    if(v_cnt==1){
        for(var i=0; i<v_imgcnt; i++){
            if(i==0){$('.visual_img li:eq('+i+')').animate({left:0, opacity:1},1000);}
            else if(i==(v_imgcnt-1)){$('.visual_img li:eq('+i+')').animate({left:-2000, opacity:0},1000);}
            else {$('.visual_img li:eq('+i+')').animate({left:2000, opacity:0},1000);}
        }
    } else if (v_cnt==v_imgcnt){
        for(var i=0; i<v_imgcnt; i++){
            if(i==(v_imgcnt-1)){$('.visual_img li:eq('+i+')').animate({left:0, opacity:1},1000);}
            else if(i==(v_imgcnt-2)){$('.visual_img li:eq('+i+')').animate({left:-2000, opacity:0},1000);}
            else {$('.visual_img li:eq('+i+')').animate({left:2000, opacity:0},1000);}
        }
    } else {
        for(var i=0; i<v_imgcnt; i++){
            if(i==(v_cnt-1)){$('.visual_img li:eq('+i+')').animate({left:0, opacity:1},1000);}
            else if(i==(v_cnt-2)){$('.visual_img li:eq('+i+')').animate({left:-2000, opacity:0},1000);}
            else {$('.visual_img li:eq('+i+')').animate({left:2000, opacity:0},1000);}
        }
    };
};