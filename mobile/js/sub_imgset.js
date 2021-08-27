var img_h1;
var img_h2;
var prev_img_h1;

$(document).ready(function(){
    prev_img_h1=$('.con2_main img:eq(0)').height();
    content_set();

    $('#content section').hide();
    $('#content .content_1').show();

    $('.con_nav li a').click(function(e){
        e.preventDefault();
        var c_ind = $(this).index('.link');
        $('#content section').hide();
        $('#content .con_nav li').removeClass('con_current');
        $('#content .con_nav li:eq('+c_ind+')').addClass('con_current');
        $('#content .content_'+(c_ind+1)).fadeIn(500);
    });
    
    $(window).resize(function (){
        img_h1=$('.con2_main img:eq(0)').height();
        
        if(img_h1!=prev_img_h1){
            content_set();
        }
    });
});

function content_set(){
    img_h1=$('.con2_main img:eq(0)').width()*0.62;
    img_h2=$('.con2_main img:eq(1)').width();

    $('.con2_main img:eq(1)').css({top:(img_h1/2-img_h2/2)+'px'});
}