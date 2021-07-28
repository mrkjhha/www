var box_cnt=3;//total image
var box_p=[];
var onoff=0;
var box_set=0;
var box_size=1260;

$(document).ready(function(){
    
    for(var i=0; i<box_cnt; i++){box_p[i]=box_set+box_size*i}
    $('.management_wrap .lr_btn').click(function(event){
        event.preventDefault();
        var $target=$(event.target);
        if($target.is('.management_wrap .next')){
            if (onoff==1){onoff=0; m_slide_toleft();};
            m_slide_do();
            m_slide_toleft();
        } else if($target.is('.management_wrap .before')){
            if (onoff==0){onoff=1; m_slide_toright();};
            m_slide_toright();
            m_slide_do();
        }
    });
    
});

function m_slide_do(){
    for(var j=0; j<box_cnt; j++){
        if(onoff==0){
            if(box_p[j]==box_size*(parseInt(box_cnt/2)+1)){$('.con_wrap .manag_con:eq('+j+')').fadeOut(1).css('left',box_p[j]).fadeIn(1000);}
            else {$('.con_wrap .manag_con:eq('+j+')').css('left',box_p[j]);}
        } else if(onoff==1){
            if(box_p[j]==box_size*(parseInt(box_cnt/2)-1)){$('.con_wrap .manag_con:eq('+j+')').fadeOut(1).css('left',box_p[j]).fadeIn(1000);}
            else {$('.con_wrap .manag_con:eq('+j+')').css('left',box_p[j]);}
        }

        if(box_p[j]==box_set){$('.con_wrap .manag_con:eq('+j+')').css('zIndex','0');}
        else if(box_p[j]==box_size*parseInt(box_cnt/2)){$('.con_wrap .manag_con:eq('+j+')').css('zIndex','5');}
        else if(box_p[j]==box_size*(box_cnt-1)){$('.con_wrap .manag_con:eq('+j+')').css('zIndex','10');}
    };
}
function m_slide_toright(){

    for(var i=0; i<box_cnt; i++){
        if(box_p[i]==(box_size*(box_cnt-1))){box_p[i]=box_set;}
        else {box_p[i]+=box_size;}
    }
};
function m_slide_toleft(){

    for(var i=0; i<box_cnt; i++){
        if(box_p[i]==box_set){box_p[i]=box_size*(box_cnt-1);}
        else {box_p[i]-=box_size;}
    }
};