var img_cnt=5;//total image
var img_p=[];
var onoff=0;
var p_center=-490;
var per_set=400;
var init=1;
var cnt_set=0;

$(document).ready(function(){
    even_odd();
    init_poset();
    slide_do();
    $('.design .d_next').click(function(event){
        event.preventDefault();
        var $target=$(event.target);
        
        if($target.is('.before')){
            slide_toleft();
            slide_do();

        } else if($target.is('.d_next')){
            slide_toright();
            slide_do();
        }
    });  
});

function even_odd(){
    if(img_cnt%2==0){cnt_set=1; //even
    } else {cnt_set=0;} //odd
}

function init_poset(){
    for(var i=0; i<img_cnt; i++){
        img_p[i]=p_center-per_set*i;
        if (img_p[i]<p_center-per_set*(img_cnt-2)){
            img_p[i]=p_center+per_set;
        };
    }
}

function slide_do(){
    for(var j=0; j<img_cnt; j++){                
        $('.prcon_wrap li:eq('+j+')').css('marginLeft', img_p[j]);
        $('.prcon_wrap li:eq('+j+')').removeClass('center').removeClass('side1').removeClass('side2').removeClass('other');
        $('.doc span:eq('+j+')').css('background','#fff');
        if(img_p[j]==p_center){
            $('.prcon_wrap li:eq('+j+')').addClass('center');
            $('.doc span:eq('+j+')').css('background','rgba(218,41,28,.8)');
        } else if(img_p[j]==p_center+per_set){
            $('.prcon_wrap li:eq('+j+')').addClass('side1').fadeOut('fast');
        } else if(img_p[j]==p_center-per_set){
            $('.prcon_wrap li:eq('+j+')').addClass('side2');
        } else if(img_p[j]==p_center+parseInt(img_cnt/2)*per_set){
            $('.prcon_wrap li:eq('+j+')').addClass('other');
        } else if(img_p[j]==p_center-(parseInt(img_cnt/2)-cnt_set)*per_set){
            $('.prcon_wrap li:eq('+j+')').addClass('other').fadeIn('fast');
        }
    };
}
function slide_toright(){

    for(var i=0; i<img_cnt; i++){
        if(img_p[i]==(p_center+per_set)){
            img_p[i]=p_center-(img_cnt-parseInt(img_cnt/2)-cnt_set)*per_set;
        }else {img_p[i]+=per_set;}
    }
};