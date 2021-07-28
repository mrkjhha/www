var img_cnt=5;//total image
var img_p=[];
var onoff=0;
var p_center=-354;
var per_set=654;
var init=1;
var cnt_set=0;

$(document).ready(function(){
    even_odd();
    init_poset();
    videofunc();

    $('.video_wrap span a').click(function(event){
        event.preventDefault();
        var $target=$(event.target);
        
        if($target.is('.before')){
            slide_toleft();
            slide_do();

        } else if($target.is('.next')){
            slide_toright();
            slide_do();
        }
        videofunc();
    });  
});

function even_odd(){
    if(img_cnt%2==0){cnt_set=1; //even
    } else {cnt_set=0;} //odd
}

function init_poset(){
    for(var i=0; i<img_cnt; i++){
        img_p[i]=p_center+per_set*i;
        if (img_p[i]>p_center+parseInt(img_cnt/2)*per_set){
            img_p[i]=p_center-per_set*(img_cnt-i);
        };
    }
}

function slide_do(){
    for(var j=0; j<img_cnt; j++){                
        $('.video_box li:eq('+j+')').css('marginLeft', img_p[j]);
        $('.video_box li:eq('+j+')').removeClass('center').removeClass('side').removeClass('other')
        if(img_p[j]==p_center){
            $('.video_box li:eq('+j+')').css('zIndex','10').addClass('center');
        } else if(img_p[j]==p_center+per_set || img_p[j]==p_center-per_set){
            $('.video_box li:eq('+j+')').css('opacity','1').css('zIndex','5').addClass('side');
        } else if(img_p[j]==p_center+parseInt(img_cnt/2)*per_set){
            $('.video_box li:eq('+j+')').css('opacity','0').css('zIndex','0').addClass('other');
        } else if(img_p[j]==p_center-(parseInt(img_cnt/2)-cnt_set)*per_set){
            $('.video_box li:eq('+j+')').css('opacity','0').css('zIndex','0').addClass('other');
        }
    };
}
function slide_toright(){

    for(var i=0; i<img_cnt; i++){
        if(img_p[i]==(p_center+parseInt(img_cnt/2)*per_set)){
            img_p[i]=p_center-(parseInt(img_cnt/2)-cnt_set)*per_set;
        }else {img_p[i]+=per_set;}
    }
};
function slide_toleft(){

    for(var i=0; i<img_cnt; i++){
        if(img_p[i]==(p_center-(parseInt(img_cnt/2)-cnt_set)*per_set)){
            img_p[i]=p_center+parseInt(img_cnt/2)*per_set;
        }else {img_p[i]-=per_set;}
    }
};

function videofunc(){
    $('.center>a').click(
        function(e){
            e.preventDefault();
            $('.content_area #box').show();
            $('.center .video').fadeIn('fast');
            $('.center .video iframe').attr('id','player');
    });
    
    $('.content_area #box, .center .video a').click(
        function(e){
            e.preventDefault();
            $('.content_area #box').hide();
            $('.center .video').hide();

            var video = $('#player').attr('src');
            $('#player').attr('src','');
            $('#player').attr('src',video);
            $('.center .video iframe').removeAttr('id');
    });
};