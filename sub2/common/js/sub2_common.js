$(document).ready(function(){    
    $('.title_area a').click(function(e){
        e.preventDefault();
        var stat_on = $(this).index('.link');
        
        $('.title_area ul li').removeClass('current');
        $('.title_area ul li:eq('+stat_on+')').addClass('current');

    });
});