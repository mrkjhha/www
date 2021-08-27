var map_w1;
var prev_map_w1;

$(document).ready(function(){
    prev_map_w1=$('#kakaoMap').width();
    content_set();
    
    $(window).resize(function (){
        map_w1=$('#kakaoMap').width();
        
        if(map_w1!=prev_map_w1){
            content_set();
        }
    });
});

function content_set(){
    map_w1=$('#kakaoMap').width();
    $('#kakaoMap').css({height:map_w1*0.7+'px'});
}