$(document).ready(function(){
    var cnt=1;
    var cen_p=0;
    var right_p=1;
    var left_p=2;
    var timeonoff;
    var onoff=true;
    
    function visualslide(){
        cnt++;
        if (cnt>3){
            cnt=1;
        };

        if (cnt==1){cen_p=0; right_p=1; left_p=2;}
        else if (cnt==2){cen_p=1; right_p=2; left_p=0;}
        else if (cnt==3){cen_p=2; right_p=0; left_p=1;}

        $('.visual_text li').hide();
        $('.visual_text li:eq('+(cnt-1)+')').fadeIn(1000);

        $('.dock_init').css('background','#fff');
        $('.dock_'+cnt).css('background','rgb(225,84,73)');

        $('.visual_img li:eq('+cen_p+')').animate({left:0, opacity:1},1000);
        $('.visual_img li:eq('+right_p+')').animate({left:2000, opacity:0},'fast');
        $('.visual_img li:eq('+left_p+')').animate({left:-2000, opacity:0},1000);
    };

    timeonoff=setInterval(visualslide,4000);

    $('.dock_init').click(function(event){
        var $target=$(event.target);
        clearInterval(timeonoff);
        
        $('.dock_init').css('background','#fff');
        if($target.is('.dock_1')){
            cnt=1; cen_p=0; right_p=1; left_p=2;
        }else if($target.is('.dock_2')){
            cnt=2; cen_p=1; right_p=2; left_p=0;
        }else if($target.is('.dock_3')){
            cnt=3; cen_p=2; right_p=0; left_p=1;
        }

        $('.visual_img li:eq('+cen_p+')').animate({left:0, opacity:1},'slow');
        $('.visual_img li:eq('+right_p+')').animate({left:2000, opacity:0},'slow');
        $('.visual_img li:eq('+left_p+')').animate({left:-2000, opacity:0},'slow');

        $('.visual_text li').hide();
        $('.visual_text li:eq('+(cnt-1)+')').fadeIn('slow');
        
        $('.dock_'+cnt).css('background','rgb(225,84,73)');
        
        timeonoff=setInterval(visualslide,4000);
        
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
            timeonoff=setInterval(visualslide,4000);
            $(this).css('background','url(images/ps_pause.svg)');
            onoff=true;
        }
    });
});