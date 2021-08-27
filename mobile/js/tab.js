$(document).ready(function(){

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
});