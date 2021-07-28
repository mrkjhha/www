$(document).ready(function(){
    
    $('.gnb_dropmenu').hover(
        function(){
            $('.menu .depth_menu').fadeIn('fast')
            $('#headerArea').animate({height:381},'fast').clearQueue();
        },function(){
            $('.menu .depth_menu').hide();
            $('#headerArea').animate({height:186},'fast').clearQueue();
    });
    
    //tab
    $('ul.gnb_dropmenu .menu h3 a').on('focus',function(){
        $('#headerArea').animate({height:381},'fast').clearQueue();
        $('.menu .depth_menu').fadeIn('fast')
    });

    $('ul.gnb_dropmenu .dropmenu_6 li a').on('focus',function(){
        $('#headerArea').animate({height:381},'fast').clearQueue();
        $('.menu .depth_menu').fadeIn('fast')
    });

    $('ul.gnb_dropmenu .dropmenu_6 li:last').find('a').on('blur',function(){
        $('#headerArea').animate({height:186},'fast').clearQueue();
        $('.menu .depth_menu').hide();
    });
});

family_cnt=0;
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