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