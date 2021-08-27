var scroll_onoff=0;
var mouse_onoff=0;
$(document).ready(function(){
    $('.topMove').hide();

    $(window).on('scroll',function(e){
        e.preventDefault();

        var scroll = $(window).scrollTop();
        
        if(scroll>620){$('.topMove').fadeIn('slow').clearQueue();}
        else{$('.topMove').fadeOut('fast').clearQueue();}

        if(scroll>100){
            $('#headerArea').css('borderBottom', '1px solid rgb(218,41,28)');

        }else{
            $('#headerArea').css('borderBottom', '0');
        }
    });

    $('.topMove').click(function(e){
           e.preventDefault();
           $("html,body").stop().animate({"scrollTop":0},1000).clearQueue();
    });
});

var family_cnt=0;
$(document).ready(function() {

    $('.family .fa_title').click(function(e){
        e.preventDefault();
        family_cnt++;
        if(family_cnt>2){family_cnt=1;}
        if(family_cnt==1){
            $('.family .fam_list').show();
            $('.family .fa_title span').addClass('show');
            $('.family').css('border-radius','0 0 4px 4px');
            $('.family .fam_list').mouseleave(function(){
                $(this).hide();
                $('.family').css('border-radius','4px 4px 4px 4px');
                $('.family .fa_title span').removeClass('show');
                family_cnt=0;
            });
        } else if(family_cnt==2){
            $('.family .fam_list').hide();
            $('.family').css('border-radius','4px 4px 4px 4px');
            $('.family .fa_title span').removeClass('show');
        };
        
    });
	//tab키 처리
	  $('.family .fa_title').bind('focus', function (e) {  
            e.preventDefault();
            $('.family').css('border-radius','0 0 4px 4px');
            $('.family .fam_list').show();
       });
       $('.family .fa_title li:last').find('a').bind('blur', function (e) {   
            e.preventDefault();
            $('.family').css('border-radius','4px 4px 4px 4px');
            $('.family .fam_list').hide();
       });  
});