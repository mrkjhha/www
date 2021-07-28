$(document).ready(function(){    
    $('.title_area a').click(function(e){
        e.preventDefault();
        var stat_on = $(this).index('.link');
        
        $('.title_area ul li').removeClass('current');
        $('.title_area ul li:eq('+stat_on+')').addClass('current');

    });
});

$(document).ready(function(){    
    $('.h_timeline a').click(function(e){
        e.preventDefault();
        var h_stat = $(this).index('.h_link');
        
        $('.h_timeline li a').removeClass('current');
        $('.h_timeline li:eq('+h_stat+') a').addClass('current');
    });
});